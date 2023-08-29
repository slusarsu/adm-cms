<div class="widget">
    <h2 class="section-title mb-3">Categories</h2>
    <div class="widget-body">
        <ul class="widget-list">
            @foreach(parentsCategories() as $category)
                <li>
                    <a href="{{$category->link()}}">
                        {{$category->title}}
                        <span class="ml-auto">({{$category->posts_count}})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
