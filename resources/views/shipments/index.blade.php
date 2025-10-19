@extends('layouts.app')
@section('title', 'Shipments')

@section('content')
<a href="{{ route('shipments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-3 inline-block">+ New Shipment</a>

<table class="min-w-full bg-white rounded shadow">
  <thead class="bg-blue-50">
    <tr class="text-left">
      <th class="p-3">Ship No</th>
      <th class="p-3">Warehouse</th>
      <th class="p-3">Destination</th>
      <th class="p-3">Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach($shipments as $s)
    <tr class="border-b hover:bg-gray-50">
      <td class="p-3">{{ $s->ship_no }}</td>
      <td class="p-3">{{ $s->warehouse->name ?? '-' }}</td>
      <td class="p-3">{{ $s->destination }}</td>
      <td class="p-3">{{ $s->date }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection