@extends('dashboard.master')

@section('content')

{{-- @include('dashboard.partials.validation-error') --}}

<form action="{{ route('post.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Titulo</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="Titulo">

        @error('title')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    <div class="form-group">
        <label for="url_clean">Url limpia</label>
        <input type="text" name="url_clean" class="form-control" id="url_clean" placeholder="Url limpia">

        @error('url_clean')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    <div class="form-group">
        <label for="content">Contenido</label>
        <input name="content" type="text" class="form-control" id="content" placeholder="Contenido">

        @error('content')
        <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>
    <input class="btn btn-primary" type="submit" value="Guardar">
</form>



@endsection
