@extends('dashboard.master')

@section('content')

<div class="form-group">
    <label for="name">Nombre</label>
    <input name="name" type="text" class="form-control" id="name" placeholder="Nombre" value="{{ $user->name }}" readonly>
</div>

<div class="form-group">
    <label for="surname">Apellido</label>
    <input type="text" name="surname" class="form-control" id="surname" placeholder="Apellido"
        value="{{ $user->surname }}" readonly>
</div>

@endsection
