<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
    * Display a listing of the resource.
    */

    public function show_categories()
    {
        $categories = Category::paginate(5);
        return view('admin.product.categories', compact('categories'));
    }

    public function index()
    {
        //
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create()
    {
        return view('admin.product.addcategory');
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = str_replace(' ', '', strtolower($validated[ 'name' ])) . '.' . $extension;
        $imagePath = $request->file('image')->storeAs('categories', $fileName, 'public');

        Category::create([
            'name' => $validated[ 'name' ],
            'description' => $validated[ 'description' ],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.categories')->with('success', 'Category added successfully!');
    }

    /**
    * Display the specified resource.
    */

    public function show(string $id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit(string $id)
    {
        $category = Category::findorfail($id);
        return view('admin.product.editcategory', compact('category'));
    }

    /**
    * Update the specified resource in storage.
    */

    public function update(Request $request, string $id)
    {
        $category = Category::findorfail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $id,
            'description' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image from storage
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = str_replace(' ', '', strtolower($validated[ 'name' ])) . '.' . $extension;
            $imagePath = $request->file('image')->storeAs('categories', $fileName, 'public');
            $validated[ 'image' ] = $imagePath;
        } else {
            $validated[ 'image' ] = $category->image;
        }

        $category->update([
            'name' => $validated[ 'name' ],
            'description' => $validated[ 'description' ],
            'image' => $validated[ 'image' ],
        ]);
        return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy(string $id)
    {
        $category = Category::findorfail($id);

        $category->delete();
        return back()->with('success', 'Category deleted successfully!');
    }
}
