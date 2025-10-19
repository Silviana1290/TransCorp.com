<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ReceiptDetail extends Model {
    protected $table = 'receipt_details';
    protected $fillable = ['receipt_id','item_id','qty','unit_price'];
    public function item(){ return $this->belongsTo(Item::class); }
    public function receipt(){ return $this->belongsTo(Receipt::class); }
}