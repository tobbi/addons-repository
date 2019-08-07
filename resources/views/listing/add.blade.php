@extends('layout.layout')

@section('additional_head_tags')
<script type="text/javascript">
function createSlug($el)
{
  var title = $el.value.trim().toLowerCase()
                .replace(/[^a-zA-Z0-9\s]/g, '').replace(/\s/g, '-');
  document.getElementById('addonID').value = title;
}
</script>
@endsection

@section('title', 'Upload Add-on')

@section('content')
<div class="container">
<div class='page-header'>
<h2>Upload add-on</h2>
</div>
<form action="/addons/store" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="form-group row">
    <label for="addonZIP" class="col-sm-2 col-form-label">File</label>
    <div class="col-sm-10">
    <input type="file" class="form-control" id="addonZIP" aria-describedby="emailHelp" placeholder="Select ZIP file of add-on..." name="addon_file">
    </div>
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group row">
    <label for="addonName" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="addonName" aria-describedby="emailHelp" placeholder="Name of the add-on" name="addon_name" oninput="createSlug(this);">
    </div>
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group row">
    <label for="addonID" class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="addonID" placeholder="ID (auto-generated from name)" name="addon_id" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="addonVersion" class="col-sm-2 col-form-label">Version</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="addonVersion" placeholder="Version" name="addon_version">
    </div>
  </div>
  <div class="form-group row">
    <label for="addonAuthor" class="col-sm-2 col-form-label">Author</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="addonAuthor" placeholder="Author" name="addon_author">
    </div>
  </div>
  <div class="form-group row">
    <label for="addonLicense" class="col-sm-2 col-form-label">License</label>
    <div class="col-sm-10">
    <select class="form-control" id="exampleFormControlSelect1">
      @foreach($licenses as $license)
      <option value="{{ $license->id }}">{{ $license->title }}</option>
      @endforeach
    </select>
    <!-- <input type="text" class="form-control" id="addonLicense" placeholder="License" name='addon_license'> -->
    </div>
  </div>
  <div class="form-group row">
    <label for="addonSTVersion" class="col-sm-2 col-form-label">SuperTux versions</label>
    <div class="col-sm-10">
    <input type="checkbox" class="form-control" id="addonSTVersion" placeholder="SuperTux versions">
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