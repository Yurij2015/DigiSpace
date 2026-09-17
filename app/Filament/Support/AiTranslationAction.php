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
        $actionName = 'translateWithAi_'.$targetLocale;
        $label = match ($targetLocale) {
            'uk' => 'Перекласти з англійської',
            'pl' => 'Przetłumacz z angielskiego',
            default => 'Translate from English',
        };

        $configured = self::isConfigured();

        return Action::make($actionName)
            ->label($label)
            ->icon(Heroicon::OutlinedLanguage)
            ->color('gray')
            ->disabled(fn (?Model $record): bool => ! $record || empty($record->name) || empty($record->content))
            ->tooltip(fn (?Model $record): ?string => (! $record || empty($record->name) || empty($record->content)) ? 'Save English content first' : null)
            ->modalHeading($configured ? "Translate to {$targetLocale} from English" : 'AI not configured')
            ->modalDescription($configured ? 'Translate the saved English content into this language. Choose between an adapted natural rewrite or a faithful literal translation.' : null)
            ->modalSubmitActionLabel($configured ? 'Translate' : 'Close')
            ->schema($configured ? [
                Radio::make('translation_mode')
                    ->label('Translation Mode')
                    ->options([
                        'adapted' => 'Adapted (Cultural adaptation & natural localization for target audience)',
                        'literal' => 'Literal (Faithful and precise translation preserving exact structure)',
                    ])
                    ->default('adapted')
                    ->required(),
            ] : [
                Section::make('Configuration required')
                    ->description(self::configurationMessage())
                    ->icon(Heroicon::OutlinedExclamationTriangle),
            ])
            ->action(function (array $data, $set, ?Model $record, ContentGeneratorService $generator) use ($entityType, $targetLocale): void {
                if (! self::isConfigured()) {
                    Notification::make()
                        ->title('AI not configured')
                        ->body(self::configurationMessage())
                        ->danger()
                        ->send();

                    return;
                }

                if (! $record || empty($record->name) || empty($record->content)) {
                    Notification::make()
                        ->title('Cannot translate')
                        ->body('Please save the English content first before translating.')
                        ->warning()
                        ->send();

                    return;
                }

                try {
                    $sourceContent = array_filter([
                        'name' => $record->name,
                        'content' => $record->content,
                        'description' => $record->description,
                        'keywords' => $record->keywords,
                        'meta' => $record->meta ?? null,
                    ], fn ($val) => $val !== null);

                    $payload = $generator->translate(
                        entityType: $entityType,
                        sourceContent: $sourceContent,
                        targetLocale: $targetLocale,
                        translationMode: $data['translation_mode'] ?? 'adapted',
                        record: $record,
                    );

                    AiGenerationAction::populateFields($set, $targetLocale, $payload);

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
            });
    }
}
