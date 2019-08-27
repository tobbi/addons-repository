@extends('dashboard')

@section('title', 'Manage add-ons')

@section('dashboard_content')
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Version</th>
      <th scope="col">Actions</th>
      {{-- <th scope="col">Slug</th>
      <th scope="col">Author</th>
      <th scope="col">Actions</th> --}}
    </tr>
  </thead>
  <tbody>
  @foreach($st_versions as $version)
    <tr>
      <th scope="row">{{$version->id }}</th>
      <td>{{ $version->name }}</td>
      <td>
          <div class="btn-group btn-group-sm" role="group">
          <button type="button" class="btn btn-secondary"><a href="{{ route('addon_view_nfo', $version->name) }}"><i class="fa fa-edit"></i></a></button>
          <button type="button" class="btn btn-secondary"><a href="{{ $version->github_url }}"><i class="fa fa-arrow-right"></i></a></button>
              {{-- @if($addon->enabled)
              <button type="button" class="btn btn-secondary" data-id="{{ $addon->id }}" onclick="AddonManager.toggleVisibility(this);"><i class="fa fa-eye"></i></button>
              @else
              <button type="button" class="btn btn-secondary bg-danger" data-id="{{ $addon->id }}" onclick="AddonManager.toggleVisibility(this);"><i class="fa fa-eye-slash"></i></button>
              @endif
              <button type="button" class="btn btn-secondary" data-id="{{ $addon->id }}"><i class="fa fa-trash"></i></button>
              <button type="button" class="btn btn-secondary" data-id="{{ $addon->id }}" onclick="AddonManager.viewRevisions(this);"><i class="far fa-clipboard"></i></button> --}}
          </div>
        </td>
      {{-- <td>{{ $addon->slug }}</td>
      <td>{{ $addon->author->name }}</td>
      <td>
        <div class="btn-group btn-group-sm" role="group">
            <button type="button" class="btn btn-secondary" data-id="{{ $addon->id }}" onclick="$('#editAddonModal').modal()"><i class="fa fa-edit"></i></button>
            @if($addon->enabled)
            <button type="button" class="btn btn-secondary" data-id="{{ $addon->id }}" onclick="AddonManager.toggleVisibility(this);"><i class="fa fa-eye"></i></button>
            @else
            <button type="button" class="btn btn-secondary bg-danger" data-id="{{ $addon->id }}" onclick="AddonManager.toggleVisibility(this);"><i class="fa fa-eye-slash"></i></button>
            @endif
            <button type="button" class="btn btn-secondary" data-id="{{ $addon->id }}"><i class="fa fa-trash"></i></button>
            <button type="button" class="btn btn-secondary" data-id="{{ $addon->id }}" onclick="AddonManager.viewRevisions(this);"><i class="far fa-clipboard"></i></button>
        </div>
      </td> --}}
    </tr>
  @endforeach
  </tbody>
</table>
@component('layout.modal')
  @slot('modal_id', 'toggleVisibilityModal')
  @slot('modal_title', 'Toggle visibility')
  @slot('modal_content')
    <p>The add-on you specified could not be found.</p>
  @endslot
@endcomponent

{{-- @component('layout.modal')
  @slot('modal_id', 'editAddonModal')
  @slot('modal_title', 'Edit addon')
  @slot('modal_content')
  <form>
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="The name of the add-on">
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Slug</label>
    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Slug of the add-on">
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
  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
</form>
  @endslot
  @slot('modal_ok_label', 'Save changes')
  @slot('modal_cancel_label', 'Cancel')
@endcomponent --}}

@component('layout.modal')
@slot('modal_id', 'viewRevisionsModal')
@slot('modal_title', 'View Revisions')
@slot('modal_content')
<table class="table">
    <thead class="thead-light">
        <tr>
        <th scope="col">Date</th>
        <th scope="col">Version</th>
        <th scope="col">User</th>
        <th scope="col">Changes</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endslot
@endcomponent

@endsection
