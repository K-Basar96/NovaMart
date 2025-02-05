@include('user.layout.loginpopup')
<nav class="navbar navbar-expand-sm mx-1 navbar-dark bg-primary bg-gradient">
    <div class="container-fluid mx-5 header">
        <a class="navbar-brand d-flex" href="{{ route('home') }}">
            <img src="/images/online-shop.png" alt="online-shop" class="bg-primary logo" height="50px" width="150px"
                style="border-radius: 1% 100% 1% 1%;">
            <h2>Welcome to Online Shop</h2>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <form class="d-flex mx-auto w-100" style="max-width: 500px"; role="search" action="route('search')"
                method="POST">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control form-control-lg"
                        placeholder="Search for Products or Brands" name="search" aria-label="Search">
                    <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <ul class="navbar-nav fs-5 text-dark d-flex gap-3 me-5 fw-bold">
                @auth
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.index') }}">Dashboard</a>
                        </li>
                    @endif
                    <li nav-item>
                        <p class="nav-link">{{ Auth::check() ? Auth::user()->name : 'Guest User' }}</p>
                    </li>
                    <li class="nav-item profile mx-3" style="position: relative;">
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Image" id="profileImage"
                            style="cursor: pointer; width: 50px; height: 50px; border-radius: 50%;">
                        <div class="dropdown-menu" id="dropdownMenu" style="display: none;">
                            @if (Auth::user()->role == 'user')
                                <a href="{{ route('user.edit', Auth::id()) }}" class="dropdown-item">
                                    <i class="bi bi-person-circle"></i>&nbsp;Profile
                                </a>
                            @endif
                            <a href="{{ route('address.index') }}" class="dropdown-item">
                                <i class="bi bi-bookmark-plus"></i>&nbsp;Saved Addresses
                            </a>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-truck"></i>&nbsp;Track Order
                            </a>
                            <a href="{{ route('order.index') }}" class="dropdown-item">
                                <i class="bi bi-list-check"></i></i>&nbsp;Orders History
                            </a>
                            <a class="dropdown-item" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart-fill"></i>&nbsp;Cart
                            </a>
                            <a class="dropdown-item" href="{{ route('wishlist.show', Auth::id()) }}">
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
                        <a href="{{ route('login') }}" class="nav-link" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Login</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
