{{-- <x-app-layout :user=$user> --}}
    <x-app-layout :user="Auth::user()">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
                <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 p-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2 text-gray-900">
                        <!-- Personal Information -->
                        <div>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Personal Information') }}
                                </h2>
                            </header>
                        </div>
                        <div class="grid grid-cols-12 gap-2 mb-2">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Full Name:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-600 dark:bg-neutral-600 dark:text-neutral-400 rounded-lg">
                                {{ $user->name ?? 'Not Applicable' }} 
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                MyKad Number:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $user->mykad ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Age:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->age ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Race:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                @if($application->race == 'others')
                                    {{ $application->other_race ?? 'Not provided' }}
                                @else
                                    {{ $application->race ?? 'Not provided' }}
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Nationality:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->nationality ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Birth State:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                @if($application->birthState == 'others')
                                    {{ $application->other_birthstate ?? 'Not provided' }}
                                @else
                                    {{ $application->birthstate ?? 'Not provided' }}
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Gender:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->gender ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Marital Status:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->maritalstatus ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                House Phone:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->housephone ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Mobile Phone:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->mobilephone ?? 'Not provided' }}
                            </div>
                        </div>
                        <!-- Permanent Address -->
                        <div>
                            <header>
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ __('Permanent Address') }}
                                </h3>
                            </header>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Permanent Address:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->permanentaddress ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Permanent City:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->permanentcity ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Permanent Postcode:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->permanentpostcode ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Permanent State:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->permanentstate ?? 'Not provided' }}
                            </div>
                        </div>
                        <!-- Emergency Contact -->
                        <div>
                            <header>
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ __('Emergency Contact') }}
                                </h3>
                            </header>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Emergency Name:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->emergencyname ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Relationship:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->relationship ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Phone Number:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->emergencyphone ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Emergency Address:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->emergencyaddress ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Emergency City:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->emergencycity ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Emergency Postcode:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->emergencypostcode ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Emergency State:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->emergencystate ?? 'Not provided' }}
                            </div>
                        </div>
                        <!-- Academic Qualifications -->
                        <div>
                            <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Academic Qualifications') }}
                                    </h2>
                                </header>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Course Name:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->coursename ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                University Name:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->universityname ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                University Country:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->universitycountry ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Commencement Year:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->commencementyear ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Completion Year:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->completionyear ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Result:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->result ?? 'Not provided' }}
                            </div>
                        </div>
                        <!-- Skills -->
                        <div>
                            <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Skills and Extra Curricullar Activities') }}
                                    </h2>
                                </header>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Personal Statement:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->personalstatement ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Skills and Extracurricular:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->skillsandextracurricular ?? 'Not provided' }}
                            </div>
                        </div>
                        <!-- Work Experience -->
                        <div>
                            <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Work Experiences') }}
                                    </h2>
                                </header>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Employement Status:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->employmentstatus ?? 'Not Applicable' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Employer Type:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->employertype ?? 'Not Applicable' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Employer Name:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->employername ?? 'Not Applicable' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Employer Address:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->employeraddress ?? 'Not Applicable' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Office Number:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->officephone ?? 'Not Applicable' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Position:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->position ?? 'Not Applicable' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Salary (RM):
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->salary ?? 'Not Applicable' }}
                            </div>
                        </div>
                        <!-- Study Information -->
                        <div>
                            <header>
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ __('Study Information') }}
                                    </h3>
                                </header>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Applied Course Title:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->appliedcoursetitle ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                University:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->university ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Mode of Study:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->studymode ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Start Date:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->startdate ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                End Date:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->enddate ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Period of Study:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->studyperiod ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Summary of Research Proposal:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->researchproposalsummary ?? 'Not provided' }}
                            </div>
                        </div>
                        <!-- Additional Document -->
                        <div>
                            <header>
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ __('Documents') }}
                                    </h3>
                                </header>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Mykad:
                            </div><!-- Mykad Document -->
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                @if($document->filetype == 'D01')
                                    {{ $document->filename ?? 'Not provided' }}
                                @else
                                    {{ 'Not provided' }}
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Passport:
                            </div><!-- Additional Document -->
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                @if($document->filetype == 'D02')
                                    {{ $document->filename ?? 'Not provided' }}
                                @else
                                    {{ 'Not provided' }}
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Academics Transcript:
                            </div><!-- Academics Transcript Document -->
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                @if($document->filetype == 'D03')
                                    {{ $document->filename ?? 'Not provided' }}
                                @else
                                    {{ 'Not provided' }}
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                University Offer Letter:
                            </div><!-- University Offer Letter Document -->
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                @if($document->filetype == 'D04')
                                    {{ $document->filename ?? 'Not provided' }}
                                @else
                                    {{ 'Not provided' }}
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Curriculum Vitae:
                            </div><!-- Curriculum Vitae Document -->
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                @if($document->filetype == 'D05')
                                    {{ $document->filename ?? 'Not provided' }}
                                @else
                                    {{ 'Not provided' }}
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Proof of Employment:
                            </div><!-- Proof of Employment Document -->
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                @if($document->filetype == 'D06')
                                    {{ $document->filename ?? 'Not provided' }}
                                @else
                                    {{'Not provided' }}
                                @endif
                            </div>
                        </div>
                        <!-- Declaration -->
                        <div>
                            <header>
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ __('Declaration') }}
                                    </h3>
                                </header>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Declaration 1:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->declaration01 ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Declaration 2:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->declaration02 ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Declaration 3:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->declaration03 ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Declaration 4:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->declaration04 ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Declaration 5:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->declaration05 ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Declaration 6:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->declaration06 ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Declaration 7:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->declaration07 ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Declaration 8:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->declaration08 ?? 'Not provided' }}
                            </div>
                        </div>
                        <!-- Consent -->
                        <div>
                            <header>
                                    <h4 class="text-lg font-medium text-gray-900">
                                        {{ __('Consent') }}
                                    </h4>
                                </header>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Consent 1:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->consent01 ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Consent 2:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->consent02 ?? 'Not provided' }}
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-3 text-gray-700 font-semibold p-2" style="text-align: right">
                                Consent 3:
                            </div>
                            <div class="col-span-9 bg-gray-100 p-2 text-gray-900 dark:bg-neutral-900 dark:text-neutral-400 rounded-lg">
                                {{ $application->consent03 ?? 'Not provided' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>