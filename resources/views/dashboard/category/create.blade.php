@extends('dashboard.master')

@section('content')

<form action="{{ route('category.store') }}" method="POST">
    @include('dashboard.category._from')
</form>

@endsection
