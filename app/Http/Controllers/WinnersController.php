<?php

namespace App\Http\Controllers;

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
        $winners = Winner::with(['ticket' =>
        function($ticket){
            $ticket->with(['user'])->get();
        }])->get();
       
        if(auth()->user()->role == 'admin') {
            return view('admin.winners', ['winners' => $winners]);
        } else {
            return view('member.results', ['winners' => $winners]);
        }
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
