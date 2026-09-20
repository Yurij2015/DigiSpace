## 1. Metadata regressions

- [x] 1.1 Add and run HTTP regressions for blog listings, posts, localized services and category metadata; fix route-based metadata selection and verify those tests pass with valid JSON-LD.
- [x] 1.2 Normalize CMS social images and verify filename, upload-path, root-relative, absolute and missing-image cases through rendered metadata tests.
- [x] 1.3 Add noindex to every public 404 rendering path and verify unknown paths, missing resources, minimal fallback and successful-page isolation.

## 2. Multilingual sitemap

- [x] 2.1 Emit all supported locale entries with reciprocal alternates and configured x-default; verify generated XML for static and dynamic resources and publication filters in an isolated output directory.

## 3. Integration verification

- [x] 3.1 Run new tests together with existing public localization, redirect, 404 and search tests; run Pint, git diff --check and strict OpenSpec validation; record outcomes and complete the task checklist.
