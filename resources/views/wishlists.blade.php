@extends('user.layout.master')
@section('title', 'Wishlist')

@section('content')
    <div class="container my-3 justify-content-center">
        <div class="row justify-content-center">
            <h1 class="mb-4">Wishlist</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <!-- Wishlist Action Buttons -->
            <div class="text-end">
                <form action="{{ route('wishlist.destroy', Auth::id()) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" {{ $wishlists->isEmpty() ? 'hidden' : '' }}>Clear
                        Wishlist</button>
                </form>
            </div>
            <div class="col-md-8 table-responsive">
                <div id="cart-items" class="mb-4">
                    @forelse($wishlists as $wishlist)
                        <div class="card mb-3" style="max-width: 100%; border: 1px solid #ddd;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/' . $wishlist->product->image) }}"
                                        class="img-fluid rounded-start" alt="Product Image">
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $wishlist->product->name }}</h5>
                                        <p class="d-flex justify-content-between">
                                            <span class="h6">{{ $wishlist->product->category->name }}</span>
                                            <span class="text-muted">With attention to detail and precision, carefully
                                                manufactured by {{ $wishlist->product->brand->name }}.
                                            </span>
                                        </p>
                                        <p class="card-text">{{ $wishlist->product->description }}</p>
                                        <h6 class="card-text">₹&nbsp;{{ $wishlist->product->price }}</h6>
                                        <form action="{{ route('wishlist.store') }}" method="POST"
                                            class="add-to-cart-form">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                                            <input type="hidden" name="quantity" value="1" min="1">
                                            <button type="submit" class="btn btn-primary">Move to Cart</button>
                                        </form>
                                        <!-- Add to Wishlist Button -->
                                        <form action="{{ route('wishlist.toggle') }}" method="POST"
                                            class="add-to-cart-form mt-1">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $wishlist->product->id }}">
                                            @php $inWishlist = auth()->user()->wishlists->contains('product_id', $wishlist->product->id); @endphp
                                            <button type="submit" class="btn btn-danger"> Remove from Wishlist</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-header">
                                Your Wishlist
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Your Wishlist is currently empty.</h5>
                                <a href="{{ route('product.index') }}" class="btn btn-secondary">Check Products</a>
                                <a href="{{ route('cart.index') }}" class="btn btn-warning">Go to cart</a>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
