@props([
    'items' => []
])
@if(!empty($items))
{{--    @dd(session()->getId());--}}
    <div class="row">
        <div class="col-12">
            <form action="{{route('adm-search')}}">
                <div class="input-group mb-3 ">
                    <input class="form-control" id="search-query" name="s" type="search" placeholder="Search..." autocomplete="off" aria-label="Search  " aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>
        </div>

        @foreach($items as $key => $item)
            <div class="col-md-4 mb-5" id="post-{{$item->id}}">
                <article class="card article-card article-card-sm h-100">

                    <a href="{{$item->link()}}">
                        <div class="card-image">
                            <div class="post-info">
                                <span class="text-uppercase">{{$item->getDate()}}</span>
                                <span class="text-uppercase">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                      <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                      <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                    </svg>
                                    {{$item->views}}
                                </span>
                            </div>

                            <div>
                                <img loading="lazy" decoding="async" src="{{$item->thumb() ?? asset('images/no-image.png')}}" alt="{{$item->title}}" class="w-100">
                            </div>

                        </div>
                    </a>

                    <div class="card-body px-0 pb-0">
                        @if(!empty($item->category))
                            <a href="{{$item->category->link()}}">{{$item->category->title}}</a>
                        @endif
                        <h2><a class="post-title" href="{{$item->link()}}">{{$item->title}}</a></h2>
                        <p class="card-text">{!! $item->short !!}</p>
                    </div>

                    <livewire:add-to-cart :productId="$item->id"/>

                </article>
            </div>

        @endforeach

        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    @if(method_exists($items, 'links'))
                        {!! $items->appends(Request::except('page'))->render() !!}
                    @endif
                </div>
            </div>
        </div>

    </div>
@endif
