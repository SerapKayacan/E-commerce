<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas=[
            [
                "category_name"=>"fashion",
                "category_description"=>"fashion",
                "category_status"=>"0"

            ],

            [
                "category_name"=>"makeup",
                "category_description"=>"fashion",
                "category_status"=>"1"

            ],

            ];
            foreach($datas as $data){
                $new_category= new Category();
                $new_category->category_name = $data["category_name"];
                $new_category->category_description = $data["category_description"];
                $new_category->category_status = $data["category_status"];
                $new_category->save();
            }
    }
}
