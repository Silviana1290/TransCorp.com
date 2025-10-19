<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\ShipmentDetail;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::with('warehouse')->latest()->get();
        return view('shipments.index', compact('shipments'));
    }

    public function create()
    {
        return view('shipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ship_no' => 'required|unique:shipments,ship_no',
            'warehouse_id' => 'required|integer',
            'date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|integer',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // 🧠 1️⃣ Cek stok semua item dulu
            foreach ($request->items as $item) {
                $stock = Stock::where('item_id', $item['item_id'])
                    ->where('warehouse_id', $request->warehouse_id)
                    ->lockForUpdate()
                    ->first();

                if (!$stock) {
                    DB::rollBack();
                    return redirect()
                        ->back()
                        ->with('error', "❌ Item dengan ID {$item['item_id']} tidak ditemukan di gudang ini!")
                        ->withInput();
                }

                if ($stock->quantity <= 0) {
                    DB::rollBack();
                    return redirect()
                        ->back()
                        ->with('error', "⚠️ Stok item ID {$item['item_id']} sudah habis!")
                        ->withInput();
                }

                if ($stock->quantity < $item['qty']) {
                    DB::rollBack();
                    return redirect()
                        ->back()
                        ->with('error', "⚠️ Stok item ID {$item['item_id']} tidak mencukupi (tersedia {$stock->quantity}, diminta {$item['qty']})")
                        ->withInput();
                }
            }

            // ✅ 2️⃣ Kalau semua stok aman, buat shipment
            $shipment = Shipment::create([
                'ship_no' => $request->ship_no,
                'warehouse_id' => $request->warehouse_id,
                'date' => $request->date,
                'destination' => $request->destination,
                'operator_id' => auth()->id() ?? 1,
                'note' => $request->note,
            ]);

            // 🏷️ 3️⃣ Buat detail dan kurangi stok
            foreach ($request->items as $item) {
                ShipmentDetail::create([
                    'shipment_id' => $shipment->id,
                    'item_id' => $item['item_id'],
                    'qty' => $item['qty'],
                ]);

                $stock = Stock::where('item_id', $item['item_id'])
                    ->where('warehouse_id', $request->warehouse_id)
                    ->lockForUpdate()
                    ->first();

                $stock->decrement('quantity', $item['qty']);
            }

            DB::commit();

            return redirect()
                ->route('shipments.index')
                ->with('success', '✅ Shipment berhasil disimpan!');

        } catch (Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', '❌ Transaksi gagal: ' . $e->getMessage())
                ->withInput();
        }
    }
}