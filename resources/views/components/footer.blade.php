<footer class="section footer-classic context-dark">
    <div class="footer-classic__main bg-gray-3">
        <div class="container">
            <div class="row row-50 align-items-sm-end justify-content-sm-center justify-content-lg-start">
                <div class="col-lg-6">
                    <div class="footer-classic__custom-column">
                        <div class="unit flex-sm-row">
                            @foreach($footerWidgets as $widget)
                                @if($widget->title === 'Phone')
                                    <div class="unit__left">
                                        <span class="icon icon-md icon-default {{ $widget->icon }}"></span>
                                    </div>
                                    <div class="unit__body">
                                        <a class="link link-lg" href="{{ route('contact-us') }}">
                                            {{ $widget->subtitle }}
                                        </a>
                                        <p>{!! $widget->content !!}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-lg-6">
                    @foreach($footerWidgets as $widget)
                        @if($widget->title === 'Subscribe')
                            <div class="group-md">
                                <h3>{{ $widget->title }}</h3>
                                <p class="large">{{ $widget->subtitle }}</p>
                            </div>
                            <!-- TODO - set up with RD Mailform or send with ajax -->
                            <form class="rd-mailform form_inline form_lg" data-form-output="form-output-global"
                                  data-form-type="subscribe" method="post" action="{{ route('subscriber-save') }}">
                                @csrf
                                <div class="form-wrap">
                                    <input class="form-input" id="subscribe-form-footer-form-email" type="email"
                                           name="email">
                                    <label class="form-label"
                                           for="subscribe-form-footer-form-email">{{ $widget->content }}</label>
                                </div>
                                <div class="form-button">
                                    <button class="button button-lg button-primary button-ujarak" type="submit">
                                        Subscribe
                                    </button>
                                </div>
                            </form>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="row row-50 justify-content-md-center justify-content-lg-start justify-content-xl-between">
                @foreach($footerWidgets as $widget)
                    @if($widget->title === 'About us')
                        <div class="col-md-5 col-lg-3">
                            <p class="custom-heading-1 custom-heading-bordered"> {{ $widget->title }}</p>
                            <div class="divider"></div>
                            <p class="ls-05">{{ $widget->subtitle }}</p>
                            <ul class="list-inline list-inline-xs">
                                @foreach($widget->widgetIcon as $icon)
                                    <li>
                                        <a class="icon icon-xxs icon-circle icon-filled icon-filled_brand {{ $icon->icon_class }}"
                                           href="{{ $icon->url }}" target="_blank"></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach
                @foreach($footerWidgets as $widget)
                    @if($widget->title === 'Latest news')
                        <div class="col-md-5 col-lg-4 col-xl-3">
                            <p class="custom-heading-1 custom-heading-bordered">{{ $widget->title }}</p>
                            <div class="divider"></div>
                            <div class="post-small-wrap">
                                <x-latest-news-in-footer :$footerLatestNews/>
                            </div>
                        </div>
                    @endif
                @endforeach
                @foreach($footerWidgets as $widget)
                    @if($widget->title === 'Useful Links')
                        <div class="col-md-10 col-lg-5 col-xl-4">
                            <p class="custom-heading-1 custom-heading-bordered">{{ $widget->title }}</p>
                            <div class="divider"></div>
                            <div class="row row-5">
                                <x-useful-link-footer :$footerUsefulLinks/>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="footer-default__aside bg-gray-5">
        <x-footer-bottom-bar-content/>
    </div>
</footer>
