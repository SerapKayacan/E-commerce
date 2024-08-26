<?php

namespace Database\Seeders;
use App\Models\Campaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $datas=[

            [
                'campaign_name' => 'Buy 2 Pay 1',
                'campaign_status' => "Active",


            ],
            [
                'campaign_name' => 'Local Author Discount',
                'campaign_status' =>"Active",


            ],
            [
                'campaign_name' => 'Percentage Discount',
                'campaign_status' =>"Active",


            ],


            ];
            foreach($datas as $data){
                $new_campaign= new Campaign();
                $new_campaign->campaign_name = $data["campaign_name"];
                $new_campaign->campaign_status = $data["campaign_status"];
                $new_campaign->save();
            }
    }
}
