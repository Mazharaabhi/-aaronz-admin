@if(count($languages) > 0)
    @foreach ($languages as $item)
     <button class="btn @if($item->id == 1) mt-3 btn_lang btn-cherwell lang-buttons @endif" id="btn_lang" data-id="{{ $item->id }}">{{ $item->name }}</button>
    @endforeach
@endif
