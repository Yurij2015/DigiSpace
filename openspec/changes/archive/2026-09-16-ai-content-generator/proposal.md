## Why

Content creation for blog posts, marketing articles, and CMS pages currently requires manual drafting and metadata entry across multiple languages (en, uk, pl). To accelerate editorial workflows, DigiSpace needs an AI-assisted content generator. 

Instead of duplicating the complex RAG (Retrieval-Augmented Generation) pipeline inside DigiSpace, we will utilize a microservice architecture. DigiSpace will act as a client, making API requests to a centralized content-generation microservice (`net-post-panel`). `net-post-panel` already possesses the logic for searching Google Custom Search, parsing top results, evaluating them, and generating high-quality SEO content. 

This separation of concerns keeps DigiSpace lightweight while leveraging the powerful, centralized AI engine of `net-post-panel`.

## What Changes

- **Configurable Entity Definitions**: Create configuration and schema storage for generatable entities (e.g. `post`, `page`, and future entities).
- **NetPostPanel API Client**: Implement an HTTP client (`NetPostPanelClient`) in DigiSpace that communicates with the external `net-post-panel` API (`POST /api/v1/generate`), passing the prompt, topic, language, and target entity schema.
- **Polymorphic Generation Attempt History**: Store all generation attempts in a dedicated `generation_attempts` table tracking polymorphic entity relation (`generatable_type`, `generatable_id`), sequential `attempt_number`, user prompt, and raw generated payload.
- **Filament 5 Form Action & Modal**: Add a clean header/form action ("Generate with AI") on Post and Page forms. When triggered, it requests generation from the external API, pre-fills the respective form fields, and saves the history attempt.
- **AI Translation from English Base**: Add a "Translate from English" action button on the Ukrainian and Polish language tabs. This action will also utilize the external API (or a specific translation endpoint on `net-post-panel`) to translate the base English fields into the target locale.

## Capabilities

### New Capabilities
- `content-generation`: External API-driven multi-entity AI content generation, generation attempt audit log, and Filament 5 form action integration.

### Modified Capabilities
<!-- None -->

## Impact

- **Database**: New tables `generation_configs` and `generation_attempts`.
- **Filament Control Panel**: `PostForm`, `PageForm` receive the AI generation action.
- **Backend Services**: `app/Services/AI/NetPostPanelClient.php` introduced to handle external API communication.
- **Environment & Configuration**: `config/services.php` updated with `NETPOSTPANEL_API_URL` and `NETPOSTPANEL_API_KEY`.
