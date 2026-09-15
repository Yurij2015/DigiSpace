---
type: Runbook
title: "GitHub Variables & Secrets — setup commands (`gh` CLI)"
description: "Commands to create the testing/production environments and populate every Variable/Secret read by deploy.yml. Placeholders only — real values are never stored in the repository."
tags: [deployment, github-actions, runbook]
status: stable
stale_after: 2027-03-15
---

# GitHub Variables & Secrets — setup commands (`gh` CLI)

Everything `.github/workflows/deploy.yml` reads is listed here. Values in angle brackets are
placeholders: take them from the current server `.env` (`<base>/.env`) and from CloudPanel — never
commit them, never paste them into issues, PRs or chat. Keys not set fall back to the defaults in
`.github/scripts/compose-env.sh`.

## Prerequisites

```bash
gh auth status                       # must be admin on the repo, scopes: repo, workflow
REPO=<owner>/DigiSpace
```

## 0. Current state and how to fill in real values

Environments `testing`/`production`, `DEPLOYMENT_MATRIX` (testing entry real, production entry
disabled with placeholders), all repository-level defaults, every per-environment Variable and every
Secret already exist — Secrets hold `REPLACE_ME_<KEY>`, Variables that need a real value hold
`<placeholder>`. `gh variable set` / `gh secret set` overwrite, so filling in is the same command
as creating. Find what is still a placeholder with:

```bash
gh variable list --repo "$REPO"                  | grep -E '<|REPLACE_ME'
gh variable list --repo "$REPO" --env testing    | grep -E '<|REPLACE_ME'
gh variable list --repo "$REPO" --env production | grep -E '<|REPLACE_ME'
# secrets cannot be read back; treat every one in §6 as REPLACE_ME until you have set it
```

Fill a whole environment from a copy of the server `.env` (values never leave your terminal —
the file is read line by line, keys not used by the workflow are ignored):

```bash
E=testing
ENV_FILE=/path/to/copy-of-server.env      # e.g. scp'ed from <base>/.env; delete it afterwards
SECRET_KEYS="APP_KEY DB_PASSWORD AWS_SECRET_ACCESS_KEY MAIL_PASSWORD RECAPTCHA_SECRET_KEY ZOHO_CLIENT_SECRET ZOHO_GRANT_TOKEN TINY_MCE_API_KEY SENTRY_LARAVEL_DSN"
ENV_VAR_KEYS="APP_ENV APP_DEBUG APP_URL LOG_LEVEL DB_DATABASE DB_USERNAME AWS_ACCESS_KEY_ID MINIO_BUCKET RECAPTCHA_SITE_KEY FILAMENT_ADMIN_EMAILS IS_PROMO_TAB_ACTIVE"
REPO_VAR_KEYS="APP_NAME LOG_CHANNEL CACHE_DRIVER QUEUE_CONNECTION SESSION_DRIVER SESSION_LIFETIME FILESYSTEM_DISK DB_HOST DB_PORT MAIL_MAILER MAIL_HOST MAIL_PORT MAIL_USERNAME MAIL_ENCRYPTION MAIL_FROM_ADDRESS AWS_DEFAULT_REGION AWS_USE_PATH_STYLE_ENDPOINT MINIO_ENDPOINT AWS_URL ZOHO_CLIENT_ID FACEBOOK_PIXEL_ID SENTRY_TRACES_SAMPLE_RATE"

get() { grep -E "^$1=" "$ENV_FILE" | head -1 | cut -d= -f2- | sed -e 's/^"//' -e 's/"$//'; }

for k in $SECRET_KEYS;  do v="$(get "$k")"; [ -n "$v" ] && printf '%s' "$v" | gh secret   set "$k" --repo "$REPO" --env "$E"; done
for k in $ENV_VAR_KEYS; do v="$(get "$k")"; [ -n "$v" ] && gh variable set "$k" --repo "$REPO" --env "$E" --body "$v"; done
for k in $REPO_VAR_KEYS; do v="$(get "$k")"; [ -n "$v" ] && gh variable set "$k" --repo "$REPO" --body "$v"; done   # shared defaults — run once, from the testing file
```

Single values by hand:

```bash
gh variable set APP_URL --repo "$REPO" --env testing --body "https://<TEST_DOMAIN>"
printf '%s' "<value>" | gh secret set DB_PASSWORD --repo "$REPO" --env testing
```

