@extends('dashboard')
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
      console.log(response);
      alert(response.err_code);
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
            <button type="button" class="btn btn-secondary"><i class="fa fa-edit"></i></button>
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
@endsection
