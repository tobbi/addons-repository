@extends('layout.layout')

@section('title', 'Add Add-on')

@section('content')
<div class="container">
<div class='page-header'>
<h2>Add add-on...</h2>
</div>
<form>
  <div class="form-group row">
    <label for="exampleInputEmail1" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Name of the add-on">
    </div>
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group row">
    <label for="exampleInputPassword1" class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="ID (auto-generated from name)" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Version</label>
    <div class="col-sm-10">
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Version">
    </div>
  </div>
  <div class="form-group row">
    <label for="exampleInputPassword1" class="col-sm-2 col-form-label">Author</label>
    <div class="col-sm-10">
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Author">
    </div>
  </div>
  <div class="form-group row">
    <label for="exampleInputPassword1" class="col-sm-2 col-form-label">License</label>
    <div class="col-sm-10">
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="License">
    </div>
  </div>
  <div class="form-group row">
    <label for="exampleInputPassword1" class="col-sm-2 col-form-label">SuperTux versions</label>
    <div class="col-sm-10">
    <input type="checkbox" class="form-control" id="exampleInputPassword1" placeholder="SuperTux versions">
    </div>
  </div>
  <!-- <div class="form-check row">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary">Save add-on</button>
</form>
</div>
@endsection