@extends('dashboard')

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
        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary"><i class="fa fa-edit"></i></button>
            @if($addon->enabled)
            <button type="button" class="btn btn-secondary"><i class="fa fa-eye-slash"></i></button>
            @else
            <button type="button" class="btn btn-secondary"><i class="fa fa-eye"></i></button>
            @endif
            <button type="button" class="btn btn-secondary"><i class="fa fa-trash"></i></button>
        </div>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
