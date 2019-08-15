@extends('layout.layout')

@section('title', $addon->title)

@section('content')
<h2>{{ $addon->title }}</h2>
<h3>by {{ $addon->author->name }}<h3>
@endsection