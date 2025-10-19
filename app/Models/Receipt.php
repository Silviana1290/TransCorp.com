<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model {
    protected $fillable = ['receipt_no','vendor_id','warehouse_id','date','operator_id','note'];
    public function details(){ return $this->hasMany(ReceiptDetail::class); }
    public function vendor(){ return $this->belongsTo(Vendor::class); }
    public function warehouse(){ return $this->belongsTo(Warehouse::class); }
}