<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function home() {
        $sliders = Slider::all();
        $brands = Brand::take( 6 )->get();
        $categories = Category::take( 4 )->get();
        $newItems = Product::orderby( 'created_at', 'desc' )->take( 4 )->get();
        $bestProducts = Product::orderby( 'stock', 'desc' )->take( 3 )->get();
        return view( 'home', compact( 'sliders', 'brands', 'categories', 'newItems', 'bestProducts' ) );
    }

    public function faqs() {
        return view( 'faqs' );

    }

    public function returnpolicy() {
        return view( 'returnpolicy' );
    }

    public function index() {

    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'user.register' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ) {

        $validated = $request->validate( [
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|unique:users,email',
            'phone' => 'required|numeric|digits:10',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@])[A-Za-z\d@]+$/',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ] );
        // Process the image
        $imageName = $request->file( 'image' )->store( 'images', 'public' );

        // Create the user
        $user = User::create( [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make( $request->password ),
            'image' => $imageName,
        ] );

        return redirect()->route( 'login' )->with( 'success', 'User registered successfully.' );
    }

    public function login() {
        return view( 'login' );
    }

    public function login_check( Request $request ) {
        $request->validate( [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ] );

        if ( Auth::attempt( $request->only( 'email', 'password' ) ) ) {
            $user = Auth::user();

            if ( $user->role == 'admin' ) {
                return redirect()->route( 'admin.index' );
            } else {
                return redirect()->route( 'home' );
            }
        } else {
            return back()->withErrors( [
                'email' => 'The provided credentials do not match our records.',
            ] );
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route( 'home' );
    }

    /**
    * Display the specified resource.
    */

    public function show( string $id ) {
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( string $id ) {
        $user = User::findorfail( $id );
        return view( 'user.userProfile', compact( 'user' ) );
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, string $id ) {
        $request->validate( [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ] );
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ( $request->hasFile( 'image' ) ) {
            // Delete the old image from storage
            if ( $user->image ) {
                Storage::disk( 'public' )->delete( $user->image );
            }
            $imageName = $request->file( 'image' )->store( 'images', 'public' );
            $user->image = $imageName;
        }
        $user->save();
        return redirect()->route( 'user.edit', $user->id )->with( 'success', 'Profile updated successfully.' );
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( string $id ) {

    }
}
