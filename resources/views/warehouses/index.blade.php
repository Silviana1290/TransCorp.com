@extends('layouts.app')
@section('title', 'Warehouses')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h2 class="text-xl font-semibold">Warehouse List</h2>
  <a href="{{ route('warehouses.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded">+ Add Warehouse</a>
</div>

<table class="min-w-full bg-white rounded shadow">
  <thead class="bg-blue-50">
    <tr class="text-left">
      <th class="p-3">Name</th>
      <th class="p-3">Address</th>
      <th class="p-3">Capacity</th>
      <th class="p-3 text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($warehouses as $w)
    <tr class="border-b hover:bg-gray-50">
      <td class="p-3">{{ $w->name }}</td>
      <td class="p-3">{{ $w->address }}</td>
      <td class="p-3">{{ $w->capacity }}</td>
      <td class="p-3 text-center">
        <a href="{{ route('warehouses.edit', $w->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded">Edit</a>
        <form action="{{ route('warehouses.destroy', $w->id) }}" method="POST" class="inline">
          @csrf @method('DELETE')
          <button class="bg-red-600 text-white px-2 py-1 rounded" onclick="return confirm('Delete this warehouse?')">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection