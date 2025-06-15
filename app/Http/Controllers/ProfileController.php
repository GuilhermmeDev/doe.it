<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status',
            $user->wasChanged('email')
                ? 'Um e-mail de verificação foi enviado para seu novo endereço.'
                : 'Perfil atualizado com sucesso!');
    }

    /**
     * Send password reset link
     */
    public function sendResetLink(Request $request): RedirectResponse
    {
        // Certifica-se de que o usuário está logado
        if (!Auth::check()) {
            return back()->with([
                'reset_status' => false,
                'reset_message' => 'Você precisa estar logado para redefinir sua senha.'
            ]);
        }

        // Pega o e-mail do usuário autenticado diretamente
        $email = Auth::user()->email;

        // Tenta enviar o link de redefinição
        $status = Password::sendResetLink(
            ['email' => $email] // Passa o e-mail como um array associativo
        );

        // Retorna com a mensagem de status apropriada
        return back()->with([
            'reset_status' => $status === Password::RESET_LINK_SENT,
            'reset_message' => __($status)
        ]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Sua conta foi excluída com sucesso.');
    }

    /**
     * Register/update CPF
     */
    public function registerCpf(Request $request): RedirectResponse
    {
        $request->validate([
            'cpf' => ['required', 'string', 'size:14']
        ]);

        $user = $request->user();
        $user->CPF = $request->cpf;
        $user->save();

        return redirect()->back()->with('status', 'CPF atualizado com sucesso!');
    }
}