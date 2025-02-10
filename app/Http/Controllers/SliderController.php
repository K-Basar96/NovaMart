<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function show_sliders() {
        $sliders = Slider::paginate( 3 );
        return view( 'admin.slider.sliders', compact( 'sliders' ) );
    }

    public function index() {
        $sliders = Slider::all();
        return view( 'home', compact( 'sliders' ) );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'admin.slider.addslider' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {
        $request->validate( [
            'position' => 'required|in:left,center,right',
            'image' => 'required|image|mimes:jpeg,png,jpg '. Rule::dimensions()->ratio( 25, 9 ),
            'heading' => 'required|string|max:255',
            'content' => 'required|string',
            'button_text' => 'required|string|max:50',
            'button_url' => 'required|url',
        ] );

        $imagePath = $request->file( 'image' )->store( 'sliders', 'public' );

        Slider::create( [
            'image' => $imagePath,
            'heading' => $request->heading,
            'content' => $request->content,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'position' => $request->position,
        ] );

        return redirect()->route( 'admin.sliders' )->with( 'success', 'Slider added successfully!' );
    }

    /**
    * Display the specified resource.
    */

    public function show() {
        $sliders = Slider::all();
        return $sliders;
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        $slider = Slider::findOrFail( $id );

        return view( 'admin.slider.editslider', compact( 'slider' ) );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        $slider = Slider::findOrFail( $id );
        $validated = $request->validate( [
            'position' => 'required|in:left,center,right',
            'image' => 'image|mimes:jpeg,png,jpg '. Rule::dimensions()->ratio( 25, 9 ),
            'heading' => 'required|string|max:255',
            'content' => 'required|string',
            'button_text' => 'required|string|max:50',
            'button_url' => 'required|url',
        ] );
        if ( $request->hasFile( 'image' ) ) {
            // Delete the old image from storage
            if ( $slider->image ) {
                Storage::disk( 'public' )->delete( $slider->image );
            }

            $imagePath = $request->file( 'image' )->store( 'images', 'public' );
            $validated[ 'image' ] = $imagePath;
        } else {
            $validated[ 'image' ] = $slider->image;
        }

        $slider->update( [
            'image' => $validated[ 'image' ],
            'heading' => $validated[ 'heading' ],
            'content' => $validated[ 'content' ],
            'button_text' => $validated[ 'button_text' ],
            'button_url' => $validated[ 'button_url' ],
            'position' => $validated[ 'position' ],
        ] );
        return redirect()->route( 'admin.sliders' )->with( 'success', 'Slider updated successfully!' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {
        $slider = Slider::findOrFail( $id );
        // return $slider;
        $slider->delete();
        return back()->with( 'success', 'Slider deleted successfully!' );
    }
}
