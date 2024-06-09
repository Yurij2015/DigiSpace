<div class="blog-layout__aside">
    <div class="blog-layout__aside-item">
        <!-- RD Search-->
        <form class="rd-search rd-search_inline form_lg form_outline" action="{{ route('service-search') }}"
              method="get">
            <div class="form-wrap">
                <label class="form-label" for="rd-search-blog-form-input">Search the service...</label>
                <input class="form-input" id="rd-search-blog-form-input" type="text" name="search"
                       autocomplete="off" required>
            </div>
            <button class="button-link fl-budicons-launch-search81" type="submit"></button>
        </form>
    </div>
    <div class="blog-layout__aside-item blog-layout__aside-item_bordered">
        <p class="custom-heading-line heading-8">Service Categories</p>
        <ul class="list-categories">
            @foreach($serviceCategories as $category )
                <li class="{{ url()->current() === route('category-services', $category->slug) ? 'active' : '' }}">
                    @if( url()->current() !== route('category-services', $category->slug))
                        <a href="{{ route('category-services', $category->slug) }}">{{ $category['name'] }}</a>
                    @else
                        {{ $category['name'] }}
                    @endif
                    <span class="count">{{ count($category->service) }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
