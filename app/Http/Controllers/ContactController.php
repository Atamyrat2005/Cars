<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')
            ->get();

        return view('contact.index')
            ->with([
                'contacts' => $contacts,
            ]);
    }


    public function create()
    {
        return view('contact.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'nullable|email|max:50',
            'phone' => 'nullable|integer|between:60000000,65999999',
            'message' => 'required|string|between:5,255',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return to_route('contacts.index')
            ->with([
                'success' => 'Message sent!'
            ]);
    }
}
