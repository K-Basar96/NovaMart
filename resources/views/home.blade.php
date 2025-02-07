@extends('user.layout.master')

@section('title', 'Homepage')

@section('content')
    @include('user.layout.carousel')
    <section class="featured-categories py-5" id="categories">
        <div class="container">
            <h2 class="text-center mb-4">Featured Categories</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach ($categories as $category)
                    <div class="col">
                        <a href="{{ route('product.index') }}" class="text-decoration-none">
                            <div class="card h-100">
                                <img src="{{ asset('storage/' . $category->image) }}" class="card-img-top"
                                    alt="{{ $category }}" width="200" height="200">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $category->name }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="best-deals py-5 bg-light" id="new">
        <div class="container">
            <h2 class="text-center mb-4">New & Noteworthy</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                @foreach ($newItems as $newItem)
                    <div class="col">
                        <div class="card h-100 d-flex flex-column">
                            <img src="{{ asset('storage/' . $newItem->image) }}" class="card-img-top"
                                alt="{{ $newItem->name }}" width="300" height="300">
                            <!-- Wishlist Icon (Love Icon) -->
                            @php
                                $inWishlist =
                                    auth()->check() && auth()->user()->wishlists->contains('product_id', $newItem->id);
                            @endphp
                            <form action="{{ route('wishlist.toggle') }}" method="POST"
                                style="position: absolute; top: 10px; right: 10px;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $newItem->id }}">
                                <button type="submit"
                                    class="btn wishlist-icon {{ $inWishlist ? 'text-danger' : 'text-muted' }} rounded-circle border-0 p-2"
                                    id="wishlist-icon-{{ $newItem->id }}"
                                    style="background-color: rgba(255, 255, 255, 0.5);">
                                    <i class="bi {{ $inWishlist ? 'bi-heart-fill' : 'bi-heart' }}"
                                        style="font-size: 1.5rem;"></i>
                                </button>
                            </form>
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title">{{ $newItem->name }}</h4>
                                <p class="card-text">{{ $newItem->price }}</p>
                                <div class="d-flex flex-column align-items-center w-100 mt-auto">
                                    <div class="w-100 mb-2">
                                        <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $newItem->id }}">
                                            <input type="hidden" name="quantity" value="1" min="1">
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </form>
                                    </div>
                                    <div class="success-message"
                                        style="display: none; color: green; margin-top: 10px; text-align: center;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="choose-brand py-5" id="brands">
        <div class="container">
            <h2 class="text-center mb-4">Top Brands for You</h2>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-4">
                @foreach ($brands as $brand)
                    <div class="col">
                        <a href="{{ route('allproducts', $brand->id) }}" class="text-decoration-none">
                            <div class="card h-100">
                                <img src="{{ asset('storage/' . $brand->logo) }}" class="card-img-top"
                                    alt="{{ $brand }}" width="100" height="100">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $brand->name }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="products py-5 bg-light" id="new">
        <div class="container">
            <h2 class="text-center mb-4">Best Selling Products</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($bestProducts as $product)
                    <div class="col">
                        <div class="card h-100 d-flex flex-column">
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                alt="{{ $product['title'] }}" width="400" height="400">
                            <!-- Wishlist Icon (Love Icon) -->
                            @php
                                $inWishlist =
                                    auth()->check() && auth()->user()->wishlists->contains('product_id', $product->id);
                            @endphp
                            <form action="{{ route('wishlist.toggle') }}" method="POST"
                                style="position: absolute; top: 10px; right: 10px;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit"
                                    class="btn wishlist-icon {{ $inWishlist ? 'text-danger' : 'text-muted' }} rounded-circle border-0 p-2"
                                    id="wishlist-icon-{{ $product->id }}"
                                    style="background-color: rgba(255, 255, 255, 0.5);">
                                    <i class="bi {{ $inWishlist ? 'bi-heart-fill' : 'bi-heart' }}"
                                        style="font-size: 1.5rem;"></i>
                                </button>
                            </form>
                            <div class="card-body d-flex flex-column">
                                <h3 class="card-title">{{ $product['title'] }}</h3>
                                <p class="card-text">{{ $product['description'] }}</p>
                                <p class="fw-bold">{{ $product['price'] }}</p>
                                <div class="mt-auto w-100">
                                    <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1" min="1">
                                        <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                                    </form>
                                    <div class="success-message" style="display: none; color: green; margin-top: 10px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

{{-- Add to cart functionality with AJAX --}}
@include('user.layout.addtoCart')
