<?php
namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller {
    public function index() {
        $warehouses = Warehouse::all();
        return view('warehouses.index', compact('warehouses'));
    }

    public function create() {
        return view('warehouses.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
        ]);
        Warehouse::create($request->only('name', 'address', 'capacity'));
        return redirect()->route('warehouses.index')->with('success', 'Warehouse added successfully.');
    }

    public function edit(Warehouse $warehouse) {
        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse) {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
        ]);
        $warehouse->update($request->only('name', 'address', 'capacity'));
        return redirect()->route('warehouses.index')->with('success', 'Warehouse updated successfully.');
    }

    public function destroy(Warehouse $warehouse) {
        $warehouse->delete();
        return back()->with('success', 'Warehouse deleted successfully.');
    }
}