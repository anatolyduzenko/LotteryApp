<?php

namespace App\Http\Controllers;

use App\Winner;
use Illuminate\Http\Request;

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
        return view('admin.winners', ['winners' => $winners]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
