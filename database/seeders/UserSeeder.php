<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas=[
            [
                "name"=>"Serap Kayacan",
                "email"=>"kayacan@gmail.com",
                "password"=>"1234",
                "slug"=>"serap-kayacan-1"


            ],
            [
                "name"=>"Ahmet Yılmaz",
                "email"=>"ahmet@gmail.com",
                "password"=>"12345",
                 "slug"=>"ahmet-yilmaz-2"


            ],
            [
                "name"=>"Bahar Özçelik",
                "email"=>"bahar@gmail.com",
                "password"=>"234345fds",
                 "slug"=>"	bahar-ozcelik-3"


            ],
            [
                "name"=>"Aynur Deniz",
                "email"=>"aynur55@gmail.com",
                "password"=>"5643gv",
                 "slug"=>"aynur-deniz-4"


            ],
            [
                "name"=>"Deniz Aslan",
                "email"=>"deniz11@gmail.com",
                "password"=>"wedr3r241",
                "slug"=>"deniz-aslan-5"


            ],
            [
                "name"=>"Ayça Şimşek",
                "email"=>"ayca22@gmail.com",
                "password"=>"234r32cxr",
                 "slug"=>"ayca-simsek-6"


            ]
        ];

        foreach($datas as $data){
            $new_user= new User();
            $new_user->name = $data["name"];
            $new_user->email= $data["email"];
            $new_user->password=$data["password"];
            $new_user->slug= $data["slug"];
            $new_user->save();
        }
    }
}
