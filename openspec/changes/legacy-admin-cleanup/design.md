## Context

See `proposal.md` and the legacy admin requirements. The current panel is an Inertia/Vue surface mounted at `/admin`; its routes are declared in `routes/web.php`, controllers live under `app/Http/Controllers/Admin`, and screens are split across `resources/js/Pages/Admin` and shared components. The panel includes content CRUD, header/footer/menu settings, banners, widgets, profile, and portfolio screens. The separate Filament panel at `/control` is an additive surface and is not a target for this change.

## Goals / Non-Goals

**Goals:**

- Make the existing legacy shell and navigation the single reusable UI boundary.
- Make route destinations, route parameters, active states, and permissions verifiable.
- Preserve existing endpoint contracts while standardizing form states and feedback.
- Use the existing locale configuration and session mechanism consistently in admin.
- Provide a representative browser and feature regression matrix before release.

**Non-Goals:**

- Replacing the legacy panel with Filament.
- Redesigning the public site or changing public URL/SEO behavior.
- Changing database schemas, API payloads, or authentication policy without a separately approved change.
- Adding AI functionality.

## Decisions

### Shared shell, incremental screen migration

Keep the current Inertia/Vue architecture and consolidate common navigation and feedback in shared components. Migrate screens by feature group so each group can be verified independently. A full rewrite would create unnecessary compatibility risk.

### Route inventory as the source of truth

Build a route inventory from `routes/web.php`, mapping each named route to its controller action, required parameters, middleware, and Vue destination. Navigation links will be generated or checked against this inventory. Existing names and methods remain stable; a redirect or alias is allowed only where it preserves existing callers.

### Locale selection at the admin boundary

Reuse `config/locales.php`, `Locales`, and the existing locale switch endpoint/session behavior. The Inertia shared props will expose normalized locale metadata and the current locale so every screen renders the same control. Admin locale changes must not change public route generation.

### Contract-preserving form normalization

Use shared form primitives for labels, errors, loading, confirmation, and upload states, while retaining each controller's existing field names and HTTP method. Any controller response change requires an explicit regression test and compatibility review.

### Verification in layers

Use route smoke tests for all destinations, feature tests for authorization and mutation contracts, and browser checks for shell behavior and representative workflows. Keep `/control` and public localized URLs in a small non-regression check.

## Risks / Trade-offs

- **[Risk]** A shared component change affects many screens. → Migrate behind small, focused changes and run the full legacy route matrix after each group.
- **[Risk]** Some legacy links may depend on historical route names or misspelled paths such as `admin.dafault-pages`. → Preserve names initially, add tested aliases where needed, and remove links only after usage is confirmed.
- **[Risk]** Locale state can diverge between Inertia props, session, and public middleware. → Normalize through the existing locale service and test a complete request sequence.
- **[Risk]** Existing forms may rely on implicit payload or upload behavior. → Snapshot representative request fields and verify persisted records and validation responses before changing components.
- **[Risk]** Broad visual cleanup can obscure functional regressions. → Separate visual assertions from endpoint and persistence assertions in the verification matrix.

## Migration Plan

1. Capture the current route/component inventory and baseline smoke results.
2. Introduce shared shell and locale metadata without changing endpoint contracts.
3. Migrate navigation and screen groups in dependency order: dashboard/shell, content resources, site chrome, then portfolio.
4. Add and run route, feature, and browser regression checks.
5. Deploy to the test server, compare representative legacy workflows, and roll back the asset/code release if route health or mutation checks regress.

## Open Questions

None. The remaining visual choices can be made within the existing style system without changing the behavior contract.
