@extends('user.layout.master')
@section('title', 'Orders')
@section('content')
    <div class="container my-3 justify-content-centre">
        <div class="row justify-content-center">
            <h1 class="mb-4">Your Orders</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-md-8 table-responsive">
                <div id="cart-items" class="mb-4">
                    <table class="table table-striped table-hover table-bordered text-center">
                        <tr class="table-primary">
                            <th>Order Tracking Id</th>
                            <th>Total Amount</th>
                            <th>Order Status</th>
                            <th>Payment Id</th>
                            <th>Action</th>
                        </tr>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->tracking_id }}</td>
                                    <td>₹&nbsp;{{ number_format($order->total_amount, 2) }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td>{{ $order->order_status ? 'Paid' : 'Pending' }}</td>
                                    <td class="d-flex gap-2">
                                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-outline-secondary w-100">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
