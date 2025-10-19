@extends('layouts.app')
@section('title', 'Inventory History')

@section('content')
<h2 class="text-xl font-semibold mb-3">Inventory History</h2>

<table class="min-w-full bg-white rounded shadow">
  <thead class="bg-blue-50">
    <tr class="text-left">
      <th class="p-3">Item</th>
      <th class="p-3">Warehouse</th>
      <th class="p-3">Change</th>
      <th class="p-3">Reason</th>
      <th class="p-3">Reference</th>
      <th class="p-3">Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach($histories as $h)
    <tr class="border-b hover:bg-gray-50">
      <td class="p-3">{{ $h->item->name ?? '-' }}</td>
      <td class="p-3">{{ $h->warehouse->name ?? '-' }}</td>
      <td class="p-3 {{ $h->change_qty > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $h->change_qty }}</td>
      <td class="p-3">{{ ucfirst($h->reason) }}</td>
      <td class="p-3">{{ $h->note }}</td>
      <td class="p-3">{{ $h->created_at->format('Y-m-d H:i') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection