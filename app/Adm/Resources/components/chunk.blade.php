@if(!empty($chunk))
    @if($chunk->type == 'text')
        {{$chunk->body}}
    @endif

    @if($chunk->type == 'html')
        {!! $chunk->body !!}
    @endif
@endif
