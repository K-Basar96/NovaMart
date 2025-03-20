<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
    * Display a listing of the resource.
    */

    public function show_brands()
    {
        $brands = Brand::paginate(4);
        return view('admin.product.brands', compact('brands'));
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
        return view('admin.product.addbrand');
    }

    private function uploadImage($image, $name)
    {
        $extension = $image->getClientOriginalExtension();
        $modifiedName = preg_replace('/[^A-Za-z0-9]+/', '_', $name);
        $imageName = $modifiedName . '.' . $extension;
        return $image->storeAs('products', $imageName, 'public');
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:brands,name',
            'logo' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $imagePath = $this->uploadImage($request->file('logo'), $request->name);

        Brand::create([
            'name' => $request->name,
            'logo' => $imagePath,
        ]);

        return redirect()->route('admin.brands')->with('success', 'Brand added successfully!');
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
        $brand = Brand::findorfail($id);
        return view('admin.product.editbrand', compact('brand'));
    }

    /**
    * Update the specified resource in storage.
    */

    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|unique:brands,name,' . $id,
            'logo' => 'image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('logo')) {
            // Delete the old logo from storage
            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }
            $imagePath = $this->uploadImage($request->file('logo'), $request->name);
        } else {
            $imagePath = $brand->logo;
        }

        $brand->update([
            'name' => $validated[ 'name' ],
            'logo' => $imagePath,
        ]);

        return redirect()->route('admin.brands')->with('success', 'Brand updated successfully!');
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy(string $id)
    {
        $brand = Brand::findorfail($id);

        $brand->delete();
        return back()->with('success', 'Brand deleted successfully!');
    }

}
