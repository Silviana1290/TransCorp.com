@extends('layouts.app')
@section('title', 'Vendors')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h2 class="text-xl font-semibold">Vendor List</h2>
  <a href="{{ route('vendors.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Add Vendor</a>
</div>

<table class="min-w-full bg-white rounded shadow">
  <thead class="bg-blue-50">
    <tr class="text-left">
      <th class="p-3">Name</th>
      <th class="p-3">Address</th>
      <th class="p-3">Phone</th>
      <th class="p-3">Contact Person</th>
      <th class="p-3 text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($vendors as $v)
    <tr class="border-b hover:bg-gray-50">
      <td class="p-3">{{ $v->name }}</td>
      <td class="p-3">{{ $v->address }}</td>
      <td class="p-3">{{ $v->phone }}</td>
      <td class="p-3">{{ $v->contact_person }}</td>
      <td class="p-3 text-center">
        <a href="{{ route('vendors.edit', $v->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>
        <form action="{{ route('vendors.destroy', $v->id) }}" method="POST" class="inline">
          @csrf @method('DELETE')
          <button class="bg-red-600 text-white px-2 py-1 rounded" onclick="return confirm('Delete this vendor?')">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection