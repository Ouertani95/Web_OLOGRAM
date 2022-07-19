<?php

namespace App\Http\Controllers;

use App\Mail\SendContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    public function sendContact(Request $request)
    {
        $sender_email = $request->input('email');
        $contact_subject = $request->input('subject');
        $contact_message = $request->input('message');

        Contact::create([
            'email' => $sender_email,
            'subject' => $contact_subject,
            'message' => $contact_message
        ]);

        Mail::to("ouertani2006@gmail.com")
            ->send(new SendContact($sender_email,$contact_subject,$contact_message));

        return back()->with(['success' => "The message has been successfully transmitted.<br> We will get back to you as soon as possible.<br> Thank you ! "]);

    }
}
