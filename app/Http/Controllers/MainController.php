<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function welcome() {
        if (auth()->user() == true)
        {
            return MainController::home();
        }

        return view('welcome');
    }


    public function home() {
        $campaigns = Campaign::all();

        return view('home', ['campaigns' => $campaigns]);
    }

    public function info() {
        return view('info');
    }
}
