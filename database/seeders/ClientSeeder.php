<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;


class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::truncate();

        $client = new Client;
    	$client -> name = "Jesús Rivas";
    	$client -> cc = "1075268384";
    	$client -> save();

    	$client = new Client;
    	$client -> name = "David Rivas";
    	$client -> cc = "1075268954";
    	$client -> save();


    }
}
