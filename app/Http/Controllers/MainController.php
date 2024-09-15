<?php

namespace App\Http\Controllers;

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
        return view('home');
    }
}
