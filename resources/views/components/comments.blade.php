@props([
    'item' => ''
])

@if($item)

    <div class="d-flex justify-content-between">
        <h2 class="section-title mb-3">Comments</h2>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addComment">
            Add Comment
        </button>
    </div>

    @if(!empty($item->comments))
        <div class="widget">
            <div class="widget-body my-3">
                <div class="widget-list">
                    @foreach($item->comments as $comment)
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
                        <input type="hidden" name="record_id" value="{{$item->id}}">
                        <input type="hidden" name="model" value="{{get_class($item)}}">
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

@endif

