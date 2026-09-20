## Why

Recent public SEO changes assign the final blog-list item to listing metadata, reuse category metadata for individual services, and emit sitemap entries only for English. Further review found root-relative social image URLs and missing noindex tags on actual 404 pages.

## What Changes

- Select metadata by the current public route and its intended model; keep blog listings independent of loop variables.
- Use each service's localized SEO fields and image for its own page.
- Generate a sitemap entry for every supported locale with reciprocal alternates and x-default.
- Resolve CMS social images to absolute URLs while preserving existing absolute URLs and the default image.
- Mark all rendered public 404 views noindex, including the minimal fallback.
- Add HTTP and generated-XML regression coverage; retain valid JSON-LD and escaping.

## Capabilities

### New Capabilities
- `public-site/seo`: Route-specific metadata, absolute social images, 404 indexing policy, and complete multilingual sitemaps.

### Modified Capabilities
None. Existing public localization requirements remain unchanged.

## Impact

Public Blade layout, error templates, sitemap command, and feature tests. No dependency changes, schema migrations, production data edits, deployment, or changes to legacy admin routes. The implementation is explicitly requested together with this OpenSpec change.
