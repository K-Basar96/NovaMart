<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
    * Display a listing of the resource.
    */

    public function index()
    {
        $user = auth()->user();
        $wishlists = $user->wishlists()->with('product', 'product.category', 'product.brand')->get();
        return view('wishlists', compact('wishlists', 'user'));
    }

    public function toggleWishlist(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $validated[ 'product_id' ];

        $wishlistItem = $user->wishlists()->where('product_id', $productId)->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            $message = 'Product removed from wishlist!';
        } else {
            $user->wishlists()->create([
                'product_id' => $productId,
            ]);
            $message = 'Product added to wishlist!';
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    */

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
            $cartItem->quantity += $validated[ 'quantity' ];
            $cartItem->save();
        } else {
            $user->carts()->create([
                'product_id' => $product->id,
                'quantity' => $validated[ 'quantity' ],
            ]);
        }

        // Remove the product from the wishlist
        $user->wishlists()->where('product_id', $request->product_id)->delete();

        return redirect()->back()->with('success', 'Product moved to cart successfully!');
    }

    /**
    * Display the specified resource.
    */

    public function show(string $id)
    {
        $user = User::findorfail($id);
        $wishlists = $user->wishlists()->with('product', 'product.category', 'product.brand')->get();
        return view('admin.client.wishlist', compact('wishlists', 'user'));
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit(string $id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update(Request $request, string $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy(string $id)
    {
        $user = auth()->user();
        $user->wishlists()->delete();
        return redirect()->route('wishlist.index', $user->id)->with('success', 'Wishlist cleared successfully!');
    }
}
