@foreach($footerLatestNews as $item)
    <!-- Post small-->
    <article class="post-small">
        <div class="post-small__aside">
            <a class="post-small__media" href="{{ route('blog.post', $item->id) }}">
                <img class="post-small__image"
                     src="{{ asset($item->img_path) }}"
                     alt="" width="80" height="68"/>
            </a>
        </div>
        <div class="post-small__main">
            <p class="post-small__title">
                <a href="{{ route('blog.post', $item->id) }}">
                    {{ $item->name }}
                </a>
            </p>
            <time class="post-small__time" datetime="2023">{{ $item->created_at->toFormattedDateString() }}</time>
        </div>
    </article>
@endforeach
