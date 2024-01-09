<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {
        return view('faq', [
            'faqs' => Faq::orderBy('created_at', 'desc')->with(['user:uuid,first_name,last_name', 'faqReponse:id,faq_id,message,created_at'])->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string'],
            'name' => [Auth::check() ? 'nullable' : 'required'],
        ]);

        if (Auth::check()) {
            $request->user()->faqs()->create([
                'message' => $request->message
            ]);
        } else {
            Faq::create([
                'message' => $request->message,
                'name' => $request->name,
            ]);
        }

        return redirect()->back()->with('status', 'Question posté avec succés');
    }
}
