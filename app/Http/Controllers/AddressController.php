<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
    * Display a listing of the resource.
    */

    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('user.address', compact('addresses'));
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create()
    {
        return view('user.newaddress');
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient' => 'required|string|max:100',
            'recipient_number' => 'required|numeric|digits:10',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'zip_code' => 'required|digits:6|numeric', // Adjust max length as needed
            'exact_locale' => 'required|regex:/^[A-Z0-9]{4}\+[A-Z0-9]{2}$/', // Plus Code validation
            'address_type' => 'required|string|max:100',
            'is_default' => 'string',
        ], [
            'exact_locale.regex' => 'The Exact Locale must be a valid Plus Code format.',
        ]);
        // Check if a default address exists for the user, if exists, update it
        $defaultAddress = Address::where('user_id', auth()->id())
        ->where('is_default', true)
        ->first();
        if ($defaultAddress) {
            $defaultAddress->is_default = false;
            $defaultAddress->save();
        }
        Address::create([
            'user_id' => Auth::id(),
            'recipient' => $validated[ 'recipient' ],
            'recipient_number' => $validated[ 'recipient_number' ],
            'street' => $validated[ 'street' ],
            'city' => $validated[ 'city' ],
            'state' => $validated[ 'state' ],
            'country' => $validated[ 'country' ],
            'zip_code' => $validated[ 'zip_code' ],
            'exact_locale' => $validated[ 'exact_locale' ],
            'address_type' => $validated[ 'address_type' ],
            'is_default' => $request->is_default ? true : false,
        ]);
        return redirect()->route('address.index')->with('success', 'Address added successfully!');
    }

    /**
    * Display the specified resource.
    */

    public function show(Address $address)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit(Address $address)
    {
        return view('user.editaddress', compact('address'));
    }

    /**
    * Update the specified resource in storage.
    */

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'recipient' => 'required|string|max:100',
            'recipient_number' => 'required|numeric|digits:10',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'zip_code' => 'required|digits:6|numeric', // Adjust max length as needed
            'exact_locale' => 'required|regex:/^[A-Z0-9]{4}\+[A-Z0-9]{2}$/', // Plus Code validation
            'address_type' => 'required|string|max:100',
            'is_default' => 'string',
        ], [
            'exact_locale.regex' => 'The Exact Locale must be a valid Plus Code format.',
        ]);
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        // Check if a default address exists for the user, if exists, update it
        $defaultAddress = Address::where('user_id', auth()->id())->where('is_default', true)->first();
        if ($defaultAddress) {
            $defaultAddress->is_default = false;
            $defaultAddress->save();
        }

        $address->update([
            'recipient' => $validated[ 'recipient' ],
            'recipient_number' => $validated[ 'recipient_number' ],
            'street' => $validated[ 'street' ],
            'city' => $validated[ 'city' ],
            'state' => $validated[ 'state' ],
            'country' => $validated[ 'country' ],
            'zip_code' => $validated[ 'zip_code' ],
            'exact_locale' => $validated[ 'exact_locale' ],
            'address_type' => $validated[ 'address_type' ],
            'is_default' => $request->is_default ? true : false,
        ]);

        return redirect()->route('address.index')->with('success', 'Address updated successfully!');
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy(string $id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);
        $address->delete();
        return redirect()->route('address.index')->with('success', 'Address Deleted successfully!');
    }
}
