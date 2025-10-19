<?php
namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller {
    public function index() {
        $vendors = Vendor::all();
        return view('vendors.index', compact('vendors'));
    }

    public function create() {
        return view('vendors.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'contact_person' => 'nullable|string|max:100',
        ]);
        Vendor::create($request->only('name', 'address', 'phone', 'contact_person'));
        return redirect()->route('vendors.index')->with('success', 'Vendor added successfully.');
    }

    public function edit(Vendor $vendor) {
        return view('vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'contact_person' => 'nullable|string|max:100',
        ]);
        $vendor->update($request->only('name', 'address', 'phone', 'contact_person'));
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    public function destroy(Vendor $vendor) {
        $vendor->delete();
        return back()->with('success', 'Vendor deleted successfully.');
    }
}