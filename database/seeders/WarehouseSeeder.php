<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder {
  public function run(){
    Warehouse::insert([
      ['name'=>'Gudang Utama','address'=>'Jl. Siliwangi 10','capacity'=>5000,'created_at'=>now(),'updated_at'=>now()],
      ['name'=>'Gudang Cabang','address'=>'Jl. Ahmad Yani 22','capacity'=>3000,'created_at'=>now(),'updated_at'=>now()],
    ]);
  }
}