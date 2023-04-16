<div class="pricing-table pricing-table-creative">
    <!-- Pricing table item-->
    <article class="pricing-table__item pricing-table-creative__item">
        <div class="pricing-table__item-inner">
            @foreach($products as $product)
                @if($product->title === 'Basic')
                    <p class="pricing-table__item-title">{{ $product->title }}</p>
                    <div class="pricing-table__item-price">
                        <p class="pricing-table__item-price-value">
                            <span class="small">$</span><span>{{ $product->price_value }}</span>
                        </p>
                        <p class="pricing-table__item-price-details">{{ $product->details }}</p>
                    </div>
                    <div class="pricing-table__item-control">
                        <div class="button-wrap">
                            <a class="button btn-primary-outline button-ujarak" href="#">Order now</a>
                        </div>
                    </div>
                    <ul class="pricing-table__item-features">
                        @foreach($product->services as $service)
                            <li><span class="{{ $service->css_style }}">{{ $service->title }}</span></li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
    </article>
    <!-- Pricing table item-->
    <article class="pricing-table__item pricing-table-creative__item pricing-table-creative__item_prefered">
        <div class="pricing-table__item-inner">
            @foreach($products as $product)
                @if($product->title === 'Optimal')
                    <p class="pricing-table__item-title">{{ $product->title }}</p>
                    <div class="pricing-table__item-price">
                        <p class="pricing-table__item-price-value">
                            <span class="small">$</span><span>{{ $product->price_value }}</span>
                        </p>
                        <p class="pricing-table__item-price-details">{{ $product->details }}</p>
                    </div>
                    <div class="pricing-table__item-control">
                        <div class="button-wrap">
                            <a class="button btn-white-outline button-ujarak" href="#">Order now</a>
                        </div>
                    </div>
                    <ul class="pricing-table__item-features">
                        @foreach($product->services as $service)
                            <li><span class="{{ $service->css_style }}">{{ $service->title }}</span></li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
    </article>
    <!-- Pricing table item-->
    <article class="pricing-table__item pricing-table-creative__item">
        <div class="pricing-table__item-inner">
            @foreach($products as $product)
                @if($product->title === 'Ultimate')
                    <p class="pricing-table__item-title">{{ $product->title }}</p>
                    <div class="pricing-table__item-price">
                        <p class="pricing-table__item-price-value"><span
                                class="small">$</span><span>{{$product->price_value}}</span></p>
                        <p class="pricing-table__item-price-details">{{ $product->details }}</p>
                    </div>
                    <div class="pricing-table__item-control">
                        <div class="button-wrap">
                            <a class="button btn-primary-outline button-ujarak" href="#">Order now</a>
                        </div>
                    </div>
                    <ul class="pricing-table__item-features">
                        @foreach($product->services as $service)
                            <li><span class="{{ $service->css_style }}">{{ $service->title }}</span></li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
    </article>
</div>

