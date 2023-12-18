<?php

namespace App\Http\Controllers\Auth;

use App\Events\RegistrationEvent;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**ne   
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:64'],
            'lname' => ['required', 'string', 'max:64'],
            'sex' => ['required', 'string', Rule::in(['male', 'female'])],
            'dob' => ['required', 'date'],
            'phone' => ['required', 'string', 'max:10', 'unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:128', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:8', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'sex' => $request->sex,
            'dob' => (new \DateTime($request->dob))->format('Y-m-d'),
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new RegistrationEvent($user));

        Auth::login($user);

        return redirect(route('verification.notice'));
    }
}
