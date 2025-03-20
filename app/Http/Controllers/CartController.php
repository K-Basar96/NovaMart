<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cartItems = $user->carts()->with('product')->get();
        return view('cart', compact('cartItems', 'user'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json([
                'message' => 'You need to log in first.'
            ], 401);
        }
        $user = auth()->user();
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($validated[ 'product_id' ]);

        // checking the choosen product is already in user's cart
        $cartItem = $user->carts()->where('product_id', $product->id)->first();

        if ($cartItem) {
            if ($cartItem->quantity + $validated['quantity'] > $product->stock) {
                return response()->json([
                    'message' => 'Not enough stock available.'
                ], 400);
            }
            $cartItem->quantity += $validated[ 'quantity' ];
            $cartItem->save();
        } else {
            $user->carts()->create([
                'product_id' => $product->id,
                'quantity' => $validated[ 'quantity' ],
            ]);
        }
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Product added to cart successfully!',
            ]);
        }
    }


    public function show(string $id)
    {
        $user = User::findorfail($id);
        $cartItems = $user->carts()->with('product')->get();
        return view('admin.client.cart', compact('cartItems', 'user'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer',
        ]);
        $user = auth()->user();
        $cartItem = $user->carts()->where('product_id', $id)->firstOrFail();
        $product = Product::findOrFail($id);

        if ($validated['quantity'] == -1) {
            $cartItem->quantity > 1 ? $cartItem->decrement('quantity') : $cartItem->delete();
            $message = $cartItem->exists ? 'Quantity decreased by 1 in the cart successfully!' : 'Product removed from cart successfully!';
        } else {
            if ($cartItem->quantity + 1 > $product->stock) {
                return redirect()->back()->with('error', 'Not enough stock available.');
            }
            $cartItem->increment('quantity');
            $message = 'Quantity increased by 1 in the cart successfully!';
        }
        return redirect()->back()->with('success', $message);
    }

    public function destroy(string $id)
    {
        $cartItem = Cart::where('user_id', $id)->delete();
        return redirect()->back()->with('success', 'Your cart has been cleared successfully!');
    }
}
