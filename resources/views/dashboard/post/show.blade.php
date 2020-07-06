@extends('dashboard.master')

@section('content')

<div class="form-group">
    <label for="title">Titulo</label>
    <input name="title" type="text" class="form-control" id="title" placeholder="Titulo" value="{{ $post->title }}" readonly>
</div>

<div class="form-group">
    <label for="url_clean">Url limpia</label>
    <input type="text" name="url_clean" class="form-control" id="url_clean" placeholder="Url limpia"
        value="{{ $post->url_clean }}" readonly>
</div>

<div class="form-group">
    <label for="content">Contenido</label>
    <textarea name="content" type="text" class="form-control" id="content" rows="3" placeholder="Contenido"
        value="" readonly>{{ $post->content }}</textarea>
</div>

@endsection
