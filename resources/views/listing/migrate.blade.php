@extends('layout.layout')

@section('title', 'Migrate Add-ons')

@section('content')
<div class="container">
<div class='page-header'>
<h2>Migrate add-ons</h2>
</div>
<form action="/addons/parse-nfo" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="form-group row">
    <label for="nfoURL" class="col-sm-2 col-form-label">.nfo URL</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="nfoURL" placeholder="Please add a URL to the NFO file" name="nfoURL">
    </div>
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <button type="submit" class="btn btn-primary">Migrate add-ons</button>
</form>
</div>
@endsection