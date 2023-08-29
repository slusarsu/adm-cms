<div class="widget">
    <h2 class="section-title mb-3">Tags</h2>
    <div class="widget-body">
        <ul class="widget-list">
            @foreach(getAllTags() as $tag)
                <li>
                    <a href="{{$tag->link()}}">
                        {{$tag->title}}
                        <span class="ml-auto">({{$tag->posts_count}})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
