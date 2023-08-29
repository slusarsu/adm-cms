<footer class="bg-dark mt-5">
    <div class="container section">
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <a class="d-inline-block mb-4 pb-2" href="index.html">

                    @if($site['isTextLogo'])
                        <h2 class="logo-text text-white">{{$site['name']}}</h2>
                    @else
                        <img loading="prelaod" decoding="async" class="img-fluid" src="{{admLogoUrl('logoFooter')}}" alt="{{$site['name']}}">
                    @endif

                </a>
                <ul class="p-0 d-flex navbar-footer mb-0 list-unstyled">
                    @foreach(admMenuByPosition('footer') as $item)
                        <li class="nav-item my-0">
                            <a class="nav-link" href="{{$item->link()}}">
                                {{$item->title}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="copyright bg-dark content">
{{--        Designed &amp; Developed By <a href="https://themefisher.com/">Themefisher</a>--}}
        {!! $site['copyright'] !!}
    </div>
</footer>
