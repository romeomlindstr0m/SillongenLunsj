<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    public function create(): View
    {
        $roles = Role::all();
        return view('users.create')->with('roles', $roles);
    }

    public function destroy($id): RedirectResponse
    {
        $target_user = User::findOrFail($id);
        $target_user->delete();

        return back()->with('session', 'Brukeren ble fjernet.');
    }

    public function edit($id): View
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit')->with(['user' => $user, 'roles' => $roles]);
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            'email' => ['required', 'max:255', 'unique:users,email', 'email:rfc'],
            'first_name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'role_id' => ['required', 'numeric', 'exists:roles,id'],
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

            'role_id.numeric' => 'Rollen må være en gyldig numerisk verdi.',
            'role_id.exists' => 'Den valgte rollen eksisterer ikke.',
        
            'password.confirmed' => 'Passordene samsvarer ikke.',
            'password.min' => 'Passordet må være minst 6 tegn langt.',
            'password.letters' => 'Passordet må inneholde minst én bokstav.',
            'password.uncompromised' => 'Passordet er funnet i en datalekkasje og er ikke sikkert. Velg et annet passord.',
        ];

        $validator = Validator::make($request->only(['email', 'first_name', 'last_name', 'role_id', 'password', 'password_confirmation']), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $user = new User;
        
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;

        $user->save();

        return back()->with('status', 'En ny konto ble opprettet.');
    }
}
