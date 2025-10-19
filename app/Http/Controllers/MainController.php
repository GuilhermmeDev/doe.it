<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

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

    public function terms()
    {
        $filename = 'termos_de_uso_e_privacidade.pdf';
        $path = 'terms/'.$filename;

        $disk = Storage::disk('public');

        if (! $disk->exists($path)) {
            abort(404, 'O arquivo não existe ou não foi encontrado.');
        }

        $filePath = $disk->path($path);

        $fileContents = file_get_contents($filePath);

        return new Response($fileContents, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"',
            'Cache-Control' => 'no-cache, must-revalidate',
        ]);
    }
}
