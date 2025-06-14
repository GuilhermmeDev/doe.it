<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash; // Adicione esta linha para usar Hash::check

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {

        $request->validateWithBag('userDeletion', [
            'password_confirmation' => ['required', 'string'],
        ]);

        $user = $request->user();

        if (! Hash::check($request->password_confirmation, $user->password)) {
            return Redirect::back()->withErrors(['password_confirmation' => 'A senha fornecida está incorreta.'], 'userDeletion');
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Sua conta foi excluída com sucesso.');
    }

    public function registerCpf(Request $request) {
        $user = User::where('id', auth()->user()->id)->first();

        if (strlen($request->cpf) === 14) {
            $user->CPF = $request->cpf;

            $user->save();

            return redirect()->back();
        }

        return redirect()->back()->withErrors(['cpf' => 'Digite um CPF válido.']);
    }
}