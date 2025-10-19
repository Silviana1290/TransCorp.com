@extends('layouts.app')
@section('title', 'Add Item')

@section('content')
<h2 class="text-xl font-semibold mb-4">Add New Item</h2>

<form action="{{ route('items.store') }}" method="POST" class="bg-white p-6 rounded shadow w-2/3">
  @csrf
  <div class="mb-3">
    <label class="block mb-1 font-medium">Item Code</label>
    <input type="text" name="item_code" class="border rounded p-2 w-full" required>
  </div>

  <div class="mb-3">
    <label class="block mb-1 font-medium">Name</label>
    <input type="text" name="name" class="border rounded p-2 w-full" required>
  </div>

  <div class="mb-3">
    <label class="block mb-1 font-medium">Description</label>
    <textarea name="description" class="border rounded p-2 w-full" rows="3"></textarea>
  </div>

  <div class="mb-3">
    <label class="block mb-1 font-medium">Unit</label>
    <input type="text" name="unit" class="border rounded p-2 w-full">
  </div>

  <div class="mb-3">
    <label class="block mb-1 font-medium">Reorder Point</label>
    <input type="number" name="reorder_point" value="0" min="0" class="border rounded p-2 w-full">
  </div>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Item</button>
</form>
@endsection