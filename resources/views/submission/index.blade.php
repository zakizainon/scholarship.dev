{{-- <x-app-layout :user=$user> --}}

    <x-app-layout :user="Auth::user()">

    @if ($user->role == 'admin')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
                    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css"> -->
                    <link rel="stylesheet"
                        href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
                    <link rel="stylesheet"
                        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
                    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

                    <style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            background-color: white;
                            border-radius: 12px;
                            overflow: hidden;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        }

                        thead {
                            background-color: #f8f9fa;
                            color: #212529;
                            text-align: left;
                        }

                        th,
                        td {
                            padding: 10px 15px;
                            border-bottom: 1px solid #e9ecef;
                        }

                        tbody tr:hover {
                            background-color: #f1f1f1;
                        }

                        .dt-button-collection {
                            min-width: 200px;
                            padding: 10px;
                            border-radius: 20px;
                            /* Rounded corners */
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                            background-color: white;
                            /* White background */
                            border: 1px solid #ccc;
                            /* Light border */
                        }

                        .dt-button-collection .dt-button {
                            display: flex;
                            align-items: center;
                            padding: 8px 12px;
                            border: none;
                            border-radius: 30px;
                            /* Rounded corners */
                            background-color: white;
                            /* White background for buttons */
                            transition: background-color 0.3s ease;
                        }

                        .dt-button-collection .dt-button:hover {
                            background-color: #f1f1f1;
                            /* Light gray hover effect */
                        }

                        .dt-button-collection .dt-button i {
                            margin-right: 8px;
                            font-size: 1rem;
                            transition: color 0.3s ease;
                        }

                        /* Color for individual icons */
                        .dt-button-collection .dt-button i.fas.fa-copy {
                            color: #6c757d;
                            /* Gray for Copy */
                        }

                        .dt-button-collection .dt-button i.fas.fa-print {
                            color: #007bff;
                            /* Blue for Print */
                        }

                        .dt-button-collection .dt-button i.fas.fa-file-excel {
                            color: #28a745;
                            /* Green for Excel */
                        }

                        .dt-button-collection .dt-button i.fas.fa-file-csv {
                            color: #17a2b8;
                            /* Teal for CSV */
                        }

                        .dt-button-collection .dt-button i.fas.fa-file-pdf {
                            color: #dc3545;
                            /* Red for PDF */
                        }

                        /* Added by Zaki: 25th Nov 2024 */
                        .dt-lengthsize {
                            width: 70px;
                        }
                    </style>

                        <div class="overflow-x-auto">

                        <!-- <table id="applicantTable" class="min-w-full table-auto border-collapse"> -->
                        <table id="applicantTable" class="min-w-full">
                            <thead
                                class="bg-white border-b border-gray-200 dark:bg-neutral-800 dark:border-neutral-700">
                                <tr>
                                    <th class="border-b border-gray-300 py-3 px-6 text-left">Status</th>
                                    <th class="border-b border-gray-300 py-3 px-6 text-left">Name</th>
                                    <th class="border-b border-gray-300 py-3 px-6 text-left">MyKad</th>
                                    <th class="border-b border-gray-300 hidden">Email</th>
                                    <th class="border-b border-gray-300 hidden">Age</th>
                                    <th class="border-b border-gray-300">Race</th>
                                    <th class="border-b border-gray-300 hidden">Nationality</th>
                                    <th class="border-b border-gray-300 hidden">Birth State</th>
                                    <th class="border-b border-gray-300">Gender</th>
                                    <th class="border-b border-gray-300 hidden">Marital Status</th>
                                    <th class="border-b border-gray-300 hidden">House Phone</th>
                                    <th class="border-b border-gray-300 hidden">Mobile Phone</th>
                                    <th class="border-b border-gray-300 hidden">Permanent Address</th>
                                    <th class="border-b border-gray-300 hidden">Permanent Postcode</th>
                                    <th class="border-b border-gray-300 hidden">Permanent City</th>
                                    <th class="border-b border-gray-300 hidden">Permanent State</th>
                                    <th class="border-b border-gray-300 hidden">Emergency Phone</th>
                                    <th class="border-b border-gray-300 hidden">Emergency Name</th>
                                    <th class="border-b border-gray-300 hidden">Relationship</th>
                                    <th class="border-b border-gray-300 hidden">Emergency Address</th>
                                    <th class="border-b border-gray-300 hidden">Emergency Postcode</th>
                                    <th class="border-b border-gray-300 hidden">Emergency City</th>
                                    <th class="border-b border-gray-300 hidden">Emergency State</th>
                                    <th class="border-b border-gray-300 hidden">Emergency Country</th>
                                    <th class="border-b border-gray-300 hidden">Level of Study</th>
                                    <th class="border-b border-gray-300 hidden">Course Name</th>
                                    <th class="border-b border-gray-300 hidden">University Name</th>
                                    <th class="border-b border-gray-300 hidden">University Country</th>
                                    <th class="border-b border-gray-300 hidden">Commencement Year</th>
                                    <th class="border-b border-gray-300 hidden">Completion Year</th>
                                    <th class="border-b border-gray-300">Result</th>
                                    <th class="border-b border-gray-300 hidden">Final score (Other than CGPA)</th>
                                    <th class="border-b border-gray-300 hidden">Any extention?</th>
                                    <th class="border-b border-gray-300 hidden">Yes/No</th>
                                    <th class="border-b border-gray-300 hidden">Personal Statement</th>
                                    <th class="border-b border-gray-300 hidden">Skill and Extracurricular</th>
                                    <th class="border-b border-gray-300 hidden">Extracurricular Activities</th>
                                    <th class="border-b border-gray-300 hidden">Employment Status</th>
                                    {{-- <th class="border-b border-gray-300 hidden">Employer Type</th> --}}
                                    <th class="border-b border-gray-300 hidden">Employer Name</th>
                                    <th class="border-b border-gray-300 hidden">Employer Address</th>
                                    <th class="border-b border-gray-300 hidden">Office Phone</th>
                                    <th class="border-b border-gray-300 hidden">Position</th>
                                    <th class="border-b border-gray-300 hidden">Salary</th>
                                    <th class="border-b border-gray-300 hidden">Applied Level of Study</th>
                                    <th class="border-b border-gray-300 hidden">Major study</th>
                                    <th class="border-b border-gray-300">Applied Course Title</th>
                                    <th class="border-b border-gray-300">University</th>
                                    <th class="border-b border-gray-300 hidden">Study Mode</th>
                                    <th class="border-b border-gray-300 hidden">Start date</th>
                                    <th class="border-b border-gray-300 hidden">End date</th>
                                    <th class="border-b border-gray-300 hidden">Study Period</th>
                                    <th class="border-b border-gray-300 hidden">Research Proposal Summary</th>
                                    <th class="border-b border-gray-300 hidden">Latest Semester Result (CGPA)</th>
                                    <th class="border-b border-gray-300 hidden">Latest Semester Result (Other than CGPA)</th>
                                    <th class="border-b border-gray-300 hidden">1. I have no chronic illnesses, infectious diseases, or conditions requiring follow-up treatment.</th>
                                    <th class="border-b border-gray-300 hidden">2. I have no psychiatric condition requiring follow-up treatment.</th>
                                    <th class="border-b border-gray-300 hidden">3. I have not been terminated by any sponsor for disciplinary action.</th>
                                    <th class="border-b border-gray-300 hidden">4. I have never committed any criminal offences and being charged at any court in Malaysia.</th>
                                    <th class="border-b border-gray-300 hidden">5. I have no other scholarships/loans for the same level of study applied.</th>
                                    <th class="border-b border-gray-300 hidden">6. I hereby consent to and conscientiously declare that YTI reserves the right to decline the application or withdraw
                                    sponsorship awarded at any time should any of the information provided are false.</th>
                                    <th class="border-b border-gray-300 hidden">7. I hereby undertake and agree to comply with all the terms and conditions set forth by YTI at any time.</th>
                                    <th class="border-b border-gray-300 hidden">8. I hereby declare in good faith that all information provided in this form are true.</th>
                                    <th class="border-b border-gray-300 hidden">9. I am committed to return to Malaysia after completing my studies and contribute to the country’s development.</th>
                                    <th class="border-b border-gray-300 hidden">1. By submitting and signing this Declaration, I hereby agree and consent that YTI may collect, obtain, store and
                                    process my personal date which I provide in this Declaration for the purposes of processing this sponsorship application
                                    in accordance with the relevant provisions on personal data.</th>
                                    <th class="border-b border-gray-300 hidden">2. I hereby agree and consent that YTI may:
                                    -Store and process my personal data for the purpose of verification and consideration of this sponsorship application;
                                    and/or declare, supply and/or submit my personal data to the relevant Government authorities or third parties, as required by
                                    law.</th>
                                    <th class="border-b border-gray-300 hidden">3. I hereby agree that all the above is true and it has been accurately recorded.
                                    In the event of any fraud and/or inaccuracy of the information even if it is unintentionally provided while signing this
                                    Declaration, YTI reserves the right to reject this application or terminate my sponsorship at any time, even if the
                                    offer has been awarded.</th>
                                    <th class="border-b border-gray-300 hidden">User ID</th>
                                    <th class="border-b border-gray-300">Time Stamp</th>

                                    <!-- <th class="border-b border-gray-300 text-end">Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr class="border-b border-gray-50">
                                    <td class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{$item->status}}</td>
                                    <td class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{$item->name}}</td>
                                    <td class="px-4 py-2 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{$item->mykad}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->email}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->age}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{$item->race}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->nationality}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->birthstate}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{$item->gender}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->maritalstatus}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->housephone}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->mobilephone}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->permanentaddress}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->permanentpostcode}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->permanentcity}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->permanentstate}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->emergencyphone}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->emergencyname}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->relationship}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->emergencyaddress}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->emergencypostcode}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->emergencycity}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->emergencystate}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                            {{$item->emergencycountry}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->studylevel}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->coursename}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-20 hidden">
                                        {{$item->universityname}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->universitycountry}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->commencementyear}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->completionyear}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{$item->result}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->resultother}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->studyextension}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->reasonextension}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->personalstatement}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->skillsandextracurricular}}</td>
                                    <td 
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->activityextra}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->employmentstatus}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->employername}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->employeraddress}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->officephone}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->position}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->salary}}</td>
                                    <td 
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->appliedlevelstudy}}</td>
                                    <td 
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->majorstudy}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{$item->appliedcoursetitle}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{$item->university}}</td>
                                    <td 
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->studymode}}</td>
                                    <td 
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->startdate}}</td>
                                    <td 
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->enddate}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->studyperiod}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->researchproposalsummary}}</td>
                                    <td 
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->cgpasemresult}}</td>
                                    <td 
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->othersemresult}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->declaration01}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->declaration02}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->declaration03}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->declaration04}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->declaration05}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->declaration06}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->declaration07}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->declaration08}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->declaration09}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->consent01}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->consent02}}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->consent03}}</td>
                                    
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200 hidden">
                                        {{$item->user_id}}</td>
                                    <td
                                        class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{$item->updated_at}}</td>
                                    <!-- <td class="px-4 py-2 text-end">
                                        <button type="button" class="text-blue-600">Delete</button>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Updated DataTable Initialization Script -->
    <script>
        $(document).ready(function () {
        $('#applicantTable').DataTable({

            dom: '<"top row"<"col-md-6 d-flex align-items-center"l><"col-md-6 text-end"fB>>rt<"bottom"ip><"clear">',
                
            buttons: [
                {
                    extend: 'collection',
                    text: '<i class="fas fa-download"></i> Export',
                    // className: 'btn btn-white rounded-10', // Add class for round and white background
                    className: 'btn btn-white rounded-10 border border-gray-300 shadow-md', // White button with rounded corners
                    buttons: [
                        {
                            extend: 'copy',
                            text: '<i class="fas fa-copy" style="color: #6c757d;"></i> Copy',
                            className: 'btn btn-secondary rounded-10',
                            exportOptions: {
                            //    columns: ':visible, :hidden'', 
                            //    orthogonal: 'export'
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fas fa-file-excel" style="color: #28a745;"></i> Excel',
                            className: 'btn btn-secondary rounded-10',
                            exportOptions: {
                                columns: ':visible, .hidden'
                            }
                        },
                        {
                            extend: 'csv',
                            text: '<i class="fas fa-file-csv" style="color: #17a2b8;"></i> CSV',
                            className: 'btn btn-secondary rounded-10',
                            exportOptions: {
                                // columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="fas fa-file-pdf" style="color: #dc3545;"></i> PDF',
                            className: 'btn btn-secondary rounded-10',
                            exportOptions: {
                                // columns: ':visible'
                            },
                            customize: function (doc) {
                                doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                                doc.styles.tableHeader = {
                                    alignment: 'center',
                                    bold: true,
                                    fontSize: 12
                                };
                                doc.defaultStyle = {
                                    alignment: 'center',
                                    fontSize: 10
                                };
                                doc.pageMargins = [20, 20, 20, 20];
                                doc.content[1].margin = [0, 10, 0, 0];
                            }
                        }
                    ]
                }
            ],
            paging: true,
            searching: true, // Disable search box
            info: true, // Disable "Showing X of Y" info
            lengthMenu: [[10, 20, 50, 100, -1], [10, 20, 50, 100, 'All']],
            pageLength: 10,
            initComplete: function () {
                // var buttons = $('.dt-buttons');
                // buttons.addClass('d-inline-block'); 

                // buttons.addClass('text-center mt-3'); 
                // buttons.appendTo('.button-container');

                var lengthMenu = $('.dataTables_length');
                var buttons = $('.dt-buttons');
                // Add margin to create gap between elements
                lengthMenu.addClass('me-3', 'width'); // Adds margin between "Show entries" and buttons
                buttons.addClass('d-inline-block');
            }
        });

        $('div.dataTables_length select').addClass('dt-lengthsize');
    });


    </script>
    @else
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Unauthorized access! ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 gap-4 p-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-2">
                <div class="p-6 text-gray-900">
                    You don't have the permission to view this page.
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <span class="font-extrabold text-4xl text-indigo-900">24<span
                            style="position: relative; top: -0.8em; font-size: 50%;">th</span> November 2024</span>
                    The closing date for submission of the scholarship application
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>