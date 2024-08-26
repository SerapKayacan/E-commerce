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

                'author_type'=>"Local",
                "author_name"=>"Yaşar Kemal",
            ],
            [

                'author_type'=>"Local",
                "author_name"=>"Oğuz Atay",
            ],
            [

                'author_type'=>"Local",
                "author_name"=>"Sabahattin Ali ",
            ],
            [

                'author_type'=>"Foreign",
                "author_name"=>"John Steinback",
            ],
            [

                'author_type'=>"Foreign",
                "author_name"=>"Jose Mauro De Vasconcelos",
            ],
            [

                'author_type'=>"Local",
                "author_name"=>"Hakan Mengüç",
            ],
            [

                'author_type'=>"Foreign",
                "author_name"=>"Stephen Hawking",
            ],
            [

                'author_type'=>"Local",
                "author_name"=>"Uğur Koşar",
            ],
            [

                'author_type'=>"Local",
                "author_name"=>"Mehmet Yıldız",
            ],
            [

                'author_type'=>"Local",
                "author_name"=>"Mert Arık",
            ],
            [

                'author_type'=>"Foreign",
                "author_name"=>"Marcus Aurelius",
            ],
            [

                'author_type'=>"Foreign",
                "author_name"=>"Michel de Montaigne",
            ],

            [

                'author_type'=>"Foreign",
                "author_name"=>"George Orwell",
            ],
            [

                'author_type'=>"Local",
                "author_name"=>"Peyami Safa",
            ],











        ];
        foreach($datas as $data){
            $new_author= new Author();
            $new_author->author_type = $data["author_type"];
            $new_author->author_name = $data["author_name"];
            $new_author->save();
        }
    }
}
