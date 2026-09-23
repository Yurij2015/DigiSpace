<?php

namespace App\Filament\Support;

use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ContentImage
{
    public static function make(string $attribute, string $disk, string $directory = '', bool $url = false): FileUpload
    {
        return FileUpload::make($attribute)
            ->image()
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
            ->maxSize(2048)
            ->disk($disk)
            ->directory($directory)
            ->fetchFileInformation(false)
            ->afterStateHydrated(function (FileUpload $component, ?Model $record) use ($attribute): void {
                $raw = $record?->getRawOriginal($attribute);
                $component->state(filled($raw) ? [(string) str()->uuid() => $raw] : []);
            })
            ->getUploadedFileUsing(function (string $file) use ($disk, $url): array {
                $fileUrl = $url && ! str_starts_with($file, 'http://')
                    && ! str_starts_with($file, 'https://')
                    && ! str_starts_with($file, '/')
                    ? asset($file)
                    : $file;

                return ['name' => basename($file), 'size' => 0, 'type' => null,
                    'url' => $url ? $fileUrl : Storage::disk($disk)->url($file)];
            })
            ->saveUploadedFileUsing(function (TemporaryUploadedFile $file) use ($disk, $directory, $url): string {
                $path = $file->storeAs($directory, str()->uuid().'.'.$file->guessExtension(), $disk);
                if ($path === false) {
                    throw new \RuntimeException('Image could not be saved.');
                }

                return $url ? Storage::disk($disk)->url($path) : $path;
            });
    }
}
