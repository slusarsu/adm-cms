<div class="widget">
    <h2 class="section-title mb-3">Popular</h2>
    <div class="widget-body">
        <div class="widget-list">

            @foreach(getPopularPosts() as $key => $post)
                @if($key == 0)
                    <article class="card mb-4" id="popular-post-{{$post->id}}">
                        <div class="card-image">
                            <div class="post-info">
                                <span class="text-uppercase">
                                    {{$post->getDate()}}
                                </span>
                            </div>


                            @if(!empty($post->thumb()) || !empty($site['showRandomImages']))
                                <img loading="lazy" decoding="async" src="{{$post->thumb() ?? admRandomImage()}}" alt="{{$post->title}}" class="w-100">
                            @endif

                        </div>

                        <div class="card-body px-0 pb-1 my-3">
                            <h3>
                                <a class="post-title post-title-sm" href="{{$post->link()}}">
                                    {{$post->title}}
                                </a>
                            </h3>
                        </div>

                    </article>
                    @continue
                @endif

                <a class="media align-items-center" href="{{$post->link()}}" id="popular-post-{{$post->id}}">
                    @if(!empty($post->thumb()) || !empty($site['showRandomImages']))
                        <img loading="lazy" decoding="async" src="{{$post->thumb() ?? admRandomImage()}}" alt="{{$post->title}}" class="w-100">
                    @endif

                    <div class="media-body ml-3">
                        <h3 style="margin-top:-5px">{{$post->title}}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
