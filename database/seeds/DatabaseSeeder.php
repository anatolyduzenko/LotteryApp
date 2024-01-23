<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', -1);
        $this->call([
            UsersSeeder::class,
            TicketsSeeder::class
        ]);
    }
}
