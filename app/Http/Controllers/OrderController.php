<?php

namespace App\Http\Controllers;

use Log;
use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Address;
use App\Models\Product;
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

    public function checkout() {
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
            $addresses = Address::where( 'user_id', Auth::id() )->get();
            // Pass data to the checkout view
            return view( 'checkout', [
                'order_id' => $razorpayOrder[ 'id' ],
                'totalAmount' => $totalAmount,
                'items' => $items,
                'addresses' => $addresses,
            ] );
        } catch ( Exception $e ) {
            return redirect()->back()->with( 'error', 'Failed to prepare checkout. ' . $e->getMessage() );
        }
    }

    /**
    * Store a newly created resource in storage.
    */

    public function confirmation( Request $request ) {
        try {
            $request->validate( [
                'razorpay_payment_id' => 'required',
                'total_amount' => 'required|numeric',
                'items' => 'required|array',
                'address' => 'required|array',
            ] );

            // Verify the payment
            $api = new Api( config( 'services.razorpay.key' ), config( 'services.razorpay.secret' ) );
            $payment = $api->payment->fetch( $request->razorpay_payment_id );

            if ( $payment->status == 'captured' ) {
                // Payment is successful, Generate a unique tracking ID for the order
                $trackingId = now()->format( 'YmdHis' ) . str_pad( Order::whereDate( 'created_at', today() )->count() + 1, 3, '0', STR_PAD_LEFT );
                Order::create( [
                    'user_id' => Auth::id(),
                    'tracking_id' => $trackingId,
                    'total_amount' => $request->total_amount / 100, // Convert back to original amount
                    'order_status' => 'Pending',
                    'payment_id' => $request->razorpay_payment_id,
                    'items' => json_encode( $request->items ), // Array of cart items
                    'address' => json_encode( $request->address ), // Array of address
                ] );
                // Update the product table and decrease the product quantity
                foreach ( $request->items as $item ) {
                    $product = Product::find( $item[ 'product_id' ] );
                    $product->stock -= $item[ 'quantity' ];
                    $product->save();
                }
                //clearing user cart
                Cart::where( 'user_id', Auth::id() )->delete();
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

    public function show_orders( string $id ) {
        $user = User::find( $id );
        $orders = Order::with( 'user' )->where( 'user_id', $id )->get();
        return view( 'admin.orders', compact( 'orders', 'user' ) );
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        $order = Order::findOrFail( $id );
        $statusSteps = [ 'Pending', 'Processing', 'Shipped', 'Delivered' ];
        $currentStatus = array_search( $order->order_status, $statusSteps );

        if ( $currentStatus < count( $statusSteps ) - 1 ) {
            $order->order_status = $statusSteps[ $currentStatus + 1 ];
            $order->save();
        }
        return redirect()->back()->with( 'success', 'Order status updated successfully.' );
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

    public function destroy( string $id ) {
        // this is not required as we would not cancel any order - we will update it as Cancelled.
    }

    public function cancel( Request $request, string $id ) {
        $order = Order::findOrFail( $id );
        if ( $order->user_id == Auth::id() ) {
            $order->order_status = 'Cancelled';
            $order->save();
            return redirect()->back()->with( 'success', 'Order canceled Successfully.' );
        } else {
            return redirect()->back()->with( 'failed', "You're not authorized to cancel." );
        }
    }

    public function track() {
        return view( 'ordertrack' );
    }

    public function tracking( Request $request ) {
        $request->validate( [
            'tracking_id' => 'required|string',
        ] );
        $order = Order::where( 'tracking_id', $request->tracking_id )->with( 'user' )->first();
        if ( !$order ) {
            return response()->json( [ 'error' => 'Order not found' ], 404 );
        }
        return response()->json( [ 'order' => $order ] );
    }
}
