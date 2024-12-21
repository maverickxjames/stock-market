<?php

namespace App\Http\Controllers;
use App\Providers\Helper;
use Illuminate\Http\Request;
use App\Models\watchlist;
use Illuminate\Support\Facades\Auth;


class ScriptController extends Controller
{
    public function future(){
    $user = Auth::user();
    $apidata = Helper::allCompanyData($user->id);
    event(new \App\Events\Watchlist($apidata));

    }

    public function test(){
        
        while(true){
            $apidata = Helper::fluctuateNumber('24775');

            event(new \App\Events\Watchlist($apidata));
            sleep(1);
        }

    }
}
