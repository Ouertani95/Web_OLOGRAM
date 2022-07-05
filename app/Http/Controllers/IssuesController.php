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
        $sender_email = $request->input('email');
        $issue_title = $request->input('title');
        $issue_description = $request->input('description');

        Issue::create([
            'email' => $sender_email,
            'title' => $issue_title,
            'description' => $issue_description
        ]);

        Mail::to("ouertani2006@gmail.com")
            ->send(new SendIssue($sender_email,$issue_title,$issue_description));

        return back()->with(['success' => "The issue has been successfully submitted.<br> We will address it as soon as possible.<br> Thank you for helping improve Web-OLOGRAM ! "]);

    }
}
