<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:contact_form,email',
            'message' => 'required|string',
        ], [
            'email.unique' => 'You have already filled this form.',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'You have successfully filled this form.');
    }
}