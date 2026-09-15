---
type: Implementation Plan
title: "Tasks — branch-driven deployments to test and production"
description: "Ordered, verifiable steps to port the core-api pipeline to DigiSpace's CloudPanel/SSH hosting."
tags: [tasks, deployment, github-actions]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: proposal
    resource: repo://openspec/changes/deploy-branch-environments/proposal.md
  - id: design
    resource: repo://openspec/changes/deploy-branch-environments/design.md
  - id: reference-workflow
    resource: repo://docs/deployment/README.md
---

Workflow YAML is validated locally with `actionlint` (`brew install actionlint`) and shell with `shellcheck`; real behaviour is verified by running the workflow (`workflow_dispatch`) — tasks say which. Never paste server addresses, users, paths or secret values into files or chat; use `<placeholders>`.

## 1. Test suite ready for CI

- [x] 1.1 Add `$this->withoutVite();` to `tests/TestCase.php::setUp()` (create the method); verify the full suite still passes locally via Sail (`vendor/bin/sail exec -T digi-space-app vendor/bin/phpunit`) and that `AuthenticationTest` passes with `public/build` temporarily renamed.
- [x] 1.2 Write `.github/scripts/ci-env.sh` that produces the CI `.env` (copies `.env.example`, sets `DB_HOST=127.0.0.1`, `DB_DATABASE=testing`, `DB_USERNAME=root`, `DB_PASSWORD` from `$MYSQL_ROOT_PASSWORD`, `CACHE_DRIVER=array`, `SESSION_DRIVER=array`, `QUEUE_CONNECTION=sync`) and runs `php artisan key:generate --force`; verify with `shellcheck` and by running it locally against a throwaway copy of `.env`.

## 2. Matrix and branch routing

- [x] 2.1 Create `.github/actions/export-deploy-matrix/action.yml` (copy of the core-api composite action with `master → production`, `dev → testing`, `php_binary` documented in the input description); verify with `actionlint` and by running its script body locally with sample JSON for `master`, `dev`, `environment_override=all`, an empty matrix and `enabled:false` entries (expected outputs per spec `deployment/environment-routing`).
- [ ] 2.2 Update `example.deployment-config.json` to the new entry shape (`environment`, `enabled`, `php_binary`, placeholder `203.0.113.x` IPs, no hooks); `git rm --cached deployment-config.json` and add `/deployment-config.json` to `.gitignore`; verify `git ls-files | grep deployment-config` lists only the example file and `git status` shows the real file untracked-but-ignored.

## 3. Workflow rewrite (`.github/workflows/deploy.yml`)

