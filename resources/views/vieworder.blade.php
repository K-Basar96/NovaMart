@extends('user.layout.master')
@section('title', 'Orders')
@section('content')
    <div class="container my-3">
        <div class="row justify-content-around">
            <h1 class="mb-4">Order ID - {{ $order->tracking_id }}</h1>

            <div class="card col-3">
                <div class="card-header">
                    <h5>Order Details</h5>
                </div>
                <div class="card-body">
                    <h6><strong>Name:</strong> {{ $order->user->name }}</h6>
                    <h6><strong>Total Amount:</strong> ₹&nbsp;{{ number_format($order->total_amount, 2) }}</h6>
                    <h6><strong>Status:</strong> <span
                            class="{{ $order->order_status == 'Cancelled' ? 'text-danger fw-bold' : '' }}">{{ $order->order_status }}</span>
                    </h6>
                    <h6><strong>Payment ID:</strong> <span
                            class="{{ $order->order_status == 'Cancelled' ? 'text-success' : '' }}">
                            {{ $order->payment_id ? ($order->order_status == 'Cancelled' ? 'Refund Proceed' : 'Paid') : 'Pending' }}
                        </span>
                    </h6>
                    <h6><strong>Order Placing Time:</strong>
                        {{ date('d M Y, h:i A', strtotime($order->created_at)) }}
                    </h6>
                    @if ($order->order_status == 'Delivered')
                        <h6><strong>Delivered at:</strong>
                            {{ date('d M Y, h:i A', strtotime($order->updated_at)) }}
                        </h6>
                    @endif
                </div>
            </div>
            <div class="card col-3">
                <div class="card-header">
                    <h5>Address Details</h5>
                </div>
                <div class="card-body">
                    @php
                        $addressData = json_decode($order->address);
                    @endphp
                    <h6><strong>Name:</strong> {{ $addressData->recipient }}</h6>
                    <h6><strong>Contact:</strong> {{ $addressData->recipient_number }}</h6>
                    <h6><strong>Address:</strong> {{ $addressData->street }}, {{ $addressData->city }}</h6>
                    <h6> {{ $addressData->state }}, {{ $addressData->zip_code }}</h6>
                </div>
            </div>

            <div class="card col-5">
                <div class="card-header">
                    <h5>Items Ordered</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach (json_decode($order->items) as $item)
                            <a href="#" class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->item_name }}</strong> (Quantity: {{ $item->quantity }})
                                    (<strong>MRP:
                                    </strong>{{ $item->price }})
                                </div>
                                <span class="badge badge-primary badge-pill">${{ number_format($item->price, 2) }}</span>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- Order Tracking Progress Bar --}}
        @if ($order->order_status != 'Cancelled')
            <div class="mt-4">
                <h5>Order Status Tracking</h5>
                <div class="progress">
                    @php
                        $status = $order->order_status;
                        $progress = 0;

                        switch ($status) {
                            case 'Processing':
                                $progress = 25;
                                break;
                            case 'Shipped':
                                $progress = 50;
                                break;
                            case 'Delivered':
                                $progress = 100;
                                break;
                            case 'Pending':
                            default:
                                $progress = 0;
                                break;
                        }
                    @endphp
                    <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;"
                        aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <span>Pending</span>
                    <span>Processing</span>
                    <span>Shipped</span>
                    <span>Dispatch</span>
                    <span>Delivered</span>
                </div>
            </div>
        @endif
    </div>
@endsection