## 1. Environments

```bash
gh api --method PUT "repos/$REPO/environments/testing"    --silent
gh api --method PUT "repos/$REPO/environments/production" --silent
# Recommended: require a reviewer for production (Settings → Environments → production → Required reviewers)
```

## 2. `DEPLOYMENT_MATRIX` (repository Variable)

One entry per server; `environment` decides which branch deploys it (`dev` → `testing`,
`master` → `production`), `enabled: false` parks an entry, `php_binary` is the CLI used for
`artisan` on that host (CloudPanel: `/usr/bin/php8.3`). Shape and placeholder values:
[`example.deployment-config.json`](../../example.deployment-config.json).

```bash
gh variable set DEPLOYMENT_MATRIX --repo "$REPO" --body '[
  {"name":"test-cloudpanel","ip":"<TEST_IP>","port":"<TEST_SSH_PORT>","username":"<TEST_SITE_USER>","path":"/home/<TEST_SITE_USER>/htdocs/<TEST_DOMAIN>","environment":"testing","enabled":true,"php_binary":"/usr/bin/php8.3"},
  {"name":"prod-cloudpanel","ip":"<PROD_IP>","port":"<PROD_SSH_PORT>","username":"<PROD_SITE_USER>","path":"/home/<PROD_SITE_USER>/htdocs/<PROD_DOMAIN>","environment":"production","enabled":false,"php_binary":"/usr/bin/php8.3"}
]'
```

## 3. `SSH_KEY_2` (Secret)

Private key whose public half is in `~/.ssh/authorized_keys` of each site user. The name is kept
from the previous workflow so the existing repository secret keeps working. One repository-level
secret is enough when both hosts accept the same key; set it per environment to use different keys.

```bash
gh secret set SSH_KEY_2 --repo "$REPO" < ~/.ssh/<deploy-key>            # repository-level (already set)
# or per environment:
gh secret set SSH_KEY_2 --repo "$REPO" --env testing    < ~/.ssh/<test-deploy-key>
gh secret set SSH_KEY_2 --repo "$REPO" --env production < ~/.ssh/<prod-deploy-key>
```

## 4. Repository-level Variables (shared defaults, override per environment when needed)

```bash
gh variable set APP_NAME                    --repo "$REPO" --body "DigiSpace"
gh variable set LOG_CHANNEL                 --repo "$REPO" --body "stack"
gh variable set CACHE_DRIVER                --repo "$REPO" --body "file"
gh variable set QUEUE_CONNECTION            --repo "$REPO" --body "sync"
gh variable set SESSION_DRIVER              --repo "$REPO" --body "file"
gh variable set SESSION_LIFETIME            --repo "$REPO" --body "120"
gh variable set FILESYSTEM_DISK             --repo "$REPO" --body "local"
gh variable set DB_HOST                     --repo "$REPO" --body "127.0.0.1"
gh variable set DB_PORT                     --repo "$REPO" --body "3306"
gh variable set MAIL_MAILER                 --repo "$REPO" --body "<smtp|mailgun|log>"
gh variable set MAIL_HOST                   --repo "$REPO" --body "<MAIL_HOST>"
gh variable set MAIL_PORT                   --repo "$REPO" --body "<MAIL_PORT>"
gh variable set MAIL_USERNAME               --repo "$REPO" --body "<MAIL_USERNAME or null>"
gh variable set MAIL_ENCRYPTION             --repo "$REPO" --body "tls"
gh variable set MAIL_FROM_ADDRESS           --repo "$REPO" --body "<noreply@domain>"
gh variable set AWS_DEFAULT_REGION          --repo "$REPO" --body "<region>"
gh variable set AWS_USE_PATH_STYLE_ENDPOINT --repo "$REPO" --body "true"
gh variable set MINIO_ENDPOINT              --repo "$REPO" --body "<https://minio-endpoint>"
gh variable set AWS_URL                     --repo "$REPO" --body "<https://minio-public-url>"
gh variable set ZOHO_CLIENT_ID              --repo "$REPO" --body "<ZOHO_CLIENT_ID>"
gh variable set FACEBOOK_PIXEL_ID           --repo "$REPO" --body "<FACEBOOK_PIXEL_ID>"
gh variable set SENTRY_TRACES_SAMPLE_RATE   --repo "$REPO" --body "0.2"
```

