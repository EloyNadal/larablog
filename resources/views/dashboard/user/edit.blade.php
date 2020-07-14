@extends('dashboard.master')

@section('content')

<form action="{{ route('user.update', $user->id) }}" method="POST">
    @method('PUT')
    @include('dashboard.user._from', ['pasw' => false])
</form>

@endsection
