@extends('layouts.app')
@section('title', 'Items')

@section('content')
<div class="flex justify-between items-center mb-4">
  <h2 class="text-xl font-semibold">Item List</h2>
  <a href="{{ route('items.create') }}" class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700">+ Add Item</a>
</div>

<table class="min-w-full bg-white rounded shadow">
  <thead class="bg-blue-50 text-blue-900">
    <tr class="text-left">
      <th class="p-3">Code</th>
      <th class="p-3">Name</th>
      <th class="p-3">Unit</th>
      <th class="p-3">Reorder Point</th>
      <th class="p-3 text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $item)
    <tr class="border-b hover:bg-gray-50">
      <td class="p-3">{{ $item->item_code }}</td>
      <td class="p-3">{{ $item->name }}</td>
      <td class="p-3">{{ $item->unit }}</td>
      <td class="p-3">{{ $item->reorder_point }}</td>
      <td class="p-3 text-center">
        <a href="{{ route('items.edit', $item->id) }}" class="bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">Edit</a>
        <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline">
          @csrf @method('DELETE')
          <button class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700" onclick="return confirm('Delete this item?')">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection