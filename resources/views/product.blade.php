@extends('user.layout.master')
@section('title', 'Cart')
@section('content')
    <div class="container my-3 justify-content-center">
        <div class="row justify-content-center">
            <div class="row">
                <div class=" card col-4">
                    <img src="{{ asset('storage/' . $product->image) }}" height="450" alt="{{ $product->name }}"
                        class="img-fluid">
                    <!-- Wishlist Icon (Love Icon) -->
                    @php
                        $inWishlist =
                            auth()->check() && auth()->user()->wishlists->contains('product_id', $product->id);
                    @endphp
                    <form action="{{ route('wishlist.toggle') }}" method="POST"
                        style="position: absolute; top: 20px; right: 25px;">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit"
                            class="btn wishlist-icon {{ $inWishlist ? 'text-danger' : 'text-muted' }} rounded-circle border-0 p-2"
                            id="wishlist-icon-{{ $product->id }}"
                            style="background-color: rgba(255, 255, 255, 0.5);min-width:45px">
                            <i class="bi {{ $inWishlist ? 'bi-heart-fill' : 'bi-heart' }}" style="font-size: 1.5rem;"></i>
                        </button>
                    </form>
                </div>
                <div class="col mx-3 d-flex flex-column justify-content-between" style="height: 100%;">
                    <div class="my-3">
                        <h1 class="mb-4">{{ $product->name }}</h1>
                        <h2>Price: ₹&nbsp;<strong>{{ $product->price }}</strong></h2>
                        <p class="my-3">{{ $product->description }}</p>
                        <h5 class="my-2">Category: <strong>{{ $product->category->name }}&nbsp;</strong></h5>
                        <h5 class="my-2">Brand: <strong>{{ $product->brand->name }}&nbsp;</strong></h5>
                        <h5 class="my-2">Available: <strong>{{ $product->stock }}&nbsp;Qty</strong></h5>
                    </div>
                    <form action="{{ route('cart.store') }}" method="POST" class="add-to-cart-form  mb-5">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1" min="1">
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('user.layout.addtoCart')
@endsection
