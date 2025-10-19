@extends('layouts.app')
@section('title', 'Edit Warehouse')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Warehouse</h2>

<form action="{{ route('warehouses.update', $warehouse->id) }}" method="POST" class="bg-white p-6 rounded shadow w-2/3">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label class="block mb-1 font-medium">Name</label>
    <input type="text" name="name" value="{{ $warehouse->name }}" class="border rounded p-2 w-full" required>
  </div>
  <div class="mb-3">
    <label class="block mb-1 font-medium">Address</label>
    <input type="text" name="address" value="{{ $warehouse->address }}" class="border rounded p-2 w-full">
  </div>
  <div class="mb-3">
    <label class="block mb-1 font-medium">Capacity</label>
    <input type="number" name="capacity" value="{{ $warehouse->capacity }}" class="border rounded p-2 w-full" min="0">
  </div>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Warehouse</button>
</form>
@endsection