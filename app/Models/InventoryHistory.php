<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class InventoryHistory extends Model {
    protected $table = 'inventory_histories';
    protected $fillable = ['item_id','warehouse_id','change_qty','reason','reference_id','operator_id','note'];
}