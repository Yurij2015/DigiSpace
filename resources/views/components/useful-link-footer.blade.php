<div class="col-sm-6">
    <ul class="list-marked list-marked_primary">
        @foreach($footerUsefulLinks as $footerUsefulLink)
            @if($footerUsefulLink->position === config('constants.FOOTER_USEFUL_LINKS_COL_LEFT'))
                <li><a href="{{ str_starts_with($footerUsefulLink->url, 'http') ? $footerUsefulLink->url : url(app()->getLocale().'/'.$footerUsefulLink->url) }}">{{ $footerUsefulLink->name }}</a></li>
            @endif
        @endforeach
    </ul>
</div>
<div class="col-sm-6">
    <ul class="list-marked list-marked_primary">
        @foreach($footerUsefulLinks as $footerUsefulLink)
            @if($footerUsefulLink->position === config('constants.FOOTER_USEFUL_LINKS_COL_RIGHT'))
                <li><a href="{{ str_starts_with($footerUsefulLink->url, 'http') ? $footerUsefulLink->url : url(app()->getLocale().'/'.$footerUsefulLink->url) }}">{{ $footerUsefulLink->name }}</a></li>
            @endif
        @endforeach
    </ul>
</div>
