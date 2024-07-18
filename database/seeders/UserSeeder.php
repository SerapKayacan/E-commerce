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
                "name"=>"serap",
                "email"=>"kayacan@gmail.com",
                "password"=>"1234",


            ],
            [
                "name"=>"serap1",
                "email"=>"kayacan1@gmail.com",
                "password"=>"sdadfasdfda",


            ],
            [
                "name"=>"serap2",
                "email"=>"kayacan2@gmail.com",
                "password"=>"sdadfasdfda",


            ],
            [
                "name"=>"serap33",
                "email"=>"kayacan33@gmail.com",
                "password"=>"sdadfasdfda",


            ],
            [
                "name"=>"serap11",
                "email"=>"kayacan11@gmail.com",
                "password"=>"sdadfasdfda",


            ],
            [
                "name"=>"serap22",
                "email"=>"kayacan22@gmail.com",
                "password"=>"sdadfasdfda",


            ]
        ];

        foreach($datas as $data){
            $new_user= new User();
            $new_user->name = $data["name"];
            $new_user->email= $data["email"];
            $new_user->password=$data["password"];
            $new_user->save();
        }
    }
}
