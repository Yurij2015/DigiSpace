---
type: Design
title: "Design — branch-driven deployments on CloudPanel via SSH"
description: "How the digispace-core-api pipeline is ported to DigiSpace: same job graph and GitHub configuration model, SSH/SCP transport instead of self-hosted Docker runners."
tags: [design, deployment, github-actions, cloudpanel]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: workflow
    resource: repo://.github/workflows/deploy.yml
  - id: example-config
    resource: repo://example.deployment-config.json
  - id: deployment-docs
    resource: repo://docs/deployment/README.md
  - id: testing-docs
    resource: repo://docs/testing.md
  - id: test-case
    resource: repo://tests/TestCase.php
  - id: gitignore
    resource: repo://.gitignore
---

## Context

See `proposal.md` — Why. Observed state that shapes the approach:

- Current `deploy.yml`: `push: [master]` only, `ubuntu-latest` runners, `appleboy/scp-action@master` + `appleboy/ssh-action@master` with `secrets.SSH_KEY_2`, matrix read from the committed `deployment-config.json` (real IP/user/path; only the testing CloudPanel target is present), `.env` written from `secrets.LARAVEL_ENV` then immediately overwritten by `.env_prev`, image dirs backed up/restored, per-server `afterHooks` string (`/usr/bin/php8.3 …/artisan migrate && … livewire:publish --assets`, no `--force`), cleanup step declares `ARTIFACTS_PATH` but does not pass it to SSH.
- Reference (`digispace-core-api`): `push: [main, dev]` + `workflow_dispatch(environment)`, `DEPLOYMENT_MATRIX` repo Variable filtered by `.github/actions/export-deploy-matrix`, jobs run **on self-hosted runners on the target hosts** and act on the local filesystem with Docker; `.env` composed from `vars.*`/`secrets.*` with `get_val` defaults; `tests` job gates `dev`; `after-deploy.sh` restarts containers; health check through the proxy; prune to five.
- DigiSpace hosts are CloudPanel VMs (PHP-FPM, no Docker, SSH on a forwarded port behind Proxmox, fail2ban — see `docs/deployment/README.md`). The user chose to keep SSH/SCP transport, generate `.env` from GitHub Environments, and gate `dev` and `master` with tests.
- Tests: PHPUnit 11, MySQL-only SQL in `BlogRepository`, `phpunit.xml` pins `DB_DATABASE=testing` but takes `DB_HOST/USER/PASSWORD` from `.env`; Breeze auth tests render `app.blade.php` with `@vite`, so CI without a build needs `withoutVite()`. Suite currently: 64 tests, ~1 min locally.
- Route `locale.switch` is a closure → `route:cache` is impossible; `config:cache` and `view:cache` are safe.
- Branch names in this repository are `master` and `dev` (the reference uses `main`).

## Goals / Non-Goals

**Goals:**
- Same mental model as core-api for operators: one workflow, `DEPLOYMENT_MATRIX`, per-environment Variables/Secrets, `gh` setup runbook.
- Zero new software on the servers; the only server-side prerequisites stay PHP 8.3 CLI + SSH.
- A run is red whenever the site is not actually serving the new release.

**Non-Goals:**
- Self-hosted runners, Docker, Caddy — the servers are CloudPanel.
- Zero-downtime guarantees beyond the existing symlink switch (opcache reload is best-effort).
- Automated rollback job (documented manual procedure stays; `.env_prev` + previous release directory make it possible).
- Database backups before migrate (separate change; core-api has `db-backup.yml` as a template).
- Migrating `public/uploads`/`banners` to S3 (would remove the backup/restore dance; out of scope).

## Decisions

### D1 — Keep the core-api job graph, swap the execution layer for SSH
Jobs: `create-deployment-artifacts` → `tests` → `prepare-release-on-servers` → `create-env-file` → `run-before-hooks` → `activate-release` → `run-after-hooks` (incl. health check) → `clean-up`, each server job `runs-on: ubuntu-latest`, `environment: ${{ matrix.server.environment }}`, matrix from `fromJson(needs.create-deployment-artifacts.outputs.DEPLOYMENT_MATRIX)`. Every server step is an `appleboy/ssh-action` (or `scp-action`) call with `host/port/username` from the matrix and `key: ${{ secrets.SSH_KEY }}` (Environment secret first, repo secret fallback — GitHub resolves that automatically).

- Why not one job with a loop: per-job `environment:` is what scopes Variables/Secrets and enables protection rules; the matrix fan-out is also what core-api operators already read.
- Pin `appleboy/ssh-action@v1` and `appleboy/scp-action@v1` (currently `@master`, which is unpinned and has broken before).
- `if:` guards copied from core-api (`!cancelled() && needs.<prev>.result == 'success'`) so a skipped/failed upstream never silently activates a release.

