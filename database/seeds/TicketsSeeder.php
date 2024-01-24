<?php

use App\Ticket;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            ini_set('memory_limit', -1);
            DB::disableQueryLog();

            factory(Ticket::class, 5)->create([
                'user_id' => 2, 
                'drawing_date' => today()->format('Y-m-d')
            ]);
    
            for ($i=3; $i < 1000000; $i++) { 
                factory(Ticket::class, rand(1, 3))->create([
                    'user_id' => $i
                ]);
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }
}
