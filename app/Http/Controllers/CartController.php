<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $user = auth()->user();
        $cartItems = $user->carts()->with( 'product' )->get();
        return view( 'cart', compact( 'cartItems' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        $user = auth()->user();
        $validated = $request->validate( [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ] );

        $product = Product::findOrFail( $validated[ 'product_id' ] );

        // checking the choosen product is already in user's cart
        $cartItem = $user->carts()->where( 'product_id', $product->id )->first();

        if ( $cartItem ) {
            $cartItem->quantity += $validated[ 'quantity' ];
            $cartItem->save();
        } else {
            $user->carts()->create( [
                'product_id' => $product->id,
                'quantity' => $validated[ 'quantity' ],
            ] );
        }
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Product added to cart successfully!',
            ]);
        }
    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        $validated = $request->validate( [
            'quantity' => 'required|integer',
        ] );
        $user = auth()->user();
        $cartItem = $user->carts()->where('product_id', $id)->firstOrFail();

        if($validated['quantity']==-1){
            $cartItem->quantity > 1 ? $cartItem->decrement('quantity') : $cartItem->delete();
            $message = $cartItem->exists ? 'Quantity decreased by 1 in the cart successfully!' : 'Product removed from cart successfully!';
        } else {
            $cartItem->increment('quantity');
            $message = 'Quantity increased by 1 in the cart successfully!';
        }
        return redirect()->back()->with('success', $message);
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        $cartItem = Cart::where('user_id', $id )->delete();
        return redirect()->back()->with('success', 'Your cart has been cleared successfully!' );
    }
}
