<div class="blog-layout__aside">
    <div class="blog-layout__aside-item">
        <!-- RD Search-->
        <form class="rd-search rd-search_inline form_lg form_outline" action="search-results.html"
              method="GET">
            <div class="form-wrap">
                <label class="form-label" for="rd-search-blog-form-input">Search the blog...</label>
                <input class="form-input" id="rd-search-blog-form-input" type="text" name="s"
                       autocomplete="off">
            </div>
            <button class="button-link fl-budicons-launch-search81" type="submit"></button>
        </form>
    </div>
    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
        <p class="custom-heading-line heading-8">Categories</p>
        <ul class="list-categories">
            <li class="active"><a href="#">All categories</a><span class="count">64</span></li>
            <li><a href="#">Software</a><span class="count">23</span></li>
            <li><a href="#">Development</a><span class="count">10</span></li>
            <li><a href="#">Programming</a><span class="count">10</span></li>
        </ul>
    </div>
    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
        <p class="custom-heading-line heading-8">Latest Posts</p>
        <ul class="list-posts">
            <li>
                <!-- Post Line-->
                <article class="post-line">
                    <time class="post-line__time" datetime="2021"><span
                            class="post-line__time-day">24</span><span
                            class="post-line__time-month">may</span></time>
                    <div class="post-line__title"><a href="blog-post.html">Startup Software
                            Development</a></div>
                </article>
            </li>
            <li>
                <!-- Post Line-->
                <article class="post-line">
                    <time class="post-line__time" datetime="2021"><span
                            class="post-line__time-day">12</span><span
                            class="post-line__time-month">may</span></time>
                    <div class="post-line__title"><a href="blog-post.html">Hybrid Cloud Management
                            Software Solutions</a></div>
                </article>
            </li>
            <li>
                <!-- Post Line-->
                <article class="post-line">
                    <time class="post-line__time" datetime="2021"><span
                            class="post-line__time-day">03</span><span
                            class="post-line__time-month">may</span></time>
                    <div class="post-line__title"><a href="blog-post.html">Creating Better Software
                            Through Design Thinking</a></div>
                </article>
            </li>
        </ul>
    </div>
    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
        <p class="custom-heading-line heading-8">Archive</p>
        <!-- Select 2-->
        <select class="form-input select" data-placeholder="All"
                data-minimum-results-for-search="Infinity" data-constraints="Required">
            <option>August 2021</option>
            <option value="1">July 2021</option>
            <option value="2">June 2021</option>
            <option value="3">May 2021</option>
            <option value="4">April 2021</option>
            <option value="5">March 2021</option>
        </select>
    </div>
    <div class="blog-layout__aside-item">
        <a class="link-banner" href="#">
            <img src="{{ asset('images/banner-305x302.jpg') }}" alt="" width="305" height="302"/>
        </a>
    </div>
</div>
