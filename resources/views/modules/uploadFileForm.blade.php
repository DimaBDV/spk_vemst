<div class="card-body">
    {{ Form::open(['route' => 'upload.file', 'enctype' => 'multipart/form-data']) }}
        <input type="text" name="text" value="">
        <input type="file" name="file[]" multiple>
        <button type="submit">Отправить</button>
    {{ Form::close() }}
</div>

