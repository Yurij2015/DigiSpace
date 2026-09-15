---
type: Reference
title: "Project Analysis and Known Gaps"
description: "Source-verified findings and limits of the documentation review."
tags: [analysis, maintenance]
status: stable
stale_after: 2027-03-13
---

# Project Analysis and Known Gaps

Reviewed on 2026-09-13 from the working tree: dependencies, routes, bootstrap/providers, public content flow, admin/upload actions, models, seeders/migrations, tests and deployment workflow. This is not a production audit or proof that the application passes its test suite.

## Application boundaries

DigiSpace is a single Laravel 13/MySQL application: a public Blade company site with blog, services/pricing, contact capture and menu-backed pages; a legacy Inertia/Vue 3 admin; and portfolio/CV editing. There are two explicit routes in `routes/api.php`, not a full CMS REST API.

| Endpoint | Current implementation |
|---|---|
| `GET /api/user` | Sanctum-protected current user |
| `GET /api/education` | Public portfolio education, transformed by `PfEducationController` |

Education returns `locales` keyed by locale and `items` containing `id` (from item name), `period`, `place` and item `locales`. `place` contains `logoUrl`, `faIcon` and locale text. The controller selects the first education record, does not handle an empty collection safely, and can return null for absent locale/item collections. Do not assume pagination, locale filtering or an empty-array contract. Portfolio seeders are not called by `DatabaseSeeder`.

## Findings to account for in future work

| Finding | Evidence | Consequence |
|---|---|---|
| Fresh-install category IDs drift | Image-category migration inserts a row before `WidgetCategorySeeder`, neither assigns IDs | `migrate --seed` is not a verified complete setup; template slots may resolve the wrong category |
| Full seed deletes users | `UserSeeder::run()` calls `delete()` on users | Do not use full reseeding as routine repair |
| Some site chrome is not seeded by default | `DatabaseSeeder` omits header/footer content seeders | Missing layout data on a fresh DB requires additional fixtures |
| Verification middleware is ineffective for current User | Routes declare `verified`, model lacks `MustVerifyEmail` | Do not describe email verification as an enforced access control |
| Contact processing can partially succeed | DB insert precedes uncaught Zoho SDK calls | User may see failure despite a stored submission; retry can duplicate it |
| Upload URL can outlive failed upload | S3 has `throw=false`; helpers ignore `put()` result | Verify actual object existence when troubleshooting |
| Deployment activates before restoration/migration | Order in `.github/workflows/deploy.yml` | Do not promise zero downtime; inspect migration/image results |
| Test scaffold differs from current routes | Active registration tests, disabled registration routes | Existing tests need reconciliation before being treated as a release gate |
| No DB guard in test base class | `tests/TestCase.php`, unforced PHPUnit environment entries | Check resolved DB target before `RefreshDatabase` |

These findings are documented, not fixed by this documentation task. The detailed setup, testing, integration and deployment guides explain the relevant boundaries.

## Reference adaptation

VetSpace's documentation index/frontmatter and focused skill layout were used as structural examples. Content was checked against DigiSpace source. The project skills intentionally target Blade, the installed Inertia packages, MySQL and PHPUnit 10; they do not import VetSpace's tenancy, Nuxt, PostgreSQL, Pest, billing or worker configuration.

## Validation scope

Documentation links and the four skill manifests were checked locally. The bundled Python skill validator could not run because PyYAML is absent; frontmatter, names and placeholder checks were performed using the repository’s installed Node YAML parser instead. No production connections, migrations, seeders, contact submissions or deployments were run for this review. Documentation-only changes do not establish application runtime correctness.

[Documentation index](README.md)
