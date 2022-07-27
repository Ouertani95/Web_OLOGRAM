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
        // Get contact form data
        $sender_email = $request->input('email');
        $contact_subject = $request->input('subject');
        $contact_message = $request->input('message');

        // Save contact form data to database using Contact model
        Contact::create([
            'email' => $sender_email,
            'subject' => $contact_subject,
            'message' => $contact_message
        ]);

        // Send contact email to Admin
        Mail::to("ouertani2006@gmail.com")
            ->send(new SendContact($sender_email,$contact_subject,$contact_message));

        // Return success message to contact page
        return back()->with(['success' => "The message has been successfully transmitted.<br> We will get back to you as soon as possible.<br> Thank you ! "]);

    }
}
