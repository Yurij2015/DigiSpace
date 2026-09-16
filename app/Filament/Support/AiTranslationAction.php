<?php

namespace App\Filament\Support;

use App\Services\AI\ContentGeneratorService;
use Filament\Actions\Action;
use Filament\Forms\Components\Radio;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class AiTranslationAction
{
    public static function make(string $entityType, string $targetLocale): Action
    {
        $actionName = 'translateWithAi_'.$targetLocale;
        $label = match ($targetLocale) {
            'uk' => 'Перекласти з англійської',
            'pl' => 'Przetłumacz z angielskiego',
            default => 'Translate from English',
        };

        return Action::make($actionName)
            ->label($label)
            ->icon(Heroicon::OutlinedLanguage)
            ->color('gray')
            ->disabled(fn (?Model $record): bool => ! $record || empty($record->name) || empty($record->content))
            ->tooltip(fn (?Model $record): ?string => (! $record || empty($record->name) || empty($record->content)) ? 'Save English content first' : null)
            ->modalHeading("Translate to {$targetLocale} from English")
            ->modalDescription('Translate the saved English content into this language. Choose between an adapted natural rewrite or a faithful literal translation.')
            ->modalSubmitActionLabel('Translate')
            ->form([
                Radio::make('translation_mode')
                    ->label('Translation Mode')
                    ->options([
                        'adapted' => 'Adapted (Cultural adaptation & natural localization for target audience)',
                        'literal' => 'Literal (Faithful and precise translation preserving exact structure)',
                    ])
                    ->default('adapted')
                    ->required(),
            ])
            ->action(function (array $data, $set, ?Model $record, ContentGeneratorService $generator) use ($entityType, $targetLocale): void {
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
