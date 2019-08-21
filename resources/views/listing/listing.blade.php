@extends('layout.layout')

@section('title', 'Add-ons')

@section('content')
<div class='page-header'>
<h2>Add-ons for SuperTux {{ request('v') ?? "" }}</h2>
</div>
    <div class="row">
    @foreach($addons as $addon)
      @component('listing.addon-column')
        @slot('title'){{ $addon->title }} @endslot
        @slot('id'){{ $addon->id }} @endslot
        @slot('version') v{{$addon->version }} @endslot
        @slot('author') {{ $addon->getRealAuthorName() }} @endslot
        @slot('hasLinkedUser') {{ $addon->author->hasLinkedUser() }} @endslot
        @slot('type') {{ $addon->addonType->type }} @endslot
      @endcomponent
    @endforeach
    </div>
@endsection