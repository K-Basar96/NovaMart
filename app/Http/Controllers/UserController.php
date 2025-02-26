<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Mail\ForgotPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        ], [
            'password.regex' => 'Password must contain at least 1 uppercase letters, 1 lowercase letter, 1 number, and 1 special character.'
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
            'email' => 'required | email | exists:users,email',
            'password' => 'required | string | min:8',
        ], [
            'email.exists' => 'The email does not exist in our records.', // Custom error message
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

    public function forgot_password( Request $request ) {
        $request->validate( [
            'email' => 'required | email | exists:users,email',
        ], [
            'email.exists' => 'The email does not exist in our records.',
        ] );
        $user = User::where( 'email', $request->email )->first();
        $token = Str::random( 60 );
        DB::table( 'password_reset_tokens' )->updateOrInsert(
            [ 'email' => $user->email ],
            [ 'token' => $token, 'created_at' => now() ]
        );

        Mail::to( $user->email )->send( new ForgotPassword( $token ) );
        return back()->with( 'success', 'Password reset link has been sent to your email.' );
    }

    public function updatePassword( Request $request ) {
        $request->validate( [
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ] );

        $reset = DB::table( 'password_reset_tokens' )
        ->where( 'email', $request->email )
        ->where( 'token', $request->token )
        ->first();

        if ( !$reset ) {
            return back()->with( 'error', 'Invalid or expired token!' );
        }

        User::where( 'email', $request->email )->update( [
            'password' => Hash::make( $request->password ),
        ] );

        DB::table( 'password_reset_tokens' )->where( 'email', $request->email )->delete();
        return redirect()->route( 'login' )->with( 'success', 'Password has been reset successfully!' );
    }

    public function changePassword( Request $request ) {
        $request->validate( [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).+$/',
        ], [
            'password.regex' => 'Password must contain at least 1 uppercase letters, 1 lowercase letter, 1 number, and 1 special character.'
        ] );
        $user = Auth::user();
        if ( !Hash::check( $request->old_password, $user->password ) ) {
            return back()->withErrors( [ 'old_password' => 'Old password is incorrect.' ] );
        }
        $user->update( [
            'password' => Hash::make( $request->password ),
        ] );
        return 'Password changed successfully.';
        return redirect()->route( 'user.edit', Auth::id() )->with( 'success', 'Password changed successfully.' );
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
