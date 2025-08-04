<?php

namespace Database\Seeders;
use App\Models\Client;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { //

        Client::create([
            "last_name"=> "ERIC",
            "first_name"=>"Eric",
            "email"=>"eric34@gmail.com",
            "phone"=>"0022897865643"
        ]);
        Client::create([
            'last_name'=> "KOKOU",
            "first_name"=>"Kwame",
            "email"=>"kwa98@gmail.com",
            "phone"=>"0022896543283"
        ]);
        Client::create([
            'last_name'=> "YOBAN",
            "first_name"=>"Vika",
            "email"=>"yvi5@gmail.com",
            "phone"=>"0022890765445"
        ]);
        //  Client::create([
        //     'last_name'=> "RENE",
        //     "first_name"=>"Ali",
        //     "email"=>"ali@gmail.com",
        //     "phone"=>"0022896547643"
        // ]);
        //  Client::create([
        //     'last_name'=> "IGOR",
        //     "first_name"=>"Hubert",
        //     "email"=>"hubert@gmail.com",
        //     "phone"=>"0022879897654"
        // ]);
        //  Client::create([
        //     'last_name'=> "YAO",
        //     "first_name"=>"John",
        //     "email"=>"john@gmail.com",
        //     "phone"=>"0022890763445"
        // ]);
        
           
    }
}
