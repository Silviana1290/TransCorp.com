@extends('layouts.app')
@section('title', 'Edit Vendor')

@section('content')
<h2 class="text-xl font-semibold mb-4">Edit Vendor</h2>

<form action="{{ route('vendors.update', $vendor->id) }}" method="POST" class="bg-white p-6 rounded shadow w-2/3">
  @csrf
  @method('PUT')

  <div class="mb-3">
    <label class="block mb-1 font-medium">Name</label>
    <input type="text" name="name" value="{{ $vendor->name }}" class="border rounded p-2 w-full" required>
  </div>
  <div class="mb-3">
    <label class="block mb-1 font-medium">Address</label>
    <input type="text" name="address" value="{{ $vendor->address }}" class="border rounded p-2 w-full">
  </div>
  <div class="mb-3">
    <label class="block mb-1 font-medium">Phone</label>
    <input type="text" name="phone" value="{{ $vendor->phone }}" class="border rounded p-2 w-full">
  </div>
  <div class="mb-3">
    <label class="block mb-1 font-medium">Contact Person</label>
    <input type="text" name="contact_person" value="{{ $vendor->contact_person }}" class="border rounded p-2 w-full">
  </div>

  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Vendor</button>
</form>
@endsection