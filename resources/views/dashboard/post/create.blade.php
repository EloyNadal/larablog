@extends('dashboard.master')

@section('content')

<form action="{{ route('post.store') }}" method="POST">
    @include('dashboard.post._from')
</form>

@endsection
