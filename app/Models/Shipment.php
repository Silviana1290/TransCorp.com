<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model {
    protected $fillable = ['ship_no','warehouse_id','date','destination','operator_id','note'];
    public function details(){ return $this->hasMany(ShipmentDetail::class); }
    public function warehouse(){ return $this->belongsTo(Warehouse::class); }
}