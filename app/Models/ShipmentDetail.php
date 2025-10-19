<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ShipmentDetail extends Model {
    protected $table = 'shipment_details';
    protected $fillable = ['shipment_id','item_id','qty'];
    public function item(){ return $this->belongsTo(Item::class); }
    public function shipment(){ return $this->belongsTo(Shipment::class); }
}