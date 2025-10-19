<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_code',
        'name',
        'description',
        'unit',
        'reorder_point'
    ];

    public function item()
    {
        return $this->hasMany(Stock::class);
    }
}