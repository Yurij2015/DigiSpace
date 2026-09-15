---
type: Behaviour Spec
title: "Deployment — Environment routing"
description: "Which branch or manual input deploys which environment, how the server matrix is sourced from GitHub Variables, and the concurrency guarantees."
tags: [deployment, github-actions, environments]
status: proposed
last_verified_at: 2026-09-15
sources:
  - id: workflow
    resource: repo://.github/workflows/deploy.yml
  - id: example-config
    resource: repo://example.deployment-config.json
  - id: deployment-docs
    resource: repo://docs/deployment/README.md
---

## Purpose

Defines how a git event is turned into a set of target servers so that the testing and production sites can never be deployed by the wrong branch, and so that no server address, user or path has to live in the repository.

## ADDED Requirements

### Requirement: Branches map to environments
A push to `dev` MUST deploy only servers whose `environment` is `testing`; a push to `master` MUST deploy only servers whose `environment` is `production`. A push to any other branch MUST NOT start server jobs and MUST NOT fail the run because of the branch alone.

#### Scenario: Push to dev
- **WHEN** a commit is pushed to `dev`
- **THEN** the run builds, tests and deploys to every enabled `testing` server and to no `production` server

#### Scenario: Push to master
- **WHEN** a commit is pushed to `master`
- **THEN** the run builds, tests and deploys to every enabled `production` server and to no `testing` server

#### Scenario: Push to a feature branch
- **WHEN** a commit is pushed to `feature/x`
- **THEN** no deployment workflow run is started for that push

### Requirement: Manual dispatch selects the environment explicitly
The workflow MUST be runnable manually with an `environment` input accepting `testing`, `production` or `all`; the input MUST take precedence over the branch mapping so a hotfix can be deployed from any ref on purpose.

#### Scenario: Dispatch production from dev
- **WHEN** an operator runs the workflow on `dev` with `environment=production`
- **THEN** the run deploys only `production` servers, after the tests job has passed

#### Scenario: Dispatch all
- **WHEN** an operator runs the workflow with `environment=all`
- **THEN** every enabled server in the matrix is deployed

### Requirement: Server matrix comes from a GitHub Variable
The list of target servers MUST be read from the repository Variable `DEPLOYMENT_MATRIX`, a JSON array of objects with `name`, `ip`, `port`, `username`, `path`, `environment` (`testing` | `production`), `enabled` (boolean, default true) and optional `php_binary` (default `php`). The repository MUST NOT contain a tracked file with real server addresses, users or paths; only an example file with placeholder values.

#### Scenario: Matrix missing or malformed
- **WHEN** `DEPLOYMENT_MATRIX` is empty or is not a non-empty JSON array
- **THEN** the run fails in the build job with a message naming the variable, before any artifact is uploaded to a server

#### Scenario: Disabled server
- **WHEN** a matrix entry has `enabled: false`
- **THEN** that server is skipped even if its `environment` matches

#### Scenario: No server for the target environment
- **WHEN** the filtered matrix is empty (for example `master` pushed while no `production` entry is enabled)
- **THEN** the run fails with a message naming the environment and no server job starts

### Requirement: Environment-scoped configuration
Every server job MUST run inside the GitHub Environment named after the matrix entry's `environment`, so that Variables and Secrets are resolved per environment and environment protection rules (required reviewers, wait timers) apply without workflow changes.

#### Scenario: Different APP_URL per environment
- **WHEN** `APP_URL` is set to different values in the `testing` and `production` environments
- **THEN** a `dev` deploy writes the testing value and a `master` deploy writes the production value into the server `.env`

### Requirement: One deploy per environment at a time
Runs targeting the same environment MUST be serialised. A newer `dev` push MAY cancel a still-queued testing run; a production run MUST NOT be cancelled by a later push.

#### Scenario: Two pushes to master in quick succession
- **WHEN** a second commit lands on `master` while the first deploy is still running
- **THEN** the second run waits for the first to finish and then deploys, and the first run is not cancelled
