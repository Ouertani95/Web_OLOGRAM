<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisplayIssuesController extends Controller
{
    public function DisplayIssues()
    {   
        // Get all issues from database
        $issues = DB::table('issues')->get()->toArray();
        // Transform data to array
        $issues = json_decode(json_encode($issues), true);
        // Return the display issues page with table containing the issues recovered from database
        return view("display-issues")->with(['issues'=>$issues]);
    }
}
