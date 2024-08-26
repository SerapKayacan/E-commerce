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
                "category_name"=>"Roman",
                "category_description"=>"Roman Kitapları.",
                "category_status"=>"1",
                "category_slug"=>"roman"


            ],

            [
                "category_name"=>"Kişisel Gelişim",
                "category_description"=>"Kişisel Gelişim Kitapları.",
                "category_status"=>"1",
                "category_slug"=>"kisisel-gelisim"


            ],
            [
                "category_name"=>"Bilim",
                "category_description"=>"Bilim Kitapları. ",
                "category_status"=>"1",
                "category_slug"=>"bilim"


            ],
            [
                "category_name"=>"Din Tasavvuf",
                "category_description"=>"Din Tasavvuf Kitapları",
                "category_status"=>"1",
                "category_slug"=>"din-tasavvuf"


            ],
            [
                "category_name"=>"Çocuk ve Gençlik",
                "category_description"=>"Çocuk ve Gençlik Kitapları",
                "category_status"=>"1",
                "category_slug"=>"cocuk-ve-genclik"


            ],
            [
                "category_name"=>"Öykü",
                "category_description"=>"Öykü Kitapları",
                "category_status"=>"1",
                "category_slug"=>"oyku"


            ],
            [
                "category_name"=>"Felsefe",
                "category_description"=>"Felsefe Kitapları",
                "category_status"=>"1",
                "category_slug"=>"felsefe"


            ]


            ];
            foreach($datas as $data){
                $new_category= new Category();
                $new_category->category_name = $data["category_name"];
                $new_category->category_description = $data["category_description"];
                $new_category->category_status = $data["category_status"];
                $new_category->category_slug = $data["category_slug"];
                $new_category->save();
            }
    }
}
