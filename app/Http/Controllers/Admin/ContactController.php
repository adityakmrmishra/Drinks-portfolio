<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ContactController extends Controller
{
    /**
     * Display a listing of contacts.
     */
    public function index()
    {
        // Check if the contacts table exists
        if (!Schema::hasTable('contacts')) {
            return view('admin.contacts.index', [
                'contacts' => collect(),
                'unreadCount' => 0,
                'tableNotExists' => true
            ]);
        }
        
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        $unreadCount = Contact::unread()->count();
        
        return view('admin.contacts.index', compact('contacts', 'unreadCount'));
    }

    /**
     * Show a specific contact.
     */
    public function show(Contact $contact)
    {
        // Mark as read if not already
        if (!$contact->read_at) {
            $contact->read_at = now();
            $contact->save();
        }
        
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Mark a contact as read/unread.
     */
    public function toggleRead(Contact $contact)
    {
        $contact->read_at = $contact->read_at ? null : now();
        $contact->save();
        
        return back()->with('success', 'Contact status updated.');
    }

    /**
     * Delete a contact.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
