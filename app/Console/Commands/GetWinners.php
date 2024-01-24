<?php

namespace App\Console\Commands;

use App\Ticket;
use App\Winner;
use App\Traits\AwardAmountTrait;
use Illuminate\Console\Command;

class GetWinners extends Command
{
    use AwardAmountTrait;
    
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
            ->whereNotIn(
                'id', 
                Winner::whereDate(
                    'drawing_date', 
                    today()->format('Y-m-d')
                )->get(['ticket_id']))
            ->take(rand(1, 20))
            ->get()
            ->unique('user_id')
            ->shuffle();
        
        $award = $this->calculateAwardAmount($tickets_winners->count());
        
        if(isset($award)) {
            $tickets_winners->each(function($ticket) use ($award) {
                $winner = new Winner();
                $winner->drawing_date = $ticket->drawing_date->format('Y-m-d');
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

}
