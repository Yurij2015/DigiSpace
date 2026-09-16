## Context

DigiSpace manages marketing articles, technical blog posts, and site pages via Filament 5 (`/control`). Currently, drafting articles and entering multi-language SEO metadata is entirely manual. The sister project `net-post-panel` already established a clean AI generation subsystem using `ArticlePromptBuilder`, `AiManager`, and provider drivers (such as Gemini and OpenAI). This design adapts and extends that architecture into DigiSpace with configurable entity definitions, polymorphic attempt auditing, direct Filament 5 form action integration, and AI-powered translation from the English base to Ukrainian and Polish.

See `proposal.md` for motivation and `specs/content-generation/spec.md` for behavioral requirements.

## Goals / Non-Goals

**Goals:**
- Provide a configurable database-backed registry (`generation_configs`) defining entity types, domain descriptions, primary fields, and SEO fields.
- Implement an AI generator service adapting `net-post-panel`'s `ArticlePromptBuilder` and `AiManager` to synthesize clean JSON payloads.
- Record every generation and translation request in `generation_attempts` with polymorphic record associations, attempt numbers, type discriminator, prompts, and raw responses.
- Integrate a reusable `AiGenerationAction` into Filament 5 forms (`PostForm`, `PageForm`) with a modal for entering prompts, selecting locales, and specifying writing styles.
- Integrate a reusable `AiTranslationAction` on the Ukrainian and Polish tabs of Filament 5 forms, providing "Translate from English" with adapted and literal modes.
- Auto-populate corresponding Filament form fields (including translation arrays like `translations.uk.*`) without auto-saving the model.

**Non-Goals:**
- Automatically publishing posts or pages without human review.
- Replacing Filament's native validation or save lifecycle.
- Building a standalone chat or conversational AI interface.
- Translating between non-English languages (only English → uk/pl is in scope).

## Decisions

### 1. Database Registry for Generatable Entities (`generation_configs`)
- **Decision**: Store entity generation configuration in a dedicated database table `generation_configs` seeded with default configs for `post` and `page`.
- **Schema**:
  - `entity_type` (string, unique, e.g. `'post'`, `'page'`)
  - `entity_name` (string, e.g. `'Blog Post'`, `'CMS Page'`)
  - `entity_description` (text, human-readable domain description passed to the AI to instruct it on what this entity represents)
  - `fields` (json, e.g. `["name", "content", "excerpt"]`)
  - `seo_fields` (json, e.g. `["description", "keywords", "meta"]`)
  - `default_prompt` (text, template with `{prompt}`, `{writingStyle}`, `{keywords}`)
  - `system_prompt` (text, tone and structure constraints)
- **Rationale**: Storing this in DB allows new entities (e.g. `service`, `portfolio_item`, `case_study`) to be added or prompt templates fine-tuned without deploying code.
- **Alternatives considered**: Hardcoded config arrays in `config/ai.php`. Rejected because DB storage allows dynamic runtime customization, seed versioning, and future admin management UI.

### 2. Polymorphic Generation Attempt History (`generation_attempts`)
- **Decision**: Log every generation and translation in `generation_attempts`:
  - `id` (PK)
  - `type` (string: `'generation'` or `'translation'`)
  - `entity_type` (string)
  - `generatable_type` (string, nullable)
  - `generatable_id` (bigint, nullable)
  - `attempt_number` (unsigned int)
  - `locale` (string, e.g. `'en'`, `'uk'`, `'pl'`)
  - `translation_mode` (string, nullable: `'adapted'` or `'literal'`, only for translation type)
  - `user_prompt` (text)
  - `resolved_prompt` (text)
  - `source_content` (json, nullable — stores the original English content snapshot for translation attempts)
  - `generated_payload` (json)
  - `created_by` (foreignId to `users`, nullable)
  - `created_at` (timestamp)
- **Rationale**: If generating for an existing record, `generatable_id` is set and `attempt_number` increments. If generating for a brand-new uncreated record, `generatable_id` is null (or linked post-save), while the attempt number tracks attempts made during that authoring session. The `type` discriminator distinguishes generation from translation for audit and analytics. `source_content` preserves the English snapshot at translation time for reproducibility.
- **Alternatives considered**: Embedding attempt logs as JSON inside the `posts` / `pages` tables. Rejected because attempts happen *before* records exist and require history queries across attempts.

### 3. AI Service Layer Inspired by `net-post-panel`
- **Decision**: Port and refine the AI service architecture from `net-post-panel`:
  - `App\Services\AI\ArticlePromptBuilder`: Constructs targeted prompt instructions combining the entity description, user prompt, target locale (English, Ukrainian, Polish), writing style, and requested JSON schema.
  - `App\Services\AI\AiManager`: Extends Laravel's `Manager` class, supporting `gemini`, `openai`, and a `mock` driver for local testing without external API credentials.
  - `App\Services\AI\Contracts\ContentGenerator`: Contract returning a structured array of fields conforming to the entity configuration.
  - `App\Services\AI\ContentGeneratorService`: Orchestrates config resolution, prompt construction, AI invocation, JSON decoding/validation, attempt logging, and field mapping.
