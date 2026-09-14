---
name: inertia-admin-crud
description: "Implement or change DigiSpace admin CRUD with the existing Laravel routes, legacy Inertia Vue 3 forms, validation and upload contracts."
---

# Inertia admin CRUD

Read [architecture](../../../docs/architecture.md); inspect a sibling controller and Vue page for the entity being changed.

## Follow the installed stack

- Frontend uses Inertia v2 with `@inertiajs/vue3` and `inertiajs/inertia-laravel:^2.0`. Verify APIs against installed packages; do not migrate dependencies during a CRUD task.
- `Inertia::render('Admin/Posts/Update')` resolves `resources/js/Pages/Admin/Posts/Update.vue`. Keep exact path/case and prop names aligned.
- Routes in `routes/web.php` use explicit controller groups, verbs and Ziggy names. Preserve existing names, including `admin.dafault-pages`, unless renaming all consumers is in scope.
- Shared props are in `HandleInertiaRequests`; inspect them instead of inventing a JSON response envelope. Successful form actions generally redirect.

## Keep the complete form contract

Trace route → controller validation → model fillable fields/relationships → Vue form. Reuse the relevant FormRequest where one exists; some older actions validate inline. For new validation prefer the local FormRequest pattern. Treat create and update separately, especially optional uploads and status fields.

Check actual authorization per action: post/category controllers have specific policy methods. `auth` does not imply an administrator role. The `verified` middleware on two routes does not enforce verification because `User` lacks `MustVerifyEmail`. Do not document or rely on stronger access controls than implemented.

Inspect existing multipart submission code and global `MultipartFormDataParser` before changing file update requests. Widget/post uploads use S3; service/banner uploads use direct filesystem moves. TinyMCE needs its key prop in the relevant action; it is not shared globally.

## Validate

Use a focused PHPUnit feature test for changed persistence or authorization behavior after verifying the test DB; use Inertia component/prop assertions when useful. Check create/update redirects, validation errors and upload retention when no replacement file is supplied. Run `npm run build` for Vue changes. There is no configured frontend unit-test or lint script in `package.json`.

See [testing](../../../docs/testing.md) and [integrations](../../../docs/integrations.md) for isolation of database and external services.
