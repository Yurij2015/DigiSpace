---
type: Guide
title: "Deployment"
description: "GitHub Actions release flow: dev → testing, master → production, servers and configuration in GitHub Variables/Secrets, SSH release-symlink layout on CloudPanel, health gate and rollback."
tags: [deployment, github-actions, cloudpanel, environments]
status: stable
stale_after: 2027-03-15
---

# Deployment

Source of truth: [`deploy.yml`](../../.github/workflows/deploy.yml), the composite action
[`export-deploy-matrix`](../../.github/actions/export-deploy-matrix/action.yml) and the scripts in
[`.github/scripts/`](../../.github/scripts/). Nothing about the servers lives in the repository:
addresses, users, paths, `.env` values and hooks are GitHub Variables/Secrets — see
[github-setup-commands.md](github-setup-commands.md) for the `gh` runbook.

## Triggers and environments

| Event | Environment | Servers deployed |
|---|---|---|
| push to `dev` | `testing` | matrix entries with `environment: testing` |
| push to `master` | `production` | matrix entries with `environment: production` |
| `workflow_dispatch` (`environment` input) | as chosen: `testing`, `production`, `all` | input wins over the branch mapping — the hotfix escape hatch |
| push to any other branch | — | no run |

Runs are serialised per environment (`concurrency: deploy-<env>`); a newer `dev` push cancels a
still-running testing deploy, production runs queue and are never cancelled. Every server job runs
inside the GitHub Environment of its matrix entry, so Variables/Secrets resolve per environment and
protection rules (required reviewers, wait timer) can be added on `production` without touching the
workflow.

## GitHub configuration model

- **`DEPLOYMENT_MATRIX`** (repository Variable) — JSON array; see
  [`example.deployment-config.json`](../../example.deployment-config.json) for the shape:
  `name`, `ip`, `port`, `username`, `path`, `environment`, `enabled`, `php_binary`
  (CloudPanel: `/usr/bin/php8.3`). Disabled entries are skipped; an empty filtered matrix fails the
  run before anything is uploaded.
- **`SSH_KEY_2`** (Secret, repository-level or per environment) — private key for `username@ip:port`.
- **Environment Variables** — every non-secret `.env` key (`APP_URL`, `DB_HOST`, `MINIO_*`,
  `RECAPTCHA_SITE_KEY`, `FILAMENT_ADMIN_EMAILS`, `IS_PROMO_TAB_ACTIVE`, …) with defaults in
  [`compose-env.sh`](../../.github/scripts/compose-env.sh).
- **Environment Secrets** — `APP_KEY`, `DB_PASSWORD`, `AWS_SECRET_ACCESS_KEY`, `MAIL_PASSWORD`,
  `RECAPTCHA_SECRET_KEY`, `ZOHO_CLIENT_SECRET`, `ZOHO_GRANT_TOKEN`,
  `TINY_MCE_API_KEY`, `SENTRY_LARAVEL_DSN`. `APP_KEY` and `DB_PASSWORD` are mandatory.
- **`DEPLOY_BEFORE_HOOKS` / `DEPLOY_AFTER_HOOKS`** (optional Environment Variables) — extra shell
  run on the server around activation, with `set -euo pipefail` semantics.

The old committed `deployment-config.json`, the `LARAVEL_ENV` blob and the "server `.env` wins"
restore step are gone: **GitHub is the source of truth for `.env`**, the previous file is kept on
the server as `.env_prev`.

## Job sequence

1. **Create deployment artifacts** (GitHub runner): PHP 8.3, Composer `--no-dev`, `npm ci && npm run build`,
   tarball of the tree without `.git`, `node_modules`, `storage`, `tests`; export the filtered matrix.
2. **PHPUnit suite** (GitHub runner, MySQL 8 service, `testing` database, Vite disabled through
   `tests/TestCase.php`): gates *every* deploy — `dev`, `master` and manual dispatches.
3. **Prepare release** (per server, SSH): upload the tarball and `after-deploy.sh` to `<base>/artifacts`,
   extract into `<base>/releases/<sha>`, drop its `storage`, create the shared `storage` tree.
4. **Write `.env`**: compose from Variables/Secrets on the runner, keep the current file as `.env_prev`
   and as a dated copy in `<base>/env-backups/` (ten newest), write `<base>/.env` (`umask 077`).
5. **Before hook**: copy `current/public/{images,uploads,banners}` to `<base>/backup_*`, then
   `DEPLOY_BEFORE_HOOKS`.
6. **Activate**: link `<base>/.env` and `<base>/storage` into the release, switch `<base>/current`.
7. **After hook**: restore the three image directories into the new release, run
   [`after-deploy.sh`](../../.github/scripts/after-deploy.sh) with the matrix `php_binary`
   (`migrate --force`, `livewire:publish --assets`, `config:cache`, `view:cache`, best-effort
   PHP-FPM reload — no `route:cache`, the app has a closure route), then `DEPLOY_AFTER_HOOKS`.
   **Health gate**: the runner requests `APP_URL/` and `APP_URL/control/login`; anything but 200
   after three attempts fails the run (`current` stays on the new release — decide on rollback
   deliberately).