- [x] 3.1 Triggers and top level: `push: branches: [master, dev]`, `workflow_dispatch` with `environment` choice (`production` default, `testing`, `all`), `permissions: contents: read`, concurrency group per environment with `cancel-in-progress` only for `dev` (design D4); verify with `actionlint`.
- [x] 3.2 `create-deployment-artifacts`: `actions/checkout@v4`, `shivammathur/setup-php@v2` (8.3, extensions from the current file) **before** Composer, `actions/setup-node@v4` (Node 20, npm cache), Composer `--no-dev` with `actions/cache`, `npm ci && npm run build`, tarball excluding `.git`, `node_modules`, `storage`, upload with `actions/upload-artifact@v4`, matrix export through the composite action from `vars.DEPLOYMENT_MATRIX`; verify with `actionlint` and a `workflow_dispatch` dry run once 3.7 exists.
- [x] 3.3 `tests` job (design D6): MySQL 8 service with health check, PHP 8.3, Composer with dev deps, `ci-env.sh`, `php artisan migrate --force` is **not** run (RefreshDatabase migrates), `vendor/bin/phpunit`; not branch-gated; verify the job passes on a `dev` push and that a deliberately failing test (temporary commit) blocks the server jobs.
- [x] 3.4 `prepare-release-on-servers`: `needs: [create-deployment-artifacts, tests]`, `environment: ${{ matrix.server.environment }}`, `appleboy/scp-action@v1` upload of tarball **and** `.github/scripts/after-deploy.sh` to `<path>/artifacts`, `appleboy/ssh-action@v1` extract with `set -euo pipefail`, shared `storage` dirs; verify with `actionlint`.
- [x] 3.5 `create-env-file` (design D5): compose `.env` on the runner from `vars.*`/`secrets.*` with `get_val` defaults and the key table from the design, fail if `APP_KEY` or `DB_PASSWORD` is empty, ship via `envs: ENV_FILE` and write `cp -a .env .env_prev || true; printf '%s' "$ENV_FILE" > .env`; verify with `actionlint`, `shellcheck` on the extracted script, and `grep -n 'secrets\.' deploy.yml` showing secrets only inside `env:`/`with: key:` blocks, never in `script:`.
- [x] 3.6 `run-before-hooks` (image backups + optional `vars.DEPLOY_BEFORE_HOOKS`), `activate-release` (link `.env` and `storage`, switch `current`; **no** `.env_prev` restore), `run-after-hooks` (restore images with `mkdir -p` targets, run `after-deploy.sh` with `PHP_BINARY`/`BASE_PATH`, optional `vars.DEPLOY_AFTER_HOOKS`), health check from the runner against `vars.APP_URL` and `/control/login` (design D8), `clean-up` with `ARTIFACTS_PATH` passed in `envs` and `if: !cancelled()`; verify with `actionlint`.
- [x] 3.7 Write `.github/scripts/after-deploy.sh` (design D7: migrate `--force`, `livewire:publish --assets`, `config:cache`, `view:cache`, best-effort FPM reload, `set -euo pipefail`); verify with `shellcheck` and by running it against the local Sail container (`PHP_BINARY=php BASE_PATH=/var/www/html` with `current` symlink simulated in a temp dir).
- [x] 3.8 Remove every reference to `deployment-config.json`, `LARAVEL_ENV`, `matrix.server.beforeHooks/afterHooks` and `SSH_KEY_2` from the workflow (keep `SSH_KEY_2` only as documented fallback if the operator prefers not to rename); verify `grep -n "LARAVEL_ENV\|deployment-config\|afterHooks\|SSH_KEY_2" .github/workflows/deploy.yml` returns nothing (or only the documented fallback line).

## 4. Documentation

- [x] 4.1 Rewrite `docs/deployment/README.md`: triggers and branch mapping, GitHub configuration model, job sequence, persistence, health gate, rollback, first-run verification (`diff .env_prev .env`), keep the Proxmox/fail2ban troubleshooting section; verify links resolve and no real address/user/path appears (`grep -nE "[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}|/home/" docs/deployment/README.md` shows only placeholders).
- [x] 4.2 Create `docs/deployment/github-setup-commands.md` with the `gh` commands: create environments, repo-level defaults, `DEPLOYMENT_MATRIX` template, per-environment Variables and Secrets for the key table in design D5, `SSH_KEY_2`; verify every key used by `deploy.yml` (`grep -oE "(vars|secrets)\.[A-Z_]+" .github/workflows/deploy.yml | sort -u`) appears in the runbook.
- [x] 4.3 Update `CLAUDE.md` (Deployment paragraph) and `docs/local-setup.md` / `docs/README.md` mentions of `deployment-config.json`; verify `grep -rn "deployment-config.json" CLAUDE.md docs` only points at the example file.

## 5. Rollout (operator steps, recorded here so the change is complete)

- [ ] 5.1 In GitHub: create `testing` and `production` environments, set `DEPLOYMENT_MATRIX` (testing enabled, production `enabled:false`), set Variables/Secrets for `testing` from the live server `.env`, set `SSH_KEY_2`; verify `gh variable list --env testing` and `gh secret list --env testing` show every key from the runbook.
- [ ] 5.2 Push the change to `dev`; verify the run: tests green, testing server deployed, `diff <base>/.env_prev <base>/.env` shows only intended differences, health check green, `/control/login` and `/vendor/livewire/*` return 200, an uploaded service image still loads.
- [ ] 5.3 Set production Variables/Secrets, set the production matrix entry `enabled:true`, run `workflow_dispatch environment=production` from `master` (or merge `dev → master`); verify the same checklist on production and that a `dev` push afterwards does not touch production.
- [ ] 5.4 Remove the `LARAVEL_ENV` secret from GitHub once both environments have deployed successfully; verify the next `dev` run is still green.
