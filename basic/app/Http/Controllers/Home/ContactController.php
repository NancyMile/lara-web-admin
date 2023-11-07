<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        return view('frontend.contact');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required|email:rfc,dnsd|unique:contacts',
            'message' => 'required',
        ]);

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Message successfully saved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function contactMessages()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.all_contacts', compact('contacts'));
    }

    public function deleteContact($id)
    {
        Contact::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Contact successfully removed',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
