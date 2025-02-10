@extends('admin.layout.master')
@section('page-name', 'Order Management')

@section('admin-content')
    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="mb-4 text-center">List of Orders</h1>
        <div class="col-md-12 table-responsive">
            <div id="cart-items" class="mb-4">
                <table class="table table-striped table-hover table-bordered text-center">
                    @if ($orders->isNotEmpty())
                        <tr class="table-primary">
                            <th>Order Tracking Id</th>
                            <th>Customer Id</th>
                            <th>Customer Name</th>
                            <th>Order Status</th>
                            <th>Address/Location</th>
                            <th>Total Amount</th>
                            <th>Payment</th>
                            <th>Action</th>
                        </tr>
                    @endif
                    <tbody>
                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->tracking_id }}</td>
                                <td>{{ $order->user->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td
                                    class="{{ $order->order_status == 'Cancelled' ? 'text-danger fw-bold' : ($order->order_status == 'Delivered' ? 'text-success fw-bold' : '') }}">
                                    {{ $order->order_status }}</td>
                                @php
                                    $addressData = json_decode($order->address);
                                    $plusCode = $addressData ? $addressData->exact_locale : null;
                                    $street = $addressData ? $addressData->street : '';
                                    $city = $addressData ? $addressData->city : '';
                                    $zipCode = $addressData ? $addressData->zip_code : '';
                                    $location = $plusCode ? $street . ', ' . $city . ', ' . $zipCode : null;
                                @endphp
                                <td>{{ $location }} </td>
                                <td>₹&nbsp;{{ number_format($order->total_amount, 2) }}</td>
                                <td class="text-success fw-bold">
                                    {{ $order->payment_id ? ($order->order_status == 'Cancelled' ? 'Refund Proceed' : 'Paid') : 'Pending' }}
                                </td>
                                <td class="d-flex gap-2">
                                    @if ($order->order_status == 'Delivered')
                                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-success">
                                            Delivered
                                        </a>
                                    @elseif ($order->order_status == 'Cancelled')
                                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-danger">
                                            Cancelled
                                        </a>
                                    @else
                                        <a href="{{ route('order.show', $order->id) }}">
                                            <i class="fs-3 bi bi-eye-fill text-secondary"></i>
                                        </a>
                                        <form action="{{ route('order.cancel', $order->id) }}" method="POST"
                                            onsubmit="return confirm('Do you want to cancel this order?');">
                                            @csrf
                                            <button type="submit" class="btn btn-link p-0">
                                                <i class="fs-3 bi bi-x-circle-fill text-danger"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <div class="card">
                                <div class="card-header">
                                    Orders
                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title">No order found.</h5>
                                </div>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
