@extends('layout.layout')

@section('title', 'Welcome')

@section('content')
<h2>Listing for add-on {{ Request('id') ?? ""}}</h2>
@endsection