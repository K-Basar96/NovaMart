<nav class="navbar bg-body-tertiary mt-2">
    <div class="container-fluid">
        <a class="navbar-brand">
            <span class="toggle-btn" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                aria-controls="collapseExample">
                <i class="bi bi-arrow-left-right btn btn-outline-secondary rounded-circle me-3"></i>
            </span>
        </a>
        <h4>@yield('page-name')</h4>
        <form class="d-flex" role="search">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
        </form>
        {{-- Topbar profile Dropdown --}}
        <ul class="ms-auto ms-md-0 me-3 me-lg-4">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill-gear"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('home') }}">Go To Website</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{ route('admin.settings') }}">Settings</a></li>
                    <li><a class="dropdown-item" href="{{ route('admin.edit', Auth::user()->id) }}">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('logout', Auth::id()) }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        <a href="#" class="dropdown-item"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                </ul>
            </div>
        </ul>
    </div>
</nav>
