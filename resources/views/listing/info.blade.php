@extends('layout.layout')

@section('title', $addon->title)

@section('content')
@if(!$addon->enabled)
<p>The specified add-on is disabled.</p>
@else
<h2>{{ $addon->title }}</h2>
<h3>by {{ $addon->author->name }}<h3>
@endif
@endsection