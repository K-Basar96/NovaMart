@extends('user.layout.master')

@section('title', 'Track Order')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Track Your Order</h1>

        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form id="trackOrderForm" class="input-group">
                    @csrf
                    <input type="text" class="form-control" id="tracking_id" name="tracking_id"
                        placeholder="Enter Tracking ID" required>
                    <button class="btn btn-primary" type="submit">Track Order</button>
                </form>
            </div>
        </div>

        <div id="orderDetails" class="row justify-content-around d-none">
            <!-- Order details here -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#trackOrderForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('order.track') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#orderDetails').removeClass('d-none').html(`
                            <div class="card col-md-4 mb-4">
                                <div class="card-header">
                                    <h5>Order Details</h5>
                                </div>
                                <div class="card-body">
                                    <h6><strong>Name:</strong> ${response.order.user.name}</h6>
                                    <h6><strong>Total Amount:</strong> ₹${parseFloat(response.order.total_amount).toFixed(2)}</h6>
                                    <h6><strong>Status:</strong> <span class="${response.order.order_status == 'Cancelled' ? 'text-danger fw-bold' : ''}">${response.order.order_status}</span></h6>
                                    <h6><strong>Payment ID:</strong> ${response.order.payment_id ? (response.order.order_status === 'Cancelled' ? 'Refund Proceed' : 'Paid') : 'Pending'}</h6>
                                    <h6><strong>Order Placing Time:</strong> ${new Date(response.order.created_at).toLocaleString()}</h6>
                                    ${response.order.order_status === 'Delivered' ? `<h6><strong>Delivered at:</strong> ${new Date(response.order.updated_at).toLocaleString()}</h6>` : ''}
                                    <h6><strong>Items Ordered:</strong></h6>
                                    <ul class="list-group"> ${JSON.parse(response.order.items).map(item => 
                                        `<li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href='${item.item_name}' class='text-decoration-none text-secondary'>
                                                <strong>${item.item_name}</strong> (Quantity: ${item.quantity})
                                            </a>
                                            <span class="badge bg-primary rounded-pill">₹${parseFloat(item.price).toFixed(2)}</span>
                                        </li>`).join('')}
                                    </ul>
                                </div>
                            </div>
                        `);
                    },
                    error: function(xhr) {
                        if (xhr.status === 404) {
                            alert(xhr.responseJSON.error);
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
@endsection
