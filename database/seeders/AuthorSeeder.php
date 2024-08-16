<?php

namespace Database\Seeders;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas=[
            [

                'author_type'=>1,
                "author_name"=>"Yaşar Kemal",
            ],
            [

                'author_type'=>0,
                "author_name"=>"Oğuz Atay",
            ],
            [

                'author_type'=>1,
                "author_name"=>"Sabahattin Ali ",
            ]
        ];
        foreach($datas as $data){
            $new_author= new Author();
            $new_author->author_type = $data["author_type"];
            $new_author->author_name = $data["author_name"];
            $new_author->save();
        }
    }
}
