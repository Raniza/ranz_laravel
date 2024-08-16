<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom mb-2">
    <div class="container">
        <a target="_blank" class="navbar-brand" href="https://www.flaticon.com/free-icons/letter-r"
            title="letter r icons"><img src="{{ asset('ranz2.png') }}" width="28" alt="ranz-logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home*') ? 'active px-3' : '' }}" aria-current="page"
                        href="{{ route('home.index') }}">
                        <i class="fa-solid fa-house"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tutorials*') ? 'active px-3' : '' }}"
                        href="{{ route('tutorials.all.index') }}">Tutorials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Demo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                @if (auth()->check() && auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin') }}">Admin Panel</a>
                </li>
                @endif

                <li class="nav-item @auth dropdown @endauth ">
                    @auth
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-regular fa-user text-primary"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#"
                                onclick="document.getElementById('logout-form').submit();">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa-solid fa-unlock-keyhole"></i> Change Password
                            </a>
                        </li>
                    </ul>
                    @endauth

                    @guest
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    @endguest
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control form-control-sm me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-sm btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>