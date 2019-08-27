<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">
    <img src="{{ asset('images/supertux.png') }}" style="width:40px;" alt="logo">
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
                <a class="dropdown-item" href="/addons?v={{ $version->id }}">{{ $version->name }}</a>
            @endforeach()
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/addons">All versions</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarType" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            By type
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarType">
            @foreach($types as $type)
                <a class="dropdown-item" href="#">{{ $type->type }}</a>
            @endforeach()
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/addons">All add-ons</a>
            </div>
        </li>
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="NewAddonNavbar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            New add-on
            </a>
            <div class="dropdown-menu" aria-labelledby="NewAddonNavbar">
            <a class="dropdown-item" href="/addons/add">Upload</a>
            <a class="dropdown-item" href="/addons/migrate">Import from .nfo file</a>
            </div>
        </li>
        @endauth
        {{-- <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
        </li> --}}
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
         <!-- Right Side Of Navbar -->
         <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>