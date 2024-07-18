<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas=[
            [
                "product_name"=>"bag",
                "product_categoryId"=>"2",
                "barcode"=>"12",
                "product_status"=>1

            ],

            ];
            foreach($datas as $data){
                $new_product= new Product();
                $new_product->product_name = $data["product_name"];
                $new_product->product_categoryId = $data["product_categoryId"];
                $new_product->barcode = $data["barcode"];
                $new_product->product_status = $data["product_status"];
                $new_product->save();
            }
    }
}
