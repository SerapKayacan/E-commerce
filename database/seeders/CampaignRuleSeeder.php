<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CampaignRule;
use SebastianBergmann\CodeCoverage\Util\Percentage;

class CampaignRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas=[
            [
                'campaign_id' => 1,
                'campaign_type' => 'buy_2_pay_1',
                'category_id'=>1,
                'author_id' => 3,
                'author_type' => null,
                'discount_type' => 'Free',
                'discount_value' => null,
                'min_total_price' => null,

            ],
            [
                'campaign_id' =>2,
                'campaign_type' => 'author_type_discount ',
                'category_id'=>null,
                'author_id' => null,
                'author_type' => 'Local',
                'discount_type' => 'Percentage ',
                'discount_value' =>  5.00,
                'min_total_price' => null,

            ],
            [
                'campaign_id' => 3,
                'campaign_type' =>  'percentage_discount ',
                'category_id'=>null,
                'author_id' =>null,
                'author_type' => null,
                'discount_type' => 'Percentage',
                'discount_value' => 5.00,
                'min_total_price' => 200,

            ],




            ];
            foreach($datas as $data){
                $new_campaign_rule= new CampaignRule();
                $new_campaign_rule->campaign_id = $data["campaign_id"];
                $new_campaign_rule->author_id = $data["author_id"];
                $new_campaign_rule->author_type = $data["author_type"];
                $new_campaign_rule->campaign_type = $data["campaign_type"];
                $new_campaign_rule->category_id = $data["category_id"];
                $new_campaign_rule->discount_type = $data["discount_type"];
                $new_campaign_rule->discount_value = $data["discount_value"];
                $new_campaign_rule->min_total_price = $data["min_total_price"];
                $new_campaign_rule->save();
            }
    }
}
