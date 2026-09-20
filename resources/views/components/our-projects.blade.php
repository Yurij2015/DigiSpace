<h2>{{ $clientsCategory->name }}</h2>
<!-- Owl Carousel-->
<div class="owl-outer-navigation-wrap owl-carousel_nav-modern wow fadeIn">
    <div class="owl-carousel quote-creative-carousel review-carousel" data-items="1" data-lg-items="2"
         data-stage-padding="0" data-margin="30"
         data-owl="{&quot;dots&quot;:true,&quot;nav&quot;:true,&quot;loop&quot;:true,&quot;autoplayTimeout&quot;:3500,&quot;navContainer&quot;:&quot;#owl-carousel-nav&quot;,&quot;dotsEach&quot;:1}">

        @foreach( $clients['widgets'] as $widget )
            <div class="item">
                <!-- Quote Creative-->
                <article class="quote-creative">
                    <div class="quote-creative__header">
                        <div class="quote-creative__media"><img
                                src="{{ asset($widget->widget_image) }}"
                                alt="{{ $widget->title }}"
                                width="112" height="99"/>
                        </div>
                        <div class="quote-creative__info">
                            <p class="quote-creative__title">{{ $widget->title }}</p>
                            <p class="quote-creative__subtitle">{{ $widget->subtitle }}</p>
                        </div>
                    </div>
                    <div class="quote-creative__main">
                        <div class="quote-creative__mark">
                            <svg x="0px" y="0px" width="39px" height="21px" viewbox="0 0 39 21">
                                <g fill="url(#grad1)">
                                    <polyline
                                        points="8.955,21 0,14.031 0.002,0.001 15.984,0.001 15.984,13.984 8.969,14.016 "></polyline>
                                    <polyline
                                        points="31.97,20.999 23.016,14.031 23.018,0.001 39,0.001 39,13.984 31.984,14.015 "></polyline>
                                </g>
                            </svg>
                        </div>
                        <div class="quote-creative__main-text">
                            <div class="quote-creative__clamp is-clamped">
                                {!! $widget->content !!}
                            </div>
                            <button type="button" class="quote-creative__toggle" hidden
                                    data-more="{{ __('site.read_more') }}" data-less="{{ __('site.show_less') }}">
                                <span>{{ __('site.read_more') }}</span>
                                <svg width="12" height="8" viewBox="0 0 12 8" fill="none" aria-hidden="true">
                                    <path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="2"
                                          stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
    <div class="owl-outer-navigation" id="owl-carousel-nav"></div>
</div>
@once
    <script>
        window.addEventListener('load', function () {
            document.querySelectorAll('.quote-creative__clamp.is-clamped').forEach(function (el) {
                var btn = el.parentElement.querySelector('.quote-creative__toggle');
                if (!btn) {
                    return;
                }
                el.classList.remove('is-clamped');
                var full = el.scrollHeight;
                el.classList.add('is-clamped');
                if (full > el.clientHeight + 1) {
                    btn.hidden = false;
                }
            });
        });
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('.quote-creative__toggle');
            if (!btn) {
                return;
            }
            var text = btn.closest('.quote-creative__main-text').querySelector('.quote-creative__clamp');
            var collapsed = text.classList.toggle('is-clamped');
            btn.classList.toggle('is-open', !collapsed);
            btn.querySelector('span').textContent = collapsed ? btn.dataset.more : btn.dataset.less;
        });
    </script>
@endonce
