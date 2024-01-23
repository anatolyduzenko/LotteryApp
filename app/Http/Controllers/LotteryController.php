<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LotteryController extends Controller
{
    switch(auth()->user()->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
            break;

        case 'member':
            return redirect()->route('member.lottery');
            break;

        default:
            return redirect()->route('login');
            break;
    }
}
