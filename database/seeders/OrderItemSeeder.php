<?php

namespace Database\Seeders;


use App\Models\OrderItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                'order_id'=> 3,
                'product_id'=>1,
             'order_quantity'=> 5,
             'order_price'=>34.9




            ],
            [
                'order_id'=> 2,
                'product_id'=>2,
                'order_quantity'=> 3,
                'order_price'=>56.9




            ]

        ];
        foreach ($datas as $data) {
            $new_order_item = new OrderItem();
            $new_order_item->order_id = $data["order_id"];
            $new_order_item->product_id = $data["product_id"];
            $new_order_item->order_price = $data["order_price"];
            $new_order_item->order_quantity = $data["order_quantity"];


            $new_order_item->save();
        }
    }
}
