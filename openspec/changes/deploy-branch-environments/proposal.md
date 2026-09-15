---
type: Change Proposal
title: "Proposal — branch-driven deployments to separate test and production environments"
description: "Rework deploy.yml after the digispace-core-api pipeline: dev → testing server, master → production server, server matrix and .env sourced from GitHub Variables/Secrets per environment, tests gate every deploy."
tags: [proposal, deployment, github-actions, environments]
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
  - id: phpunit
    resource: repo://phpunit.xml
---

## Why

Today one workflow deploys every push to `master` to whatever is in the committed `deployment-config.json` — which currently holds only the CloudPanel **testing** target and real server addresses/users/paths — so there is no way to deploy to test from `dev`, production cannot be deployed at all without editing a tracked file, and the server `.env` silently overrides the `LARAVEL_ENV` secret. `digispace-core-api` already runs the pattern we want (branch → GitHub Environment, matrix and configuration in GitHub Variables/Secrets, tests gate, health check); this change ports it to DigiSpace's CloudPanel/SSH hosting.

## What Changes

- **Branch → environment routing**: push to `dev` deploys the `testing` environment, push to `master` deploys `production`; any other branch does nothing. `workflow_dispatch` with an `environment` input (`testing` / `production` / `all`) remains an explicit escape hatch. One deploy per environment at a time (concurrency group), never cancelling an in-flight production run.
- **Server matrix out of the repository**: `deployment-config.json` is deleted from git and replaced by the `DEPLOYMENT_MATRIX` repository Variable (JSON array with `name`, `ip`, `port`, `username`, `path`, `environment`, `enabled`, `php_binary`). A composite action `.github/actions/export-deploy-matrix` (same contract as core-api, `master` instead of `main`) filters it by branch/dispatch input. `example.deployment-config.json` is updated to the new schema. **BREAKING** for operators: the old JSON file and its `beforeHooks`/`afterHooks` fields are no longer read.
- **`.env` generated from GitHub Environments**: each deploy writes `<base>/.env` from Environment-scoped Variables (non-secret: `APP_NAME`, `APP_URL`, `DB_HOST`, `MINIO_*`, `RECAPTCHA_SITE_KEY`, `FILAMENT_ADMIN_EMAILS`, `IS_PROMO_TAB_ACTIVE`, `FACEBOOK_PIXEL_ID`, …) and Secrets (`APP_KEY`, `DB_PASSWORD`, `AWS_SECRET_ACCESS_KEY`, `ZOHO_*`, `RECAPTCHA_SECRET_KEY`, `MAIL_PASSWORD`, `SENTRY_LARAVEL_DSN`, `TINY_MCE_API_KEY`). GitHub becomes the source of truth; the previous file is kept as `.env_prev` for rollback. **BREAKING** for operators: `LARAVEL_ENV` and the "server `.env` wins" restore step are removed.
- **Test gate**: a `tests` job (PHPUnit on `ubuntu-latest` with a MySQL 8 service, `testing` database, `withoutVite`) must pass before any server job runs — on `dev` *and* `master`.
- **Standardised after-deploy**: the per-server hook strings are replaced by a versioned script `.github/scripts/after-deploy.sh` run over SSH: `artisan migrate --force`, `livewire:publish --assets`, `config:cache`, `view:cache`, opcache-safe PHP-FPM reload if available, using the matrix `php_binary`. Optional extra commands stay possible through `DEPLOY_BEFORE_HOOKS` / `DEPLOY_AFTER_HOOKS` Environment Variables.
- **Health gate**: after activation the workflow requests `APP_URL` (and `/control/login`) and fails the run on a non-200 — a failed health check leaves `current` on the new release but marks the run red so the rollback procedure is applied deliberately.
- **Kept**: SSH/SCP transport (`appleboy/*` pinned to a tagged version instead of `@master`), release/`current` symlink layout, shared `storage`, backup/restore of `public/images`, `public/uploads`, `public/banners`, prune to the newest five releases and artifacts (the `ARTIFACTS_PATH` env omission is fixed).
- **Docs**: `docs/deployment/README.md` rewritten for the new flow; new `docs/deployment/github-setup-commands.md` with the `gh` commands to create environments, variables and secrets (placeholders only).

## Capabilities

### New Capabilities
- `deployment/environment-routing`: which branch or manual input deploys which environment, how the server matrix is sourced and filtered, and the concurrency guarantees.
- `deployment/release-pipeline`: what a deployment run must do end-to-end on a target server — build artifact, test gate, generated `.env`, release layout and persistence of local images, after-deploy steps, health gate, cleanup.

### Modified Capabilities
<!-- None of the existing specs (admin/, architecture/) define deployment behaviour. -->

## Impact

- `.github/workflows/deploy.yml` (rewritten), new `.github/actions/export-deploy-matrix/action.yml`, new `.github/scripts/after-deploy.sh`, `deployment-config.json` removed from git (kept locally via `.gitignore`), `example.deployment-config.json` updated.
- `tests/TestCase.php` gains `withoutVite()` so the Breeze/Inertia pages render in CI without a Vite build; `phpunit.xml` unchanged (it already pins `DB_DATABASE=testing`).
- GitHub repository settings (operator task, not code): environments `testing` and `production`, repository Variables `DEPLOYMENT_MATRIX` + shared defaults, per-environment Variables/Secrets listed above, `SSH_KEY_2` secret (reused). Production environment can carry a required-reviewer rule later without workflow changes.
- Servers: no new software. The generated `.env` must reproduce every value currently on each server before the first run (one-time migration of values into GitHub, verified by diffing `.env_prev`).
- `docs/deployment/README.md`, `CLAUDE.md` deployment paragraph, `docs/local-setup.md` mention of the config file.
- Not affected: application code, database schema, admin surfaces, the `copilot-setup-steps.yml` workflow.
