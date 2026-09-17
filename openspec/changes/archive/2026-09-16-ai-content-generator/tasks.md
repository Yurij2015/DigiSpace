## 1. Database & Models

- [x] 1.1 Create migrations for `generation_configs` and `generation_attempts` tables (including `type`, `translation_mode`, and `source_content` columns) and verify `vendor/bin/sail artisan migrate` runs cleanly
- [x] 1.2 Create Eloquent models `App\Models\GenerationConfig` and `App\Models\GenerationAttempt` with polymorphic relations and array/json attribute casts
- [x] 1.3 Create `App\Models\Concerns\HasGenerationAttempts` trait and include it in `App\Models\Post` and `App\Models\Page`
- [x] 1.4 Create `Database\Seeders\GenerationConfigSeeder` with definitions for `post` and `page` and verify seed execution via `vendor/bin/sail artisan db:seed --class=GenerationConfigSeeder`

## 2. AI Service Layer (NetPostPanel Microservice Client)

- [x] 2.1 Implement `App\Services\AI\NetPostPanelClient` for `POST /api/v1/generate` and `POST /api/v1/translate` with `X-API-KEY` authentication, a 120s timeout, and `payload` envelope validation
- [x] 2.2 Register `services.netpostpanel.url` / `services.netpostpanel.key` and document `NETPOSTPANEL_API_URL` / `NETPOSTPANEL_API_KEY`
- [x] 2.3 Implement `App\Services\AI\ContentGeneratorService` to orchestrate entity config lookup, request payload assembly, microservice invocation, and `GenerationAttempt` logging (no local provider drivers)

## 3. Filament 5 Content Generation Integration

- [x] 3.1 Create reusable `App\Filament\Support\AiGenerationAction` with modal inputs (prompt, locale, writing style, keywords) and form field population logic using `$set`
- [x] 3.2 Integrate `AiGenerationAction` into `App\Filament\Resources\Posts/Schemas/PostForm.php` for English, Ukrainian, and Polish tabs
- [x] 3.3 Integrate `AiGenerationAction` into `App\Filament\Resources\Pages/Schemas/PageForm.php` for English, Ukrainian, and Polish tabs
- [x] 3.4 Ensure non-destructive workflow where generated drafts populate form fields for author review before standard Filament save

## 4. AI Translation from English Base

- [x] 4.1 Delegate translation to the `net-post-panel` `/api/v1/translate` endpoint via `ContentGeneratorService::translate()`, passing `translation_mode` (adapted/literal), target locale, entity description, and source content
- [x] 4.2 Create reusable `App\Filament\Support\AiTranslationAction` with modal input for translation mode (adapted/literal), disabled state when English content is missing, and form field population via `$set`
- [x] 4.3 Integrate `AiTranslationAction` into `PostForm` on the Українська and Polski tabs with "Translate from English" / "Перекласти з англійської" / "Przetłumacz z angielskiego" labels
- [x] 4.4 Integrate `AiTranslationAction` into `PageForm` on the Українська and Polski tabs
- [x] 4.5 Log translation attempts in `generation_attempts` with `type` = `translation`, `translation_mode`, `source_content` (English snapshot), and `locale`

## 5. Verification & Code Quality

- [x] 5.1 Write Feature test `tests/Feature/Services/AI/NetPostPanelClientTest.php` to verify endpoint URLs, the `X-API-KEY` header, and `payload` envelope handling/failures using `Http::fake()`
- [x] 5.2 Write Feature test `tests/Feature/Services/AI/ContentGeneratorServiceTest.php` to verify the generation/translation request payloads sent to the microservice (including adapted vs literal mode) and `GenerationAttempt` persistence
- [x] 5.3 Write Feature test `tests/Feature/Services/AI/ContentGeneratorServiceTest.php` to verify end-to-end generation execution and `GenerationAttempt` persistence
- [x] 5.4 Write Feature test for Filament Post & Page resource forms verifying the AI generation action executes and populates form data
- [x] 5.5 Write Feature test for Filament Post & Page resource forms verifying the AI translation action reads English content and populates translation fields
- [x] 5.6 Run `vendor/bin/sail bin pint --format agent` to format all new and modified PHP files to project coding standards
- [x] 5.7 Remove local prompt builders (ArticlePromptBuilder, TranslationPromptBuilder) and their tests to ensure all AI logic is delegated to the microservice
