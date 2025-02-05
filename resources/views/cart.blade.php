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
                    <form id="checkout-form" action="{{ route('order.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            console.log('Script is loaded and running.');
            $('#checkout-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log('Response from server:', response);
                        // Response contains order_id, amount and items
                        if (response.order_id) {
                            // Call Razorpay payment gateway
                            var options = {
                                key: "{{ config('services.razorpay.key') }}",
                                amount: response.amount * 100, // Amount in paise
                                currency: "INR",
                                name: "NovaMart",
                                description: "Test Transaction",
                                order_id: response.order_id,
                                handler: function(paymentResponse) {
                                    console.log(paymentResponse);
                                    $.ajax({
                                        url: "{{ route('order.confirmation') }}",
                                        type: 'POST',
                                        data: {
                                            _token: '{{ csrf_token() }}', // Include CSRF token
                                            razorpay_payment_id: paymentResponse
                                                .razorpay_payment_id,
                                            razorpay_order_id: paymentResponse
                                                .razorpay_order_id,
                                            amount: response.amount,
                                            items: response.items,
                                        },
                                        success: function(successResponse) {
                                            alert('Payment successful! Order Tracking ID: ' +
                                                successResponse
                                                .tracking_id);
                                            window.location.href =
                                                "{{ route('order.index') }}";
                                        },
                                        error: function() {
                                            alert('Payment verification failed.');
                                        }
                                    });
                                },
                                prefill: {
                                    name: "{{ Auth::user()->name }}",
                                    email: "{{ Auth::user()->email }}",
                                    contact: "{{ Auth::user()->phone }}"
                                },
                                theme: {
                                    color: "#F37254"
                                }
                            };
                            var rzp1 = new Razorpay(options);
                            rzp1.open();
                        }
                    },
                    error: function(xhr) {
                        alert('Error occurred while processing your request.');
                    }
                });
            });
        });
    </script>
@endsection
