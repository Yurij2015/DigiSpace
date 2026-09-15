# Legacy admin UI audit

The legacy panel currently repeats the same shell in the majority of screens: `<sidebar/>`, `<AdminNavbar/>`, `<HeaderStats/>`, and `<FooterAdmin/>`. Navigation is split between `Sidebar.vue` and `AdminNavbar.vue`, with route active-state expressions maintained independently. `LanguageSwitcher.vue` is shared by the navbar but currently labels the `uk` locale as `UA` for compatibility.

The cleanup will consolidate the shell and route map first, then migrate resource screens without changing controller endpoint contracts. Form components will retain each screen's current `useForm` field names and HTTP methods. Loading, validation, upload, empty, and missing-record states will be checked separately from visual assertions.

Current source groups:

- Shell: `resources/js/Components/Sidebar/Sidebar.vue`, `resources/js/Components/Navbars/AdminNavbar.vue`, `resources/js/Components/Headers/HeaderStats.vue`, `resources/js/Components/Footers/FooterAdmin.vue`.
- Locale: `resources/js/Components/LanguageSwitcher.vue`, shared Inertia props in `app/Http/Middleware/HandleInertiaRequests.php`.
- Content screens: `resources/js/Pages/Admin/{Categories,Posts,Pages,Services,Products,Widgets,DefaultPages}`.
- Site chrome: `resources/js/Pages/Admin/{PublicMenu,HeaderNavBarSettings,FooterBottomBarSettings,FooterUsefulLinks,BlogPostBanners}`.
- Portfolio/profile: `resources/js/Pages/Admin/Portfolio`, `resources/js/Pages/Admin/Profile.vue`.

## Applied cleanup

- Removed placeholder actions from the user and notification dropdowns; the user menu now shows the signed-in identity, profile, and logout actions.
- Removed the non-functional desktop search field from the admin navbar so locale and account controls remain aligned.
- Added service-category and profile destinations to the sidebar and corrected nested service/product active states.
- Corrected the navbar Widgets active state.
- Tightened sidebar spacing, section heading typography, link padding, hover states, and active-state highlighting for desktop and mobile layouts.
- Replaced hardcoded dashboard stats with current category/page/post/service counts supplied through shared authenticated admin props.
