<div style="width: 78px; flex-shrink: 0">
    <x-filament::input.wrapper>
        <x-filament::input.select aria-label="{{ __('site.language') }}" onchange="window.location.assign(this.value)">
            @foreach (config('locales.supported', []) as $locale)
                <option value="{{ route('locale.switch', ['locale' => $locale]) }}" @selected(app()->getLocale() === $locale)>
                    {{ strtoupper($locale === 'uk' ? 'ua' : $locale) }}
                </option>
            @endforeach
        </x-filament::input.select>
    </x-filament::input.wrapper>
</div>
