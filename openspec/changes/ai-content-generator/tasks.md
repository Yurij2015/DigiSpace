## 1. Database & Models

- [x] 1.1 Create migrations for `generation_configs` and `generation_attempts` tables (including `type`, `translation_mode`, and `source_content` columns) and verify `vendor/bin/sail artisan migrate` runs cleanly
- [x] 1.2 Create Eloquent models `App\Models\GenerationConfig` and `App\Models\GenerationAttempt` with polymorphic relations and array/json attribute casts
- [x] 1.3 Create `App\Models\Concerns\HasGenerationAttempts` trait and include it in `App\Models\Post` and `App\Models\Page`
- [x] 1.4 Create `Database\Seeders\GenerationConfigSeeder` with definitions for `post` and `page` and verify seed execution via `vendor/bin/sail artisan db:seed --class=GenerationConfigSeeder`

## 2. AI Service Layer

- [x] 2.1 Implement `App\Services\AI\ArticlePromptBuilder` with entity description context, multi-language prompt instructions (en, uk, pl), writing styles, and strict JSON output formatting
- [x] 2.2 Implement `App\Services\AI\AiManager` and driver contracts with support for Gemini, OpenAI, and a Mock fallback driver for test/local environments
- [x] 2.3 Implement `App\Services\AI\ContentGeneratorService` to orchestrate entity config lookup, prompt synthesis, AI invocation, JSON response validation, and `GenerationAttempt` logging

## 3. Filament 5 Content Generation Integration

- [x] 3.1 Create reusable `App\Filament\Support\AiGenerationAction` with modal inputs (prompt, locale, writing style, keywords) and form field population logic using `$set`
- [x] 3.2 Integrate `AiGenerationAction` into `App\Filament\Resources\Posts/Schemas/PostForm.php` for English, Ukrainian, and Polish tabs
- [x] 3.3 Integrate `AiGenerationAction` into `App\Filament\Resources\Pages/Schemas/PageForm.php` for English, Ukrainian, and Polish tabs
- [x] 3.4 Ensure non-destructive workflow where generated drafts populate form fields for author review before standard Filament save

## 4. AI Translation from English Base

- [x] 4.1 Implement `App\Services\AI\TranslationPromptBuilder` with adapted and literal translation modes, locale-specific instructions (Ukrainian idioms/conventions, Polish declension patterns), entity description context, and strict JSON output formatting
- [x] 4.2 Create reusable `App\Filament\Support\AiTranslationAction` with modal input for translation mode (adapted/literal), disabled state when English content is missing, and form field population via `$set`
- [x] 4.3 Integrate `AiTranslationAction` into `PostForm` on the Українська and Polski tabs with "Translate from English" / "Перекласти з англійської" / "Przetłumacz z angielskiego" labels
- [x] 4.4 Integrate `AiTranslationAction` into `PageForm` on the Українська and Polski tabs
- [x] 4.5 Log translation attempts in `generation_attempts` with `type` = `translation`, `translation_mode`, `source_content` (English snapshot), and `locale`

## 5. Verification & Code Quality

- [x] 5.1 Write Unit test `tests/Unit/Services/AI/ArticlePromptBuilderTest.php` to verify prompt construction and locale/entity parameter handling
- [x] 5.2 Write Unit test `tests/Unit/Services/AI/TranslationPromptBuilderTest.php` to verify adapted vs literal prompt construction and locale-specific instructions
- [x] 5.3 Write Feature test `tests/Feature/Services/AI/ContentGeneratorServiceTest.php` to verify end-to-end generation execution and `GenerationAttempt` persistence
- [x] 5.4 Write Feature test for Filament Post & Page resource forms verifying the AI generation action executes and populates form data
- [x] 5.5 Write Feature test for Filament Post & Page resource forms verifying the AI translation action reads English content and populates translation fields
- [x] 5.6 Run `vendor/bin/sail bin pint --format agent` to format all new and modified PHP files to project coding standards
