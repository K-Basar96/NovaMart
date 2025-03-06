@extends('user.layout.master')
@section('title', 'Order Checkout')
@section('content')
    <div class="container my-3 justify-content-center">
        <div class="row justify-content-center">
            <h1 class="mb-4">Confirm your order</h1>
            @include('alert')

            <!-- Address Selection -->
            <div class="mb-4 col-8">
                <h5>Select Address</h5>
                <select id="address-select" class="form-select" required>
                    <option hidden value="">Select an address</option>
                    @forelse ($addresses as $address)
                        <option value="{{ json_encode($address) }}">{{ $address->address_type }}</option>
                    @empty
                        <option disabled>No Saved addresses found, Please add address to continue order</option>
                    @endforelse
                </select>
            </div>

            <div class="col-md-8 table-responsive">
                <div id="cart-items" class="mb-4">
                    <table class="table table-striped table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item['item_name'] }}</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>₹{{ number_format($item['price'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="cart-summary" class="text-end mb-4">
                    <h4>Total Amount: ₹{{ number_format($totalAmount, 2) }}</h4>
                </div>

                <div class="d-flex justify-content-end">
                    <form id="razorpay-form" action="{{ route('order.confirmation') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order_id }}">
                        <input type="hidden" name="total_amount" value="{{ $totalAmount * 100 }}">

                        @foreach ($items as $item)
                            <input type="hidden" name="items[]" value="{{ json_encode($item) }}">
                        @endforeach

                        <button type="button" id="pay-button" class="badge bg-primary rounded-pill py-3 my-2">
                            Pay ₹{{ number_format($totalAmount, 2) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            $('#pay-button').on('click', function(e) {
                e.preventDefault();

                var addressSelect = $('#address-select');

                if (addressSelect.val() === "") {
                    alert("Please select an address or enter a new address.");
                    window.location.href = "{{ route('address.create') }}";
                    return;
                }
                var selectedAddress = JSON.parse(addressSelect.val());

                var formData = {
                    order_id: $('input[name="order_id"]').val(),
                    total_amount: $('input[name="total_amount"]').val(),
                    address: selectedAddress,
                    items: []
                };

                @foreach ($items as $item)
                    formData.items.push({!! json_encode($item) !!});
                @endforeach

                // Prepare Razorpay options
                var options = {
                    key: "{{ config('services.razorpay.key') }}",
                    amount: $('input[name="total_amount"]').val(),
                    currency: "INR",
                    name: "NovaMart",
                    description: "Order Payment",
                    order_id: formData.order_id,
                    handler: function(response) {
                        formData.razorpay_order_id = response
                            .razorpay_order_id; // Ensure this is set
                        formData.razorpay_payment_id = response.razorpay_payment_id;

                        // Send AJAX request to confirm the order
                        $.ajax({
                            url: "{{ route('order.confirmation') }}",
                            type: 'POST',
                            data: JSON.stringify(formData),
                            contentType: 'application/json',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.status === 'success') {
                                    alert('Order confirmed! Tracking ID: ' + data
                                        .tracking_id);
                                    window.location.href =
                                        "{{ route('order.index') }}"; // Redirect to order index
                                } else {
                                    alert('Payment failed. Please try again.');
                                }
                            },
                            error: function(xhr) {
                                console.error('Error:', xhr);
                                alert('An error occurred. Please try again.');
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
                rzp1.open(); // Open the Razorpay payment modal
            });
        });
    </script>
@endsection
