<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    // function to view dashboard with all the contacts
    public function index()
    {
        $contacts = auth()->user()->contacts()->get();
        return view('dashboard', compact('contacts'));
    }

    // function to view the create contact form
    public function create()
    {
        return view('contacts.create');
    }


    // function to store the new contact into the db
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:contacts',
            'contact_number' => 'required',
            'address' => 'nullable',
            'notes' => 'nullable',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // store avatar in the 'public' directory inside the 'storage/app' directory
            // also linked into the public/storage
            $path = $request->file('avatar')->store('public');
            $validatedData['avatar'] = $path;
        }

        auth()->user()->contacts()->create($validatedData);
        return redirect()->route('contacts.index')->with('success', 'Contact has been created successfully.');
    }

    // function to view selected contact
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    // function to view the edit contact form
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    // function to update the selected contact
    public function update(Request $request, Contact $contact)
    {
        $contact = auth()->user()->contacts()->findOrFail($contact);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
            'contact_number' => 'required',
            'address' => 'nullable',
            'notes' => 'nullable',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // delete the old avatar if it exists
            if ($contact->avatar) {
                Storage::delete($contact->avatar);
            }
            // store the new avatar in the 'public' directory inside the 'storage/app' directory
            // also linked into the public/storage
            $path = $request->file('avatar')->store('public');
            $validatedData['avatar'] = $path;
        }

        $contact->update($validatedData);
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    // function to view the trashed contacts
    public function trashed()
    {
        $contacts = Contact::onlyTrashed()->get();
        return view('contacts.trashed', compact('contacts'));
    }

    // function to restore selected contact from trash contacts
    public function restore($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();
        return redirect()->route('contacts-trashed')->with('success', 'Contact has been restored successfully.');
    }

    // function to soft-delete a contact, moving to trash contacts
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact moved to trash successfully.');
    }

    // function to really delete a selected contact
    public function forceDelete($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();
        return redirect()->route('contacts.trashed')->with('success', 'Contact permanently deleted successfully.');
    }
}
