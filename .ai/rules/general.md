---
paths:
  - '**'
---

# General

## Commit messages follow Conventional Commits
Format: `<type>(<scope>?): <lowercase imperative summary>` — same convention as the other active projects (vetspace family uses `feat(auth): ...`, net-post-panel uses `feat: ...`). Types: `feat`, `fix`, `chore`, `refactor`, `test`, `docs`, `style`, `perf`. Scope is optional — short area name when it adds clarity (`contact-form`, `filament`, `zoho`, `deploy`, `e2e`); omit it when the change spans the app. No issue-number suffix (that `— VSF-XX` pattern is vetspace-only). Tooling: `npm run commit` launches commitizen for an interactive conventional message; `npx commitlint --from <ref>` validates a range (advisory, no git hook installed). One logical change per commit — split unrelated work into separate commits rather than one large commit. Summaries state intent, not file lists. Never commit secrets or git-ignored files (.env, deployment-config.json, tokens). Do not push unless the user explicitly asks.
