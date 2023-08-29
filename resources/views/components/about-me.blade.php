@props([
    'page' => pageDataBySlug('about'),
])

@if($page)
    @php
        $cf = $page->customFields();
    @endphp

    <div class="widget">
        <div class="widget-body">

            @if($page->thumb())
                <img loading="lazy" decoding="async" src="{{$page->thumb()}}" alt="{{$page->title}}" class="w-100 author-thumb-sm d-block">
            @endif

            <h2 class="widget-title my-3">{{$cf['name'] ?? ''}}</h2>
            <p class="mb-3 pb-2">
                {!! $page->short !!}
            </p>
            <a href="{{$page->link()}}" class="btn btn-sm btn-outline-primary">
                {{$cf['button_text'] ?? ''}}
            </a>
        </div>
    </div>

@endif

