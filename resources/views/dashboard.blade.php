@extends('layout.layout')

@section('content')
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="row">
                    <div class="col col-md-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href='{{ route('home') }}'>Home</a></li>
                        <li class="list-group-item"><a href='#'>My add-ons</a></li>
                        <li class="list-group-item"><a href='#'>Edit profile</a></li>
                        <li class="list-group-item"><a href='{{ route('dashboard_manage') }}'>Manage add-ons</a></li>
                        <li class="list-group-item"><a href='#'>Review add-ons</a></li>
                        <li class="list-group-item"><a href='#'>Manage SuperTux versions</a></li>
                        <li class="list-group-item"><a href='#'>Manage users</a></li>
                        <li class="list-group-item"><a href='#'>Manage licenses</a></li>
                    </ul>
                    </div>
                    <div class="col">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @yield('dashboard_content')
                    </div>
                    </div>
                </div>
            </div>
@endsection
