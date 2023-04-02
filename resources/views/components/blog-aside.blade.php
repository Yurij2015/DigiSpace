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
            @foreach($sideBarData['categories'] as $categories )
                <li class={{ $categories['name'] === 'All categories' ? 'active' : '' }}>
                    <a href="{{ $categories['url'] }}">{{ $categories['name'] }}</a>
                    <span class="count">{{ $categories['count'] }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
        <p class="custom-heading-line heading-8">Latest Posts</p>
        <ul class="list-posts">
            @foreach($sideBarData['latestPosts'] as $latestPosts)
                <li>
                    <!-- Post Line-->
                    <article class="post-line">
                        <time class="post-line__time" datetime="{{ $latestPosts['year'] }}">
                            <span class="post-line__time-day">{{ $latestPosts['day'] }}</span>
                            <span class="post-line__time-month">{{ $latestPosts['month'] }}</span>
                        </time>
                        <div class="post-line__title">
                            <a href="{{ $latestPosts['url'] }}">{{ $latestPosts['title'] }}</a>
                        </div>
                    </article>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
        <p class="custom-heading-line heading-8">Archive</p>
        <!-- Select 2-->
        <select class="form-input select" data-placeholder="All"
                data-minimum-results-for-search="Infinity" data-constraints="Required">
            @foreach($sideBarData['archive'] as $archiveItem)
                <option value="{{ $archiveItem['id'] }}">{{ $archiveItem['monthYear'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="blog-layout__aside-item">
        <a class="link-banner" href="#">
            <img src="{{ asset('images/banner-305x302.jpg') }}" alt="" width="305" height="302"/>
        </a>
    </div>
</div>
