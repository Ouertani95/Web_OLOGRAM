<?php

namespace App\Http\Controllers;

use App\Mail\SendIssue;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IssuesController extends Controller
{
    public function sendIssue(Request $request)
    {   
        // Get issue form data
        $sender_email = $request->input('email');
        $issue_title = $request->input('title');
        $issue_description = $request->input('description');

        // Save issue form data to database using Issue model 
        Issue::create([
            'email' => $sender_email,
            'title' => $issue_title,
            'description' => $issue_description
        ]);

        // Send issue email to Admin
        Mail::to("ouertani2006@gmail.com")
            ->send(new SendIssue($sender_email,$issue_title,$issue_description));

        // Return success message to issue page
        return back()->with(['success' => "The issue has been successfully submitted.<br> We will address it as soon as possible.<br> Thank you for helping improve Web-OLOGRAM ! "]);

    }
}
