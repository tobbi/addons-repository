@extends('layout.layout')

@section('title', 'Welcome')

@section('content')
<h2>{{ $addon->title }}</h2>
<h3>by {{ $addon->author->name }}<h3>
@endsection