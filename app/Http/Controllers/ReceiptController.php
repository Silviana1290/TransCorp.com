<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\ReceiptDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = Receipt::with(['vendor', 'warehouse'])->latest()->get();
        return view('receipts.index', compact('receipts'));
    }

    public function create()
    {
        return view('receipts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'receipt_no' => 'required|unique:receipts,receipt_no',
            'vendor_id' => 'required',
            'warehouse_id' => 'required',
            'date' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            $receipt = Receipt::create([
                'receipt_no' => $request->receipt_no,
                'vendor_id' => $request->vendor_id,
                'warehouse_id' => $request->warehouse_id,
                'date' => $request->date,
                'operator_id' => 1,
                'note' => $request->note,
            ]);

            foreach ($request->items as $item) {
                ReceiptDetail::create([
                    'receipt_id' => $receipt->id,
                    'item_id' => $item['item_id'],
                    'qty' => $item['qty'],
                    'unit_price' => $item['unit_price'] ?? 0,
                ]);
            }
        });

        return redirect()->route('receipts.index')->with('success', 'Receipt berhasil disimpan');
    }
}