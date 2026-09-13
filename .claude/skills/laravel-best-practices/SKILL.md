---
name: laravel-best-practices
description: "Change DigiSpace Laravel backend code using its installed Laravel 11 structure, MySQL content model and existing application conventions."
---

# DigiSpace Laravel conventions

Use [architecture](../../../docs/architecture.md) to locate the relevant layer. This skill adapts the useful consistency-first approach from VetSpace to this repository's stack.

## Work with the existing application

Laravel is 11 but bootstrap, HTTP/console kernels and exception handler retain the older application structure. PHP requirements are `^8.2`; Sail uses 8.3 and deploy hooks use 8.2. Keep new syntax compatible with the deployment runtime. Verify version-sensitive behavior from installed source.

Public controllers return Blade views; admin controllers return Inertia responses. Existing concrete services and `BlogRepository` handle reusable queries; add abstractions when they solve the actual task. Preserve MySQL semantics and inspect eager loading when changing queries. Shared layout queries run in `ContentServiceProvider::boot()`, including console boots.

Match sibling validation and policy conventions while checking correctness. Do not equate login with an admin role or assume `verified` works without `MustVerifyEmail`. Preserve named routes consumed by Ziggy and public slug contracts. Coordinate schema changes with model fillable fields, request rules and the consuming view.

## Boundaries that matter here

- Fixed category IDs and migration/seed ordering are application contracts; see [content model](../../../docs/content-model.md).
- Read environment values through `config`; keep actual credentials and server matrix values out of generated docs/log output.
- Contact forms save locally before synchronous Zoho calls. Preserve or deliberately change that partial-failure behavior; do not describe it as transactional or queued.
- Storage differs by entity. Inspect the upload helper and accessor before normalizing a path.
- The release workflow activates code before migrations and image restoration. Schema changes need a compatibility plan; see [deployment](../../../docs/deployment/README.md).

Use PHPUnit 10 for regression tests and `vendor/bin/pint --dirty` for changed PHP. Larastan is configured at level 5. Scope verification to the change and follow [test DB guidance](../../../docs/testing.md) before feature tests.

VetSpace's tenancy, PostgreSQL, Nuxt, Pest, Cashier/Stripe, Horizon and Caddy workflows are not dependencies of this app. Do not introduce them merely to match the reference project.
