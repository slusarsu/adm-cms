<div class="dropdown">
    <a class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        {{app()->getLocale()}}
    </a>
    <div class="dropdown-menu">
        @foreach(admLanguages() as $locale => $item)
            @if($locale == app()->getLocale())
                @continue(1)
            @endif
            <a class="dropdown-item" href="{{route('locale-switcher', admLocaleSwitcherParams($locale))}}">{{$item}}</a>
        @endforeach
    </div>
</div>
