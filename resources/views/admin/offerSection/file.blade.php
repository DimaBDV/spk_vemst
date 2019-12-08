<hr/>
<h5 class="text-center">Прикреплённые файлы</h5>
@if( isset($file) )
    @foreach($file as $item)
        <a class="btn btn-outline-success my-2" href="{{ route('admin.offer.download.file', $item->id) }}">
            {{ $item->name  }}
            @if( preg_match( "/^image\/\w*$/", $item->mime_type ) )
                <img src="{{ asset('storage/' . $item->path) }}" style="width: 100px;">
            @endif
        </a>
    @endforeach
@endif
