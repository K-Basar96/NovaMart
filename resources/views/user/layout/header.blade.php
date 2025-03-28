<nav class="navbar navbar-expand-sm mx-1 navbar-dark bg-primary bg-gradient">
    <div class="container-fluid mx-5 header">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="/images/NovaMart.png" alt="NovaMart" class="bg-primary logo me-2" height="50px" width="150px"
                style="border-radius: 1% 100% 1% 1%;">
            <h3 class="d-none d-md-block">Welcome to NovaMart</h3> <!-- Hides on small screens -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <form class="d-flex mx-auto w-100" style="max-width: 400px;min-width: 130px" role="search"
                action="{{ route('product.search') }}" method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control form-control-lg"
                        placeholder="Search for Products or Brands" name="search" aria-label="Search">
                    <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <ul class="navbar-nav fs-5 text-dark d-flex gap-2 me-5 fw-bold">
                @auth
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">Dashboard</a>
                        </li>
                    @endif
                    <li class="nav-item profile mx-3" style="position: relative;">
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Image" id="profileImage"
                            style="cursor: pointer; width: 50px; height: 50px; border-radius: 50%;">
                        <div class="dropdown-menu" id="dropdownMenu" style="display: none;">
                            <a href="{{ route('user.edit', Auth::id()) }}" class="dropdown-item">
                                <i class="bi bi-person-circle"></i>&nbsp;
                                {{ Auth::check() ? Auth::user()->name : 'Guest User' }}
                            </a>
                            <a href="{{ route('address.index') }}" class="dropdown-item">
                                <i class="bi bi-bookmark-plus"></i>&nbsp;Saved Addresses
                            </a>
                            <a href="{{ route('order.track') }}" class="dropdown-item">
                                <i class="bi bi-truck"></i>&nbsp;Track Order
                            </a>
                            <a href="{{ route('order.index') }}" class="dropdown-item">
                                <i class="bi bi-list-check"></i></i>&nbsp;Orders History
                            </a>
                            <a class="dropdown-item" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart-fill"></i>&nbsp;Cart
                            </a>
                            <a class="dropdown-item" href="{{ route('wishlist.index') }}">
                                <i class="bi bi-heart-fill"></i>&nbsp;Wishlist
                            </a>
                            <hr class="dropdown-divider" />
                            <form id="logout-form" action="{{ route('logout', Auth::id()) }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="dropdown-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </div>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link"><i class="bi bi-person-circle"></i>&nbsp;Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order.track') }}" class="nav-link">
                            <i class="bi bi-truck"></i>&nbsp;Track Order
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
