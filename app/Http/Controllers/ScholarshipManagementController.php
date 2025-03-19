<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ScholarshipManagement;


class ScholarshipManagementController extends Controller
{
    /**
     * Display a listing of scholarships.
     */
    public function index(Request $request)
    {
        $data = ScholarshipManagement::orderBy('id', 'asc')->get();

        $selectedScholarship = null;
    
        // Check if there's a selected ID
        if ($request->has('id')) {
            $selectedScholarship = ScholarshipManagement::find($request->id);
        }
    
        return view('scholarship.index', [
            'data' => $data,
            'selectedScholarship' => $selectedScholarship,
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'startdate' => 'required|date',
        'enddate' => 'required|date',
        'maxage' => 'required|integer|min:0',
        'status' => 'required|in:0,1',
    ]);

    $scholarship = ScholarshipManagement::findOrFail($id);
    $scholarship->name = $request->name;
    $scholarship->startdate = $request->startdate;
    $scholarship->enddate = $request->enddate;
    $scholarship->maxage = $request->maxage;
    $scholarship->status = $request->status;

    // Update radio button fields
    $fields = ['internalflag', 'personal', 'parentdetails', 'academics', 'spm', 'skills', 'experience', 'study', 'document', 'declaration', 'consent'];
    foreach ($fields as $field) {
        $scholarship->$field = $request->$field;
    }

    $scholarship->save();

    return redirect()->route('scholarship.index', ['id' => $id])->with('success', 'Scholarship updated successfully.');
}

    


    
}
