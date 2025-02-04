<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $orders = Order::with( 'user' )->get();
        return view( 'orders', compact( 'orders' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
    }

    public function store( Request $request ) {
    }

    public function checkout( Request $request ) {
        try {
            $cartItems = Cart::where( 'user_id', Auth::id() )->get();
            $totalAmount = 0;
            $items = [];

            foreach ( $cartItems as $item ) {
                $totalAmount += $item->quantity * $item->product->price;
                // Prepare items array
                $items[] = [
                    'product_id' => $item->product_id,
                    'item_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ];
            }
            // Prepare Razorpay order
            $api = new Api( config( 'services.razorpay.key' ), config( 'services.razorpay.secret' ) );
            $razorpayOrder = $api->order->create( [
                'amount' => $totalAmount * 100, // Amount in paise
                'currency' => 'INR',
                'payment_capture' => 1,
            ] );

            return response()->json( [
                'order_id' => $razorpayOrder[ 'id' ],
                'amount' => $totalAmount,
                'items' => $items,
            ] );
        } catch ( Exception $e ) {
            return response()->json( [
                'error' => 'Failed to create Razorpay order.',
                'message' => $e->getMessage(),
            ], 500 );
        }
    }

    /**
    * Store a newly created resource in storage.
    */

    public function confirmation( Request $request ) {
        try {
            \Log::info( 'Payment verification data:', [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'amount' => $request->amount,
                'items' => $request->items,
            ] );
            // Validate the request
            $request->validate( [
                'razorpay_payment_id' => 'required',
                'razorpay_order_id' => 'required',
                'amount' => 'required|numeric',
                'items' => 'required|array',
            ] );

            // Razorpay API
            $api = new Api( config( 'services.razorpay.key' ), config( 'services.razorpay.secret' ) );

            // Verify the payment
            $payment = $api->payment->fetch( $request->razorpay_payment_id );

            if ( $payment->status == 'captured' ) {
                // Payment is successful, Generate a unique tracking ID for the order
                $trackingId = now()->format( 'YmdHis' ) . str_pad( Order::whereDate( 'created_at', today() )->count() + 1, 3, '0', STR_PAD_LEFT );
                Order::create( [
                    'user_id' => Auth::id(),
                    'tracking_id' => $trackingId,
                    'total_amount' => $request->amount,
                    'order_status' => 'Pending',
                    'payment_id' => $request->razorpay_payment_id, // Retrieved from Razorpay
                    'items' => json_encode( $request->items ), // Array of cart items
                ] );
                // return redirect()->route( 'order.index' )->with( 'success', 'Order placed successfully!' );
                return response()->json( [ 'order_id' => $request->razorpay_order_id, 'tracking_id' => $trackingId, 'status' => 'success' ] );
            } else {
                return response()->json( [ 'status' => 'failed' ], 400 );
            }
        } catch ( \Exception $e ) {
            return response()->json( [ 'status' => 'error', 'message' => $e->getMessage() ], 500 );
        }
    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
        $order = Order::with( 'user' )->findOrFail( $id );
        return view( 'vieworder', compact( 'order' ) );
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( Order $order ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, Order $order ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( Order $order ) {
        //
    }
}
