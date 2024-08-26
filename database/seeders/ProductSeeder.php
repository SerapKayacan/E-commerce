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
                "product_name"=>"İnce Memed",
                'author_id'=>1,
                "product_category_id"=>1,
                "barcode"=>"12Ak34df",
                "product_status"=>1,
                "stock_quantity"=>10,
                "price"=>48.75,
                "product_slug"=>"ince-memed-1",


           ],
            [
                "product_name"=>"Tutunamayanlar",
                'author_id'=>2,
                "product_category_id"=>1,
                "barcode"=>"15afew23",
                "product_status"=>1,
                "stock_quantity"=> 20,
                "price"=>90.3,
                "product_slug"=>"tutunamayanlar-2",



            ],
            [
                "product_name"=>"Kürk Mantolu Madonna",
                'author_id'=>3,
                "product_category_id"=>1,
                "barcode"=>"15s9806t34",
                "product_status"=>1,
                "stock_quantity"=>4,
                "price"=> 9.1,
                "product_slug"=>"kurk-mantolu-madonna-3",



            ],
            [
                "product_name"=>"Fareler ve İnsanlar",
                'author_id'=>4,
                "product_category_id"=>1,
                "barcode"=>"15sasfe9t34",
                "product_status"=>1,
                "stock_quantity"=> 8,
                "price"=>35.75,
                "product_slug"=>"fareler-ve-insanlar-4",



            ],
            [
                "product_name"=>"Şeker Portakalı",
                'author_id'=>5,
                "product_category_id"=>1,
                "barcode"=>"16787ujght34",
                "product_status"=>1,
                "stock_quantity"=> 1,
                "price"=>33,
                "product_slug"=>"seker-portakali-5",



            ],
            [
                "product_name"=>"Sen Yola Çık Yol Sana Görünür",
                'author_id'=>6,
                "product_category_id"=>2,
                "barcode"=>"1679ret34",
                "product_status"=>1,
                "stock_quantity"=>7,
                "price"=>28.5,
                "product_slug"=>"sen-yola-cik-yol-sana-gorunur-6",



            ],
            [
                "product_name"=>"Kara Delikler",
                'author_id'=>7,
                "product_category_id"=>3,
                "barcode"=>"1547ret34",
                "product_status"=>1,
                "stock_quantity"=>2,
                "price"=> 39,
                "product_slug"=>"kara-delikler-7",



            ],
            [
                "product_name"=>"Allah De Ötesini Bırak",
                'author_id'=>8,
                "product_category_id"=>4,
                "barcode"=>"234eret34",
                "product_status"=>1,
                "stock_quantity"=>18,
                "price"=>39.6,
                "product_slug"=>"allah-de-otesini-birak-8",



            ],
            [
                "product_name"=>"Aşk 5 Vakittir",
                'author_id'=>9,
                "product_category_id"=>4,
                "barcode"=>"7876tıret34",
                "product_status"=>1,
                "stock_quantity"=> 9,
                "price"=> 42,
                "product_slug"=>"ask-5-vakittir-9",



            ],
            [
                "product_name"=>"Benim Zürafam Uçabilir",
                'author_id'=>10,
                "product_category_id"=>5,
                "barcode"=>"1sfcs56t54",
                "product_status"=>1,
                "stock_quantity"=>12,
                "price"=>27.3,
                "product_slug"=>"benim-zurafam-ucabilir-10",

            ],
            [
                "product_name"=>"Kuyucaklı Yusuf",
                'author_id'=>3,
                "product_category_id"=>1,
                "barcode"=>"154yg456t54",
                "product_status"=>1,
                "stock_quantity"=> 2,
                "price"=> 10.4,
                "product_slug"=>"kuyucakli-yusuf-11",

            ],
            [
                "product_name"=>"Kamyon - Seçme Öyküler",
                'author_id'=>3,
                "product_category_id"=>6,
                "barcode"=>"wegsvre6t54",
                "product_status"=>1,
                "stock_quantity"=> 9,
                "price"=> 9.75,
                "product_slug"=>"kamyon-secme-oykuler-12",

            ],
            [
                "product_name"=>"Kendime Düşünceler",
                'author_id'=>11,
                "product_category_id"=>7,
                "barcode"=>"wtf4w456t54",
                "product_status"=>1,
                "stock_quantity"=> 1,
                "price"=> 14.40,
                "product_slug"=>"kendime-dusunceler-13",

            ],
            [
                "product_name"=>"Denemeler - Hasan Ali Yücel Klasikleri",
                'author_id'=>12,
                "product_category_id"=>7,
                "barcode"=>"156hugbg54",
                "product_status"=>1,
                "stock_quantity"=>  4,
                "price"=> 24,
                "product_slug"=>"denemeler-hasan-ali-yucel-klasikleri-14",

            ],
            [
                "product_name"=>"Animal Farm",
                'author_id'=>13,
                "product_category_id"=>1,
                "barcode"=>"sdvcdw456t54",
                "product_status"=>1,
                "stock_quantity"=> 1,
                "price"=>  17.50,
                "product_slug"=>"animal-farm-15",

            ],
            [
                "product_name"=>"Dokuzuncu Hariciye Koğuşu",
                'author_id'=>14,
                "product_category_id"=>1,
                "barcode"=>"dfbgpş6t54",
                "product_status"=>0,
                "stock_quantity"=>  0,
                "price"=> 18.5,
                "product_slug"=>"dokuzuncu-hariciye-kogusu-16",

            ],









            ];
            foreach($datas as $data){
                $new_product= new Product();
                $new_product->product_name = $data["product_name"];
                $new_product->author_id= $data["author_id"];
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
