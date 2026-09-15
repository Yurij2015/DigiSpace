---
type: Behaviour Spec
title: "Deployment — Release pipeline"
description: "What one deployment run must do on a target server: build artifact, test gate, generated .env, release layout, persistence of local images, after-deploy steps, health gate and cleanup."
tags: [deployment, github-actions, release, cloudpanel]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: workflow
    resource: repo://.github/workflows/deploy.yml
  - id: deployment-docs
    resource: repo://docs/deployment/README.md
  - id: testing-docs
    resource: repo://docs/testing.md
  - id: phpunit
    resource: repo://phpunit.xml
  - id: env-example
    resource: repo://.env.example
---

## Purpose

Guarantees that every release reaching a DigiSpace server was built once, passed the test suite, runs with configuration owned by GitHub, keeps the locally stored images, and is only reported green when the site actually answers.

## ADDED Requirements

### Requirement: Single build artifact
The run MUST build one tarball per commit on a GitHub-hosted runner (Composer `--no-dev`, `npm ci`, `npm run build`) and reuse that same artifact for every target server; it MUST exclude `.git`, `node_modules` and the local `storage` tree and include `vendor` and `public/build`.

#### Scenario: Two servers, one build
- **WHEN** the filtered matrix contains two servers
- **THEN** Composer and npm run once and both servers receive the tarball named after the commit SHA

### Requirement: Tests gate every deployment
The PHPUnit suite MUST run on a GitHub-hosted runner against a disposable MySQL 8 service using the `testing` database before any server job starts, for `dev`, `master` and manual dispatches alike. A failing suite MUST prevent every server job of that run.

#### Scenario: Red suite on master
- **WHEN** a commit on `master` fails a test
- **THEN** no artifact is uploaded to any server and the run is reported failed

#### Scenario: Suite does not need built assets
- **WHEN** the tests job runs without a Vite manifest
- **THEN** pages that reference Vite assets still render in tests

### Requirement: `.env` is generated from GitHub per environment
Before activating a release the run MUST write `<base>/.env` on the server from the Environment's Variables and Secrets, covering every key the application reads (`APP_*`, `LOG_*`, `DB_*`, `SESSION_*`, `CACHE_*`, `QUEUE_*`, `FILESYSTEM_DISK`, `MAIL_*`, `AWS_*`/`MINIO_*`, `RECAPTCHA_*`, `ZOHO_*`, `TINY_MCE_API_KEY`, `SENTRY_*`, `FACEBOOK_PIXEL_ID`, `FILAMENT_ADMIN_EMAILS`, `IS_PROMO_TAB_ACTIVE`), with documented defaults for non-secret keys. The previous file MUST be preserved as `<base>/.env_prev`. Secret values MUST NOT appear in job logs.

#### Scenario: Secret rotated in GitHub
- **WHEN** `DB_PASSWORD` is changed in the `production` environment and `master` is deployed
- **THEN** the new release runs with the new password and `.env_prev` still holds the old file

#### Scenario: Missing APP_KEY
- **WHEN** the environment has no `APP_KEY` secret
- **THEN** the run fails before writing `.env`, naming the missing key

### Requirement: Release layout and shared state
Each release MUST be extracted to `<base>/releases/<sha>` with `.env` and `storage` symlinked from `<base>`, and `<base>/current` MUST be switched atomically to the new release. Files under `public/images`, `public/uploads` and `public/banners` of the previously active release MUST be present in the new release after activation.

#### Scenario: Uploaded service image survives a deploy
- **WHEN** a service image exists in `current/public/uploads` and a new release is activated
- **THEN** the same file is readable at `current/public/uploads/<file>` afterwards

### Requirement: Standard after-deploy steps
After activation the run MUST, on the server and with the matrix `php_binary`: run `artisan migrate --force`, publish Livewire assets, cache configuration and views, and reload PHP-FPM/opcache where the host allows it. Extra per-environment commands MAY be supplied through `DEPLOY_BEFORE_HOOKS` / `DEPLOY_AFTER_HOOKS` Variables and MUST run with fail-fast shell semantics.

#### Scenario: Pending migration
- **WHEN** the release contains a new migration
- **THEN** it is applied non-interactively during the run and the run fails if the migration fails

### Requirement: Health gate
After the after-deploy steps the run MUST request the environment's `APP_URL` and `APP_URL/control/login` and MUST fail the run unless both return HTTP 200 within three attempts.

#### Scenario: Site returns 500 after deploy
- **WHEN** the home page responds 500 after activation
- **THEN** the run is reported failed with the URL and status in the log

### Requirement: Cleanup keeps five releases
After each run the server MUST retain at most the five newest `releases/*` and `artifacts/*` entries, regardless of whether the deploy succeeded.

#### Scenario: Sixth release
- **WHEN** a sixth release is deployed
- **THEN** the oldest release directory and tarball are removed and `current` still points at the newest release
