<x-filament-panels::page>
    @if($zohoError)
        <x-filament::section>
            <p class="text-danger-600 dark:text-danger-400 font-medium">
                Zoho CRM request failed: {{ $zohoError }}
            </p>
        </x-filament::section>
    @else
        {{ $this->table }}
    @endif
</x-filament-panels::page>