- **Rationale**: Proven, robust pattern already operational in `net-post-panel`, cleanly decoupled from Filament and controllers.

### 4. Filament 5 Form Action Integration (`AiGenerationAction`)
- **Decision**: Encapsulate the modal and field-setting logic in a reusable Filament action: `App\Filament\Support\AiGenerationAction`.
- **Form Schema & Interaction**:
  - Modal inputs:
    - `prompt` (Textarea, required): Topic, notes, outline, or user instructions.
    - `locale` (Select: `'en'` => 'English', `'uk'` => 'Українська', `'pl'` => 'Polski').
    - `writing_style` (Select: 'Professional', 'Engaging', 'Informative', 'Casual', 'Technical').
    - `keywords` (TextInput: optional comma-separated keywords for SEO injection).
  - Action execution:
    - Calls `ContentGeneratorService::generate(...)`.
    - Automatically maps generated fields to the form schema using Filament's `$set` closure.
    - For `en`: sets `name`, `content`, `description`, `keywords`.
    - For `uk`: sets `translations.uk.name`, `translations.uk.content`, `translations.uk.description`, `translations.uk.keywords`.
    - For `pl`: sets `translations.pl.name`, `translations.pl.content`, `translations.pl.description`, `translations.pl.keywords`.
    - Triggers `Filament\Notifications\Notification::make()->success()` informing the editor that the fields have been populated.
- **Rationale**: Non-destructive to the author. The author retains full control to inspect, edit, or reject the AI suggestions before hitting the standard Filament "Save" button.

### 5. Translation Action (`AiTranslationAction`)
- **Decision**: Create a separate reusable Filament action `App\Filament\Support\AiTranslationAction` placed on the Ukrainian and Polish language tabs.
- **Behavior**:
  - The action label reads "Translate from English" (localized: "Перекласти з англійської" / "Przetłumacz z angielskiego").
  - **Visibility**: Only shown on `uk` and `pl` tabs. Disabled with tooltip "Save English content first" when the record has no saved English content (`name` or `content` is empty/null).
  - Modal inputs:
    - `translation_mode` (Radio: `'adapted'` => "Adapted (rewrites for the target audience)" / `'literal'` => "Literal (faithful translation)"). Default: `adapted`.
  - Action execution:
    - Reads saved English fields from the model (`$record->name`, `$record->content`, `$record->description`, `$record->keywords`).
    - Constructs a translation prompt via `App\Services\AI\TranslationPromptBuilder`, which:
      - Includes the entity description from `generation_configs` for context.
      - For **adapted** mode: instructs the AI to rewrite the content naturally for the target language audience, adapting idioms, sentence patterns, SEO keywords, and cultural references.
      - For **literal** mode: instructs the AI to translate faithfully, preserving original structure, headings, lists, and formatting.
      - Requires JSON output matching the entity's fields and SEO fields.
    - Invokes the configured AI provider via `AiManager`.
    - Populates `translations.{locale}.*` form fields via `$set`.
    - Logs the attempt in `generation_attempts` with `type` = `'translation'`, `translation_mode`, and `source_content` (snapshot of original English).
- **Rationale**: Translation is a distinct UX flow from generation — the user already has content and wants it in another language. A separate action with its own prompt builder keeps responsibilities clean. Using the same `AiManager` infrastructure means no additional provider configuration is needed.

## Risks / Trade-offs

- **[Risk: AI API downtime or invalid JSON output]** → Mitigation: Strict JSON parsing with fallback cleanup. If parsing fails, retry once or return a descriptive Filament error notification without losing existing form data.
- **[Risk: API key costs or quota limits]** → Mitigation: `AiManager` supports caching identical prompts if desired, and defaults to a Mock driver in development/testing environments when keys are unconfigured.
- **[Risk: Large HTML content in Rich Editor]** → Mitigation: The prompt builder explicitly instructs the AI to generate semantic HTML tags matching the rich editor (h2, h3, p, ul, li, blockquote) without wrapper ```html tags.
- **[Risk: Translation quality varies by mode]** → Mitigation: "Adapted" mode uses detailed locale-specific instructions (e.g. Ukrainian formal/informal conventions, Polish declension patterns). Both modes are clearly labeled so the editor understands what to expect. The editor always reviews before saving.
- **[Risk: Stale English content used for translation]** → Mitigation: The action reads from the saved model (`$record`), not unsaved form state. If the editor has unsaved English edits, the button tooltip warns them to save first. The `source_content` snapshot in the attempt log preserves exactly what was translated.

## Migration Plan

1. Create migration `xxxx_create_generation_configs_table.php` and `xxxx_create_generation_attempts_table.php` (including `type`, `translation_mode`, and `source_content` columns).
2. Create and run seeder `GenerationConfigSeeder` populating baseline configs for `post` and `page`.
3. Add `App\Traits\HasGenerationAttempts` to `Post` and `Page` models.
4. Mount `AiGenerationAction` in `PostForm` and `PageForm`.
5. Mount `AiTranslationAction` on the Ukrainian and Polish tabs of `PostForm` and `PageForm`.
6. Rollback strategy: Standard `migrate:rollback` removes both tables without affecting existing posts or pages.
