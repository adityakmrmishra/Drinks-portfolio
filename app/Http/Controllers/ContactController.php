<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use Exception;

class ContactController extends Controller
{
    /**
     * Display the contact form.
     */
    public function index(Request $request)
    {
        // Get pre-filled values from query parameters (if coming from product page)
        $prefill = [
            'subject' => $request->query('subject', ''),
            'message' => $request->query('message', '')
        ];
        
        return view('contact.index', compact('prefill'));
    }

    /**
     * Process the contact form submission.
     */
    public function store(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Save to database
            Contact::create($validated);
            
            // In a real application, you would likely send an email here
            // Mail::to('info@example.com')->send(new ContactFormMail($validated));

            return back()->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
