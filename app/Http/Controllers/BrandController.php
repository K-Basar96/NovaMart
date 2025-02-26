<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function show_brands() {
        $brands = Brand::paginate( 4 );
        return view( 'admin.product.brands', compact( 'brands' ) );
    }

    public function index() {
        //
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'admin.product.addbrand' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {

        $validated = $request->validate( [
            'name' => 'required|string|unique:brands,name',
            'logo' => 'required|image|mimes:jpg,jpeg,png',
        ] );
        $extension = $request->file( 'logo' )->getClientOriginalExtension();
        $fileName = str_replace( ' ', '', strtolower( $request->name ) ) . '.' . $extension;
        $imagePath = $request->file( 'logo' )->storeAs( 'brands', $fileName, 'public' );

        Brand::create( [
            'name' => $request->name,
            'logo' => $imagePath,
        ] );

        return redirect()->route( 'admin.brands' )->with( 'success', 'Brand added successfully!' );
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
        $brand = Brand::findorfail( $id );
        return view( 'admin.product.editbrand', compact( 'brand' ) );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        $brand = Brand::findorfail( $id );

        $validated = $request->validate( [
            'name' => 'required|string|unique:brands,name,' . $id,
            'logo' => 'image|mimes:jpg,jpeg,png',
        ] );

        if ( $request->hasFile( 'logo' ) ) {
            // Delete the old logo from storage
            if ( $brand->logo ) {
                Storage::disk( 'public' )->delete( $brand->logo );
            }
            $extension = $request->file( 'logo' )->getClientOriginalExtension();
            $fileName = str_replace( ' ', '', strtolower( $request->name ) ) . '.' . $extension;
            $imagePath = $request->file( 'logo' )->storeAs( 'brands', $fileName, 'public' );
            $validated[ 'logo' ] = $imagePath;
        } else {
            $validated[ 'logo' ] = $brand->logo;
        }

        $brand->update( [
            'name' => $validated[ 'name' ],
            'logo' => $validated[ 'logo' ],
        ] );

        return redirect()->route( 'admin.brands' )->with( 'success', 'Brand updated successfully!' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        $brand = Brand::findorfail( $id );

        $brand->delete();
        return back()->with( 'success', 'Brand deleted successfully!' );
    }

}
