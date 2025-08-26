<div class="pricing-table pricing-table-creative">
    @foreach($products as $product)
        <article
            class="pricing-table__item pricing-table-creative__item {{ $product->is_prefered ? 'pricing-table-creative__item_prefered' : '' }} {{ $product->position > 3 ? 'mt-5' : '' }}">
        <div class="pricing-table__item-inner">
                <p class="pricing-table__item-title">{{ $product->title }}</p>
            <p class="pricing-table__item-price-details">{{ $product->description }}</p>
            <div class="pricing-table__item-price">
                    <p class="pricing-table__item-price-value"><span
                            class="small">$</span><span>{{$product->price_value}}</span></p>
                    <p class="pricing-table__item-price-details">{{ $product->details }}</p>
                </div>
                <div class="pricing-table__item-control">
                    <div class="button-wrap">
                        <a class="button btn-primary-outline button-ujarak" href="{{ route('contact-us') }}">
                            Get Details
                        </a>
                    </div>
                </div>
                <ul class="pricing-table__item-features">
                    @foreach($product->services as $service)
                        <li>
                            <span class="{{ $service->css_style }}">
                                {{ $service->title }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </article>
    @endforeach
</div>
