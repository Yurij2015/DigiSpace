---
type: Overview
title: "DigiSpace Documentation"
description: "Index of project documentation for the DigiSpace website (Laravel 11, Blade public site, Inertia/Vue admin)."
tags: [docs]
status: stable
stale_after: 2027-03-13
---

# DigiSpace Documentation

Documentation for the digispace.pro website and its admin panel. For AI-agent-oriented guidance (conventions, gotchas) see [`../CLAUDE.md`](../CLAUDE.md); for project skills see [the skills directory](../.claude/skills/).

## Sections

### [Architecture](./architecture.md)
How a request flows through the app, the two rendering stacks (Blade public site vs Inertia admin), the service/repository layer, shared view data, and where each kind of code lives.

### [Content Model](./content-model.md)
The CMS-lite data model: widget categories → widgets, pages ↔ widgets, menus → menu items, site chrome tables, and the **magic IDs in `config/constants.php`** that bind them to the public templates. Read this before changing anything a visitor sees.

### [Local Setup](./local-setup.md)
Laravel Sail stack, environment variables that actually matter, seeding a working site, running Vite, IDE helpers.

### [Testing](./testing.md)
PHPUnit 10 setup, the `testing` database and why `RefreshDatabase` is dangerous here, how to run a subset, what is (not) covered and where to start adding tests.

### [Deployment](./deployment/README.md)
GitHub Actions release flow to CloudPanel servers: artifact build, `releases/<sha>` + `current` symlink, `.env` and upload-directory preservation, migrations, cleanup, and how to roll back.

### [Git flow](./development/git-flow.md)
Branch naming, pull-request sequence, commit messages, release promotion and the actual `master` deployment trigger.

### [Integrations](./integrations.md)
Zoho CRM leads, Google reCAPTCHA, MinIO/S3 uploads, Sentry, TinyMCE, Facebook Pixel, sitemap generation — config keys, code entry points, failure modes.

### [Analysis and known gaps](./project-analysis.md)
Source-verified findings, fresh-install limitations, access-control behavior and validation scope.

### [OpenSpec: localization and Filament](../openspec/changes/2026-09-localization-filament/README.md)
Reviewable proposal, architecture decisions, behavior specs and implementation gates for the new public locales and the parallel Filament panel.

## Project skills

- [CMS content](../.claude/skills/digispace-cms-content/SKILL.md) — Blade, widget slots, pages and menus.
- [Admin CRUD](../.claude/skills/inertia-admin-crud/SKILL.md) — existing Inertia/Vue forms and Laravel actions.
- [PHPUnit testing](../.claude/skills/phpunit-testing/SKILL.md) — test DB isolation and external-service boundaries.
- [Laravel conventions](../.claude/skills/laravel-best-practices/SKILL.md) — backend changes with this app’s actual dependencies.

## Adding documentation

1. Put feature-level docs in `docs/<topic>.md`, or `docs/<topic>/README.md` when a topic needs several files.
2. Start the file with the same YAML frontmatter as this one (`type`, `title`, `description`, `tags`, `status`, `stale_after`).
3. Link it from this index and, if it changes a convention, from `CLAUDE.md`.
4. Prefer pointing at code (`app/Http/Controllers/PageController.php`) over copying code into docs — docs go stale, paths mostly don't.

## Related

- [Main README](../README.md)
- [GitHub workflow](../.github/workflows/deploy.yml)
- [Tests](../tests/)
