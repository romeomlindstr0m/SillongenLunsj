<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function showLoginForm(): View
    {
        return view('login');
    }

    public function showRegisterForm(): View
    {
        return view('register');
    }

    public function login(Request $request): RedirectResponse
    {
        $authentication_details = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($authentication_details)) {
            $request->session()->regenerate();
            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'De oppgitte legitimasjonene samsvarer ikke med våre oppføringer.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Du har logget ut.');
    }

    public function register(Request $request): RedirectResponse
    {
        $rules = [
            'email' => ['required', 'max:255', 'unique:users,email', 'email:rfc'],
            'first_name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'password' => ['required', 'confirmed', Password::min(6)->letters()->uncompromised()],
            'password_confirmation' => ['required'],
        ];

        $messages = [
            'required' => 'Vennligst fyll ut alle feltene.',
        
            'email.max' => 'E-postadressen kan ikke være lengre enn 255 tegn.',
            'email.unique' => 'E-postadressen er allerede registrert.',
            'email.email' => 'E-postadressen må være en gyldig e-postadresse.',

            'first_name.max' => 'Fornavnet kan ikke være lengre enn 255 tegn.',
            'first_name.string' => 'Fornavnet må være en gyldig tekststreng.',

            'last_name.max' => 'Etternavnet kan ikke være lengre enn 255 tegn.',
            'last_name.string' => 'Etternavnet må være en gyldig tekststreng.',
        
            'password.confirmed' => 'Passordene samsvarer ikke.',
            'password.min' => 'Passordet må være minst 6 tegn langt.',
            'password.letters' => 'Passordet må inneholde minst én bokstav.',
            'password.uncompromised' => 'Passordet er funnet i en datalekkasje og er ikke sikkert. Velg et annet passord.',
        ];

        $validator = Validator::make($request->only(['email', 'first_name', 'last_name', 'password', 'password_confirmation']), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = new User;
        
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);
        $user->role_id = 2;

        $user->save();

        return redirect()->route('login')->with('status', 'Du kan nå logge inn med din nye konto.');
    }
}
