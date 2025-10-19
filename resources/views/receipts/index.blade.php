@extends('layouts.app')
@section('title', 'Receipts')

@section('content')
<a href="{{ route('receipts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-3 inline-block">+ New Receipt</a>

<table class="min-w-full bg-white rounded shadow">
    <thead class="bg-blue-50">
        <tr class="text-left">
            <th class="p-3">Receipt No</th>
            <th class="p-3">Vendor</th>
            <th class="p-3">Warehouse</th>
            <th class="p-3">Date</th>
            <th class="p-3">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($receipts as $r)
        <tr class="border-b hover:bg-gray-50">
            <td class="p-3">{{ $r->receipt_no }}</td>
            <td class="p-3">{{ $r->vendor->name ?? '-' }}</td>
            <td class="p-3">{{ $r->warehouse->name ?? '-' }}</td>
            <td class="p-3">{{ $r->date }}</td>
            <td class="p-3">
                <a href="{{ route('receipts.show',$r->id) }}" class="text-blue-600 hover:underline">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection