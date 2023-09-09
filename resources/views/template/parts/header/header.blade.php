<header class="navigation">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light px-0">
            <a class="navbar-brand order-1 py-0" href="{{homeLink()}}">

                @if($site['isTextLogo'])
                    <h2 class="logo-text">{{$site['name']}}</h2>
                @else
                    <img loading="prelaod" decoding="async" class="img-fluid" src="{{admLogoUrl()}}" alt="{{$site['name']}}">
                @endif

            </a>
            <div class="navbar-actions order-3 ml-0 ml-md-4">
                <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
                        data-target="#navigation"> <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <form action="{{route('adm-search')}}" class="search order-lg-3 order-md-2 order-3 ml-auto">
                <input id="search-query" name="s" type="search" placeholder="Post Search..." autocomplete="off">
            </form>
            <!-- MENU -->
            <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
                <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
                    @foreach(admMenuByPosition('header') as $item)
                        @if($item->link == '/categories')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="{{$item->link}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{$item->title}}
                                </a>
                                <div class="dropdown-menu">
                                    @foreach(parentsCategories() as $category)
                                        <a class="dropdown-item" href="{{$category->link()}}">{{$category->title}}</a>
                                    @endforeach
                                </div>
                            </li>
                            @continue
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{$item->link()}}">
                                {{$item->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <x-locale-switcher/>

            </div>

        </nav>
    </div>

</header>
