<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $products = Product::paginate( 10 );

        return view( 'products.index', compact( 'products' ) );
    }

    public function search( Request $request ) {
        $query = Product::query();

        // Search by name
        if ( $request->filled( 'search' ) ) {
            $query->where( 'name', 'like', '%' . $request->search . '%' );
        }

        // Filter by price range
        if ( $request->filled( 'min_price' ) && $request->filled( 'max_price' ) ) {
            $query->whereBetween( 'price', [ $request->min_price, $request->max_price ] );
        }

        // Filter by category
        if ( $request->filled( 'category' ) ) {
            $query->where( 'category', $request->category );
        }

        $products = $query->paginate( 10 );

        // Return the data for AJAX
        return response()->json( [
            'html' => view( 'products.partials.product_list', compact( 'products' ) )->render()
        ] );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        $brands = Brand::all();
        $categories = Category::all();

        return view( 'admin.product.addproduct', compact( 'brands', 'categories' ) );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        $validated = $request->validate( [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ] );

        $imagePath = $request->file( 'image' )->store( 'images', 'public' );

        Product::create( [
            'name' => $validated[ 'name' ],
            'description' => $validated[ 'description' ],
            'price' => $validated[ 'price' ],
            'stock' => $validated[ 'stock' ],
            'category_id' => $validated[ 'category_id' ],
            'brand_id' => $validated[ 'brand_id' ],
            'image' => $imagePath,
        ] );

        return redirect()->route( 'admin.products', [ 'page' => 'lastPage' ] ) ->with( 'success', 'Product added successfully!' );
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
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail( $id );
        $selectedCategoryId = $product->category_id;
        $selectedBrandId = $product->category_id;

        return view( 'admin.product.editProduct', compact( 'product', 'brands', 'categories', 'selectedCategoryId', 'selectedBrandId' ) );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        $validated = $request->validate( [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // Optional image
        ] );

        $product = Product::findOrFail( $id );

        if ( $request->hasFile( 'image' ) ) {
            $imagePath = $request->file( 'image' )->store( 'images', 'public' );
            $validated[ 'image' ] = $imagePath;
        } else {
            $validated[ 'image' ] =  $product->image;
        }

        $product->update( [
            'name' => $validated[ 'name' ],
            'description' => $validated[ 'description' ],
            'price' => $validated[ 'price' ],
            'stock' => $validated[ 'stock' ],
            'category_id' => $validated[ 'category_id' ],
            'brand_id' => $validated[ 'brand_id' ],
            'image' => $validated[ 'image' ],
        ] );

        return redirect()->route( 'admin.products' )->with( 'success', 'Product updated successfully!' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        $product = Product::findOrFail( $id );
        $product->delete();

        return redirect()->route( 'admin.products' )->with( 'success', 'Product deleted successfully!' );
    }
}
