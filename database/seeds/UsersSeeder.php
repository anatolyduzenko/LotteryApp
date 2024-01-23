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

        DB::table('users')->insert([
            'name' => 'Dr. Cyrus Streich',
            'id' => 2,
            'email' => 'hblock@example.net',
            'role' => 'member',
            'password' => bcrypt('password'),
        ]);

        for ($i=0; $i < 1000; $i++) { 
            factory(App\User::class, 1000)->create()->each(function ($user) {
                $user->tickets()
                    ->saveMany(
                        factory(App\Ticket::class, rand(1, 10))
                        ->make()
                    );
            });
        }
    }
}
