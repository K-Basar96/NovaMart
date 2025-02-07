@extends('user.layout.master')
@section('title', 'All Products')
@section('content')
    @include('user.layout.filter')
    <h1 class="text-center mb-4">All Products</h1>

    <section class="all-products py-5" id="products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-2">
                        @forelse ($products as $product)
                            <div class="col">
                                <div class="card h-100 d-flex flex-column" data-brand="{{ $product->brand }}"
                                    data-category="{{ $product->category }}" data-price="{{ $product->price }}"
                                    data-name="{{ $product->name }}">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                            alt="{{ $product->name }}" width="100" height="200"></a>
                                    <!-- Wishlist Icon (Love Icon) -->
                                    @php
                                        $inWishlist =
                                            auth()->check() &&
                                            auth()->user()->wishlists->contains('product_id', $product->id);
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
                                        <h4 class="card-title">{{ $product->name }}</h4>
                                        <p class="card-text">{{ $product->price }}</p>
                                        <div class="d-flex flex-column align-items-center w-100 mt-auto">
                                            <div class="w-100 mb-2">
                                                <form action="{{ route('cart.store') }}" method="POST"
                                                    class="add-to-cart-form">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
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
                        @empty
                            <div class="d-flex w-100 justify-content-center">
                                <h4>No products found.</h4>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('user.layout.addtoCart')
@endsection
