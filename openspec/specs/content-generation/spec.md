# content-generation Specification

## Purpose
Empowers content editors and managers to generate rich, SEO-optimized articles, pages, and localized content drafts directly within Filament control panel forms using configurable entity definitions, prompt directives, and complete generation attempt auditing. Additionally, provides AI-powered translation of existing English content into Ukrainian and Polish with language-specific adaptation or literal translation modes.

## Requirements

### Requirement: Configurable Generatable Entity Definitions
The system MUST maintain a configuration registry of generatable entities (e.g., `post`, `page`). Each entity configuration MUST include: an entity key identifier, a descriptive definition of the entity's domain role and purpose (used to contextualize AI prompt synthesis), a list of generatable primary fields (such as `name`/`title`, `content`, `excerpt`), a list of generatable SEO fields (such as `description`, `keywords`, `meta`), and default prompt templates or tone guidelines.

#### Scenario: Entity configuration lookup
- **WHEN** the generation service is invoked for the `post` entity
- **THEN** it resolves the post definition, its domain description ("Articles and blog stories intended for reader engagement and SEO discovery"), its target fields (`name`, `content`), and SEO fields (`description`, `keywords`)

#### Scenario: Registering a new entity without code modification
- **WHEN** an administrator adds a new entity definition (e.g., `service` or `portfolio_item`) with its domain description and target fields
- **THEN** the generation service immediately recognizes the new entity type and applies its configuration during generation requests

### Requirement: Polymorphic Generation Attempt Tracking
Every generation request MUST be recorded in a persistent `generation_attempts` log. The log record MUST store: the polymorphic relation to the entity (`generatable_type` and `generatable_id`, which may be null for new unpersisted records), an incrementing `attempt_number` per entity or draft session, the attempt `type` (`generation` or `translation`), the user prompt/directives, the resolved system prompt, and the full structured response payload.

#### Scenario: First generation for a new post
- **WHEN** an author generates content on a new (unsaved) post form with prompt "Overview of cloud architectures"
- **THEN** a record is created in `generation_attempts` with `generatable_type` set to `App\Models\Post`, `generatable_id` null, `attempt_number` 1, `type` "generation", the prompt text, and the generated JSON payload

#### Scenario: Subsequent generation for an existing post
- **WHEN** an author requests a re-generation on an existing post with ID 42 that already has 2 recorded attempts
- **THEN** a new attempt record is created with `generatable_id` 42, `attempt_number` 3, and the new prompt and output payload

#### Scenario: Translation attempt logged
- **WHEN** an author translates an existing post (ID 42) from English to Ukrainian
- **THEN** a new attempt record is created with `type` "translation", `locale` "uk", the source English content reference, and the translated payload

### Requirement: Filament 5 Form Action & Modal
The creation and editing forms for supported entities (including `PostForm` and `PageForm`) MUST feature a "Generate with AI" action in the form interface. Activating the action MUST display a modal requiring the user to provide generation parameters (prompt / topic idea, target locale, writing style, and optional source references or keywords).

#### Scenario: Opening generation modal in Filament
- **WHEN** an editor clicks "Generate with AI" in `PostForm`
- **THEN** a Filament modal opens with input fields for prompt/topic, locale selector (en, uk, pl), writing style, and keywords

#### Scenario: Filling form fields upon successful generation
- **WHEN** the editor submits the modal form with valid generation parameters
- **THEN** the system generates the content, records the attempt, and pre-fills the corresponding form fields (`name`/`title`, `content`, `description`, `keywords`) in the active language tab without submitting or saving the model

#### Scenario: Saving after review
- **WHEN** the editor reviews and adjusts the pre-filled fields in the form and clicks "Save"
- **THEN** the standard Filament resource save lifecycle executes and persists the record normally

### Requirement: Multi-language Generation Support
The generator MUST support generating content directly into the targeted locale (English, Ukrainian, Polish). The system MUST instruct the AI provider to output the copy in the selected language and populate the corresponding translation fields (e.g. `translations.uk.name`, `translations.uk.content`, `translations.uk.description`, `translations.uk.keywords` when Ukrainian is selected).

#### Scenario: Generating content for Ukrainian locale
- **WHEN** the user selects "Українська" (uk) in the generation modal
- **THEN** the AI produces Ukrainian copy and the form populates `translations.uk.name`, `translations.uk.content`, and the Ukrainian SEO description and keywords

### Requirement: AI-Powered Translation from English Base
The Ukrainian and Polish language tabs MUST feature a "Translate from English" action button. When the entity has saved English content, the action MUST read the English fields (`name`, `content`, `description`, `keywords`), send them to the configured AI provider for translation, and populate the corresponding `translations.{locale}.*` fields. Two translation modes MUST be available:

- **Adapted**: The AI rewrites the content for the target language considering language-specific conventions, idiomatic expressions, natural sentence structure, SEO keyword localization, and cultural context appropriate for the target market (Ukrainian or Polish audience).
- **Literal**: The AI performs a straightforward, faithful translation preserving the original structure, tone, and formatting without creative rewriting.

The action MUST be disabled or show a warning when the English base content is empty or unsaved. Translation attempts MUST be logged in `generation_attempts` with `type` set to `translation`.

#### Scenario: Adapted translation of a saved post to Ukrainian
- **WHEN** an editor opens a saved post with English content, switches to the "Українська" tab, and clicks "Translate from English" selecting "Adapted" mode
- **THEN** the system reads the English `name`, `content`, `description`, and `keywords`, sends them to the AI with instructions to produce a culturally adapted Ukrainian version, and populates `translations.uk.name`, `translations.uk.content`, `translations.uk.description`, `translations.uk.keywords` without saving

#### Scenario: Literal translation of a page to Polish
- **WHEN** an editor opens a saved page with English content, switches to the "Polski" tab, and clicks "Translate from English" selecting "Literal" mode
- **THEN** the system translates the English fields faithfully into Polish, preserving structure and tone, and populates `translations.pl.name`, `translations.pl.content`, `translations.pl.description`, `translations.pl.keywords`

#### Scenario: Translation button disabled when English content is missing
- **WHEN** an editor opens a new (unsaved) post with no English content and switches to the "Українська" tab
- **THEN** the "Translate from English" button is disabled with a tooltip "Save English content first"

#### Scenario: Editor reviews and edits translated content before saving
- **WHEN** the translation completes and populates the Ukrainian fields
- **THEN** the editor can review, edit, and adjust the translated text before clicking the standard "Save" button
