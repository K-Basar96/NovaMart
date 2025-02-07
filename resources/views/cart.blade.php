@extends('user.layout.master')
@section('title', 'Cart')
@section('content')
    <div class="container my-3 justify-content-centre">
        <div class="row justify-content-center">
            <h1 class="mb-4">Your Cart</h1>
            @php
                $total_price = 0.0;
            @endphp
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-md-8 table-responsive">
                <div id="cart-items" class="mb-4">
                    <table class="table table-striped table-hover table-bordered">
                        <tr class="table-primary">
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        <tbody>
                            @forelse($cartItems as $cartItem)
                                <tr>
                                    <td>{{ $cartItem->product->name }}</td>
                                    <td class="d-flex justify-content-around">
                                        <form action="{{ route('cart.update', $cartItem->product_id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="quantity" value="-1">
                                            <button type="submit"
                                                class="border-0 bg-transparent bi bi-dash-circle"></button>
                                        </form>
                                        {{ $cartItem->quantity }}
                                        <form action="{{ route('cart.update', $cartItem->product_id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit"
                                                class="border-0 bg-transparent bi bi-plus-circle"></button>
                                        </form>
                                    </td>
                                    <td>₹&nbsp;{{ number_format($cartItem->product->price, 2) }}</td>
                                    <td>₹&nbsp;{{ number_format($cartItem->quantity * $cartItem->product->price, 2) }}</td>
                                </tr>
                                @php
                                    $total_price += $cartItem->quantity * $cartItem->product->price;
                                @endphp
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Your cart is empty.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-end" {{ $cartItems->isEmpty() ? 'hidden' : '' }}>
                <div id="cart-summary" class="text-end mb-4">
                    <h4>Total: ₹&nbsp;<span id="cart-total">{{ number_format($total_price, 2) }}</span></h4>
                </div>
                <div class="d-flex justify-content-end">
                    <form action="{{ route('cart.destroy', Auth::user()->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary me-2"
                            onclick="return confirm('Do you want to clear your cart?');">Clear Cart</button>
                    </form>
                    <a href="{{ route('order.checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
@endsection
