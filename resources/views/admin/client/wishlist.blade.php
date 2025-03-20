@extends('admin.layout.master')
@section('page-name')
    {{ $user->name }}'s Wishlist
@endsection
@section('admin-content')
    <div class="container my-3 justify-content-center">
        <div class="row justify-content-center">
            @include('alert')
            <div class="text-end">
                <a href="{{ route('cart.show', $user->id) }}" class="bi bi-cart-fill btn btn-warning">&nbsp;Go to cart</a>
            </div>
            <div class="col-md-8 table-responsive">
                <div id="cart-items" class="mb-4">
                    @forelse($wishlists as $wishlist)
                        <div class="card mb-3" style="max-width: 100%; border: 1px solid #ddd;">
                            <div class="row g-0">
                                <a href="{{ route('product.show', $wishlist->product->id) }}" class="col-md-4">
                                    <img src="{{ asset('storage/' . $wishlist->product->image) }}"
                                        class="img-fluid rounded-start" alt="Product Image">
                                </a>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <a href="{{ route('product.show', $wishlist->product->id) }}"
                                            class="text-decoration-none text-dark">
                                            <h4 class="card-title">{{ $wishlist->product->name }}</h4>
                                        </a>
                                        <p class="d-flex justify-content-between">
                                            <span class="h6">{{ $wishlist->product->category->name }}</span>
                                            <span class="text-muted">With attention to detail and precision, carefully
                                                manufactured by {{ $wishlist->product->brand->name }}.
                                            </span>
                                        </p>
                                        <p class="card-text">{{ $wishlist->product->description }}</p>
                                        <h6 class="card-text">₹&nbsp;{{ $wishlist->product->price }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-header">
                                {{ $user->name }}'s Wishlist
                            </div>
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ $user->name }}'s Wishlist is currently empty.</h4>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
