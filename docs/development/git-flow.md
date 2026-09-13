---
type: Guide
title: "Git flow"
description: "Branching, review and release conventions for DigiSpace."
tags: [git, branching, pull-request, release]
status: stable
stale_after: 2027-03-13
---

# Git flow

## Branches

`master` is the release branch. The current GitHub Actions workflow deploys every
push to `master` to the servers listed in `deployment-config.json`.

`dev` is available as an integration branch. Feature and fix branches should be
created from `dev` and use a ticket-oriented name, for example
`DS-42-disable-admin-register` or `fix/homepage-fixtures`. Merge completed work
back into `dev` first, then promote the reviewed result to `master` for release.

The workflow currently has no separate `dev` deployment, test gate, required
review rule or manual production approval. Those controls must be configured in
GitHub repository settings if the team wants GitHub to enforce them.

## Normal change sequence

1. Update local `dev` and create a focused branch from it.
2. Make the change and add or update PHPUnit tests when behavior changes.
3. Run the relevant checks locally. For the Laravel app, the usual checks are:

   ```bash
   docker compose exec -T digi-space-app vendor/bin/phpunit
   docker compose exec -T digi-space-app vendor/bin/pint --dirty
   npm run build
   ```

4. Open a pull request into `dev` with a short description, test results and any
   migration, environment or deployment notes.
5. After review, merge into `dev`. Keep the branch until the merge is confirmed,
   then delete it if no longer needed.
6. Open or merge a promotion pull request from `dev` into `master` after the
   integrated change is ready for release.
7. Confirm the `master` Actions run and perform the post-deployment checks in
   [Deployment](../deployment/README.md).

## Commit messages

Use a concise Conventional Commit when practical:

```text
type(scope): imperative summary
```

Common types are `feat`, `fix`, `docs`, `test`, `refactor` and `chore`. Examples:

```text
fix(home): handle empty widget fixtures
test(auth): reflect disabled registration routes
docs(deployment): document release checks
```

There is no commitlint hook in this repository, so this convention is a team
agreement rather than an automated gate.

## Release facts

Only a push to `master` starts `.github/workflows/deploy.yml`. The workflow builds
the artifact, uploads it to every configured server, switches the `current`
symlink, restores local image directories and runs the configured migration hook.
It does not automatically run PHPUnit, wait for an approval, health-check the
application or roll back on failure. See the deployment runbook for the exact
sequence and its limitations.

Never commit `.env`, credentials or the contents of `deployment-config.json` to a
new branch, pull request or chat message. The current repository still tracks
`deployment-config.json`; treat that as sensitive and plan credential rotation
separately if repository access changes.

[Documentation index](../README.md)
