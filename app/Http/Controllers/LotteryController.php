<?php

namespace App\Http\Controllers;

use Faker\Provider\Base;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function __invoke()
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
}