## 5. Environment `testing` — Variables

```bash
E=testing
gh variable set APP_ENV               --repo "$REPO" --env "$E" --body "testing"
gh variable set APP_DEBUG             --repo "$REPO" --env "$E" --body "false"
gh variable set APP_URL               --repo "$REPO" --env "$E" --body "https://<TEST_DOMAIN>"
gh variable set LOG_LEVEL             --repo "$REPO" --env "$E" --body "debug"
gh variable set DB_DATABASE           --repo "$REPO" --env "$E" --body "<TEST_DB_NAME>"
gh variable set DB_USERNAME           --repo "$REPO" --env "$E" --body "<TEST_DB_USER>"
gh variable set AWS_ACCESS_KEY_ID     --repo "$REPO" --env "$E" --body "<MINIO_ACCESS_KEY>"
gh variable set MINIO_BUCKET          --repo "$REPO" --env "$E" --body "<TEST_BUCKET>"
gh variable set RECAPTCHA_SITE_KEY    --repo "$REPO" --env "$E" --body "<RECAPTCHA_SITE_KEY>"
gh variable set FILAMENT_ADMIN_EMAILS --repo "$REPO" --env "$E" --body "<admin@domain,other@domain>"
gh variable set IS_PROMO_TAB_ACTIVE   --repo "$REPO" --env "$E" --body "false"
# Optional extra shell around activation (runs on the server with set -euo pipefail):
# gh variable set DEPLOY_BEFORE_HOOKS --repo "$REPO" --env "$E" --body ''
# gh variable set DEPLOY_AFTER_HOOKS  --repo "$REPO" --env "$E" --body ''
```

## 6. Environment `testing` — Secrets

```bash
E=testing
printf '%s' "<APP_KEY base64:...>"    | gh secret set APP_KEY               --repo "$REPO" --env "$E"
printf '%s' "<DB_PASSWORD>"           | gh secret set DB_PASSWORD           --repo "$REPO" --env "$E"
printf '%s' "<MINIO_SECRET_KEY>"      | gh secret set AWS_SECRET_ACCESS_KEY --repo "$REPO" --env "$E"
printf '%s' "<MAIL_PASSWORD or null>" | gh secret set MAIL_PASSWORD         --repo "$REPO" --env "$E"
printf '%s' "<RECAPTCHA_SECRET_KEY>"  | gh secret set RECAPTCHA_SECRET_KEY  --repo "$REPO" --env "$E"
printf '%s' "<ZOHO_CLIENT_SECRET>"    | gh secret set ZOHO_CLIENT_SECRET    --repo "$REPO" --env "$E"
printf '%s' "<ZOHO_GRANT_TOKEN>"      | gh secret set ZOHO_GRANT_TOKEN      --repo "$REPO" --env "$E"
printf '%s' "<TINY_MCE_API_KEY>"      | gh secret set TINY_MCE_API_KEY      --repo "$REPO" --env "$E"
printf '%s' "<SENTRY_LARAVEL_DSN>"    | gh secret set SENTRY_LARAVEL_DSN    --repo "$REPO" --env "$E"
```

## 7. Environment `production`

Same keys as §5–§6 with `E=production` and production values (`APP_ENV=production`,
`LOG_LEVEL=error`, production domain, database, bucket, reCAPTCHA keys, admin e-mails). Then enable
the matrix entry (`"enabled":true` in §2) and run the first deploy through
`gh workflow run deploy.yml --ref master -f environment=production`.

## 8. Verify

```bash
gh variable list --repo "$REPO"
gh variable list --repo "$REPO" --env testing
gh secret   list --repo "$REPO" --env testing
# every key below must be covered by §2–§7:
grep -oE "(vars|secrets)\.[A-Z_]+" .github/workflows/deploy.yml | sort -u
```

## 9. Manual runs

```bash
gh workflow run deploy.yml --ref dev    -f environment=testing
gh workflow run deploy.yml --ref master -f environment=production
gh run watch
```

## 10. Retire the legacy secrets

After both environments have deployed successfully, delete the secret the old workflow no longer needs
(`SSH_KEY_2` stays — it is the deploy key):

```bash
gh secret delete LARAVEL_ENV --repo "$REPO"
```
