<?php

use App\User;
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
            'email' => 'hblock@nfxl.com',
            'role' => 'member',
            'password' => bcrypt('password'),
        ]);
        
        for ($i=0; $i < 10; $i++) { 
            factory(App\User::class, 100)->create();
        }
    }
}
