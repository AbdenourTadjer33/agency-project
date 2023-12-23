<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    public function create() {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'fname' => ['required', 'min:2'],
            'lname' => ['required', 'min:2'],
            'phone' => ['required', 'regex:/^(05|06|07)[0-9]{8}$/'],
            'objet' => ['required'],
            'message' => ['required', 'min:2'],
        ]);

        $userId = null;
        if (Auth::check()) {
            $userId = Auth::user()->uuid;
        }

        Contact::create([
            'user_uuid' => $userId,
            'full_name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'phone' => $request->phone,
            'objet' => $request->objet,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => 'Success',
            'message' => 'Message posté avec succés!'
        ], 200);
    }
}
