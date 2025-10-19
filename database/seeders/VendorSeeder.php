<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder {
  public function run(){
    Vendor::insert([
      ['name'=>'PT Logistik Sejahtera','address'=>'Jakarta','phone'=>'021-888888','contact_person'=>'Budi','created_at'=>now(),'updated_at'=>now()],
      ['name'=>'CV Mitra Transport','address'=>'Semarang','phone'=>'024-555555','contact_person'=>'Siti','created_at'=>now(),'updated_at'=>now()],
    ]);
  }
}