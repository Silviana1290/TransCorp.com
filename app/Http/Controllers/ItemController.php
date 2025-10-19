<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_code' => 'required|unique:items,item_code',
            'name' => 'required',
        ]);

        Item::create($request->only('item_code', 'name', 'description', 'unit', 'reorder_point'));
        return redirect()->route('items.index')->with('success', 'Item berhasil dibuat');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate(['name' => 'required']);
        $item->update($request->only('name', 'description', 'unit', 'reorder_point'));
        return redirect()->route('items.index')->with('success', 'Item berhasil diperbarui');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item berhasil dihapus');
    }
}