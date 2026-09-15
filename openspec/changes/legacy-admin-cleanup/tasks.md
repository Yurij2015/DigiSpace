## 1. Baseline and inventory

- [x] 1.1 Inventory every legacy `/admin/*` and `/portfolio/*` named route, controller action, middleware, required parameter, and Vue destination; verify the inventory has no unresolved route or component reference.
- [x] 1.2 Record baseline responses for authenticated and unauthenticated access plus representative public `/en`, `/uk`, and `/pl` routes; verify the baseline commands or browser checks are repeatable.
- [x] 1.3 Identify duplicated shell, navigation, locale, loading, error, and form patterns in `resources/js`; verify each planned consolidation has a named source and target component.

## 2. Shared legacy admin shell

- [ ] 2.1 Consolidate the legacy admin layout, navbar, sidebar, footer, and page header into reusable Inertia/Vue components; verify all migrated screens render without console errors.
- [ ] 2.2 Implement a single route-aware navigation map with correct active states and responsive menu behavior; verify every visible link resolves to a named route and unrelated links are not active.
- [ ] 2.3 Standardize page titles, breadcrumbs, loading indicators, notifications, and validation error presentation; verify success, validation failure, and request failure states in browser checks.
- [ ] 2.4 Normalize the legacy locale switcher to `en`, `uk`, and `pl` labels and session persistence; verify a locale change survives a subsequent Inertia request and does not alter public URL generation.

## 3. Content resource screens

- [ ] 3.1 Migrate categories, posts, pages, services, products, and widgets to the shared index/form/show patterns while retaining existing field names and methods; verify representative create/update/delete workflows persist expected records.
- [ ] 3.2 Migrate default pages, blog banners, widget icons, and site menu/header/footer settings; verify nested links carry the correct model parameter and update responses refresh the intended screen.
- [ ] 3.3 Audit empty, loading, missing-record, upload, and authorization states for each content resource; verify each state has a visible user action or documented not-found/error result.

## 4. Portfolio and profile screens

- [ ] 4.1 Migrate portfolio education, skills, sections, and profile screens to the shared shell without changing their existing endpoint contracts; verify representative nested create/update workflows.
- [ ] 4.2 Verify portfolio locale compatibility for existing `ua` database values and the `uk` admin label; verify no internal locale value is exposed as an unexpected selectable option.

## 5. Regression and release checks

- [ ] 5.1 Add feature tests for authorization middleware, route parameters, validation responses, locale persistence, and representative mutation payloads; verify the focused test suite passes.
- [ ] 5.2 Add browser smoke coverage for dashboard, every navigation group, representative index/create/edit/show screens, and locale switching; verify no 404, wrong active state, or Inertia exception occurs.
- [ ] 5.3 Run a non-regression check for `/control` and localized public pages after legacy changes; verify both surfaces remain reachable and unchanged in response contract.
- [ ] 5.4 Run formatting, static analysis, frontend build, and the full test suite; verify all required checks pass before test-server deployment.
- [ ] 5.5 Deploy to the test server and execute the route/workflow matrix against the deployed host; verify rollback instructions are documented if any route or mutation check fails.
