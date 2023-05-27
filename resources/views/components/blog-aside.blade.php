<div class="blog-layout__aside">
    <div class="blog-layout__aside-item">
        <!-- RD Search-->
        <form class="rd-search rd-search_inline form_lg form_outline" action="{{ route('blog-search') }}"
              method="get">
            <div class="form-wrap">
                <label class="form-label" for="rd-search-blog-form-input">Search the blog...</label>
                <input class="form-input" id="rd-search-blog-form-input" type="text" name="search"
                       autocomplete="off">
            </div>
            <button class="button-link fl-budicons-launch-search81" type="submit"></button>
        </form>
    </div>
    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
        <p class="custom-heading-line heading-8">Categories</p>
        <ul class="list-categories">
            <li class="{{ Route::is('blog') ? 'active' : '' }}">
                <a href="{{ route('blog') }}">All categories</a>
                <span class="count">{{ $postsNumber }}</span>
            </li>
            @foreach($sideBarData['categories'] as $category )
                <li class="{{ url()->current() === route('blog-category', $category->slug) ? 'active' : '' }}">
                    <a href="{{ route('blog-category', $category->slug) }}">{{ $category['name'] }}</a>
                    <span class="count">{{ count($category['post']) }}</span>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
        <p class="custom-heading-line heading-8">Latest Posts</p>
        <ul class="list-posts">
            @foreach($sideBarData['latestPosts'] as $post)
                <li>
                    <!-- Post Line-->
                    <article class="post-line">
                        <time class="post-line__time" datetime="{{ $post['created_at']->format('Y') }}">
                            <span class="post-line__time-day">{{ $post['created_at']->format('d') }}</span>
                            <span class="post-line__time-month">{{ $post['created_at']->format('M') }}</span>
                        </time>
                        <div class="post-line__title">
                            <a href="{{ route('blog.post', $post->slug) }}">{{ $post['name'] }}</a>
                        </div>
                    </article>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
        <p class="custom-heading-line heading-8">Archive</p>
        <!-- Select 2-->
        <select class="form-input select" data-placeholder="All" data-minimum-results-for-search="Infinity"
                data-constraints="{!! '@' !!}Required" onchange="window.location.assign('/blog-archive/'+this.value)">
            <option {{ !$sideBarData['archive'] ? 'selected' : 'disabled' }}>All</option>
            @foreach($sideBarData['archive'] as $archiveItem)
                <option
                    {{ url()->current() === route('blog-archive', $archiveItem->year .'-'. $archiveItem->month) ? 'selected' : '' }}
                    value="{{ $archiveItem->year .'-'. $archiveItem->month }}">
                    {{ $archiveItem->month_name }} ({{ $archiveItem->post_count }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="blog-layout__aside-item">
        @if($banner)
            <a class="link-banner" href="{{ $banner->url }}">
                <img src="{{ $banner->img_path }}" alt="{{ $banner->alt }}" width="305" height="302"/>
            </a>
        @endif
    </div>
</div>
