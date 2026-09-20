<?php

namespace App\Filament\Support;

use App\Services\AI\ContentGeneratorService;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class AiTranslationAction
{
    private static function configurationMessage(): string
    {
        return 'AI is not configured. Set NETPOSTPANEL_API_KEY and NETPOSTPANEL_API_URL in the .env file, then run `php artisan config:clear`.';
    }

    private static function isConfigured(): bool
    {
        return ! empty(config('services.netpostpanel.key'));
    }

    public static function make(string $entityType, string $targetLocale): Action
    {
        $configured = self::isConfigured();

        return Action::make('translateWithAi_'.$targetLocale)
            ->label(match ($targetLocale) {
                'uk' => 'Перекласти з англійської',
                'pl' => 'Przetłumacz z angielskiego',
                default => 'Translate from English',
            })
            ->icon(Heroicon::OutlinedLanguage)
            ->color('gray')
            ->disabled(fn (?Model $record): bool => ! self::hasSourceContent($record))
            ->tooltip(fn (?Model $record): ?string => self::hasSourceContent($record) ? null : 'Save English content first')
            ->modalHeading($configured ? "Translate to {$targetLocale} from English" : 'AI not configured')
            ->modalDescription($configured ? 'Translate the saved English content into this language. Choose between an adapted natural rewrite or a faithful literal translation.' : null)
            ->modalSubmitActionLabel($configured ? 'Translate' : 'Close')
            ->schema(self::modalSchema($configured))
            ->action(fn (array $data, $set, ?Model $record, ContentGeneratorService $generator) => self::translate($data, $set, $record, $generator, $entityType, $targetLocale));
    }

    private static function hasSourceContent(?Model $record): bool
    {
        return $record && ! empty($record->name) && ! empty($record->content);
    }

    private static function modalSchema(bool $configured): array
    {
        if (! $configured) {
            return [
                Section::make('Configuration required')
                    ->description(self::configurationMessage())
                    ->icon(Heroicon::OutlinedExclamationTriangle),
            ];
        }

        return [
            Radio::make('translation_mode')
                ->label('Translation Mode')
                ->options([
                    'adapted' => 'Adapted (Cultural adaptation & natural localization for target audience)',
                    'literal' => 'Literal (Faithful and precise translation preserving exact structure)',
                ])
                ->default('adapted')
                ->required(),
        ];
    }

    private static function translate(array $data, $set, ?Model $record, ContentGeneratorService $generator, string $entityType, string $targetLocale): void
    {
        if (! self::isConfigured()) {
            Notification::make()
                ->title('AI not configured')
                ->body(self::configurationMessage())
                ->danger()
                ->send();

            return;
        }

        if (! self::hasSourceContent($record)) {
            Notification::make()
                ->title('Cannot translate')
                ->body('Please save the English content first before translating.')
                ->warning()
                ->send();

            return;
        }

        try {
            $response = $generator->translate(
                entityType: $entityType,
                sourceContent: array_filter([
                    'name' => $record->getAttribute('name'),
                    'content' => $record->getAttribute('content'),
                    'description' => $record->getAttribute('description'),
                    'keywords' => $record->getAttribute('keywords'),
                    'meta' => $record->getAttribute('meta'),
                ], fn ($val) => $val !== null),
                targetLocale: $targetLocale,
                translationMode: $data['translation_mode'] ?? 'adapted',
                record: $record,
            );

            if (($response['status'] ?? 'succeeded') === 'pending') {
                Notification::make()
                    ->title('Translation started')
                    ->body('Content is being translated asynchronously. It will be available shortly.')
                    ->info()
                    ->send();

                return;
            }

            AiGenerationAction::populateFields($set, $targetLocale, $response['payload'] ?? []);

            Notification::make()
                ->title('Translation completed')
                ->body('Fields have been populated with the translated content. Review before saving.')
                ->success()
                ->send();
        } catch (Throwable $e) {
            Notification::make()
                ->title('Translation failed')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }
}
