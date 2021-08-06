<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
    	DB::statement("TRUNCATE TABLE {$clients} RESTART IDENTITY CASCADE");

        $this->call(ClientSeeder::class);

    }
}
