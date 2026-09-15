## Why

The legacy `/admin` panel is still the active editing surface, but its navigation, page layouts, labels, locale controls, and route links have drifted across many Inertia/Vue screens. Some links use inconsistent names or active states, while shared admin behavior is duplicated between pages, making routine content management difficult to verify and increasing the risk of breaking the existing admin contract.

## What Changes

- Establish one consistent legacy-admin shell for navigation, header, sidebar, user controls, locale switching, breadcrumbs, loading states, and error feedback.
- Audit every existing `/admin/*` and `/portfolio/*` route used by the legacy panel and make its menu link, active state, controller response, and Vue page agree.
- Bring the dashboard and resource index/create/edit/show screens to a consistent responsive layout using the existing visual language.
- Preserve existing route names, HTTP methods, payload shapes, authorization middleware, and public `/admin` compatibility unless a route defect requires a documented non-breaking alias or redirect.
- Make Ukrainian, Polish, and English selection work consistently in the legacy panel without exposing internal locale values or changing public API fallback behavior.
- Add regression coverage for navigation, route reachability, validation/error rendering, locale switching, and representative create/update/delete flows.
- Remove stale, duplicated, or dead navigation links only after an equivalent working destination is verified.

## Capabilities

### New Capabilities

- `admin/legacy-admin-ux`: Consistent, verifiable navigation and user experience for the existing Inertia/Vue administration panel.

### Modified Capabilities

- `openspec/specs/architecture/localization.spec.md`: Legacy admin locale selection and persistence must be made consistent with the supported locale contract.

## Impact

- Inertia controllers and route definitions under `app/Http/Controllers/Admin` and `routes/web.php`.
- Vue pages and shared components under `resources/js/Pages/Admin`, `resources/js/Components`, and related styles/assets.
- Existing admin feature areas: pages, posts, categories, services, products, widgets, menus, banners, profile, and portfolio.
- Browser/E2E and feature tests; no new backend dependency is required.
- The Filament `/control` panel and public site remain outside this change except for compatibility checks.
