@extends('dashboard.master')

@section('content')

<form action="{{ route('post.update', $post->id) }}" method="POST">
    @method('PUT')
    @include('dashboard.post._from')
</form>

<br>

<form action="{{ route('post.image', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col">
            <input type="file" name="image" id="imgage" class="from-control">
        </div>
        <div class="col">
            <input type="submit" value="Subir" class="btn btn-primary">
        </div>
    </div>

    @error('image')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</form>

@endsection
