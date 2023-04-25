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
                                alt=""
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
                            {!! $widget->content !!}
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
    <div class="owl-outer-navigation" id="owl-carousel-nav"></div>
</div>
