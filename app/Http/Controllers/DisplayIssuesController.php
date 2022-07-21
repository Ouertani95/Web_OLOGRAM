<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisplayIssuesController extends Controller
{
    public function DisplayIssues()
    {
        $issues = DB::table('issues')->get()->toArray();
        $issues = json_decode(json_encode($issues), true);
        return view("display-issues")->with(['issues'=>$issues]);
    }
}
