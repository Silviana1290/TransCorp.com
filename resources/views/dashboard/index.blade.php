@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
  <div class="bg-blue-600 text-white p-5 rounded shadow">
    <h4 class="text-sm">Total Items</h4>
    <p class="text-2xl font-bold">{{ $totalItems }}</p>
  </div>
  <div class="bg-green-600 text-white p-5 rounded shadow">
    <h4 class="text-sm">Total Vendors</h4>
    <p class="text-2xl font-bold">{{ $totalVendors }}</p>
  </div>
  <div class="bg-yellow-500 text-white p-5 rounded shadow">
    <h4 class="text-sm">Total Warehouses</h4>
    <p class="text-2xl font-bold">{{ $totalWarehouses }}</p>
  </div>
  <div class="bg-purple-600 text-white p-5 rounded shadow">
    <h4 class="text-sm">Receipts / Shipments ({{ date('M') }})</h4>
    <p class="text-lg font-bold">{{ $receiptsMonth }} / {{ $shipmentsMonth }}</p>
  </div>
</div>

<div class="bg-white rounded shadow p-6 mb-6">
  <h3 class="text-lg font-semibold mb-3">Stock Overview by Warehouse</h3>
  <canvas id="stockChart" height="120"></canvas>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <div class="bg-white p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-3">Recent Receipts</h3>
    <table class="w-full text-sm">
      <thead><tr class="border-b"><th class="text-left p-2">No</th><th>Date</th></tr></thead>
      <tbody>
        @foreach(\App\Models\Receipt::latest()->take(5)->get() as $r)
        <tr class="border-b">
          <td class="p-2">{{ $r->receipt_no }}</td>
          <td class="p-2">{{ $r->date }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="bg-white p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-3">Recent Shipments</h3>
    <table class="w-full text-sm">
      <thead><tr class="border-b"><th class="text-left p-2">No</th><th>Date</th></tr></thead>
      <tbody>
        @foreach(\App\Models\Shipment::latest()->take(5)->get() as $s)
        <tr class="border-b">
          <td class="p-2">{{ $s->ship_no }}</td>
          <td class="p-2">{{ $s->date }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('stockChart');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: @json($chartData['labels']),
    datasets: [{
      label: 'Total Stock Quantity',
      data: @json($chartData['stockCounts']),
      backgroundColor: '#3b82f6'
    }]
  },
  options: {
    scales: {
      y: { beginAtZero: true }
    }
  }
});
</script>
@endsection