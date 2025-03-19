<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Application;
use Illuminate\Support\Facades\Session;
use App\Models\ScholarshipManagement;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        // Get counts of draft and complete applications
        $counts = DB::table('applications')
            ->selectRaw("
                SUM(CASE WHEN status = 'draft' THEN 1 ELSE 0 END) AS draft_count,
                SUM(CASE WHEN status = 'complete' THEN 1 ELSE 0 END) AS complete_count
            ")
            ->first();
    
        $draftCount = $counts->draft_count;
        $completeCount = $counts->complete_count;

        

        return view('dashboard', [
            'draftCount' => $draftCount,
            'completeCount' => $completeCount,
            'user' => $request->user(),
            'application' => $request->user()->application,
            'documents' => $request->user()->document
        ]);

        $activeScholarship = ScholarshipManagement::where('status',1)->first();

        if ($activeScholarship) {
            Session::put('id',
                $activeScholarship->id
            );
            Session::put('name', $activeScholarship->name);
        }

        return view('dashboard');
    }
}
