<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function markSeen(Request $request, Contact $contact)
    {
        $before = $contact->toArray();

        $contact->update(['status' => 'seen']);

        AdminActivityLog::create([
            'admin_user_id' => $request->user()->id,
            'entity_type' => 'Contact',
            'entity_id' => $contact->id,
            'action' => 'mark_seen',
            'before' => $before,
            'after' => $contact->fresh()->toArray(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return back()->with('success', 'Contact marked as seen.');
    }
}