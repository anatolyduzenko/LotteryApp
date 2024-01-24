<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        DB::disableQueryLog();
        $this->call([
            UsersSeeder::class,
            TicketsSeeder::class
        ]);
    }
}
