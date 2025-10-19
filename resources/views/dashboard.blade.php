@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Total Items</h3>
        <p class="text-3xl font-bold">{{ \App\Models\Item::count() }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Total Vendors</h3>
        <p class="text-3xl font-bold">{{ \App\Models\Vendor::count() }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-gray-500 text-sm">Total Warehouses</h3>
        <p class="text-3xl font-bold">{{ \App\Models\Warehouse::count() }}</p>
    </div>
</div>

<div class="mt-10">
    <h2 class="text-lg font-semibold mb-3">Recent Receipts</h2>
    <table class="min-w-full bg-white rounded shadow">
        <thead class="bg-blue-50">
            <tr class="text-left">
                <th class="p-3">Receipt No</th>
                <th class="p-3">Vendor</th>
                <th class="p-3">Warehouse</th>
                <th class="p-3">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\App\Models\Receipt::latest()->take(5)->get() as $r)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $r->receipt_no }}</td>
                <td class="p-3">{{ $r->vendor->name ?? '-' }}</td>
                <td class="p-3">{{ $r->warehouse->name ?? '-' }}</td>
                <td class="p-3">{{ $r->date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection