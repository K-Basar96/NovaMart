<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
    * Display a listing of the resource.
    */

    public function index()
    {
        $users = User::count();
        $products = Product::count();
        return view('admin.dashboard', compact('users', 'products'));
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
        //
    }

    /**
    * Display the specified resource.
    */

    public function show(string $id)
    {

    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit(string $id)
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    /**
    * Update the specified resource in storage.
    */

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
        $user = Auth::user();
        // Get the authenticated user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($user->image) {
                // Delete the old image from storage
                Storage::disk('public')->delete($user->image);
            }
            $imageName = $request->file('image')->store('images', 'public');
            $user->image = $imageName;
        }
        $user->save();
        return redirect()->route('admin.edit', $id)->with('success', 'Profile updated successfully.');
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy(string $id)
    {
        //
    }

    public function open_settings()
    {
        return view('admin.setting.settings');
    }

    public function show_products(Request $request)
    {
        $req_page = $request->page;
        $products = Product::with(['category', 'brand'])->paginate(5);
        if ($req_page == 'lastPage') {
            return redirect()->route('admin.products', ['page' => $products->lastPage()]);
        }
        return view('admin.product.products', compact('products'));
    }

    public function show_orders()
    {
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function services()
    {
        return view('admin.services');
    }

    public function show_users()
    {
        $users = User::Paginate(5);
        return view('admin.client.registeredUser', compact('users'));
    }

    public function switch_users(string $id)
    {
        $user = User::find($id);

        if (!$user || $id == 1 || $user->id === auth()->id() || auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        $user->role = ($user->role === 'user') ? 'admin' : 'user';
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function show_pages()
    {
        return view('admin.pages');
    }
}
