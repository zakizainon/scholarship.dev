<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Application;
use App\Models\Guardian;
use App\Models\AcademicQualification;
use App\Mail\FormCompletionMail;
use Carbon\Carbon;
use App\Models\ScholarshipManagement;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    // public function showForm()
    // {
    //     //$scholarshipName = Session::get('name', 'No Active Scholarship');

    //     return view('apply', compact('scholarshipName'));
    // }

    public function index(Request $request, $step = "personal")
    {
        //Get Active scholaraship
        $scholarship = DB::table('scholarship_management')
            ->select(
                'code',
                'name',
                'startdate',
                'enddate',
                'maxage',
                'status',
                'personal',
                'guardianinfo',
                'academics',
                'spm',
                'skills',
                'experience',
                'study',
                'document',
                'declaration',
                'columncount',
                'consent'
            )
            ->where('status', 1)
            ->first();

            // Debugging: Check if the scholarship is retrieved
            // dd($scholarship);

            if ($scholarship) {
                Session::put('name', $scholarship->name);
                Session::put('scholarshipstartdate', $scholarship->startdate);      // Added by Zaki: 18/03
                Session::put('scholarshipenddate', $scholarship->enddate);          // Added by Zaki: 18/03
                Session::put('tab01', $scholarship->personal);
                Session::put('tab10', $scholarship->guardianinfo);
                Session::put('tab02', $scholarship->academics);
                Session::put('tab03', $scholarship->spm);
                Session::put('tab04', $scholarship->skills);
                Session::put('tab05', $scholarship->experience);
                Session::put('tab06', $scholarship->study);
                Session::put('tab07', $scholarship->document);
                Session::put('tab08', $scholarship->declaration);
                Session::put('tab09', $scholarship->consent);
                Session::put('columncount', $scholarship->columncount);

                // echo "Scholarship Name  : ".(session('name'))."<br />";
                // echo "Personal Tab      : " . (session('tab01')) . "<br />";
                // echo "Parent Details Tab: " . (session('tab10')) . "<br />";
                // echo "Academics Tab     : " . (session('tab02')) . "<br />";
                // echo "SPM Tab           : " . (session('tab03')) . "<br />";
                // echo "Skills Tab        : " . (session('tab04')) . "<br />";
                // exit;

            } else {
                // Remove session if no active scholarship
                Session::forget('name');
            }

            // Dropdown dataset
            // Added by     : Zaki
            // Date         : 21/03/2025
            // Description  : Get the dropdown data from the lookupcode table and populate it in the form.
            
            // State
            $racedd = DB::table('lookupcode')
                        ->where('codegroup', '=', 'RACE')
                        ->orderBy('orderval', 'asc')
                        ->get();

            $statedd = DB::table('lookupcode')
                        ->where('codegroup', '=', 'STATE')
                        ->orderBy('orderval', 'asc')
                        ->get();

            return view('apply.index', [
                'step' => $step,
                'user' => $request->user(),
                'application' => $request->user()->application,
                'academic_qualification' => $request->user()->academic_qualification,
                'guardian' => $request->user()->guardian,
                'documents' => $request->user()->document,
                'statedd' => $statedd,
                'racedd' => $racedd,
            ]);
    }

    // public function showApplicationForm()
    // {
    //     $today = Carbon::today();

    //     // Fetch the active scholarship
    //     $activeScholarship = ScholarshipManagement::where('status', 1)
    //     ->whereDate('startdate', '<=', $today)
    //     ->whereDate('enddate', '>=', $today)
    //     ->first();

    //     // Debugging: Check if the scholarship is retrieved
    //     dd($activeScholarship);

    //     if ($activeScholarship) {
    //         Session::put('name', $activeScholarship->name);
    //         dd(session('name')); // Check if session stores the value
    //     } else {
    //         // Remove session if no active scholarship
    //         Session::forget('name');
    //     }

    //     return view('apply', compact('activeScholarship'));
    // }

    public function print(Request $request){
        return view('apply.print', [
            'user' => $request->user(),
            'application' => $request->user()->application,
            'documents' => $request->user()->document,
        ]);
    }

    public function submission(Request $request){
        

        $data = DB::table('users')
        ->join('applications', 'users.id', '=', 'applications.user_id')
        ->join('guardians', 'users.id', '=', 'guardians.user_id')
        ->join('academic_qualifications', 'user.id', '=', 'academic_qualifications.user_id')
        ->where('users.role', '=', 'applicant') // Filter only applicants
        ->select(
            'users.name', 
            'users.mykad', 
            'users.email', 
            'applications.updated_at', 
            'applications.age', 
            'applications.race', 
            'applications.other_race',
            'applications.nationality', 
            'applications.birthstate', 
            'applications.other_birthstate', 
            'applications.gender', 
            'applications.maritalstatus',
            'applications.housephone',  
            'applications.mobilephone', 
            'applications.permanentaddress',
            'applications.permanentpostcode',  
            'applications.permanentcity', 
            'applications.permanentstate',
            'applications.other_permanentstate',
            'applications.permanentcountry', 
            'applications.emergencyphone', 
            'applications.emergencyname', 
            'applications.relationship',
            'applications.other_relationship', //new additional field
            'applications.emergencyaddress', 
            'applications.emergencypostcode', 
            'applications.emergencycity', 
            'applications.emergencystate',
            'applications.other_emergencystate',
            'applications.emergencycountry',
            'applications.parentname', //new additional field
            'applications.parentrelationship', //new additional field
            'applications.parentoccupation', //new additional field
            'applications.parentphone', //new additional field
            'applications.parentaddress', //new additional field
            'applications.parentstaffid', //new additional field
            'applications.studylevel', //new additional field
            'applications.coursename', 
            'applications.universityname', 
            'applications.universitycountry',
            'applications.commencementyear',
            'applications.completionyear',
            'applications.result',
            'applications.resultother',//new additional field
            'applications.studyextension',//new additional field
            'applications.reasonextension',//new additional field
            'applications.spmresults', //new additional field
            'applications.spmyear', //new additional field
            'applications.personalstatement', 
            'applications.skillsandextracurricular',
            'applications.activityextra',//new additional field
            'applications.employmentstatus', 
            'applications.employername', 
            'applications.employeraddress', 
            'applications.officephone', 
            'applications.position', 
            'applications.salary',
            'applications.appliedlevelstudy',//new additional field
            'applications.majorstudy', //new additional field
            'applications.appliedcoursetitle', 
            'applications.university',
            'applications.studymode', 
            'applications.startdate', 
            'applications.enddate', 
            'applications.studyperiod', 
            'applications.researchproposalsummary',
            'applications.cgpasemresult',
            'applications.othersemresult', 
            'applications.status', 
            'applications.user_id',
            'applications.declaration01',
            'applications.declaration02',
            'applications.declaration03',
            'applications.declaration04',
            'applications.declaration05',
            'applications.declaration06',
            'applications.declaration07',
            'applications.declaration08',
            'applications.declaration09',
            'applications.consent01',
            'applications.consent02',
            'applications.consent03',
            'guardians.guardian_name',
            'academic_qualifications.spm_school',
            'academic_qualifications.spm_commencement_year',
            'academic_qualifications.spm_completion_year',
            'academic_qualifications.spm_result',
        )
        // ->where('users.role', '=', 'applicant') // Add this line to filter by role
        ->get()
        ->map(function ($item) {
            // Transform fields with code mappings
            $item->race = match ($item->race) {
                "B01"       => "Malay",
                "B02"       => "Chinese",
                "B03"       => "Indian",
                "B04"       => "Bumiputera Sabah",
                "B05"       => "Bumiputera Sarawak",
                "others"    => $item->other_race ?? "Others",
                default     => "NA",
            };

            // $item->studylevel = match ($item->studylevel) {
            //     "Degree"    => "Bachelor degree ",
            //     "Master"    => "Master",
            //     "PhD"       => "PhD",
            //     default     => "NA",
            // };
            $item->studylevel = match ($item->studylevel ?? '') { // Use empty string as fallback
                "Degree"    => "Bachelor degree",
                "Master"    => "Master",
                "PHD"       => "PhD",
                default     => $item->studylevel ?? "NA", // Preserve original value if not NULL
            };


            $item->studyextension = match ($item->studyextension) {
                "Yes"       => "Yes",
                "No"        => "No",
                 default     => $item->studyextension ?? "NA", 
            };
            
            $item->nationality = match ($item->nationality) {
                "01" => "Malaysian",
                "02" => "Non-Malaysian",
                default => "NA",
            };

            $item->birthstate = match ($item->birthstate) {
                "MYS01" => "Johor",
                "MYS02" => "Kedah",
                "MYS03" => "Kelantan",
                "MYS04" => "Malacca",
                "MYS05" => "Negeri Sembilan",
                "MYS06" => "Pahang",
                "MYS07" => "Penang",
                "MYS08" => "Perak",
                "MYS09" => "Perlis",
                "MYS10" => "Sabah",
                "MYS11" => "Sarawak",
                "MYS12" => "Selangor",
                "MYS13" => "Terengganu",
                "MYS14" => "Wilayah Persekutuan Labuan",
                "MYS15" => "Wilayah Persekutuan Kuala Lumpur",
                "MYS16" => "Wilayah Persekutuan Putrajaya",
                "others" => $item->other_birthState ?? "Others",
                default => "NA",
            };

            $item->gender = match ($item->gender) {
                "M" => "Male",
                "F" => "Female",
                default => "NA",
            };

            $item->maritalstatus = match ($item->maritalstatus) {
                "MS01" => "Single",
                "MS02" => "Married",
                "MS03" => "Divorced",
                "MS04" => "Widowed",
                default => "NA",
            };

            $item->permanentstate = match ($item->permanentstate){
                "MYS01" => "Johor",
                "MYS02" => "Kedah",
                "MYS03" => "Kelantan",
                "MYS04" => "Malacca",
                "MYS05" => "Negeri Sembilan",
                "MYS06" => "Pahang",
                "MYS07" => "Penang",
                "MYS08" => "Perak",
                "MYS09" => "Perlis",
                "MYS10" => "Sabah",
                "MYS11" => "Sarawak",
                "MYS12" => "Selangor",
                "MYS13" => "Terengganu",
                "MYS14" => "Wilayah Persekutuan Labuan",
                "MYS15" => "Wilayah Persekutuan Kuala Lumpur",
                "MYS16" => "Wilayah Persekutuan Putrajaya",
                "others" => $item->other_permanentstate ?? "Others",
                default => "NA",
            }; 

            $item->relationship = match ($item->relationship) {
                "R01" => "Spouse",
                "R02" => "Sibling",
                "R03" => "Parent",
                "R04" => "Grandparent",
                "others"    => $item->other_relationship ?? "Others",
                default => "NA",
            };

            $item->emergencystate = match ($item->emergencystate){
                "MYS01" => "Johor",
                "MYS02" => "Kedah",
                "MYS03" => "Kelantan",
                "MYS04" => "Malacca",
                "MYS05" => "Negeri Sembilan",
                "MYS06" => "Pahang",
                "MYS07" => "Penang",
                "MYS08" => "Perak",
                "MYS09" => "Perlis",
                "MYS10" => "Sabah",
                "MYS11" => "Sarawak",
                "MYS12" => "Selangor",
                "MYS13" => "Terengganu",
                "MYS14" => "Wilayah Persekutuan Labuan",
                "MYS15" => "Wilayah Persekutuan Kuala Lumpur",
                "MYS16" => "Wilayah Persekutuan Putrajaya",
                "others" => $item->other_emergencystate ?? "Others",
                default => "NA",
            }; // Same codes as birthState

            $item->employmentstatus = match ($item->employmentstatus) {
                "E" => "Employed",
                "S" => "Self-Employed",
                "U" => "Unemployed",
                default => "NA",
            };

            // $item->employertype = match ($item->employertype) {
            //     "ET01"  => "Public sector",
            //     "ET02"  => "Private sector",
            //     "ET03"  => "Self employed",
            //     default => "NA",
            // };

            $item->appliedlevelstudy = match ($item->appliedlevelstudy) {
                "Mast"  => "Master",
                "PhD"   => "PhD",
                 default     => $item->appliedlevelstudy ?? "NA", 
            };

            $item->majorstudy = match ($item->majorstudy) {
                "Acc"   => "Accountancy",
                "ActS"  => "Actuarial Science",
                "Arch"  => "Architecture",
                "Art"   => "Arts",
                "Bness" => "Business",
                "Comm"  => "Communication",
                "Const" => "Construction, Property & Real Estate",
                "Eco"   => "Economics",
                "Eng"   => "Engineering",
                "Finc"  => "Finance",
                "HR"    => "Human Resources",
                "IT"    => "Information Technology",
                "Law"   => "Law",
                "Mgt"   => "Management",
                "Mkt"   => "Marketing",
                "Math"  => "Mathematics",
                "Psyc"  => "Psychology",
                "SocS"  => "Social Science",
                "Sce"   => "Science",
                 default     => $item->majorstudy ?? "NA", 
            };

            $item->university = match ($item->university) {
                "U01" => "Oxford University, UK",
                "U02" => "University of Cambridge, UK",
                "U03" => "Imperial College London, UK",
                "U04" => "University College London, UK",
                "U05" => "University of Edinburgh, UK",
                "U06" => "Stanford University, USA",
                "U07" => "MIT, USA",
                "U08" => "Harvard University, USA",
                "U09" => "Princeton University, USA",
                "U10" => "Caltech, USA",
                "U11" => "ETH Zurich, Switzerland",
                "U12" => "Technical University of Munich, Germany",
                "U13" => "École Polytechnique Fédérale de Lausanne, Switzerland",
                "U14" => "LMU Munich, Germany",
                "U15" => "PSL Research University Paris, France",
                "U16" => "Tsinghua University, China",
                "U17" => "Peking University, China",
                "U18" => "Shanghai Jiao Tong University, China",
                "U19" => "Fudan University, China",
                "U20" => "University of Tokyo, Japan",
                default => "N/A",
            };

            $item->studymode = match ($item->studymode) {
                "MS01" => "Coursework",
                "MS02" => "Research",
                default => "NA",
            };
            // $item->race = $item->race === "others" ? $item->race_display : $item->race;

            return $item;
        });
        // dd($data); 

        return view('submission.index', [
            'data' => $data,
            'user' => $request->user(),
            'application' => $request->application,
            'guardian' => $request->guardian,
            'academic_qualification' => $request->academic_qualification
        ]);
    }

    public function store(Request $request, $step)
    {
 
        // Check if record existed
        // $application = Application::where($user_id_col, '=', Auth::user()->id)->whereNull('deleted_at')->first();
        $application = Application::where('user_id', Auth::user()->id)->whereNull('deleted_at')->first();


        // Assign or retrieve the uuid values
        if ($application === null){
            $appUuid = Str::uuid();
            $appStatus = 'draft';
        }else {
            $appUuid = $application->uuid;
            $appStatus = $application->status;
        }
        
        


        // Assign the user_id from Authorize user value
        $user_id = Auth::user()->id;

        // Check application status before updating the data
        if ($appStatus == 'draft'){

            if ($step == "personal"){
                // Personal Information data validation
                $validateData = $request->validate([
                    'age'               => ['required', 'digits:2'],
                    'race'              => ['required'],
                    'nationality'       => ['required'],
                    'birthstate'        => ['required'],
                    'gender'            => ['required'],
                    'maritalstatus'     => ['required'],
                    'housephone'        => ['nullable', 'between:9,12'],
                    'mobilephone'       => ['required', 'between:9,12'],
                    'permanentaddress'  => ['required', 'max: 200'],
                    'permanentcity'     => ['required', 'max: 100'],
                    'permanentpostcode' => ['required', 'digits:5'],
                    'permanentstate'    => ['required'],
                    'permanentcountry'  => ['required', 'max: 200'],
                    'emergencyname'     => ['required', 'max: 100'],
                    'relationship'      => ['required'],
                    'emergencyphone'    => ['required', 'between:9,12'],
                    'emergencyaddress'  => ['required', 'max: 200'],
                    'emergencycity'     => ['required', 'max: 100'],
                    'emergencypostcode' => ['required', 'digits:5'],
                    'emergencystate'    => ['required'],
                    'emergencycountry'  => ['required', 'max: 200'],
                ]
                // ,[
                //     'housephone.required' => 'House phone cannot be empty',
                //     'housephone.digits' => 'House phone cannot be longer than 11 digits',
                // ]
                );

                // if ($validator->fails()){
                //     return back()->with("error", "Unable to save your changes. Check the form and try again");
                // }
                // $tab01 = 1;

                // Update or Create a new Application Record.
                $application = Application::updateOrCreate(
                    ['uuid' => $appUuid, 'user_id' => $user_id],
                    [
                        'age'               => $request->age,
                        'race'              => $request->race,
                        'other_race'        => $request->other_race,
                        'nationality'       => $request->nationality,
                        'birthstate'        => $request->birthstate,
                        'other_birthstate'  => $request->other_birthstate,
                        'gender'            => $request->gender,
                        'maritalstatus'     => $request->maritalstatus,
                        'housephone'        => $request->housephone,
                        'mobilephone'       => $request->mobilephone,
                        'permanentaddress'  => $request->permanentaddress,
                        'permanentcity'     => $request->permanentcity,
                        'permanentpostcode' => $request->permanentpostcode,
                        'permanentstate'    => $request->permanentstate,
                        'permanentcountry'  => $request->permanentcountry,
                        'emergencyname'     => $request->emergencyname,
                        'relationship'      => $request->relationship,
                        'other_relationship'=> $request->other_relationship,
                        'emergencyphone'    => $request->emergencyphone,
                        'emergencyaddress'  => $request->emergencyaddress,
                        'emergencycity'     => $request->emergencycity,
                        'emergencypostcode' => $request->emergencypostcode,
                        'emergencystate'    => $request->emergencystate,
                        'emergencycountry'  => $request->emergencycountry,
                        'tab01'             => 1,
                    ]
                );

                // redirect back to sender
                return redirect()->route('apply.index', ['step' => 'personal']);
                // return redirect(route('apply.index').'#hs-tab-to-select-1');

            }else if($step == "parentdetails"){
                $validateData = $request ->validate([
                    'parentname'            => ['nullable'],
                    'parentrelationship'    => ['nullable'],
                    'parentoccupation'      => ['nullable'],
                    'parentphone'           => ['nullable', 'digits:11'],
                    'parentaddress'         => ['nullable'],
                    'parentstaffid'         => ['nullable'],
                ]);
                $tab10 = 1;

                $application = Guardian::updateOrCreate(
                    ['user_id' => $user_id],
                    [
                        'guardiantype'          => $request->guardiantype,
                        'guardian_name'         => $request->guardian_name,
                        'guardian_mykad'        => $request->guardian_mykad,
                        'tab10'                 => $tab10
                    ]
                );
                return redirect()->route('apply.index', ['step' => 'parentdetails']);
                        
            }elseif($step == "academics"){
                // echo "\rAcademics tab";
                // echo "<br>UUID : ".$appUuid;
                // echo "<br>User_ID :".$user_id;
                // exit;

                // Academic Qualification data validation
                $validateData = $request->validate([
                    'studylevel'        => ['required'],
                    'coursename'        => ['required', 'max: 200'],
                    'universityname'    => ['required', 'max: 200'],
                    'universitycountry' => ['required', 'max: 50'],
                    'commencementyear'  => ['required', 'digits:4'],
                    'completionyear'    => ['required', 'digits:4'],
                    'result'            => ['nullable', 'numeric', 'between:0,4.00'],
                    'resultother'       => ['nullable', 'max: 50'], 
                    'studyextension'    => ['required'],
                    'reasonextension'   => ['required_if:studyextension,Yes', 'max:200'],
                ]);
                $tab02 = 1;
                
                // echo "values : ".$request->coursename."<br />";
                // echo "values : ".$request->universityname."<br />";
                // echo "values : ".$request->universitycountry."<br />";
                // echo "values : ".$request->commencementyear."<br />";
                // echo "values : ".$request->completionyear."<br />";
                // echo "values : ".$request->result."<br />";
                // exit;


                $application = Application::updateOrCreate(
                    ['uuid' => $appUuid, 'user_id' => $user_id],
                    [
                        'studylevel'        => $request->studylevel?? null,
                        'coursename'        => $request->coursename,
                        'universityname'    => $request->universityname,
                        'universitycountry' => $request->universitycountry,
                        'commencementyear'  => $request->commencementyear,
                        'completionyear'    => $request->completionyear,
                        'result'            => $request->result,
                        'resultother'       => $request->resultother,
                        'studyextension'    => $request->studyextension,
                        'reasonextension'   => $request->reasonextension,
                        'tab02'             => $tab02,
                    ]
                    );

                // redirect back to sender
                return redirect()->route('apply.index', ['step' => 'academic']);
                // redirect(route('apply.index').'#hs-tab-to-select-2');
            
            }elseif ($step == "spm"){
                $validateData = $request->validate([
                    'spm_school'                => ['required', 'max: 100'],
                    'spm_commencement_year'     => ['required', 'digits: 4'],
                    'spm_completion_year'       => ['required', 'digits: 4'],
                    'spm_result'                => ['required', 'max: 100'],
                ]);
                $tab03 = 1;

                $application = AcademicQualification::updateOrCreate(
                    ['user_id' => $user_id],
                    [
                        'spm_school'            => $request->spm_school,
                        'spm_commencement_year' => $request->spm_commencement_year,
                        'spm_completion_year'   => $request->spm_completion_year,
                        'spm_result'            => $request->spm_result,
                        'tab03'                 => $tab03
                    ]
                );
                // redirect back to sender
                return redirect()->route('apply.index', ['step' => 'spm']);

            }elseif ($step == "skills"){
                // Skills data validation
                $validateData = $request->validate([
                    'personalstatement'         => ['required', 'max:5000'],
                    'skillsandextracurricular'  => ['required', 'max:5000'],
                    'activityextra'             => ['required', 'max:5000'],
                ]);
                $tab04 = 1;

                $application = Application::updateOrCreate(
                    ['uuid' => $appUuid, 'user_id' => $user_id],
                    [
                        'personalstatement'         => $request->personalstatement,
                        'skillsandextracurricular'  => $request->skillsandextracurricular,
                        'activityextra'             => $request->activityextra,
                        'tab04'                     => $tab04
                    ]
                );

                return redirect()->route('apply.index', ['step' => 'skill']);

            }elseif ($step == "experience"){
                //Wrok Experience
                $validateData = $request->validate([
                    'employmentstatus'  => ['required']
                ]);
                $tab05 = 1;

                $cleanSalary = 0;

                if ($request->employmentstatus == "E")
                {
                    // Remove "RM" prefix and commas from salary before saving
                    $cleanSalary = str_replace(',', '', preg_replace('/[^0-9.]/', '', $request->salary));
                }

                $application = Application::updateOrCreate(
                    ['uuid' => $appUuid, 'user_id' => $user_id],
                    [
                        'employmentstatus'  => $request->employmentstatus,
                        // 'employertype'      => $request->employertype,
                        'employername'      => $request->employername,
                        'employeraddress'   => $request->employeraddress,
                        'officephone'       => $request->officephone,
                        'position'          => $request->position,
                        'salary'            => $cleanSalary,
                        'tab05'             => $tab05
                    ]
                );

                return redirect()->route('apply.index', ['step' => 'experience']);
            }elseif ($step == "study"){
                // Study Information
                $validateData = $request->validate([
                    'appliedlevelstudy'             => ['required'],
                    'majorstudy'                    => ['required'],
                    'appliedcoursetitle'            => ['required', 'max: 200'],
                    'university'                    => ['required'],
                    'studymode'                     => ['required'],
                    'startdate'                     => ['required'],
                    'enddate'                       => ['required'],
                    'studyperiod'                   => ['required', 'max: 100'],
                    'cgpasemresult'                 => ['nullable', 'numeric', 'between:0,4.00'],
                    'othersemresult'                => ['nullable', 'max: 50'],
                ]);
                $tab06 = 1;

                $sdate = strtotime($request->startdate);
                $nsdate = date('Y-m-d', $sdate);

                $edate = strtotime($request->enddate);
                $nedate = date('Y-m-d', $edate);

                // $duration = abs(strtotime($request->enddate) - strtotime($request->startdate));

                // $years = floor($duration / (365*60*60*24));
                // $months = floor(($duration - $years * 365*60*60*24) / (30*60*60*24));
                // $days = floor(($duration - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                // $speriod = $years." years, " .$months. " months, ".$days." days";


                // echo $nsdate ."--". $nedate."<br />";
                // echo $speriod;
                // exit;

                $application = Application::updateOrCreate(
                    ['uuid' => $appUuid, 'user_id' => $user_id],
                    [
                        'appliedlevelstudy'         => $request->appliedlevelstudy,
                        'majorstudy'                => $request->majorstudy,
                        'appliedcoursetitle'        => $request->appliedcoursetitle,
                        'university'                => $request->university,
                        'studymode'                 => $request->studymode,
                        'startdate'                 => $nsdate,
                        'enddate'                   => $nedate,
                        'studyperiod'               => $request->studyperiod,
                        'researchproposalsummary'   => $request->researchproposalsummary,
                        'cgpasemresult'              => $request->cgpasemresult,
                        'othersemresult'             => $request->othersemresult,
                        'tab06'                     => $tab06
                    ]
                );

                return redirect()->route('apply.index', ['step' => 'study']);
            }elseif ($step == "document"){
                echo "Document upload is being managed in FileUploadController";
            }elseif ($step == "declaration"){
                // Declarations items
                // $declaration_01 = $request->declaration01;
                // $declaration_02 = $request->declaration02;
                // $declaration_03 = $request->declaration03;
                // $declaration_04 = $request->declaration04;
                // $declaration_05 = $request->declaration05;
                // $declaration_06 = $request->declaration06;
                // $declaration_07 = $request->declaration07;
                // $declaration_08 = $request->declaration08;

                // // Switch declaration values
                $fdeclaration01 = $request->declaration01 == 'yes' ? 1 : 0;
                $fdeclaration02 = $request->declaration02 == 'yes' ? 1 : 0;
                $fdeclaration03 = $request->declaration03 == 'yes' ? 1 : 0;
                $fdeclaration04 = $request->declaration04 == 'yes' ? 1 : 0;
                $fdeclaration05 = $request->declaration05 == 'yes' ? 1 : 0;
                $fdeclaration06 = $request->declaration06 == 'yes' ? 1 : 0;
                $fdeclaration07 = $request->declaration07 == 'yes' ? 1 : 0;
                $fdeclaration08 = $request->declaration08 == 'yes' ? 1 : 0;
                $fdeclaration09 = $request->declaration09 == 'yes' ? 1 : 0;

                // echo "Declaration01 :" . $declaration_01 . " && Declaration02 :". $declaration_02 ."<br />";
                // echo "Declaration03 :" . $declaration_03 . " && Declaration04 :". $declaration_04 ."<br />";
                // echo "Declaration05 :" . $declaration_05 . " && Declaration06 :". $declaration_06 ."<br />";
                // echo "Declaration07 :" . $declaration_07 . " && Declaration08 :". $declaration_08 ."<br />";
                
                // echo $fdeclaration01 . " && ". $fdeclaration02 . " && " . $fdeclaration03 . " && ". $fdeclaration04 . " && " . $fdeclaration05 . " && ". $fdeclaration06 . " && " . $fdeclaration07 . " && ". $fdeclaration08;
                // // exit;

                $validateData = $request->validate([
                    'declaration01' => ['required'],
                    'declaration02' => ['required'],
                    'declaration03' => ['required'],
                    'declaration04' => ['required'],
                    'declaration05' => ['required'],
                    'declaration06' => ['required'],
                    'declaration07' => ['required'],
                    'declaration08' => ['required'],
                    'declaration09' => ['required']
                ]);
                $tab08 = 1;
                // echo "<br /><br />validate data";
                // exit;

                $application = Application::updateOrCreate(
                    ['uuid' => $appUuid, 'user_id' => $user_id],
                    [
                        'declaration01' => $fdeclaration01,
                        'declaration02' => $fdeclaration02,
                        'declaration03' => $fdeclaration03,
                        'declaration04' => $fdeclaration04,
                        'declaration05' => $fdeclaration05,
                        'declaration06' => $fdeclaration06,
                        'declaration07' => $fdeclaration07,
                        'declaration08' => $fdeclaration08,
                        'declaration09' => $fdeclaration09,
                        'tab08'         => $tab08,
                    ]
                );

                return redirect()->route('apply.index', ['step' => 'declaration']);

            }elseif ($step == "consent"){
                // Consent Items
                $consent_01 = $request->consent01;
                $consent_02 = $request->consent02;
                $consent_03 = $request->consent03;

                $fconsent01 = $request->consent01 == 'yes' ? 1 : 0;
                $fconsent02 = $request->consent02 == 'yes' ? 1 : 0;
                $fconsent03 = $request->consent03 == 'yes' ? 1 : 0;

                // echo $consent_01 . " && " . $consent_02 . " && " . $consent_03 . "<br /><br />";
                // echo $fconsent01 . " && " . $fconsent02 . " && " . $fconsent03;
                // exit;

                $validateData = $request->validate([
                    'consent01' => ['required'],
                    'consent02' => ['required'],
                    'consent03' => ['required']
                ]);

                // Save consent value
                $application = Application::updateORCreate(
                    ['uuid' => $appUuid, 'user_id' => $user_id],
                    [
                        'consent01' => $fconsent01,
                        'consent02' => $fconsent02,
                        'consent03' => $fconsent03,
                        'tab09'     => 1
                    ]
                );
            

                // ORIGINAL UPDATE 
                // Author   : Zaki
                // Date     : 27/2/2025
                // Remarks  : Update to include session values for each type of scholarship

                // // Check all tab status and update the application status column
                // $submission = Application::where('user_id', '=', Auth::user()->id)
                // ->where('uuid', '=', $appUuid)
                // ->where('tab01', '=', 1)
                // ->where('tab02', '=', 1)
                // ->where('tab03', '=', 1)
                // ->where('tab04', '=', 1)
                // ->where('tab05', '=', 1)
                // ->where('tab06', '=', 1)
                // ->where('tab07', '=', 1)
                // ->where('tab08', '=', 1)
                // ->where('tab09', '=', 1)
                // ->where('tab10', '=', 1)
                // ->get();
                // $reccount = count($submission);

                $submissionCount = 0;

                if (Session::get('tab01') == "1") {
                    $submission=  Application::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $appUuid)->where('tab01', '=', 1)->get();

                    $submissionCount += count($submission);
                }
                if (Session::get('tab10') == "1") {
                    $submission =  Application::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $appUuid)->where('tab100', '=', 1)->get();

                    $submissionCount += count($submission);
                }
                if (Session::get('tab02') == "1") {
                    $submission =  Application::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $appUuid)->where('tab02', '=', 1)->get();

                    $submissionCount += count($submission);
                }
                if (Session::get('tab03') == "1") {
                    $submission =  Application::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $appUuid)->where('tab03', '=', 1)->get();

                    $submissionCount += count($submission);
                }
                if (Session::get('tab04') == "1") {
                    $submission =  Application::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $appUuid)->where('tab04', '=', 1)->get();

                    $submissionCount += count($submission);
                }
                if (Session::get('tab05') == "1") {
                    $submission =  Application::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $appUuid)->where('tab05', '=', 1)->get();

                    $submissionCount += count($submission);
                }
                if (Session::get('tab06') == "1") {
                    $submission =  Application::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $appUuid)->where('tab06', '=', 1)->get();

                    $submissionCount += count($submission);
                }
                if (Session::get('tab07') == "1") {
                    $submission =  Application::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $appUuid)->where('tab07', '=', 1)->get();

                    $submissionCount += count($submission);
                }
                if (Session::get('tab08') == "1") {
                    $submission =  Application::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $appUuid)->where('tab08', '=', 1)->get();

                    $submissionCount += count($submission);
                }
                if (Session::get('tab09') == "1") {
                    $submission =  Application::where('user_id', '=', Auth::user()->id)->where('uuid', '=', $appUuid)->where('tab09', '=', 1)->get();

                    $submissionCount += count($submission);
                }

                echo "SubmissionCount Value :".$submissionCount." -- SESSION VALUE :".Session::get('columncount')."<br /><br />";
                echo "testing";
                // exit;

                if($submissionCount == Session::get('columncount')){
                    $application = Application::updateORCreate(
                        ['uuid' => $appUuid, 'user_id' => $user_id],
                        ['status' => 'complete']
                    );

                    $user = Auth::user();

                    // Send email 
                    Mail::to($user->email)->send(new FormCompletionMail($user));
                    
                    // echo "<br />";
                    // echo $appUuid."<br />";
                    // echo $user_id."<br />";
                    // echo "update final status";
                    // exit;
                }
                
                return redirect()->route('apply.index', ['step' => 'consent']);
            }
            
        }
    }

}
