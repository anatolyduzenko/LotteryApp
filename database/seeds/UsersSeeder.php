<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'id' => 1,
            'email' => 'admin@nfxl.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        factory(App\User::class, 40000)->create()->each(function ($user) {
            $user->tickets()->saveMany(factory(App\Ticket::class, 10)->make());
        });
        
    }
}
