@extends('layouts.app')
@section('title', 'New Shipment')

@section('content')
<h2 class="text-xl font-semibold mb-4">Create New Shipment</h2>

<form action="{{ route('shipments.store') }}" method="POST" class="bg-white p-6 rounded shadow">
  @csrf
  <div class="grid grid-cols-2 gap-4">
    <div>
      <label class="block mb-1">Ship No</label>
      <input type="text" name="ship_no" value="{{ 'SH-' . time() }}" class="border rounded p-2 w-full" readonly>
    </div>
    <div>
      <label class="block mb-1">Date</label>
      <input type="date" name="date" value="{{ date('Y-m-d') }}" class="border rounded p-2 w-full">
    </div>
    <div>
      <label class="block mb-1">Warehouse</label>
      <select name="warehouse_id" class="border rounded p-2 w-full">
        @foreach(\App\Models\Warehouse::all() as $w)
          <option value="{{ $w->id }}">{{ $w->name }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label class="block mb-1">Destination</label>
      <input type="text" name="destination" class="border rounded p-2 w-full">
    </div>
  </div>

  <hr class="my-4">
  <h4 class="font-semibold mb-2">Items</h4>
  <div id="items-wrapper">
    <div class="flex gap-2 mb-2">
      <select name="items[0][item_id]" class="border rounded p-2 w-1/3">
        @foreach(\App\Models\Item::all() as $it)
          <option value="{{ $it->id }}">{{ $it->item_code }} - {{ $it->name }}</option>
        @endforeach
      </select>
      <input name="items[0][qty]" type="number" min="1" class="border rounded p-2 w-1/6" placeholder="Qty">
      <button type="button" class="remove-row bg-red-500 text-white px-2 rounded">−</button>
    </div>
  </div>

  <button type="button" id="add-item" class="bg-gray-600 text-white px-3 py-1 rounded mb-3">+ Add Item</button>
  <div class="text-right">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Shipment</button>
  </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let idx = 1;
document.getElementById('add-item').addEventListener('click', () => {
  const wrapper = document.getElementById('items-wrapper');
  const div = document.createElement('div');
  div.className = 'flex gap-2 mb-2';
  div.innerHTML = `
    <select name="items[${idx}][item_id]" class="border rounded p-2 w-1/3">
      @foreach(\App\Models\Item::all() as $it)
        <option value="{{ $it->id }}">{{ $it->item_code }} - {{ $it->name }}</option>
      @endforeach
    </select>
    <input name="items[${idx}][qty]" type="number" min="1" class="border rounded p-2 w-1/6" placeholder="Qty">
    <button type="button" class="remove-row bg-red-500 text-white px-2 rounded">−</button>
  `;
  wrapper.appendChild(div);
  idx++;
});

document.addEventListener('click', e => {
  if(e.target.classList.contains('remove-row')) e.target.parentElement.remove();
});
</script>

{{-- SweetAlert Notifications --}}
@if(session('success'))
<script>
Swal.fire({
  icon: 'success',
  title: 'Berhasil!',
  text: '{{ session('success') }}',
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
  icon: 'Gagal',
  title: 'Stok Tidak Cukup',
  text: '{{ session('error') }}',
  confirmButtonColor: '#e74c3c',
  confirmButtonText: 'Tutup'
});
</script>
@endif

@endsection