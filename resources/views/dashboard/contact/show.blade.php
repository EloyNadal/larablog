@extends('dashboard.master')

@section('content')

<div class="form-group">
    <label for="name">Nombre</label>
    <input name="name" type="text" class="form-control" id="name" placeholder="Nombre" value="{{ $contact->name }}" readonly>
</div>

<div class="form-group">
    <label for="surname">Apellido</label>
    <input type="text" name="surname" class="form-control" id="surname" placeholder="Apellido"
        value="{{ $contact->surname }}" readonly>
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="email" name="email" class="form-control" id="email" placeholder="Email"
        value="{{ $contact->email }}" readonly>
</div>

<div class="form-group">
    <label for="message">Contenido</label>
    <textarea name="message" type="text" class="form-control" id="content" rows="3" placeholder="Mensaje"
        value="" readonly>{{ $contact->message }}</textarea>
</div>

@endsection
