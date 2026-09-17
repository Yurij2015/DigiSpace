<?php

namespace App\Filament\Support;

use App\Services\AI\ContentGeneratorService;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class AiGenerationAction
{
    private static function configurationMessage(): string
    {
        return 'AI is not configured. Set NETPOSTPANEL_API_KEY and NETPOSTPANEL_API_URL in the .env file, then run `php artisan config:clear`.';
    }

    private static function isConfigured(): bool
    {
        return ! empty(config('services.netpostpanel.key'));
    }

    public static function make(string $entityType, string $locale = 'en'): Action
    {
        $actionName = 'generateWithAi_'.$locale;
        $label = match ($locale) {
            'uk' => 'Згенерувати за допомогою AI',
            'pl' => 'Wygeneruj za pomocą AI',
            default => 'Generate with AI',
        };

        $configured = self::isConfigured();

        return Action::make($actionName)
            ->label($label)
            ->icon(Heroicon::OutlinedSparkles)
            ->color('primary')
            ->modalHeading($configured ? "Generate {$entityType} content ({$locale})" : 'AI not configured')
            ->modalDescription($configured ? 'Enter your topic instructions or outline. The AI will generate drafts and fill the fields in this tab without auto-saving.' : null)
            ->modalSubmitActionLabel($configured ? 'Generate' : 'Close')
            ->schema($configured ? [
                Textarea::make('prompt')
                    ->label('Topic / Instructions')
                    ->placeholder('e.g. Write an in-depth article about microservices best practices...')
                    ->rows(4)
                    ->required(),
                Select::make('locale')
                    ->label('Language')
                    ->options([
                        'en' => 'English',
                        'uk' => 'Українська',
                        'pl' => 'Polski',
                    ])
                    ->default($locale)
                    ->required(),
                Select::make('writing_style')
                    ->label('Writing Style')
                    ->options([
                        'Professional' => 'Professional',
                        'Engaging' => 'Engaging',
                        'Informative' => 'Informative',
                        'Casual' => 'Casual',
                        'Technical' => 'Technical',
                    ])
                    ->default('Professional')
                    ->required(),
                TextInput::make('keywords')
                    ->label('Target SEO Keywords (Optional)')
                    ->placeholder('e.g. architecture, devops, microservices'),
            ] : [
                Section::make('Configuration required')
                    ->description(self::configurationMessage())
                    ->icon(Heroicon::OutlinedExclamationTriangle),
            ])
            ->action(function (array $data, $set, ?Model $record, ContentGeneratorService $generator) use ($entityType, $locale): void {
                if (! self::isConfigured()) {
                    Notification::make()
                        ->title('AI not configured')
                        ->body(self::configurationMessage())
                        ->danger()
                        ->send();

                    return;
                }

                try {
                    $targetLocale = $data['locale'] ?? $locale;
                    $response = $generator->generate(
                        entityType: $entityType,
                        userPrompt: $data['prompt'],
                        locale: $targetLocale,
                        writingStyle: $data['writing_style'] ?? 'Professional',
                        keywords: $data['keywords'] ?? null,
                        record: $record,
                    );

                    if (($response['status'] ?? 'succeeded') === 'pending') {
                        Notification::make()
                            ->title('Generation started')
                            ->body('Content is being generated asynchronously. It will be available shortly.')
                            ->info()
                            ->send();

                        return;
                    }

                    self::populateFields($set, $targetLocale, $response['payload'] ?? []);

                    Notification::make()
                        ->title('Content generated successfully')
                        ->body('Form fields have been populated. Review the draft before saving.')
                        ->success()
                        ->send();
                } catch (Throwable $e) {
                    Notification::make()
                        ->title('Generation failed')
                        ->body($e->getMessage())
                        ->danger()
                        ->send();
                }
            });
    }

    /**
     * Set generated payload values to form schema fields.
     *
     * @param  array<string, mixed>  $payload
     */
    public static function populateFields(callable $set, string $locale, array $payload): void
    {
        $prefix = $locale === 'en' ? '' : "translations.{$locale}.";

        foreach ($payload as $key => $value) {
            if ($value !== null) {
                $set($prefix.$key, $value);
            }
        }
    }
}
