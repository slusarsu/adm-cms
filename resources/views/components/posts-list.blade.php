@props([
    'posts' => []
])
@if(!empty($posts))
    <div class="row">
        @foreach($posts as $key => $post)

            @if($key == 0)
                <div class="col-12 mb-4" id="post-{{$post->id}}">
                    <article class="card article-card">
                        <a href="{{$post->link()}}">
                            <div class="card-image">
                                <div class="post-info">
                                    <span class="text-uppercase">{{$post->getDate()}}</span>
                                    <span class="text-uppercase">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                        {{$post->views}}
                                    </span>
                                </div>

                                @if(!empty($post->thumb()) || !empty($site['showRandomImages']))
                                    <img loading="lazy" decoding="async" src="{{$post->thumb() ?? admRandomImage()}}" alt="{{$post->title}}" class="w-100">
                                @endif

                            </div>
                        </a>
                        <div class="card-body px-0 pb-1">
                            <div class="d-flex justify-content-between">
                                <ul class="post-meta mb-2" title="categories">
                                    <li>
                                        @foreach($post->categories as $category)
                                            <a href="{{$category->link()}}">{{$category->title}}</a>
                                        @endforeach
                                    </li>
                                </ul>
                            </div>

                            <h2 class="h1">
                                <a class="post-title" href="{{$post->link()}}">{{$post->title}}</a>
                            </h2>

                            <p class="card-text">{!! $post->short !!}</p>

                            <ul class="post-meta mb-2" title="tags">
                                <li>
                                    @foreach($post->tags as $tag)
                                        <a href="{{$tag->link()}}">{{$tag->title}}</a>
                                    @endforeach
                                </li>
                            </ul>

                        </div>
                    </article>
                </div>
                @continue<i class="bi bi-eye"></i>
            @endif

                <div class="col-md-6 mb-4" id="post-{{$post->id}}">
                    <article class="card article-card article-card-sm h-100">
                        <a href="{{$post->link()}}">
                            <div class="card-image">
                                <div class="post-info">
                                    <span class="text-uppercase">{{$post->getDate()}}</span>
                                    <span class="text-uppercase">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                          <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                        {{$post->views}}
                                    </span>
                                </div>

                                @if(!empty($post->thumb()) || !empty($site['showRandomImages']))
                                    <img loading="lazy" decoding="async" src="{{$post->thumb() ?? admRandomImage()}}" alt="{{$post->title}}" class="w-100">
                                @endif

                            </div>
                        </a>
                        <div class="card-body px-0 pb-0">
                            <ul class="post-meta mb-2" title="categories">
                                <li>
                                    @foreach($post->categories as $category)
                                        <a href="{{$category->link()}}">{{$category->title}}</a>
                                    @endforeach
                                </li>
                            </ul>
                            <h2><a class="post-title" href="{{$post->link()}}">{{$post->title}}</a></h2>
                            <p class="card-text">{!! $post->short !!}</p>
                            <ul class="post-meta mb-2" title="tags">
                                <li>
                                    @foreach($post->tags as $tag)
                                        <a href="{{$tag->link()}}">{{$tag->title}}</a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                    </article>
                </div>

        @endforeach

        <div class="col-12">
            <div class="row">
                <div class="col-12">
{{--                    {!! !empty($posts->links()) ? $posts->links() : '' !!}--}}
                    @if(method_exists($posts, 'links'))
                        {!! $posts->appends(Request::except('page'))->render() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
