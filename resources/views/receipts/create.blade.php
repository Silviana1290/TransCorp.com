@extends('layouts.app')
@section('title', 'New Receipt')

@section('content')
<h2 class="text-xl font-semibold mb-4">Create New Receipt</h2>

<form action="{{ route('receipts.store') }}" method="POST" class="bg-white p-6 rounded shadow">
  @csrf

  <div class="grid grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Receipt No</label>
      <input type="text" name="receipt_no" value="{{ 'RC-' . time() }}" class="border rounded p-2 w-full" readonly>
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Date</label>
      <input type="date" name="date" value="{{ date('Y-m-d') }}" class="border rounded p-2 w-full" required>
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Vendor</label>
      <select name="vendor_id" class="border rounded p-2 w-full" required>
        @foreach(\App\Models\Vendor::all() as $v)
          <option value="{{ $v->id }}">{{ $v->name }}</option>
        @endforeach
      </select>
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Warehouse</label>
      <select name="warehouse_id" class="border rounded p-2 w-full" required>
        @foreach(\App\Models\Warehouse::all() as $w)
          <option value="{{ $w->id }}">{{ $w->name }}</option>
        @endforeach
      </select>
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
      <input name="items[0][unit_price]" type="number" step="0.01" class="border rounded p-2 w-1/6" placeholder="Unit Price">
      <button type="button" class="remove-row bg-red-500 text-white px-2 rounded">−</button>
    </div>
  </div>

  <button type="button" id="add-item" class="bg-gray-600 text-white px-3 py-1 rounded mb-3">+ Add Item</button>

  <div class="text-right">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Receipt</button>
  </div>
</form>

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
    <input name="items[${idx}][unit_price]" type="number" step="0.01" class="border rounded p-2 w-1/6" placeholder="Unit Price">
    <button type="button" class="remove-row bg-red-500 text-white px-2 rounded">−</button>
  `;
  wrapper.appendChild(div);
  idx++;
});

document.addEventListener('click', e => {
  if(e.target.classList.contains('remove-row')) e.target.parentElement.remove();
});
</script>
@endsection