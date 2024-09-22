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
        $search = request('q');
        if ($search)
        {
            $campaigns = Campaign::where([['Title', 'like', '%' . $search . '%']])->get();
        } else {
            $campaigns = Campaign::all();
        }

        return view('home', compact('campaigns', 'search'));
    }

    public function info() {
        return view('info');
    }
}
