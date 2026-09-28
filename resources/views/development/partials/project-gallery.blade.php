{{-- Cover screenshot of a project card. A click opens the shared lightbox (<dialog data-gallery-dialog>
     in development/landing.blade.php), which pages through all of the project's shots from data-gallery-items.
     The cover is a zoomed crop of the first shot ({file}-cover.webp): a whole app screen squeezed into a
     card is unreadable on a phone.
     Every shot may have a dark twin ({file}-dark.webp, -dark-800, -dark-cover): the page's dark theme shows
     it, the light theme the plain file. The theme is a class on <html>, so the switch is CSS (dark:) for the
     cover and a check of that class in the lightbox script. --}}
{{-- PHP blocks only, never the one-line PHP directive form: Blade cuts raw PHP blocks out before anything
     else, from the first opening directive to the closing one, so mixing the two forms swallows the
     conditional between them (and even directive names written in a comment count). --}}
@php
    $shots = __("{$copy}.proofs.projects.$project.screens");
@endphp
@if(is_array($shots) && $shots !== [])
    @php
        $screen = fn (string $name): ?string => file_exists(public_path("landing/screens/{$name}.webp")) ? "landing/screens/{$name}.webp" : null;
        $items = collect($shots)->map(fn (array $shot): array => array_filter([
            'src' => asset($screen($shot['file'])),
            'srcDark' => ($dark = $screen($shot['file'].'-dark')) ? asset($dark) : null,
            'caption' => $shot['caption'],
        ]))->values()->all();
        $first = $shots[0]['file'];
        $cover = $screen($first.'-cover') ?? $screen($first.'-800');
        $coverDark = $screen($first.'-dark-cover') ?? $screen($first.'-dark-800');
    @endphp
    <button type="button" data-gallery-open data-gallery-items='@json($items)'
            aria-label="{{ __($copy.'.proofs.gallery_open') }}: {{ $shots[0]['caption'] }}"
            class="group relative block w-full aspect-[16/10] overflow-hidden cursor-zoom-in bg-slate-100 dark:bg-slate-800 border-b border-slate-200/80 dark:border-slate-800 focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-500">
        <img src="{{ asset($cover) }}" alt="{{ $shots[0]['caption'] }}"
             width="800" height="500" loading="lazy" decoding="async"
             class="w-full h-full object-cover object-left-top transition-transform duration-300 group-hover:scale-[1.02] {{ $coverDark ? 'dark:hidden' : '' }}">
        @if($coverDark)
            <img src="{{ asset($coverDark) }}" alt="{{ $shots[0]['caption'] }}"
                 width="800" height="500" loading="lazy" decoding="async"
                 class="hidden dark:block w-full h-full object-cover object-left-top transition-transform duration-300 group-hover:scale-[1.02]">
        @endif
        <span class="absolute bottom-3 right-3 inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold text-white bg-slate-950/75 backdrop-blur-sm">
            <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            {{ __($copy.'.proofs.gallery_count', ['count' => count($shots)]) }}
        </span>
    </button>
@endif
