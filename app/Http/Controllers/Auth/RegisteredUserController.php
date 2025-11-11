<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.max' => 'Le pseudo ne peut pas dépasser 255 caractères',
            'email.lowercase' => 'L\'adresse mail doit être en lettres minuscules',
            'email.email' => 'Le format de l\'adresse email est invalide',
            'email.max' => 'L\'adresse mail ne peut pas dépasser 255 caractères',
            'email.unique' => 'Vous ne pouvez pas utiliser cette adresse mail',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
