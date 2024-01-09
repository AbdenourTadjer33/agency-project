<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:10', Rule::unique('users')->ignore($request->user()->uuid, 'uuid')],
            'sex' => ['required', Rule::in('female', 'male')],
            'dob' => ['required', 'date'],
            'passport_id' => ['nullable', 'min:14'],
        ]);

        $request->user()->update([
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'sex' => $request->sex,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'passport_id' => $request->passport_id,
        ]);

        return Redirect::route('profile.edit')->with('status', 'Vos information sont mis à jour.');
    }

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

        return Redirect::to('/');
    }
}
