<div class="col-10 col-sm-6 col-md-4 col-lg-4 col-xl-2 mb-2">
    <div class="card">
        <div class="card-header">{{ $type ?? "Worldmap" }}</div>
        <img class="card-img-top" src={{ $thumb ?? "https://camo.githubusercontent.com/181bc5d807b52e6d2b233ac3db72caea631a5168/68747470733a2f2f7777772e73757065727475782e6f72672f696d616765732f305f355f312f305f355f315f332e706e67"}} alt="Card image cap">
        <div class="card-body">
        <h5 class="card-title"><a href="/info/{{ $id ?? 0 }}">{{ $title ?? "My add-on"}}</a><small class="float-right">{{ $version ?? "v0.0.1" }}</small></h5>
        <small class="float-right">by 
        @if ($hasLinkedUser == "1")
            <a href="#">{{ $author }}</a>
        @else
            {{ $author ?? "SuperTux player"}}
        @endif
        </small>
        <p class="card-text">{{ $description ?? "This is a great add-on"}}</p>
        <div class="btn-group float-right">
            <a href="/addons/{{ $id }}/download" class="btn btn-primary" role="button">Download</a>
            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
            @foreach($versions as $version)
                <a class="dropdown-item" href="#">Download for v{{$version->name}}</a>
            @endforeach
            </div>
            </div>
        </div>
    </div>
</div>