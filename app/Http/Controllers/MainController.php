<?php

namespace App\Http\Controllers;

use App\Models\Campaign;

class MainController extends Controller
{
    public function welcome()
    {
        if (auth()->check() && auth()->user()->hasVerifiedEmail()) {
            return redirect('/home');
        }

        return view('welcome');
    }

    public function home()
    {
        $search = request('q');

        $query = Campaign::orderBy('created_at', 'desc');

        if ($search) {
            $query->where('Title', 'like', '%'.$search.'%');
        }

        $campaigns = $query->get();

        return view('home', compact('campaigns', 'search'));
    }
}
