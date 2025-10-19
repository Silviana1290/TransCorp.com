<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder {
  public function run(){
    Item::insert([
      ['item_code'=>'ITM-001','name'=>'Ban Truk','unit'=>'pcs','reorder_point'=>10,'created_at'=>now(),'updated_at'=>now()],
      ['item_code'=>'ITM-002','name'=>'Oli Mesin','unit'=>'ltr','reorder_point'=>20,'created_at'=>now(),'updated_at'=>now()],
      ['item_code'=>'ITM-003','name'=>'Filter Udara','unit'=>'pcs','reorder_point'=>15,'created_at'=>now(),'updated_at'=>now()],
    ]);
  }
}