### D2 — Branch mapping and dispatch in a composite action, `master` not `main`
Copy `.github/actions/export-deploy-matrix/action.yml` from core-api with the `case` changed to `master) TARGET_ENV=production`, `dev) TARGET_ENV=testing`. Trigger: `push: branches: [master, dev]` + `workflow_dispatch` with the `environment` choice. Feature branches never trigger the workflow (spec: "no run is started"), so the action's "not mapped" error only protects against misconfiguration.

Alternative rejected: two workflows (`deploy-test.yml`, `deploy-prod.yml`) — duplicates 200 lines and drifts; the matrix filter is the single point of truth.

### D3 — Matrix schema: core-api fields + `php_binary`, hooks move to Variables
`DEPLOYMENT_MATRIX` entry: `{name, ip, port, username, path, environment, enabled, php_binary}`. `php_binary` (default `php`) replaces the hard-coded `/usr/bin/php8.3` in hook strings; CloudPanel entries set it explicitly. `beforeHooks`/`afterHooks` fields are dropped; optional extras go to `DEPLOY_BEFORE_HOOKS` / `DEPLOY_AFTER_HOOKS` Environment Variables (eval'd with `set -euo pipefail`, same as core-api). `deployment-config.json` is `git rm`'d and added to `.gitignore` (next to the already-ignored `deployment-config-with-prod.json`) so a local copy can stay for reference; `example.deployment-config.json` shows the new shape with `203.0.113.x` placeholder IPs.

### D4 — Concurrency
`concurrency: { group: deploy-${{ github.event_name == 'workflow_dispatch' && inputs.environment || github.ref_name }}, cancel-in-progress: ${{ github.ref_name == 'dev' }} }` at workflow level. Testing runs may be superseded; production runs queue.

### D5 — `.env` generation: core-api's `get_val` block, DigiSpace key set, written over SSH
`create-env-file` job composes the file on the runner (heredoc into a shell variable, same `get_val "${{ vars.X }}" "default"` pattern) and ships it with `appleboy/ssh-action` `envs: ENV_FILE` + `printf '%s' "$ENV_FILE" > "$BASE_PATH/.env"` after `cp -a .env .env_prev`. Key inventory (from `config/*.php` `env()` calls and the current server file):

| Variables (per environment) | Secrets (per environment) | Repo-level defaults |
|---|---|---|
| `APP_NAME`, `APP_ENV`, `APP_URL`, `APP_DEBUG`, `LOG_LEVEL`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `MINIO_ENDPOINT`, `AWS_URL`, `MINIO_BUCKET`, `AWS_ACCESS_KEY_ID`, `AWS_DEFAULT_REGION`, `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_FROM_ADDRESS`, `RECAPTCHA_SITE_KEY`, `ZOHO_CLIENT_ID`, `FACEBOOK_PIXEL_ID`, `FILAMENT_ADMIN_EMAILS`, `IS_PROMO_TAB_ACTIVE`, `SENTRY_TRACES_SAMPLE_RATE` | `APP_KEY`, `DB_PASSWORD`, `AWS_SECRET_ACCESS_KEY`, `MAIL_PASSWORD`, `RECAPTCHA_SECRET_KEY`, `ZOHO_CLIENT_SECRET`, `ZOHO_GRANT_TOKEN`, `TINY_MCE_API_KEY`, `SENTRY_LARAVEL_DSN`, `SSH_KEY` | `LOG_CHANNEL=stack`, `CACHE_DRIVER=file`, `QUEUE_CONNECTION=sync`, `SESSION_DRIVER=file`, `FILESYSTEM_DISK=local`, `AWS_USE_PATH_STYLE_ENDPOINT=true`, `BROADCAST_DRIVER=log` |

`APP_KEY` and `DB_PASSWORD` are asserted non-empty before writing (spec "Missing APP_KEY"). Secrets pass through `envs:` of the SSH action, never through `script:` interpolation, so they are masked in logs.

Alternative rejected: keep `LARAVEL_ENV` as one blob per environment — works, but cannot be diffed/rotated per key and is exactly what drifted from the servers today.

### D6 — Tests job on `ubuntu-latest` with a MySQL 8 service
`services.mysql: image: mysql:8.0`, `MYSQL_DATABASE=testing`, root password, health check via `mysqladmin ping`; `.env` for the job: `DB_HOST=127.0.0.1`, `DB_USERNAME=root`, `DB_PASSWORD=<service pw>`, `APP_KEY` generated by `artisan key:generate`. Composer **with** dev dependencies (separate from the `--no-dev` build). `tests/TestCase.php::setUp()` calls `$this->withoutVite()` so no `npm run build` is needed in this job. Runs on every trigger (`if:` not branch-gated), server jobs `needs: [create-deployment-artifacts, tests]`.

Trade-off: build and tests install Composer twice (~1 min extra) but stay independent and parallel; cache `~/.composer/cache` with `actions/cache` keyed on `composer.lock`.

### D7 — `after-deploy.sh` executed over SSH instead of hook strings
`.github/scripts/after-deploy.sh` is `scp`'d into `<base>/artifacts/` with the tarball and executed as `PHP_BINARY=<matrix php_binary> BASE_PATH=<path> bash after-deploy.sh`: `cd current && $PHP_BINARY artisan migrate --force && $PHP_BINARY artisan livewire:publish --assets && $PHP_BINARY artisan config:cache && $PHP_BINARY artisan view:cache`, then `sudo -n systemctl reload php8.3-fpm 2>/dev/null || $PHP_BINARY artisan optimize:clear >/dev/null || true` (opcache: best effort; CloudPanel site users usually cannot reload FPM — documented). No `route:cache` (closure route).

### D8 — Health check from the runner
`curl -sS -o /dev/null -w '%{http_code}' --max-time 15 "$APP_URL"` and `"$APP_URL/control/login"`, three attempts with 5 s sleeps; non-200 → `exit 1`. Runs from the GitHub runner (public HTTPS), so it also proves DNS/TLS, not just PHP-FPM.

### D9 — Persistence of local image directories stays as is
Backup before activation → restore after activation is kept verbatim (it is the only thing protecting `public/uploads`/`banners`, which are not in git and not on S3); the restore step now uses `mkdir -p` on the destination first (audit note in docs: "missing destination directories can affect image copying").

### D10 — Documentation and secrets hygiene
`docs/deployment/README.md` rewritten around the new flow; `docs/deployment/github-setup-commands.md` lists `gh api`/`gh variable set`/`gh secret set` commands with `<placeholders>` — never real values or server addresses (CLAUDE.md rule). `CLAUDE.md` deployment paragraph and `docs/local-setup.md` updated to stop mentioning `deployment-config.json`. `SSH_KEY_2` is kept readable as a fallback for one release, then removed from the workflow.

## Risks / Trade-offs

- [Generated `.env` misses a value that exists only on the server today] → first run per environment is done with `workflow_dispatch` after `.env_prev` is diffed against the generated file on the server; the operator runbook lists the exact `diff` command. Nothing is destroyed: `.env_prev` is restorable by hand.
- [Secrets leak through `${{ }}` interpolation into `script:`] → all secret-bearing values go through `envs:`; the workflow is reviewed for any `secrets.*` inside `script:` or `run:` echo.
- [Tests job flaky on MySQL service start] → `options: --health-cmd "mysqladmin ping"` + `--health-retries 10`; suite is 64 tests, so retries are cheap.
- [`appleboy` pinned tag changes input names] → pin `@v1` (major), verify in the first dispatch run.
- [fail2ban on the CloudPanel VM bans the GitHub runner IP after a failed SSH] → unchanged from today; troubleshooting section retained.
- [PHP-FPM reload not permitted for the site user → stale opcache] → `config:cache`/`view:cache` still produce fresh files; document `opcache.revalidate_freq` / manual reload in CloudPanel; CloudPanel usually validates timestamps.
- [Production accidentally deployed from `dev` via dispatch] → the `production` GitHub Environment can require a reviewer; recommended in the runbook, not enforced by the workflow.

## Migration Plan

1. Operator (once, before merging): create environments, set `DEPLOYMENT_MATRIX` (testing entry from the current JSON with `environment: testing`, `php_binary: /usr/bin/php8.3`; production entry with `enabled: false` until values are ready), set Variables/Secrets per environment from the live server `.env` files, set `SSH_KEY` (same key as `SSH_KEY_2`).
2. Merge to `dev` → run deploys testing. Verify: `diff <base>/.env_prev <base>/.env` on the test server shows only intended changes; health check green; `/control/login` 200; Livewire assets 200.
3. Enable the production entry, run `workflow_dispatch environment=production` from `master` (or merge `dev` → `master`). Same verification on production.
4. Rollback of the workflow itself: revert the commit — the old workflow still needs `deployment-config.json`, which is kept locally (ignored) and can be re-added temporarily. Rollback of a release: unchanged manual procedure (`current` → previous release, `.env_prev` → `.env` if config changed).

## Open Questions

- Does the CloudPanel site user have `sudo -n systemctl reload php8.3-fpm`? Only affects whether the opcache reload line is a no-op; the run does not depend on it.
- Should `production` get a required reviewer from day one? Pure GitHub setting; recommended in the runbook, no workflow impact.
