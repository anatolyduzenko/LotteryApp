<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTicketRequest;
use App\Ticket;
use App\Winner;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TicketsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Kernel $kernel, Schedule $schedule)
    {
        $tasks = collect($schedule->events());

        $matches = $tasks->filter(function ($item) {
            return Str::contains($item->command, 'lottery:proceed');
        });

        $next_draw_time = (count($matches)) ? $matches->first()->nextRunDate()->format('Y-m-d H:i:s') : false; 

        if(auth()->user()->role == 'admin') {
            $tickets = Ticket::paginate(10);
            return view('admin.tickets', [
                'tickets' => $tickets,
                'next_draw_time' => $next_draw_time
            ]);
        } else {
            $tickets = Ticket::where('user_id', auth()->user()->id)
                ->where('drawing_date', '>=', today()->format('Y-m-d'))
                ->whereNotIn(
                    'id',
                    Winner::whereDate(
                        'drawing_date', 
                        today()->format('Y-m-d')
                    )->get(['ticket_id'])
                )
                ->get();
            
            return view('member.lottery', [
                'tickets' => $tickets,
                'next_draw_time' => $next_draw_time
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function placetickets(AddTicketRequest $request)
    {
        $date = $request->input('date');
        $number = sprintf('%07d', $request->input('ticket_number'));
        $request->merge([
            'drawing_date' => $date,
            'number' => $number,
            'user_id' => auth()->user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $validator = FacadesValidator::make($request->all(), [
            'user_id' => 'required',
            'number' => [
                'required',
                Rule::unique('tickets')
                    ->where('user_id', auth()->user()->id)
                    ->where('drawing_date', $date)
            ],
            'drawing_date' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/member/lottery')->withErrors($validator->errors());
        } 
        
        $validated = $validator->valid();

        Ticket::create($validated);

        return redirect('/member/lottery');
    }
   
}
