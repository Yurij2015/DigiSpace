## Context

See proposal.md for the five confirmed defects. Laravel 13 Blade inheritance exposes child-view loop variables to the parent layout. The site uses locale-aware Eloquent accessors, Spatie sitemap 7.4, and PHPUnit 11; only User has an existing factory. Boost MCP is unavailable in this session, so installed source and official framework documentation provide API verification.

## Goals / Non-Goals

Goals: keep page identity explicit in metadata, preserve localized content accessors, and test rendered HTML and XML contracts.

Non-goals: a full SEO audit, pagination canonical redesign, changing publication rules or legacy redirects, cloud services, data migrations, or production deployment.

## Decisions

- Gate model selection in the existing layout by named route and model type. Reuse the selected models for both metadata and JSON-LD. Merely renaming the blog loop would leave other templates vulnerable; introducing a new SEO subsystem would be unnecessary for this bounded correction.
- Prefer service SEO title then service title; use the localized site description when no resource description is present. Keep existing visible headings unchanged.
- Normalize CMS images with the URL/asset helpers, distinguishing filenames from upload paths. Preserve HTTP(S) hosts and resolve protocol-relative images using the current scheme. Retain the shared default image.
- Mark the error template with a robots section consumed by the layout; also add a literal directive to the standalone 404 fallback. This covers 404 rendering regardless of which route failed, unlike a route-name-only condition.
- Return all localized Url objects from the sitemap helper and let Spatie add that array. Preserve current resource selection, priority, frequency and output location.
- Use database-backed HTTP tests for listing, resource and error metadata; parse the JSON-LD graph. Generate sitemap XML under a test-specific temporary public directory and parse entries/alternates so tests never overwrite the real public sitemap. Follow existing RefreshDatabase and SeedsPublicSite conventions; use User factory and direct model fixtures where factories do not exist.

## Risks / Trade-offs

- Three sitemap entries per resource increase file size proportionally; expected site size is well below the sitemap URL limit.
- Empty resource fields require stable fallbacks; cover them with tests.
- Shared error views can propagate section state; test ordinary pages and explicit error routes as well as missing resources.

## Migration Plan

No database migration. Normal release view compilation and sitemap generation apply the changes. Revert the code and regenerate the sitemap to roll back. Run targeted PHPUnit tests and Pint before handoff; deployment remains a separate action.
