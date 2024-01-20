<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->with(['user:uuid,first_name,last_name', 'faqReponse:id,faq_id,message,created_at'])->get();
        return view('admin.faq.index', [
            'faqs' => $faqs,
        ]);
    }

    public function createFaq(Request $request)
    {
        $request->validate([
            'question' => ['required', 'string'],
            'response' => ['required', 'string']
        ]);

        $faq = Faq::create([
            'user_uuid' => $request->user()->uuid,
            'message' => $request->question,
        ]);

        $faq->faqReponse()->create([
            'admin_id' => $request->user()->uuid,
            'message' => $request->response,
        ]);

        return redirect()->back()->with('status', 'Question et réponse postulé avec succés');
    }

    public function store(Request $request)
    {
        $request->validate([
            'response' => ['required', 'string', 'min:5'],
        ]);
        Faq::where('id', $request->id)->firstOrFail()->faqReponse()->create([
            'admin_id' => $request->user()->uuid,
            'message' => $request->response,
        ]);

        return redirect()->back()->with('status', 'Réponse soumis avec succés');
    }

    public function update(Request $request)
    {
        $request->validate([
            'response' => ['required', 'string', 'min:5'],
        ]);

        Faq::where('id', $request->id)->firstOrFail()->faqReponse()->update([
            'admin_id' => $request->user()->uuid,
            'message' => $request->response,
        ]);

        return redirect()->back()->with('status', 'Réponse edité avec succés');
    }

    public function destroy(Request $request)
    {
        $faq = Faq::where('id', $request->id)->first();
        $faq->delete();
        return redirect()->back()->with('status', 'Resources supprimé avec succés');
    }
}
