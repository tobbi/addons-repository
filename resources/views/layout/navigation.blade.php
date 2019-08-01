<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">
        <img src="https://raw.githubusercontent.com/SuperTux/supertux/master/data/images/engine/icons/supertux.png" style="width:40px;" alt="logo">
        SuperTux Add-Ons</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/addons">All add-ons</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            By version
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($versions as $version)
                <a class="dropdown-item" href="/addons?v={{ $version }}">{{ $version }}</a>
            @endforeach()
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/addons">All versions</a>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li> --}}
        </ul>
        <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>