{{-- <x-app-layout :user=$user> --}}
    <x-app-layout :user="Auth::user()">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-4 p-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-2">
 
                <div class="p-6 text-gray-900">
                    {{-- Check account type --}}
                    {{-- User Role : {{ $user->role }} <br /> --}}

                    {{-- Applicant account --}}
                    {{-- [[UPDATE IN PROGRESS... ]]<br /><br /> --}}
                    @if($user->role == "applicant")
                        {{-- Check if application record existed --}}
                        @if($application)
                            {{-- Check the status of the application --}}
                            @if($application->status === "draft")
                                You have an incomplete application record created on {{ date('d M, Y h:i:s A', strtotime($application->created_at)) }}.<br />
                                Complete your application form and submit it before the closing date.      
                            @else
                                <span>Your application has been submitted.</span>
                                <br>
                                <!-- Print Button (Appears only if application is submitted) -->
                                <button type="button" id="printBtn"
                                    class="ml-0 mt-2 py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none">
                                       Print Application
                                </button>  
                            @endif

                        @else
                            {{-- No application record found. Please use the  --}}
                            <p>No application record found. Please use the
                            <x-nav-link :href="route('apply.index')" :active="request()->routeIs('apply.index')">Application Form</x-nav-link> link to submit your application!
                            </p>
                        @endif

                    {{-- Admin account --}}
                    @else
                        <span class="text-indigo-900">Total applications received based on their status:</span>
                        <br><br>
                        <p><span class="label-text">Draft:</span> <span class="green-text">{{ $draftCount }}</span> applications</p>
                        <p><span class="label-text">Complete:</span> <span class="green-text">{{ $completeCount }}</span> applications</p>

                    @endif

                     

                    
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <span class="font-extrabold text-4xl text-indigo-900">9<span style="position: relative; top: -0.8em; font-size: 50%;">th</span> March 2025</span>
                    <br>The closing date for submission of the scholarship application
 
                </div>
            </div>
        </div>
    </div>

        

    <!-- JavaScript for Printing -->
    @if($user->role == "applicant")
    <script>
        document.getElementById("printBtn")?.addEventListener("click", function() {
                var printWindow = window.open('', '_blank', 'width=800,height=600');
    
                // Define the content to print
                var content = `
                    <html>
                    <head>
                        <title>Application Form</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; color: #333; }
                            .header { font-size: 25px; font-weight: bold; text-align: center; padding: 10px; background-color: black; color: white; }
                            .content { margin-top: 20px; }
                            .row { display: flex; padding: 10px; }
                            .label { font-weight: bold; width: 200px; }
                            .value { flex: 1; }
                            .logo-header { display: flex; align-items: center; background-color: white; padding: 15px; border-radius: 10px; }
                            .logo { height: 50px; /* Adjust size */ width: auto; margin-right: 15px; }
                            .title { font-size: 18px; font-weight: bold; line-height: 1.4; /* Adjusts spacing between lines */ color: black; }
                            @media print {
                                .header { background-color: black !important; color: white !important; }
                                body { print-color-adjust: exact; }
                            }
                        </style>
                    </head>
                    <body>
                        @php
                            // Gender
                            $fgender = match (isset($application->gender)) {
                                "M" => "Male",
                                "F" => "Female",
                                default => "NA",
                            };

                            //Race
                            $frace = match (isset($application->race)) {
                                "B01" => "Malay",
                                "B02" => "Chinese",
                                "B03" => "Indian",
                                "B04" => "Bumiputera Sabah",
                                "B05" => "Bumiputera Sarawak",
                                "others" => $application->other_race ?? "Others",
                                default => "NA",
                            };

                            $fstudylevel = match (isset($application->studylevel)) {
                                "Degree"    => "Bachelor degree",
                                "Master"    => "Master",
                                "PHD"       => "PhD",
                                default     =>  "NA",
                            };

                            $fstudyextension = match (isset($application->studyextension)) {
                                "Yes" => "Yes",
                                "No" => "No",
                                default => "NA",
                            };

                            $fnationality = match (isset($application->nationality)) {
                                "01" => "Malaysian",
                                "02" => "Non-Malaysian",
                                default => "NA",
                            };

                            $fbirthstate = match (isset($application->birthstate)){
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
                                "others" => $application->other_birthState ?? "Others",
                                default => "NA",
                            };

                            $fmaritalstatus = match (isset($application->maritalstatus)){
                                "MS01" => "Single",
                                "MS02" => "Married",
                                "MS03" => "Divorced",
                                "MS04" => "Widowed",
                                default => "NA",
                            };

                            $fpermanentstate = match (isset($application->permanentstate)){
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
                                "others" => $application->other_permanentstate ?? "Others",
                                default => "NA",
                            };

                            $frelationship = match (isset($application->relationship)){
                                "R01" => "Spouse",
                                "R02" => "Sibling",
                                "R03" => "Parent",
                                "R04" => "Grandparent",
                                "others" => $application->other_relationship ?? "Others",
                                default => "NA",
                            };

                            $femergencystate = match (isset($application->emergencystate)){
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
                                "others" => $application->other_emergencystate ?? "Others",
                                default => "NA",
                            };

                            $femploymentstatus = match (isset($application->employmentstatus)){
                                "E" => "Employed",
                                "S" => "Self-Employed",
                                "U" => "Unemployed",
                                default => "NA",
                            };

                            $fappliedlevelstudy = match (isset($application->appliedlevelstudy)) {
                                "Mast" => "Master",
                                "PhD" => "PhD",
                                default => $application->appliedlevelstudy ?? "NA",
                            };
                            
                            $fmajorstudy = match (isset($application->majorstudy)) {
                                "Acc" => "Accountancy",
                                "ActS" => "Actuarial Science",
                                "Arch" => "Architecture",
                                "Art" => "Arts",
                                "Bness" => "Business",
                                "Comm" => "Communication",
                                "Const" => "Construction, Property & Real Estate",
                                "Eco" => "Economics",
                                "Eng" => "Engineering",
                                "Finc" => "Finance",
                                "HR" => "Human Resources",
                                "IT" => "Information Technology",
                                "Law" => "Law",
                                "Mgt" => "Management",
                                "Mkt" => "Marketing",
                                "Math" => "Mathematics",
                                "Psyc" => "Psychology",
                                "SocS" => "Social Science",
                                "Sce" => "Science",
                                default => $application->majorstudy ?? "NA",
                            };
                            
                            $funiversity = match (isset($application->university)) {
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
                            
                            $fstudymode = match (isset($application->studymode)) {
                                "MS01" => "Coursework",
                                "MS02" => "Research",
                                default => "NA",
                            };
                        @endphp
                        <div class="logo-header">
                            <img class="logo" src="{{ url('/images/PNB_Logo_Blue_RGB.png') }}" alt="PNB Logo">
                            <div class="title">
                                <span>YTI Excellence Award</span><br>
                                <span>Scholarship Application Form</span><br>
                                <span>2025</span>
                            </div>
                        </div>
                        <div class="header text-lg font-bold mt-3">Application Submission</div>
                        <div class="content">
                            <div class="row"><span class="label">Full Name:</span> <span class="value">{{ $user->name ?? 'Not Available' }}</span></div>
                            <div class="row"><span class="label">MyKad Number:</span> <span class="value">{{ $user->mykad ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Email:</span> <span class="value">{{ $user->email ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Age:</span> <span class="value">{{ $application->age ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Race:</span> <span class="value">{{ $frace }}</span></div>
                            <div class="row"><span class="label">Other Race:</span> <span class="value">{{ $application->other_race ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Nationality:</span> <span class="value">{{ $fnationality }}</span></div>
                            <div class="row"><span class="label">Birth State:</span> <span class="value">{{ $fbirthstate }}</span></div>
                            <div class="row"><span class="label">Other Birth State:</span> <span class="value">{{ $application->other_birthstate ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Gender:</span> <span class="value">{{ $fgender }}</span></div>
                            <div class="row"><span class="label">Marital Status:</span> <span class="value">{{ $fmaritalstatus }}</span></div>
                            <div class="row"><span class="label">House Phone:</span> <span class="value">{{ $application->housephone ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Mobile Phone:</span> <span class="value">{{ $application->mobilephone ?? 'Not Provided' }}</span></div>
                            
                            <div class="header">Permanent Address</div>
                            <div class="row"><span class="label">Permanent Address:</span> <span class="value">{{ $application->permanentaddress ??'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Permanent Postcode:</span> <span class="value">{{ $application->permanentpostcode ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Permanent City:</span> <span class="value">{{ $application->permanentcity ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Permanent State:</span> <span class="value">{{ $fpermanentstate ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Other Permanent State:</span> <span class="value">{{ $application->other_permanentstate ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Permanent Country:</span> <span class="value">{{ $application->permanentcountry ?? 'Not Provided' }}</span></div>
                            
                            <div class="header">Emergency Address</div>
                            <div class="row"><span class="label">Emergency Contact Name:</span> <span class="value">{{ $application->emergencyname ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Emergency Phone:</span> <span class="value">{{ $application->emergencyphone ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Relationship:</span> <span class="value">{{ $frelationship ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Other Relationship:</span> <span class="value">{{ $application->other_relationship ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Emergency Address:</span> <span class="value">{{ $application->emergencyaddress ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Emergency Postcode:</span> <span class="value">{{ $application->emergencypostcode ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Emergency City:</span> <span class="value">{{ $application->emergencycity ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Emergency State:</span> <span class="value">{{ $femergencystate }}</span></div>
                            <div class="row"><span class="label">Other Emergency State:</span> <span class="value">{{ $application->other_emergencystate ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Emergency Country:</span> <span class="value">{{ $application->emergencycountry ?? 'Not Provided' }}</span></div>
                            
                            <div class="header">Academic Qualifications</div>
                            <div class="row"><span class="label">Study Level:</span> <span class="value">{{ $application->studylevel ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Course Name:</span> <span class="value">{{ $application->coursename ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">University Name:</span> <span class="value">{{ $application->universityname ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">University Country:</span> <span class="value">{{ $application->universitycountry ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Commencement Year:</span> <span class="value">{{ $application->commencementyear ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Completion Year:</span> <span class="value">{{ $application->completionyear ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Result:</span> <span class="value">{{ $application->result ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Other Result:</span> <span class="value">{{ $application->resultother ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Study Extension:</span> <span class="value">{{ $application->studyextension ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Reason for Extension:</span> <span class="value">{{ $application->reasonextension ?? 'Not Provided' }}</span></div>
                            
                            <div class="header">Skills</div>
                            <div class="row"><span class="label">Personal Statement:</span> <span class="value">{{ $application->personalstatement ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Skills & Extracurricular:</span> <span class="value">{{ $application->skillsandextracurricular ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Extra Activities:</span> <span class="value">{{ $application->activityextra ?? 'Not Provided' }}</span></div>
                            
                            <div class="header">Employment Information</div>
                            <div class="row"><span class="label">Employment Status:</span> <span class="value">{{ $femploymentstatus }}</span></div>
                            <div class="row"><span class="label">Employer Name:</span> <span class="value">{{ $application->employername ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Employer Address:</span> <span class="value">{{ $application->employeraddress ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Office Phone:</span> <span class="value">{{ $application->officephone ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Position:</span> <span class="value">{{ $application->position ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Salary:</span> <span class="value">{{ $application->salary ?? 'Not Provided' }}</span></div>
                            
                            <div class="header">Field of Study</div>
                            <div class="row"><span class="label">Applied Level of Study:</span> <span class="value">{{ $fappliedlevelstudy }}</span></div>
                            <div class="row"><span class="label">Major Study:</span> <span class="value">{{ $fmajorstudy }}</span></div>
                            <div class="row"><span class="label">Applied Course Title:</span> <span class="value">{{ $application->appliedcoursetitle ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">University:</span> <span class="value">{{ $funiversity }}</span></div>
                            <div class="row"><span class="label">Study Mode:</span> <span class="value">{{ $fstudymode }}</span></div>
                            <div class="row"><span class="label">Study Period:</span> <span class="value">{{ $application->studyperiod ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Research Proposal Summary:</span> <span class="value">{{ $application->researchproposalsummary ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">CGPA Semester Result:</span> <span class="value">{{ $application->cgpasemresult ?? 'Not Provided' }}</span></div>
                            <div class="row"><span class="label">Other Semester Result:</span> <span class="value">{{ $application->othersemresult ?? 'Not Provided' }}</span></div>
                            
                            <div class="header">Documents</div>
                            <div class="row"> <span class="label">MyKad:</span> <span class="value">
                                    @foreach ($documents as $document)
                                    @if ($document->filetype == 'D01')
                                    {{ $document->filename }}
                                    @endif
                                    @endforeach </span> </div>
                            <div class="row"> <span class="label">Passport Photo:</span> <span class="value">
                                    @foreach ($documents as $document)
                                    @if ($document->filetype == 'D02')
                                    {{ $document->filename }}
                                    @endif
                                    @endforeach </span> </div>
                            <div class="row"> <span class="label">Academic Transcript:</span> <span class="value">
                                    @foreach ($documents as $document)
                                    @if ($document->filetype == 'D03')
                                    {{ $document->filename }}
                                    @endif
                                    @endforeach </span> </div>
                            <div class="row"> <span class="label">University Offer Letter or Registration Slip:</span> <span class="value">
                                    @foreach ($documents as $document)
                                    @if ($document->filetype == 'D04')
                                    {{ $document->filename }}
                                    @endif
                                    @endforeach </span> </div>
                            <div class="row"> <span class="label">Curriculum Vitae:</span> <span class="value">
                                    @foreach ($documents as $document)
                                    @if ($document->filetype == 'D05')
                                    {{ $document->filename }}
                                    @endif
                                    @endforeach </span> </div>
                            <div class="row"> <span class="label">Proof of Employment:</span> <span class="value">
                                    @foreach ($documents as $document)
                                    @if ($document->filetype == 'D06')
                                    {{ $document->filename }}
                                    @endif
                                    @endforeach </span>
                            </div>

                            <div class="header">Declaration</div>
                            <div class="row">
                                <span class="label">Declaration 1:</span>
                                <span class="value">
                                    I have no chronic illnesses, infectious diseases, or conditions requiring follow-up treatment.
                                    <br>Answer: {{ isset($application->declaration01) ? ($application->declaration01 === '1' ||
                                    $application->declaration01 === 1 ? 'Yes' : ($application->declaration01 === '0' || $application->declaration01
                                    === 0 ? 'No' : 'Not provided')) : 'Not provided' }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="label">Declaration 2:</span>
                                <span class="value">
                                    I have no psychiatric condition requiring follow-up treatment.
                                    <br>Answer: {{ isset($application->declaration02) ? ($application->declaration02 === '1' ||
                                    $application->declaration02 === 1 ? 'Yes' : ($application->declaration02 === '0' || $application->declaration02
                                    === 0 ? 'No' : 'Not provided')) : 'Not provided' }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="label">Declaration 3:</span>
                                <span class="value">
                                    I have not been terminated by any sponsor for disciplinary action.
                                    <br>Answer: {{ isset($application->declaration03) ? ($application->declaration03 === '1' ||
                                    $application->declaration03 === 1 ? 'Yes' : ($application->declaration03 === '0' || $application->declaration03
                                    === 0 ? 'No' : 'Not provided')) : 'Not provided' }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="label">Declaration 4:</span>
                                <span class="value">
                                    I have never committed any criminal offences and been charged at any court in Malaysia.
                                    <br>Answer: {{ isset($application->declaration04) ? ($application->declaration04 === '1' ||
                                    $application->declaration04 === 1 ? 'Yes' : ($application->declaration04 === '0' || $application->declaration04
                                    === 0 ? 'No' : 'Not provided')) : 'Not provided' }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="label">Declaration 5:</span>
                                <span class="value">
                                    I have no other scholarships/loans for the same level of study applied.
                                    <br>Answer: {{ isset($application->declaration05) ? ($application->declaration05 === '1' ||
                                    $application->declaration05 === 1 ? 'Yes' : ($application->declaration05 === '0' || $application->declaration05
                                    === 0 ? 'No' : 'Not provided')) : 'Not provided' }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="label">Declaration 6:</span>
                                <span class="value">
                                    I hereby consent to and conscientiously declare that YTI reserves the right to decline the application or
                                    withdraw sponsorship awarded at any time should any of the information provided be false.
                                    <br>Answer: {{ isset($application->declaration06) ? ($application->declaration06 === '1' ||
                                    $application->declaration06 === 1 ? 'Yes' : ($application->declaration06 === '0' || $application->declaration06
                                    === 0 ? 'No' : 'Not provided')) : 'Not provided' }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="label">Declaration 7:</span>
                                <span class="value">
                                    I hereby undertake and agree to comply with all the terms and conditions set forth by YTI at any time.
                                    <br>Answer: {{ isset($application->declaration07) ? ($application->declaration07 === '1' ||
                                    $application->declaration07 === 1 ? 'Yes' : ($application->declaration07 === '0' || $application->declaration07
                                    === 0 ? 'No' : 'Not provided')) : 'Not provided' }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="label">Declaration 8:</span>
                                <span class="value">
                                    I hereby declare in good faith that all information provided in this form is true.
                                    <br>Answer: {{ isset($application->declaration08) ? ($application->declaration08 === '1' ||
                                    $application->declaration08 === 1 ? 'Yes' : ($application->declaration08 === '0' || $application->declaration08
                                    === 0 ? 'No' : 'Not provided')) : 'Not provided' }}
                                </span>
                            </div>

                            <div class="row">
                                <span class="label">Declaration 9:</span>
                                <span class="value">
                                    I am committed to returning to Malaysia after completing my studies and contributing to the country’s
                                    development.
                                    <br>Answer: {{ isset($application->declaration09) ? ($application->declaration09 === '1' ||
                                    $application->declaration09 === 1 ? 'Yes' : ($application->declaration09 === '0' || $application->declaration09
                                    === 0 ? 'No' : 'Not provided')) : 'Not provided' }}
                                </span>
                            </div>

                            <div class="header">Consent</div>
                            <div class="row">
                                <span class="label">Consent 1:</span>
                                <span class="value">
                                    By submitting and signing this Declaration, I hereby agree and consent that YTI may collect, obtain, store and
                                    process my personal data which I provide in this Declaration for the purposes of processing this sponsorship
                                    application in accordance with the relevant provisions on personal data.
                                    <br>Answer: {{ isset($application->consent01) ? ($application->consent01 === '1' || $application->consent01 === 1 ?
                                    'Yes' : ($application->consent01 === '0' || $application->consent01 === 0 ? 'No' : 'Not provided')) : 'Not
                                    provided' }}
                                </span>
                            </div>
                            
                            <div class="row">
                                <span class="label">Consent 2:</span>
                                <span class="value">
                                    I hereby agree and consent that YTI may store and process my personal data for the purpose of verification and
                                    consideration of this sponsorship application; and/or declare, supply and/or submit my personal data to the
                                    relevant Government authorities or third parties, as required by law.
                                    <br>Answer: {{ isset($application->consent02) ? ($application->consent02 === '1' || $application->consent02 === 1 ?
                                    'Yes' : ($application->consent02 === '0' || $application->consent02 === 0 ? 'No' : 'Not provided')) : 'Not
                                    provided' }}
                                </span>
                            </div>
                            
                            <div class="row">
                                <span class="label">Consent 3:</span>
                                <span class="value">
                                    I hereby agree that all the above is true and has been accurately recorded. In the event of any fraud and/or
                                    inaccuracy of the information, even if it is unintentionally provided while signing this Declaration, YTI
                                    reserves the right to reject this application or terminate my sponsorship at any time, even if the offer has
                                    been awarded.
                                    <br>Answer: {{ isset($application->consent03) ? ($application->consent03 === '1' || $application->consent03 === 1 ?
                                    'Yes' : ($application->consent03 === '0' || $application->consent03 === 0 ? 'No' : 'Not provided')) : 'Not
                                    provided' }}
                                </span>
                            </div>
                        </div>
                    </body>
                    </html>
                `;
    
                // Write the content into the new window
                printWindow.document.open();
                printWindow.document.write(content);
                printWindow.document.close();
    
                // Print the content
                printWindow.print();
    
                // Close the print window after printing
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            });
    </script>
    @endif
</x-app-layout>