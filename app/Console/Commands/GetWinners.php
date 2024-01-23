<?php

namespace App\Console\Commands;

use App\Ticket;
use App\Winner;
use Illuminate\Console\Command;

class GetWinners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottery:proceed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tickets_winners = Ticket::whereDate('drawing_date', today()->format('Y-m-d'))
            ->take(rand(1, 20))
            ->get()
            ->unique('user_id')
            ->shuffle();
        
        $award = $this->calculateAwardAmount($tickets_winners->count());
        
        if(isset($award)) {
            $tickets_winners->each(function($ticket) use ($award) {
                $winner = new Winner();
                $winner->drawing_date = $ticket->drawing_date;
                $winner->ticket_id = $ticket->id;
                $winner->amount = $award;
                $winner->save();
            });
        } 

        $numbers = $tickets_winners->mapWithKeys(function ($item, $key) {
            return [$key => $item['number']];
        });
        
        echo json_encode([
            'winners' => $numbers, 
            'total_winners' => $tickets_winners->count()
        ]);
    }

    private function calculateAwardAmount($numWinners) {
        if ($numWinners == 1) {
            return 20000;
        } elseif ($numWinners <= 3) {
            return 5000;
        } elseif ($numWinners <= 5) {
            return 1000;
        } elseif ($numWinners <= 10) {
            return 750;  
        } elseif ($numWinners <= 15) {
            return 600;  
        } elseif ($numWinners <= 20) {
            return 500;
        } else {
            return null;
        }
    }
}
