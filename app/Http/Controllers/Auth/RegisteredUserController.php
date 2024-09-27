<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
            'surname' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'dni' => ['required', 'string', 'max:9'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'role' => ['required', 'string'],
            'company_id' => ['nullable', 'exists:companies,id'],
        ]);

        $userData = [
            'name' => $request->name,
            'surname' => $request->surname,
            'age' => $request->age,  // Include age in user data
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dni' => $request->dni,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'role' => $request->role,
        ];

        if ($request->role === 'creador_eventos') {
            $userData['company_id'] = $request->company_id;
        }

        $user = User::create($userData);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }
}
