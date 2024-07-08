<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-light" href="/"><span class="fas fa-brain me-1"> </span>{{ config('app.name')  }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                @guest
                <li class="nav-item">
                    <a class="{{(Route::is('auth.login'))? 'active' : ''}} nav-link " aria-current="page" href="{{route('auth.login')}}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="{{(Route::is('auth.register'))? 'active' : ''}} nav-link" href="{{route('auth.register')}}">Register</a>
                </li>
                @endguest
                @auth
                @if(Auth::user()->is_admin)
                <li class="nav-item">
                    <a class="{{(Route::is('dashboard'))? 'active' : ''}} nav-link" href="{{route('dashboard')}}">Admin dashboard</a>
                </li>
                @endif
                @can('profile',auth()->user())
                    <li class="nav-item">
                        <a class="{{(Route::is('profile'))? 'active' : ''}} nav-link" href="{{route('profile')}}">{{Auth::user()->name}}</a>
                    </li>
                @else
                    <li class="nav-item">
                        {{Auth::user()->name}}
                    </li>
                @endif

                <li class="nav-item">
                    <form action="{{route('auth.logout')}}" method="POST">
                        @csrf
                        <button class="m-2 btn btn-danger btn-sm" type="submit">Logout</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
