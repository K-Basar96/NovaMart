@extends('admin.layout.master')
@section('page-name')
    {{ $user->name }}'s Cart
@endsection
@section('admin-content')
    <div class="container my-3 justify-content-centre">
        <div class="row justify-content-center">
            {{-- <h1 class="mb-4">{{ $user->name }}'s Cart</h1> --}}
            @include('alert')
            <div class="text-end">
                <a href="{{ route('wishlist.show', $user->id) }}" class="bi bi-heart-fill btn btn-warning">
                    &nbsp;Go to Wishlist</a>
            </div>
            <div class="col-md-8 table-responsive">
                <div id="cart-items" class="mb-4">
                    <table class="table table-bordered text-center align-content-center">
                        @if ($cartItems->isNotEmpty())
                            <tr class="table-primary">
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        @endif
                        <tbody>
                            @forelse($cartItems as $cartItem)
                                <tr class="fs-5">
                                    <td>
                                        <a href="{{ route('product.show', $cartItem->product->id) }}">
                                            <img src="{{ asset('storage/' . $cartItem->product->image) }}" height="150"
                                                width="200" alt="Product Image">
                                        </a>
                                    </td>
                                    <td><a href="{{ route('product.show', $cartItem->product->id) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $cartItem->product->name }}</a>
                                    </td>
                                    <td class="d-flex justify-content-around">{{ $cartItem->quantity }}</td>
                                    <td>₹&nbsp;{{ number_format($cartItem->product->price, 2) }}</td>
                                    <td>₹&nbsp;{{ number_format($cartItem->quantity * $cartItem->product->price, 2) }}</td>
                                </tr>
                            @empty
                                <div class="card">
                                    <div class="card-header">
                                        {{ $user->name }}'s Cart
                                    </div>
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ $user->name }}'s cart is empty.</h4>
                                    </div>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
