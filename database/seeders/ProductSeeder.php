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
                "product_category_id"=>"2",
                "barcode"=>"12",
                "product_status"=>1,
                "stock_quantity"=>"3",
                'price'=>"20 ",
                "product_slug"=>"dcvfd"

            ],
            [
                "product_name"=>"makeup",
                "product_category_id"=>"1",
                "barcode"=>"15",
                "product_status"=>1,
                "stock_quantity"=>"45",
                'price'=>"40 ",
                "product_slug"=>"dcsdetrytj"


            ],

            ];
            foreach($datas as $data){
                $new_product= new Product();
                $new_product->product_name = $data["product_name"];
                $new_product->product_category_id= $data["product_category_id"];
                $new_product->barcode = $data["barcode"];
                $new_product->product_status = $data["product_status"];
                $new_product->stock_quantity = $data["stock_quantity"];
                $new_product->price = $data["price"];
                $new_product->product_slug = $data["product_slug"];
                $new_product->save();
            }
    }
}
