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
                "campaign_id"=>2,
                "cargo_price" => 22,
                "total_price" => 78,
                'discount_price' => 34

            ],
            [
                "order_status" => "Canceled",
                "user_id" => 4,
                "campaign_id"=>1,
                "cargo_price" => 35,
                "total_price" => 89,
                'discount_price' => 12

            ]
            ,
            [
                "order_status" => "Canceled",
                "user_id" => 1,
                "campaign_id"=>3,
                "cargo_price" => 34,
                "total_price" => 80,
                'discount_price' => 56

            ]

        ];
        foreach ($datas as $data) {
            $new_order = new Order();
            $new_order->order_status = $data["order_status"];
            $new_order->user_id = $data["user_id"];
            $new_order->campaign_id = $data["campaign_id"];
            $new_order->cargo_price = $data["cargo_price"];
            $new_order->total_price = $data["total_price"];
            $new_order->discount_price = $data["discount_price"];
            $new_order->save();
        }
    }
}
