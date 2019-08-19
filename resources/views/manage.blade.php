@extends('dashboard')

@section('title', 'Manage add-ons')
@section('additional_head_tags')
<script type="text/javascript">
function performGETRequest($caller)
{
  var id = $caller.getAttribute('data-id');
  $.get('/addons/' + id + '/toggle_visibility', 
  {
    _token: "{{ csrf_token() }}",
  }).done(
  function(response) {
    var $children = $($caller).children('i');
    $children.removeClass("fa-eye fa-eye-slash");
    if(response.is_enabled)
    {
      $children.addClass("fa-eye");
      $($caller).removeClass('bg-danger');
    }
    else
    {
      $children.addClass("fa-eye-slash");
      $($caller).addClass('bg-danger');
    }
  }).fail(
    function(response)
    {
      $("#toggleVisibilityModal").modal();
    });
}
</script>
@endsection

@section('dashboard_content')
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Slug</th>
      <th scope="col">Author</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  @foreach($addons as $addon)
    <tr>
      <th scope="row">{{$addon->id }}</th>
      <td><a href="{{ route('addon_info', ['id' => $addon->id]) }}">{{ $addon->title }}</a></td>
      <td>{{ $addon->slug }}</td>
      <td>{{ $addon->author->name }}</td>
      <td>
        <div class="btn-group btn-group-sm" role="group">
            <button type="button" class="btn btn-secondary" data-id="{{ $addon->id }}" onclick="$('#editAddonModal').modal()"><i class="fa fa-edit"></i></button>
            @if($addon->enabled)
            <button type="button" class="btn btn-secondary" data-id="{{ $addon->id }}" onclick="performGETRequest(this);"><i class="fa fa-eye"></i></button>
            @else
            <button type="button" class="btn btn-secondary bg-danger" data-id="{{ $addon->id }}" onclick="performGETRequest(this);"><i class="fa fa-eye-slash"></i></button>
            @endif
            <button type="button" class="btn btn-secondary"><i class="fa fa-trash"></i></button>
        </div>
      </td>
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

@component('layout.modal')
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
@endcomponent

@endsection
