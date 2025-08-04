<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Article::create([
            "label"=>"Ordinateur Portable",
            "description"=>"Ordinateur pour usage bureautique",
            "price"=>"450000",
            "number"=>"10",
            "minimum_limit"=>"2",
            "maximum_limit"=>"20",

        ]); 
         Article::create([
            "label"=>"Imprimante HP",
            "description"=>"Imprimante multifonction",
            "price"=>"120000",
            "number"=>"5",
            "minimum_limit"=>"1",
            "maximum_limit"=>"10",

        ]); 
        Article::create([
            "label"=>"Souris Sans Fil",
            "description"=>"Souris ergonomique sans fil",
            "price"=>"10000",
            "number"=>"30",
            "minimum_limit"=>"5",
            "maximum_limit"=>"50",

        ]); 
        Article::create([
            "label"=>"PC Laptop",
            "description"=>"Ordinateur portable",
            "price"=>"763484",
            "number"=>"4",
            "minimum_limit"=>"2",
            "maximum_limit"=>"9",

        ]);
        Article::create([
            "label"=>"Ecran",
            "description"=>"ecran",
            "price"=>"250000",
            "number"=>"7",
            "minimum_limit"=>"3",
            "maximum_limit"=>"15",

        ]);
        Article::create([
            "label"=>"Clavier",
            "description"=>"Clavier electroluminescent",
            "price"=>"35000",
            "number"=>"10",
            "minimum_limit"=>"5",
            "maximum_limit"=>"17",

        ]); 
        
         
    }
}
