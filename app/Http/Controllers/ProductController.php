<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller {
    /**
    * Display a listing of the resource.
    */

    private function getCommonData() {
        $brands = Brand::all();
        $categories = Category::all();

        return compact( 'brands', 'categories' );
    }

    public function index() {
        $products = Product::all();
        $data = $this->getCommonData();

        return view( 'allProducts', array_merge( [ 'products' => $products ], $data ) );
    }

    public function filter( Request $request ) {
        // return $request->all();
        // Validate the incoming request data
        $request->validate( [
            'brand' => 'nullable|exists:brands,id',
            'category' => 'nullable|exists:categories,id',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
        ] );

        // Build the query for products
        $query = Product::query();

        // Apply filters based on the request
        if ( $request->filled( 'brand' ) ) {
            $query->where( 'brand_id', $request->brand );
        }
        if ( $request->filled( 'category' ) ) {
            $query->where( 'category_id', $request->category );
        }

        if ( $request->filled( 'min_price' ) ) {
            $query->where( 'price', '>=', $request->min_price );
        }

        if ( $request->filled( 'max_price' ) ) {
            $query->where( 'price', '<=', $request->max_price );
        }

        // Get the filtered products
        $products = $query->get();
        // Fetch common data ( brands and categories )
        $data = $this->getCommonData();

        // Return the view with filtered products
        return view( 'allProducts', array_merge( [ 'products' => $products ], $data ) );
    }

    public function filterbyBrand( string $id ) {
        $products = Product::where( 'brand_id', $id )->get();
        $data = $this->getCommonData();

        return view( 'allProducts', array_merge( [ 'products' => $products ], $data ) );
    }

    public function filterbyCategory( string $id ) {
        $products = Product::where( 'category_id', $id )->get();
        $data = $this->getCommonData();

        return view( 'allProducts', array_merge( [ 'products' => $products ], $data ) );
    }

    public function sortBy( string $sort ) {
        switch ( $sort ) {
            case 'newest':
            $products = Product::orderBy( 'created_at', 'desc' )->get();
            break;
            case 'oldest':
            $products = Product::orderBy( 'created_at', 'asc' )->get();
            break;
            case 'low_to_high':
            $products = Product::orderBy( 'price', 'asc' )->get();
            break;
            case 'high_to_low':
            $products = Product::orderBy( 'price', 'desc' )->get();
            break;
            default:
            $products = Product::all();
            break;
        }

        $data = $this->getCommonData();

        return view( 'allProducts', array_merge( [ 'products' => $products ], $data ) );
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

        $products = $query->get();
        $data = $this->getCommonData();
        // Return the data for AJAX
        return view( 'allProducts', array_merge( [ 'products' => $products ], $data ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        $data = $this->getCommonData();
        return view( 'admin.product.addproduct', array_merge( $data ) );
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
        $data = $this->getCommonData();
        $product = Product::findOrFail( $id );
        return view( 'product', array_merge( [ 'product' => $product ], $data ) );
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        $data = $this->getCommonData();
        $product = Product::findOrFail( $id );
        $selectedCategoryId = $product->category_id;
        $selectedBrandId = $product->category_id;
        return view( 'admin.product.editProduct', array_merge( [ 'products' => $products, 'selectedCategoryId'=>$selectedCategoryId, 'selectedBrandId'=>$selectedBrandId ], $data ) );
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
            // Delete the old image from storage
            if ( $product->image ) {
                Storage::disk( 'public' )->delete( $product->image );
            }

            $imagePath = $request->file( 'image' )->store( 'images', 'public' );
            $validated[ 'image' ] = $imagePath;
        } else {
            $validated[ 'image' ] = $product->image;
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
