<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255'],
            'subject' => ['nullable','string','max:255'],
            'message' => ['required','string'],
        ]);

        Contact::create([
            ...$data,
            'user_id' => $request->user()?->id,
            'status' => 'new',
        ]);

        return back()->with('success', 'Message sent!');
    }
}