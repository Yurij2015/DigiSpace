@php
    // Decorative icons per grid position; counter values/labels come from
    // widget category 9 ("Some Facts About Us") — editable in the admin panel.
    // widget->icon stores the value postfix ("+" or "k+").
    $factsIcons = ['linearicons-users2', 'linearicons-server', 'linearicons-cog2', 'linearicons-code'];
@endphp
<div
    class="row row-50 flex-md-row-reverse justify-content-md-between align-items-center align-items-lg-start">
    <div class="col-md-5 wow fadeInRightSmall">
        <div class="box-width-3 box-centered">
            <h2>{{ __('site.facts_title') }}</h2>
            <p class="text-style-1">{{ __('site.facts_text') }}</p><a
                class="button button-lg btn-primary button-ujarak"
                href="{{ route('pages.page', 'meet-digispace-the-company-which-opens-a-new-era-in-the-web-development-industry') }}">{{ __('site.read_more') }}</a>
        </div>
    </div>
    <div class="col-md-7 col-lg-6 wow fadeInLeftSmall">
        <div class="row row-style-1">
            @foreach(($factsWidgets ?? collect()) as $widget)
                <div class="col-sm-6">
                    <div class="col-inner">
                        <!--Counter-->
                        <article class="box-counter box-counter_modern">
                            <div class="box-counter__main">
                                <div class="box-counter__icon {{ $factsIcons[$loop->index] ?? 'linearicons-cog2' }}"></div>
                                <div class="counter">{{ $widget->content }}</div>
                                @if($widget->icon === 'k+')
                                    <div class="small">k</div>
                                    <div class="counter-postfix">+</div>
                                @elseif(filled($widget->icon))
                                    <div class="counter-postfix">{{ $widget->icon }}</div>
                                @endif
                            </div>
                            <p class="box-counter__title">{{ $widget->title }}</p>
                        </article>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
