<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Winner;
use Illuminate\Http\Request;
use Symfony\Component\Console\Output\StreamOutput;

class WinnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $winners = Winner::with([
            'ticket' =>
                function($ticket){
                    $ticket->with(['user'])->get();
                }
            ])->get();
    
        if(auth()->user()->role == 'admin') {
            return view('admin.winners', ['winners' => $winners]);
        } else {
            return view('member.results', ['winners' => $winners]);
        }
    }

    /**
     * Get winners list.
     *
     * @return \Illuminate\Http\Response
     */
    public function winners()
    {
        $winners = Winner::where([
                'drawing_date' => today()->format('Y-m-d')
            ])
            ->with([
                'ticket' =>
                    function($ticket){
                        $ticket->with(['user'])->get();
                    }
            ])
            ->latest()
            ->limit(15)
            ->get();
        
        $tickets = Ticket::where('user_id', auth()->user()->id)
            ->where('drawing_date', today()->format('Y-m-d'))
            ->whereIn(
                'id',
                $winners->pluck('ticket_id')
                ->toArray()
            )
            ->get();

        $is_winner = count($tickets) ? true : false;
        $is_looser = count($tickets) ? false : true;
        
        return view('member.results', [
            'winners' => $winners,
            'is_looser' => $is_looser,
            'is_winner' => $is_winner
        ]);    
    }

    /**
     * Launch Fortune wheel.
     *
     * @return \Illuminate\Http\Response
     */
    public function getwinners()
    {
        \ob_start();
        $stream = fopen("php://output", "w");
        \Artisan::call('lottery:proceed', [],  new StreamOutput($stream));
        $output = \ob_get_clean();
        return response()->json($output);
    }

}
