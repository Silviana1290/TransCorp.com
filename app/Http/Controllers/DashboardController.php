<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Vendor;
use App\Models\Warehouse;
use App\Models\Receipt;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
    public function index() {
        $totalItems = Item::count();
        $totalVendors = Vendor::count();
        $totalWarehouses = Warehouse::count();

        $receiptsMonth = Receipt::whereMonth('date', date('m'))->count();
        $shipmentsMonth = Shipment::whereMonth('date', date('m'))->count();

        $stocksByWarehouse = Warehouse::with(['stocks.item'])->get();

        $chartData = [
            'labels' => [],
            'stockCounts' => [],
        ];

        foreach ($stocksByWarehouse as $wh) {
            $chartData['labels'][] = $wh->name;
            $chartData['stockCounts'][] = $wh->stocks->sum('quantity');
        }

        return view('dashboard.index', compact(
            'totalItems',
            'totalVendors',
            'totalWarehouses',
            'receiptsMonth',
            'shipmentsMonth',
            'chartData'
        ));
    }
}