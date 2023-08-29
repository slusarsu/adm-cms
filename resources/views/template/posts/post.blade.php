@extends('template.layouts.main', [
    'title' => $post->seo_title ?? $post->title,
    'seoDescription' => $post->seo_description,
    'seoKeyWords' => $post->seo_text_keys,
    'seoAuthor' => $post->user->name,
    'sidebar' => true,
    ])

@push('header-code')

    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
        function onSubmit(token) {
            document.getElementById("comment-form").submit();
        }
    </script>

@endpush

@section('content')
    <div class="breadcrumbs mb-4">
        <a href="{{homeLink()}}">Home</a>
        <span class="mx-1">/</span>
        <a href="{{$post->link()}}">Posts</a>
        <span class="mx-1">/</span>
        <a href="{{$post->link()}}">{{$post->title}}</a>
    </div>
    <article>
        @if(!empty($thumb) || !empty($site['showRandomImages']))
            <img loading="lazy" decoding="async" src="{{$thumb ?? admRandomImage()}}" alt="{{$post->title}}" class="w-100">
        @endif

        <div class="d-flex justify-content-between mt-3">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                    <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                    <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                </svg> <span>{{$post->getDate()}}</span>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                </svg>
                <span>{{$post->views}}</span>
            </div>
        </div>
        <h1 class="my-3">{{$post->title}}</h1>
        <ul class="post-meta mb-4">
            @foreach($post->categories as $category)
                <li>
                    <a href="{{$category->link()}}">{{$category->title}}</a>
                </li>
            @endforeach
        </ul>
        <div class="content text-left">
            {!! $post->content !!}
        </div>
        @if(!empty($images))
            <hr>
            <h3>Images</h3>
            <div class="row">
                @foreach($images as $image)
                    <div class="col-12 col-md-6 my-3">
                        <a class="example-image-link" href="{{$image}}" data-lightbox="example-set" data-title="{{$post->title}}">
                            <img src="{{$image}}" alt="{{$post->title}}" class="w-100" data-lightbox="example-set">
                        </a>
                    </div>
                @endforeach
            </div>
        @endif


        <ul class="post-meta my-4">
            @foreach($post->tags as $tag)
                <li>
                    <a href="{{$tag->link()}}">{{$tag->title}}</a>
                </li>
            @endforeach
        </ul>
    </article>

    <div>
        @if ($message = Session::get('comment_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('comment_error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <hr/>

        <div class="d-flex justify-content-between">
            <h2 class="section-title mb-3">Comments</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addComment">
                Add Comment
            </button>
        </div>

        @if(!empty($post->comments))
            <div class="widget">
                <div class="widget-body my-3">
                    <div class="widget-list">
                        @foreach($post->comments as $comment)
                            @if($comment->is_enabled)
                                <div class="media align-items-center" id="comment-{{$comment->id}}">
                                    <div class="media-body ml-3">
                                        <h3 style="margin-top:-5px">{{$comment->emailName()}}</h3>
                                        <p class="mb-0">{{$comment->content}}</p>
                                        <div class="text-right my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                                                <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                                            </svg> <span>{{$comment->getDate()}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>

            </div>
        @endif


        <!-- Modal -->
        <div class="modal fade" id="addComment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addCommentLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCommentLabel">Add Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('add-comment')}}" id="comment-form">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="record_id" value="{{$post->id}}">
                            <input type="hidden" name="model" value="{{get_class($post)}}">
                            <input type="hidden" name="parent_id" value="">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea class="form-control" id="comment" rows="3" name="content"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            @if(!empty(env('RECAPTCHA_SITE_KEY')))
                                <input
                                    class="g-recaptcha btn btn-outline-primary"
                                    data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"
                                    data-callback='onSubmit'
                                    data-action='submit'
                                    type="submit"
                                    value="Send"
                                >
                            @else
                                <button type="submit" class="btn btn-primary">Understood</button>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('footer-code')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
@endpush
