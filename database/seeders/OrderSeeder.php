<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = [
            [
                "order_status" =>"Pending",
                "user_id" => 2,
                "cargo_price" => "22",
                "total_price" => "78",
                'date_of_delivery' => "12/04/2024",
                'discount_price' => "34"

            ],
            [
                "order_status" => "Canceled",
                "user_id" => 4,
                "cargo_price" => "35",
                "total_price" => "89",
                'date_of_delivery' => "11/04/2024",
                'discount_price' => "12"

            ]
            ,
            [
                "order_status" => "Canceled",
                "user_id" => 1,
                "cargo_price" => "345",
                "total_price" => "809",
                'date_of_delivery' => "11/04/2024",
                'discount_price' => "56"

            ]

        ];
        foreach ($datas as $data) {
            $new_order = new Order();
            $new_order->order_status = $data["order_status"];
            $new_order->user_id = $data["user_id"];
            $new_order->cargo_price = $data["cargo_price"];
            $new_order->total_price = $data["total_price"];
            $new_order->date_of_delivery = $data["date_of_delivery"];
            $new_order->discount_price = $data["discount_price"];
            $new_order->save();
        }
    }
}
