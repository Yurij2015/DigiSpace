<div class="price-matrix">
    @foreach($serviceCategories as $category)
        @php($pricedServices = $category->service->where('status', 'active')->whereNotNull('price')->sortBy('price'))
        @if($pricedServices->isNotEmpty())
            <div class="price-matrix__group">
                <div class="price-matrix__head">
                    <span class="price-matrix__icon {{ $category->icon ?? 'linearicons-code' }}"></span>
                    <h3 class="price-matrix__category">
                        <a href="{{ route('category-services', $category) }}">{{ $category->name }}</a>
                    </h3>
                    <span class="price-matrix__count">{{ trans_choice('site.services_count', $pricedServices->count()) }}</span>
                </div>
                <div class="price-matrix__rows">
                    @foreach($pricedServices as $service)
                        <a class="price-matrix__row"
                           href="{{ route('category-service', ['serviceCategory' => $category, 'service' => $service]) }}">
                            <span class="price-matrix__info">
                                <span class="price-matrix__service">{{ $service->title }}</span>
                                @if($service->details)
                                    <span class="price-matrix__details">{{ $service->details }}</span>
                                @endif
                            </span>
                            @if($service->timeline)
                                <span class="price-matrix__timeline"><span class="linearicons-clock"></span> {{ $service->timeline }}</span>
                            @endif
                            <span class="price-matrix__price">
                                <span class="price-matrix__from">{{ __('site.price_from') }}</span>
                                <span class="price-matrix__value">${{ number_format((float) $service->price, 0) }}</span>
                            </span>
                            <span class="price-matrix__arrow linearicons-chevron-right"></span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
</div>
