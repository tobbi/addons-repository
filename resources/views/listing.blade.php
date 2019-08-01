@extends('layout')

@section('title', 'Add-ons')

@section('content')
<div class='page-header'>
<h2>Add-ons for SuperTux {{ request('v') ?? "" }}</h2>
</div>
    <div class="row">
      @component('listing.addon-column')
        @slot('title')Gedoens 1 @endslot
        @slot('id')1 @endslot
      @endcomponent
      @component('listing.addon-column')
        @slot('title')Gedoens 2 @endslot
        @slot('id')2 @endslot
      @endcomponent
      @component('listing.addon-column')
        @slot('title') Gedoens 3 @endslot
        @slot('id')3 @endslot
      @endcomponent
      @component('listing.addon-column')
      @slot('title') Gedoens 4 @endslot
      @slot('id')4 @endslot
      @endcomponent
    @component('listing.addon-column')
      @slot('title') Gedoens 5 @endslot
      @slot('id')5 @endslot
    @endcomponent
    @component('listing.addon-column')
    @slot('title') Gedoens 6 @endslot
    @slot('id')6 @endslot
    @endcomponent
  @component('listing.addon-column')
  @slot('title') Gedoens 7 @endslot
  @slot('id')7 @endslot
  @endcomponent
    </div>
    <div class="row">

    </div>
@endsection