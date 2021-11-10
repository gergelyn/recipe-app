@extends('layouts.app')

@section('content')
    <h1 class="text-lg font-bold">{{ $recipe->title }}</h1>
    <p>{{ $recipe->cook_time }}</p>
    <p>{{ $recipe->level }}</p>
    <small>{{ $recipe->created_at }}</small>
@endsection