8. **Clean up**: keep the five newest `releases/*` and `artifacts/*.tar.gz`; runs even when the
   deploy failed.

```text
<base>/
  .env            ← generated each deploy from GitHub
  .env_prev       ← previous .env (manual rollback of configuration)
  env-backups/    ← dated copies of .env from the last ten deploys
  storage/        ← shared
  artifacts/      ← <sha>.tar.gz (last 5) + after-deploy.sh
  releases/<sha>/
    .env    -> <base>/.env
    storage -> <base>/storage
    public/build/
    public/images/  public/uploads/  public/banners/   ← restored after activation
  current -> releases/<sha>
```

## One-off: seeding structure translations on a server

`StructureTranslationsSeeder` adds the uk/pl translations from `database/seeders/data/*.json` to
an already populated database — only missing locales, base columns untouched, editor changes
preserved, safe to repeat. Run it once per environment after the release that ships it, either
by hand over SSH (`<php_binary> <base>/current/artisan db:seed --class=StructureTranslationsSeeder --force`)
or for a single deploy through the environment Variable
`DEPLOY_AFTER_HOOKS="$PHP_BINARY $ACTIVE_RELEASE_PATH/artisan db:seed --class=StructureTranslationsSeeder --force"`
(remove the Variable afterwards). It prints a per-table summary (updated / unchanged / unmatched).

## Persistence boundaries

Only `.env`, shared `storage` and the three image directories are carried across releases. S3/MinIO
objects are external. Zoho's token/log files (`../zohoStore.txt`, `../php_sdk_log.log`, relative to
`public/`) and anything else written into the release root are **not** preserved. `.env_prev` and the
image copies are not database backups; there is no automatic DB backup before `migrate`.

## First run on an environment / verification checklist

1. Configure GitHub (runbook §1–§6), matrix entry `enabled: true`.
2. Trigger (`dev` push for testing, `workflow_dispatch environment=production` for the first production run).
3. On the server: `diff <base>/.env_prev <base>/.env` — only intended differences.
4. Health gate green; manually: home, blog, a `/pages/{slug}` page, `/control/login`,
   `/vendor/livewire/livewire.min.js` → 200; a local `uploads` image and an S3 image load;
   `storage/logs/laravel.log` clean; scheduler still configured.
5. Contact form only with an intended test submission — it writes a Zoho lead.

## Rollback procedure

There is no automated rollback job.

1. Identify the active release (`readlink <base>/current`) and an intact previous one under `releases/`.
2. Check migration compatibility: code rollback does not revert the database. Use a reviewed DB
   recovery plan for incompatible schema changes.
3. If configuration changed in the same deploy: `cp <base>/.env_prev <base>/.env`.
4. `ln -s -n -f <base>/releases/<previous-sha> <base>/current`, then
   `<php_binary> <base>/current/artisan config:cache && view:cache` and repeat the HTTP/log checks.
   Images restored into the failed release are still in the previous release directory (they are copied,
   not moved).
5. To roll the **workflow** back, revert the commit; the old workflow needs a local
   `deployment-config.json` (now git-ignored).

## SSH troubleshooting with Proxmox and CloudPanel

The testing target may be a CloudPanel VM behind Proxmox. In the current layout,
the public SSH endpoint is forwarded as:

```text
<PROXMOX_PUBLIC_IP>:2226 → Proxmox DNAT → <CLOUDPANEL_VM_IP>:22 (CloudPanel VM)
```

When deployment fails at the SCP/SSH upload step, check Hetzner and CloudPanel
firewalls, then verify the Proxmox DNAT and `FORWARD` rules, followed by `sshd`
and UFW inside the VM. Fail2ban on the VM can ban the Proxmox bridge address
(`<PROXMOX_BRIDGE_IP>`) after repeated failed login attempts. A ban produces SYN
packets in the VM's tcpdump with no SYN-ACK response and appears in:

```bash
sudo fail2ban-client status sshd
```

Run these two simple commands in the CloudPanel VM to unblock the Proxmox bridge
and add it to the running `sshd` jail's ignore list:

```bash
sudo fail2ban-client set sshd unbanip <PROXMOX_BRIDGE_IP>
sudo fail2ban-client set sshd addignoreip <PROXMOX_BRIDGE_IP>
```

The `unbanip` command takes effect immediately. The `addignoreip` command adds
the exception to the running jail; repeat it after a Fail2ban restart unless the
same address is also placed in the server's persistent Fail2ban configuration.
Verify both lists with:

```bash
sudo fail2ban-client get sshd banip
sudo fail2ban-client get sshd ignoreip
```

Do not disable Fail2ban globally.

Useful Proxmox checks:

```bash
sudo iptables -t nat -L PREROUTING -n -v | grep 2226
sudo iptables -L FORWARD -n -v | grep <CLOUDPANEL_VM_IP>
nc -vz <CLOUDPANEL_VM_IP> 22
```

Run VM-side checks from the CloudPanel console, not from the Proxmox host:

```bash
hostname
sudo ss -lntp | grep ':22'
sudo ufw status verbose
```
