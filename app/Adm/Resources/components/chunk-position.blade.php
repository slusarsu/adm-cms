@if(!empty($chunks))
    @foreach($chunks as $chunk)
        <x-chunk :slug="$chunk->slug"/>
    @endforeach
@endif
