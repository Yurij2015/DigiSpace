<footer class="section footer-classic context-dark">
    <div class="footer-classic__main bg-gray-3">
        <div class="container">
            <div class="row row-50 align-items-sm-end justify-content-sm-center justify-content-lg-start">
                <div class="col-lg-6">
                    <div class="footer-classic__custom-column">
                        <div class="unit flex-sm-row">
                            @foreach($footerWidgets as $widget)
                                @if($widget->title === 'Phone')
                                    <div class="unit__left"><span
                                            class="icon icon-md icon-default {{ $widget->icon }}"></span></div>
                                    <div class="unit__body">
                                        <a class="link link-lg" href="tel:#">{{ $widget->subtitle }}</a>
                                        <p>{{ $widget->content }}</p>
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
                            <!-- RD Mailform-->
                            <form class="rd-mailform form_inline form_lg" data-form-output="form-output-global"
                                  data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
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
                                           href="{{ $icon->url }}"></a>
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
                                {{-- TODO add ArticleFooterComponent --}}
                                <!-- Post small-->
                                <article class="post-small">
                                    <div class="post-small__aside"><a class="post-small__media"
                                                                      href="blog-post.html"><img
                                                class="post-small__image"
                                                src="{{ asset('images/post-small-1-80x68.jpg') }}"
                                                alt=""
                                                width="80" height="68"/></a></div>
                                    <div class="post-small__main">
                                        <p class="post-small__title"><a href="blog-post.html">Benefits of Async/Await in
                                                Programming</a></p>
                                        <time class="post-small__time" datetime="2022">January 12, 2022</time>
                                    </div>
                                </article>
                                <!-- Post small-->
                                <article class="post-small">
                                    <div class="post-small__aside"><a class="post-small__media"
                                                                      href="blog-post.html"><img
                                                class="post-small__image"
                                                src="{{ asset('images/post-small-2-80x68.jpg') }}"
                                                alt=""
                                                width="80" height="68"/></a></div>
                                    <div class="post-small__main">
                                        <p class="post-small__title"><a href="blog-post.html">Key Considerations and
                                                Warnings of iPaaS</a></p>
                                        <time class="post-small__time" datetime="2022">January 12, 2022</time>
                                    </div>
                                </article>
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
                                {{-- TODO add UsefulLinkFooterComponent --}}
                                <div class="col-sm-6">
                                    <ul class="list-marked list-marked_primary">
                                        <li><a href="#">DB Management</a></li>
                                        <li><a href="#">iOS/MacOs Apps</a></li>
                                        <li><a href="#">Android Apps</a></li>
                                        <li><a href="#">Windows Apps</a></li>
                                        <li><a href="#">UX Design</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-marked list-marked_primary">
                                        <li><a href="#">Tutorials</a></li>
                                        <li><a href="#">Product Support</a></li>
                                        <li><a href="contact-us.html">Contact Us</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="footer-default__aside bg-gray-5">
        <div class="container">
            <div class="footer-default__aside-inner">
                <!-- Rights-->
                <p class="rights"><span>&copy;&nbsp;</span><span
                        class="copyright-year"></span><span>&nbsp;</span><span>Techsoft</span><span>.&nbsp;</span><a
                        href="privacy-policy.html">Privacy Policy</a></p>
                <ul class="list-separated list-inline">
                    <li><a href="faq.html">FAQ</a></li>q
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
