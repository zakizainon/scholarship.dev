<x-app-layout :user=$user>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{-- Application Form for  --}}
            @if(Session::has('name'))
                <h2>Scholarship Application: {{ Session::get('name') }}</h2>
            @else
                <h2>No Active Scholarship Available</h2>
            @endif
        </h2>
    </x-slot>

   

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="pt-3 pl-3 pr-3 pb-0 text-gray-900">
                    <div class="hidden">
                        {{-- Check for status when creating new record --}}
                        @if (isset($application->status))
                            {{ $appStatus = $application->status; }}
                        @else 
                            {{ $appStatus = "draft"; }}
                        @endif

                        <input type="text" id="appStatus" name="appStatus" value="{{ $appStatus }}" class="hidden" />
                    </div>
                    {{-- <input type="text" id="appStatus" name="appStatus" value="{{ $appStatus }}" class="hidden" /> --}}
                    @if ($appStatus == "complete")
                    <div class="bg-blue-100 border border-blue-200 text-gray-800 rounded-lg p-4 mb-5 dark:bg-blue-800/10 dark:border-blue-900 dark:text-white"
                        role="alert" tabindex="-1" aria-labelledby="hs-actions-label">
                        <div class="flex">
                            <div class="shrink-0">
                                <svg class="shrink-0 size-4 mt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M12 16v-4"></path>
                                    <path d="M12 8h.01"></path>
                                </svg>
                            </div>
                            <div class="ms-3">
                                <h3 id="hs-actions-label" class="font-semibold">
                                    Your application have been submitted.
                                </h3>
                                <div class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                                    Your application have been submitted and you can no longer perform any updates or make any changes to your application.<br />
                                    Only shortlisted candidate will be notified by YTI.
                                </div>
                                {{-- <div class="mt-4">
                                    <div class="flex gap-x-3">
                                        <button type="button"
                                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">
                                            Don't allow
                                        </button>
                                        <button type="button"
                                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">
                                            Allow
                                        </button>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    @endif

                    
                    <!-- Tabbed Form -->
                    <select id="tab-select" class="sm:hidden py-3 px-4 pe-9 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400" aria-label="Tabs">
                        <option value="#hs-tab-to-select-1">Personal</option>
                        <option value="#hs-tab-to-select-10">Guardian</option>
                        <option value="#hs-tab-to-select-2">Academics</option>
                        <option value="#hs-tab-to-select-3">SPM</option>
                        <option value="#hs-tab-to-select-4">Skills</option>
                        <option value="#hs-tab-to-select-5">Employment Information</option>
                        <option value="#hs-tab-to-select-6">Field of Study</option>
                        <option value="#hs-tab-to-select-7">Document</option>
                        <option value="#hs-tab-to-select-8">Declaration</option>
                        <option value="#hs-tab-to-select-9">Consent</option>
                        <option value="#hs-tab-to-select-intro">Introduction</option><!--0-->
                    </select>

                    <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700">
                        {{-- Form's Tab --}}
                        <?php
                            // Default all flags to "hidden" first
                            $personalflag       = "hidden";
                            $parentdetailsflag  = "hidden";
                            $academicsflag      = "hidden";
                            $spmflag            = "hidden";
                            $skillsflag         = "hidden";
                            $experienceflag     = "hidden";
                            $studyflag          = "hidden";
                            $documentflag       = "hidden";
                            $declarationflag    = "hidden";
                            $consentflag        = "hidden";

                            // Check which tabs should be visible
                            if (Session::get('tab01') == "1") {
                                $personalflag = "";
                            }if (Session::get('tab10') == "1") {
                                $parentdetailsflag = "";
                            }if (Session::get('tab02') == "1") {
                                $academicsflag = "";
                            }if (Session::get('tab03') == "1") {
                                $spmflag = "";
                            }if (Session::get('tab04') == "1") {
                                $skillsflag = "";
                            }if (Session::get('tab05') == "1") {
                                $experienceflag = "";
                            }if (Session::get('tab06') == "1") {
                                $studyflag = "";
                            }if (Session::get('tab07') == "1") {
                                $documentflag = "";
                            }if (Session::get('tab08') == "1") {
                                $declarationflag = "";
                            }if (Session::get('tab09') == "1") {
                                $consentflag = "";
                            }
                            // if (Session::get('tab01') == "1") {
                            //     $personalflag =  "";
                            // }elseif (Session::get('tab10') == "1"){
                            //     $parentdetailsflag =  "";
                            // }elseif (Session::get('tab02') == "1") {
                            //     $academicsflag =  "";
                            // }elseif (Session::get('tab03') == "1") {
                            //     $spmflag =  "";
                            // }elseif (Session::get('tab04') == "1") {
                            //     $skillsflag =  "";
                            // }elseif (Session::get('tab05') == "1") {
                            //     $experienceflag =  "";
                            // }else
                            //     $personalflag = "hidden";
                            //     $parentdetailsflag = "hidden"; $academicsflag = "hidden"; $spmflag = "hidden"; $skillsflag = "hidden"; $experienceflag = "hidden";
                        ?>
                        <nav class="flex gap-x-2" aria-label="Tabs" role="tablist" data-hs-tab-select="#tab-select">
                            <button type="button"
                                class="hs-tab-active:bg-white hs-tab-active:border-b-transparent {{ $step == 'introduction' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-intro" aria-selected="{{ $step == 'introduction' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-intro"
                                aria-controls="hs-tab-to-select-intro" role="tab">
                                Introduction
                            </button>
                            <button type="button"
                                class="hs-tab-active:bg-white {{ $personalflag }} hs-tab-active:border-b-transparent {{ $step == 'personal' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-1" aria-selected="{{ $step == 'personal' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-1"
                                aria-controls="hs-tab-to-select-1" role="tab">
                                Personal
                                @if (isset($application->user_id))
                                @if ($application->tab01 == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                    <path d="m9 11 3 3L22 4" />
                                </svg>
                                @endif
                                @endif
                            </button>
                            <button type="button"
                                class="hs-tab-active:bg-white {{ $parentdetailsflag }} hs-tab-active:border-b-transparent {{ $step == 'parentdetails' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-10" aria-selected="{{ $step == 'parentdetails' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-10"
                                aria-controls="hs-tab-to-select-10" role="tab">
                                Guardian
                                @if (isset($application->user_id))
                                @if ($application->tab10 == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                    <path d="m9 11 3 3L22 4" />
                                </svg>
                                @endif
                                @endif
                            </button>
                            <button type="button"
                                class="hs-tab-active:bg-white {{ $academicsflag }} hs-tab-active:border-b-transparent {{ $step == 'academic' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-2" aria-selected="{{ $step == 'academic' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-2"
                                aria-controls="hs-tab-to-select-2" role="tab">
                                Qualification
                                @if (isset($application->user_id))
                                @if ($application->tab02 == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                    <path d="m9 11 3 3L22 4" />
                                </svg>
                                @endif
                                @endif
                            </button>
                            <button type="button"
                                class="hs-tab-active:bg-white {{$spmflag}} hs-tab-active:border-b-transparent {{ $step == 'spm_results' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-3" aria-selected="{{ $step == 'spm_results' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-3"
                                aria-controls="hs-tab-to-select-3" role="tab">
                                SPM
                                @if (isset($application->user_id))
                                    @if ($application->tab03 == 1)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                        <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                        <path d="m9 11 3 3L22 4" />
                                    </svg>
                                    @endif
                                @endif
                            </button>
                            <button type="button"
                                class="hs-tab-active:bg-white {{ $skillsflag }} hs-tab-active:border-b-transparent {{ $step == 'skill' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-4" aria-selected="{{ $step == 'skill' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-4"
                                aria-controls="hs-tab-to-select-4" role="tab">
                                Skills
                                @if (isset($application->user_id))
                                @if ($application->tab04 == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                    <path d="m9 11 3 3L22 4" />
                                </svg>
                                @endif
                                @endif
                            </button>
                            <button type="button"
                                class="hs-tab-active:bg-white {{ $experienceflag }} hs-tab-active:border-b-transparent {{ $step == 'experience' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-5" aria-selected="{{ $step == 'experience' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-5"
                                aria-controls="hs-tab-to-select-5" role="tab">
                                Employment Information
                                @if (isset($application->user_id))
                                @if ($application->tab05 == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                    <path d="m9 11 3 3L22 4" />
                                </svg>
                                @endif
                                @endif
                            </button>
                            <button type="button"
                                class="hs-tab-active:bg-white {{ $studyflag }} hs-tab-active:border-b-transparent {{ $step == 'study' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-6" aria-selected="{{ $step == 'study' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-6"
                                aria-controls="hs-tab-to-select-6" role="tab">
                                Field of Study
                                @if (isset($application->user_id))
                                @if ($application->tab06 == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                    <path d="m9 11 3 3L22 4" />
                                </svg>
                                @endif
                                @endif
                            </button>
                            <button type="button"
                                class="hs-tab-active:bg-white {{ $documentflag }} hs-tab-active:border-b-transparent {{ $step == 'document' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-7" aria-selected="{{ $step == 'document' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-7"
                                aria-controls="hs-tab-to-select-7" role="tab">
                                Documents
                                @if (isset($application->user_id))
                                @if ($application->tab07 == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                    <path d="m9 11 3 3L22 4" />
                                </svg>
                                @endif
                                @endif
                            </button>
                            <button type="button"
                                class="hs-tab-active:bg-white {{ $declarationflag }} hs-tab-active:border-b-transparent {{ $step == 'declaration' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-8" aria-selected="{{ $step == 'declaration' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-8"
                                aria-controls="hs-tab-to-select-8" role="tab">
                                Declaration
                                @if (isset($application->user_id))
                                @if ($application->tab08 == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                    <path d="m9 11 3 3L22 4" />
                                </svg>
                                @endif
                                @endif
                            </button>
                            <button type="button"
                                class="hs-tab-active:bg-white {{ $consentflag }} hs-tab-active:border-b-transparent {{ $step == 'consent' ? 'active' : '' }} hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-3 px-4 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-medium text-center border text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-none focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200"
                                id="hs-tab-to-select-item-9" aria-selected="{{ $step == 'consent' ? 'true' : 'false' }}" data-hs-tab="#hs-tab-to-select-9"
                                aria-controls="hs-tab-to-select-9" role="tab">
                                Consent
                                @if (isset($application->user_id))
                                @if ($application->tab09 == 1)
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                    <path d="m9 11 3 3L22 4" />
                                </svg>
                                @endif
                                @endif
                            </button>
                            
                    </div>
                </div>

                <div class="mt-3">
                    <div id="hs-tab-to-select-intro" class="{{ $step == 'introduction' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-intro">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">

                            <div class="flex flex-col dark:bg-neutral-800 dark:border-neutral-700">
                                <div class="mt-6 ml-3">
                                    <div class="bg-gray-100 p-6 rounded-lg dark:bg-neutral-700">
                                        <h2 class="text-lg font-bold">Eligibility Criteria</h2>
                                        <p class="mt-2">
                                            Application is only open to candidates who have <strong>received an unconditional offer</strong> 
                                            to pursue or is currently pursuing a full-time postgraduate Master's Degree/PhD programme 
                                            this year from selected universities as listed below:
                                        </p>
                                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
                                            <div>
                                                <h3 class="font-semibold">1. United Kingdom (UK)</h3>
                                                <ul class="list-disc ml-5">
                                                    <li>Oxford University</li>
                                                    <li>University of Cambridge</li>
                                                    <li>Imperial College London</li>
                                                    <li>University College London</li>
                                                    <li>University of Edinburgh</li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold">2. United States (US)</h3>
                                                <ul class="list-disc ml-5">
                                                    <li>Stanford University</li>
                                                    <li>Massachusetts Institute of Technology</li>
                                                    <li>Harvard University</li>
                                                    <li>Princeton University</li>
                                                    <li>California Institute of Technology</li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold">3. Europe</h3>
                                                <ul class="list-disc ml-5">
                                                    <li>ETH Zurich, Switzerland</li>
                                                    <li>Technical University of Munich, Germany</li>
                                                    <li>École Polytechnique Fédérale de Lausanne, Switzerland</li>
                                                    <li>LMU Munich, Germany</li>
                                                    <li>Paris Sciences et Lettres – PSL Research University Paris, France</li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold">4. China</h3>
                                                <ul class="list-disc ml-5">
                                                    <li>Tsinghua University, China</li>
                                                    <li>Peking University, China</li>
                                                    <li>Shanghai Jiao Tong University, China</li>
                                                    <li>Fudan University, China</li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold">5. Japan</h3>
                                                <ul class="list-disc ml-5">
                                                    <li>The University of Tokyo, Japan</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <h2 class="text-lg font-bold mt-6">Other Eligibility Criteria</h2>
                                        <ul class="list-disc ml-5 mt-2">
                                            <li>Malaysian citizens</li>
                                            <li>Minimum bachelor's degree results - CGPA of 3.75 or first class or equivalent</li>
                                            <li>Obtained excellent results in SPM and A-Level/Foundation exam</li>
                                            <li>Age not exceeding 35 years old in the year of application</li>
                                        </ul>
                                        <h2 class="text-lg font-bold mt-6">Additional Criteria</h2>
                                        <ul class="list-disc ml-5 mt-2">
                                            <li>Must have at least 9 months remaining in the study period if it has already started.</li>
                                            <li>All-rounders with leadership potential and a record of contribution to society.</li>
                                            <li>Must not presently hold other scholarships/loans for the same level of study.</li>
                                            <li>Commitment to return to Malaysia after completing the studies and contribute to the country’s development.</li>
                                            <li>Program Equivalency: Master's program must not be rated as equivalent to a Bachelor's degree for public service appointments. (Example: M. Eng. UK)</li>
                                        </ul>
                                        <h2 class="text-lg font-bold mt-6">Instructions</h2>
                                        <ol class="list-decimal ml-5 mt-2">
                                            <li>Please complete all the details.</li>
                                            <li>The form can be saved as a draft in every section.</li>
                                            <li>PNB reserves the right to reject any incomplete or false application at any time.</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hs-tab-to-select-1" class="{{ $step == 'personal' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-1">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">
                            <div class="flex flex-col  dark:bg-neutral-800 dark:border-neutral-700">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Personal Information') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __("Applicant's personal information with a valid contact details.") }}
                                    </p>
                                </header>
                                <div class="mt-6 ml-3">
                                    <form id="personalForm" name="personalForm" method="POST" action="{{ route('apply.post', ['step' => 'personal']) }}">
                                        @csrf
                                        <div class="relative w-full md:w-1/3 mb-2">
                                            <input type="text" id="hs-floating-input-name" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                        focus:pt-6
                                                                        focus:pb-2
                                                                        [&:not(:placeholder-shown)]:pt-6
                                                                        [&:not(:placeholder-shown)]:pb-2
                                                                        autofill:pt-6
                                                                        autofill:pb-2" placeholder="Full Name"
                                                readonly="" value="{{ Auth::User()->name }}">
                                            <label for="hs-floating-input-name"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0]  peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                        peer-focus:scale-90
                                                                        peer-focus:translate-x-0.5
                                                                        peer-focus:-translate-y-1.5
                                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">                                                                  
                                                                        Full Name</label>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500 ml-3"
                                            id="hs-input-helper-text">Name cannot be edited. Use your profile page to
                                            update your Full Name.
                                        </p>

                                        <!--MyKad Formatting-->
                                        @php
                                            $mykad = Auth::user()->mykad ?? '';
                                            // Format MyKad to ensure "XXXXXX-XX-XXXX"
                                            if (preg_match('/^(\d{6})(\d{2})(\d{4})$/', $mykad, $matches)) {
                                                $formattedMyKad = "{$matches[1]}-{$matches[2]}-{$matches[3]}";
                                            } else {
                                                $formattedMyKad = $mykad; // In case it's already formatted or invalid
                                            }
                                        @endphp

                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <input type="text" id="hs-floating-input-mykad"
                                                class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6 focus:pb-2 [&:not(:placeholder-shown)]:pt-6 [&:not(:placeholder-shown)]:pb-2 autofill:pt-6 autofill:pb-2"
                                                placeholder="990101-10-5205"
                                                readonly value="{{ $formattedMyKad }}">
                                            <label for="hs-floating-input-mykad"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90 peer-focus:translate-x-0.5 peer-focus:-translate-y-1.5 peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90 peer-[:not(:placeholder-shown)]:translate-x-0.5 peer-[:not(:placeholder-shown)]:-translate-y-1.5 peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                                MyKad Number
                                            </label>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500 ml-3"
                                            id="hs-input-helper-text">We'll never share your MyKad details. MyKad
                                            Number cannot be edited. 
                                            {{-- Use your profile page to update your MyKad Number --}}
                                        </p>

                                        <div class="mt-2 relative w-full md:w-1/12">
                                            <input type="text" inputmode="numeric" required pattern="[0-9]+"  id="hs-floating-input-age" 
                                                class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 
                                                        disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                                                        dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2"
                                                value="{{ (old('age') != null) ? old('age') : $application->age ?? '' }}"
                                                name="age" maxlength="2">

                                            <label for="hs-floating-input-age"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                        peer-focus:scale-90
                                                                        peer-focus:translate-x-0.5
                                                                        peer-focus:-translate-y-1.5
                                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Age</label>

                                        </div>
                                        @error('age')
                                        <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
                                        @enderror
                                        @if($errors->has('age'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('age') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/4">
                                            <!-- Select -->                                            
                                            <select id="race-select" data-hs-select='{"placeholder": "Select race...",
                                                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                                                    }' class="hidden" name="race">
                                                <option value="">Select your race</option>
                                                <option value="B01" {{ old('race') == 'B01' ? 'selected' : (isset($application->race) ? $application->race == 'B01' ? 'selected' : '' : '' )}}>Malay</option>
                                                <option value="B02" {{ old('race') == 'B02' ? 'selected' : (isset($application->race) ? $application->race == 'B02' ? 'selected' : '' : '' )}}>Chinese</option>
                                                <option value="B03" {{ old('race') == 'B03' ? 'selected' : (isset($application->race) ? $application->race == 'B03' ? 'selected' : '' : '' )}}>Indian</option>
                                                <option value="B04" {{ old('race') == 'B04' ? 'selected' : (isset($application->race) ? $application->race == 'B04' ? 'selected' : '' : '' )}}>Bumiputera Sabah</option>
                                                <option value="B05" {{ old('race') == 'B05' ? 'selected' : (isset($application->race) ? $application->race == 'B05' ? 'selected' : '' : '' )}}>Bumiputera Sarawak</option>
                                                <option value="others" {{ old('race')=='others' ? 'selected' : (isset($application->race) ? $application->race == 'others' ? 'selected' : '' : '' )}}>Others</option>
                                            </select>
                                            <!-- End Select -->
                                            <!-- Input field for Other Race, hidden by default -->
                                            <div id="other-race-field" class="mt-2 hidden">
                                                <input type="text" name="other_race" class="w-full border border-gray-300 rounded-lg py-2 px-4 text-sm" placeholder="Please specify your race / ethnics" />
                                            </div>
                                        </div>
                                        @if($errors->has('race'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('race') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/4">
                                            <!-- Select -->
                                            <select data-hs-select='{
                                                                        "placeholder": "Select nationality...",
                                                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                                        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                                                        }' class="hidden" name="nationality">
                                                <option value="">Select your nationality</option>
                                                <option value="01" {{ old('nationality') == '01' ? 'selected' : (isset($application->nationality) ? $application->nationality == '01' ? 'selected' : '' : '' )}}>Malaysian</option>
                                                <option value="02" {{ old('nationality') == '02' ? 'selected' : (isset($application->nationality) ? $application->nationality == '02' ? 'selected' : '' : '' )}}>Non-Malaysian</option>
                                            </select>
                                            <!-- End Select -->
                                        </div>
                                        @if($errors->has('nationality'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('nationality') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!-- Select -->
                                            <select id="birthstate-select" data-hs-select='{
                                                            "placeholder": "Select birth state...",
                                                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                                }' class="hidden" value="" name="birthstate">>
                                                <option value="">Select your birth state</option>
                                                <option value="MYS01" {{ old('birthstate') == 'MYS01' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS01' ? 'selected' : '' : '' )}}>Johor</option>
                                                <option value="MYS02" {{ old('birthstate') == 'MYS02' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS02' ? 'selected' : '' : '' )}}>Kedah</option>
                                                <option value="MYS03" {{ old('birthstate') == 'MYS03' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS03' ? 'selected' : '' : '' )}}>Kelantan</option>
                                                <option value="MYS04" {{ old('birthstate') == 'MYS04' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS04' ? 'selected' : '' : '' )}}>Malacca</option>
                                                <option value="MYS05" {{ old('birthstate') == 'MYS05' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS05' ? 'selected' : '' : '' )}}>Negeri Sembilan</option>
                                                <option value="MYS06" {{ old('birthstate') == 'MYS06' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS06' ? 'selected' : '' : '' )}}>Pahang</option>
                                                <option value="MYS07" {{ old('birthstate') == 'MYS07' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS07' ? 'selected' : '' : '' )}}>Penang</option>
                                                <option value="MYS08" {{ old('birthstate') == 'MYS08' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS08' ? 'selected' : '' : '' )}}>Perak</option>
                                                <option value="MYS09" {{ old('birthstate') == 'MYS09' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS09' ? 'selected' : '' : '' )}}>Perlis</option>
                                                <option value="MYS10" {{ old('birthstate') == 'MYS10' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS10' ? 'selected' : '' : '' )}}>Sabah</option>
                                                <option value="MYS11" {{ old('birthstate') == 'MYS11' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS11' ? 'selected' : '' : '' )}}>Sarawak</option>
                                                <option value="MYS12" {{ old('birthstate') == 'MYS12' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS12' ? 'selected' : '' : '' )}}>Selangor</option>
                                                <option value="MYS13" {{ old('birthstate') == 'MYS13' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS13' ? 'selected' : '' : '' )}}>Terengganu</option>
                                                <option value="MYS14" {{ old('birthstate') == 'MYS14' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS14' ? 'selected' : '' : '' )}}>Wilayah Persekutuan Labuan</option>
                                                <option value="MYS15" {{ old('birthstate') == 'MYS15' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS15' ? 'selected' : '' : '' )}}>Wilayah Persekutuan Kuala Lumpur</option>
                                                <option value="MYS16" {{ old('birthstate') == 'MYS16' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'MYS16' ? 'selected' : '' : '' )}}>Wilayah Persekutuan Putrajaya</option>
                                                <option value="others" {{ old('birthstate')=='others' ? 'selected' : (isset($application->birthstate) ? $application->birthstate == 'others' ? 'selected' : '' : '' )}}>Others</option>
                                            </select>
                                            <!-- End Select -->
                                            <!-- Input field for Other state, hidden by default -->
                                            <div id="other-state-field" class="mt-2 hidden">
                                                <input type="text" name="other_birthstate" class="w-full border border-gray-300 rounded-lg py-2 px-4 text-sm" placeholder="Please specify your birth state">
                                            </div>
                                        </div>
                                        @if($errors->has('birthstate'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('birthstate') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/6">
                                            <!-- Select -->
                                            <select data-hs-select='{
                                                                        "placeholder": "Select gender...",
                                                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                                        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                                                        }' class="hidden" value="" name="gender">>
                                                <option value="">Select your gender</option>
                                                <option value="M" {{ old('gender') == 'M' ? 'selected' : (isset($application->gender) ? $application->gender == 'M' ? 'selected' : '' : '' )}}>Male</option>
                                                <option value="F" {{ old('gender') == 'F' ? 'selected' : (isset($application->gender) ? $application->gender == 'F' ? 'selected' : '' : '' )}}>Female</option>
                                            </select>
                                            <!-- End Select -->
                                        </div>
                                        @if($errors->has('gender'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('gender') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <!-- Select -->
                                            <select data-hs-select='{
                                                                        "placeholder": "Select marital status...",
                                                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                                        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                                                        }' class="hidden" value=""
                                                name="maritalstatus">>
                                                <option value="">Select your marital status</option>
                                                <option value="MS01" {{ old('maritalstatus') == 'MS01' ? 'selected' : (isset($application->maritalstatus) ? $application->maritalstatus == 'MS01' ? 'selected' : '' : '' )}}>Single</option>
                                                <option value="MS02" {{ old('maritalstatus') == 'MS02' ? 'selected' : (isset($application->maritalstatus) ? $application->maritalstatus == 'MS02' ? 'selected' : '' : '' )}}>Married</option>
                                                <option value="MS03" {{ old('maritalstatus') == 'MS03' ? 'selected' : (isset($application->maritalstatus) ? $application->maritalstatus == 'MS03' ? 'selected' : '' : '' )}}>Divorced</option>
                                                <option value="MS04" {{ old('maritalstatus') == 'MS03' ? 'selected' : (isset($application->maritalstatus) ? $application->maritalstatus == 'MS04' ? 'selected' : '' : '' )}}>Widowed</option>
                                            </select>
                                            <!-- End Select -->
                                        </div>
                                        @if($errors->has('maritalstatus'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('maritalstatus') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <input type="text" id="hs-floating-input-housephone" class="phone-format peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2" placeholder="" name="housephone"
                                                value="{{ (old('housephone') != null) ? old('housephone') : $application->housephone ?? '' }}">
                                            <label for="hs-floating-input-housephone"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">House
                                                Phone</label>
                                        </div>
                                        @if($errors->has('housephone'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('housephone') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <input type="text" id="hs-floating-input-mobilephone" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                focus:pt-6 focus:pb-2
                                                [&:not(:placeholder-shown)]:pt-6
                                                [&:not(:placeholder-shown)]:pb-2
                                                autofill:pt-6 autofill:pb-2" 
                                                placeholder="XXX-XXXXXXX or XXX-XXXXXXXX"
                                                value="{{ old('mobilephone') ?? $application->mobilephone ?? '' }}" 
                                                name="mobilephone">
                                            <label for="hs-floating-input-mobilephone"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent 
                                                origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                peer-focus:scale-90 peer-focus:translate-x-0.5 peer-focus:-translate-y-1.5 peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                peer-[:not(:placeholder-shown)]:scale-90 peer-[:not(:placeholder-shown)]:translate-x-0.5 
                                                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                                Mobile Phone
                                            </label>
                                        </div>
                                        @if($errors->has('mobilephone'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('mobilephone') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <input type="text" id="hs-floating-input-email" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                        focus:pt-6
                                                                        focus:pb-2
                                                                        [&:not(:placeholder-shown)]:pt-6
                                                                        [&:not(:placeholder-shown)]:pb-2
                                                                        autofill:pt-6
                                                                        autofill:pb-2" placeholder="Email Address"
                                                readonly="" value="{{ Auth::User()->email }}">
                                            <label for="hs-floating-input-email"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0]  peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                        peer-focus:scale-90
                                                                        peer-focus:translate-x-0.5
                                                                        peer-focus:-translate-y-1.5
                                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                    Email Address</label>
                                        </div>

                                        <div class="mt-4 -ml-4">
                                            <header>
                                                <h3 class="text-lg font-medium text-gray-900">
                                                    {{ __('Permanent Address') }}
                                                </h3>

                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ __("Permanent address for official business corresponding.") }}
                                                </p>
                                            </header>
                                        </div>

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <textarea id="hs-floating-input-permanentaddress" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2
                                                        height: h-32" placeholder=""
                                                name="permanentaddress" style="text-transform: capitalize;">{{ (old('permanentaddress') != null) ? old('permanentaddress') : $application->permanentaddress ?? '' }}</textarea>
                                            <label for="hs-floating-input-permanentaddress"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Address</label>
                                        </div>
                                        @if($errors->has('permanentaddress'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('permanentaddress') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <input type="text" id="hs-floating-input-permanentcity" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('permanentcity') != null) ? old('permanentcity') : $application->permanentcity ?? '' }}"
                                                name="permanentcity" style="text-transform: capitalize;">
                                            <label for="hs-floating-input-permanentcity"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">City / Town</label>
                                        </div>
                                        @if($errors->has('permanentcity'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('permanentcity') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/6">
                                            <input type="text" id="hs-floating-input-permanentpostcode" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('permanentpostcode') != null) ? old('permanentpostcode') : $application->permanentpostcode ?? '' }}"
                                                name="permanentpostcode">
                                            <label for="hs-floating-input-permanentpostcode"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Postcode</label>
                                        </div>
                                        @if($errors->has('permanentpostcode'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('permanentpostcode') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!-- Select -->
                                            <select id="permanentstate-select" data-hs-select='{
                                                        "placeholder": "Select mailing state...",
                                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                        "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                        "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                        "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                        "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"}'
                                                class="hidden" value="" name="permanentstate">>
                                                <option value="">Select your mail state</option>
                                                <option value="MYS01" {{ old('permanentstate')=='MYS01' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS01' ? 'selected' : '' : '' )}}>Johor</option>
                                                <option value="MYS02" {{ old('permanentstate')=='MYS02' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS02' ? 'selected' : '' : '' )}}>Kedah</option>
                                                <option value="MYS03" {{ old('permanentstate')=='MYS03' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS03' ? 'selected' : '' : '' )}}>Kelantan</option>
                                                <option value="MYS04" {{ old('permanentstate')=='MYS04' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS04' ? 'selected' : '' : '' )}}>Malacca</option>
                                                <option value="MYS05" {{ old('permanentstate')=='MYS05' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS05' ? 'selected' : '' : '' )}}>Negeri Sembilan</option>
                                                <option value="MYS06" {{ old('permanentstate')=='MYS06' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS06' ? 'selected' : '' : '' )}}>Pahang</option>
                                                <option value="MYS07" {{ old('permanentstate')=='MYS07' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS07' ? 'selected' : '' : '' )}}>Penang</option>
                                                <option value="MYS08" {{ old('permanentstate')=='MYS08' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS08' ? 'selected' : '' : '' )}}>Perak</option>
                                                <option value="MYS09" {{ old('permanentstate')=='MYS09' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS09' ? 'selected' : '' : '' )}}>Perlis</option>
                                                <option value="MYS10" {{ old('permanentstate')=='MYS10' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS10' ? 'selected' : '' : '' )}}>Sabah</option>
                                                <option value="MYS11" {{ old('permanentstate')=='MYS11' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS11' ? 'selected' : '' : '' )}}>Sarawak</option>
                                                <option value="MYS12" {{ old('permanentstate')=='MYS12' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS12' ? 'selected' : '' : '' )}}>Selangor</option>
                                                <option value="MYS13" {{ old('permanentstate')=='MYS13' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS13' ? 'selected' : '' : '' )}}>Terengganu</option>
                                                <option value="MYS14" {{ old('permanentstate')=='MYS14' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS14' ? 'selected' : '' : '' )}}>Wilayah Persekutuan Labuan</option>
                                                <option value="MYS15" {{ old('permanentstate')=='MYS15' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS15' ? 'selected' : '' : '' )}}>Wilayah Persekutuan Kuala Lumpur</option>
                                                <option value="MYS16" {{ old('permanentstate')=='MYS16' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'MYS16' ? 'selected' : '' : '' )}}>Wilayah Persekutuan Putrajaya</option>
                                                <option value="others" {{ old('permanentstate')=='others' ? 'selected' : (isset($application->permanentstate) ? $application->permanentstate == 'others' ? 'selected' : '' : '' )}}>Others</option>
                                            </select>
                                            <!-- End Select -->
                                            <!-- Input field for Other state, hidden by default -->
                                            <div id="other-permanentstate-field" class="mt-2 hidden">
                                                <input type="text" name="other_permanentstate" class="w-full border border-gray-300 rounded-lg py-2 px-4 text-sm" placeholder="Please specify your state">
                                            </div>
                                        </div>
                                        @if($errors->has('permanentstate'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('permanentstate') }}</p>
                                        @endif

                                        <!--Permanent Country-->
                                        <div class="mt-2 relative w-full md:w-1/4">
                                            <input type="text" id="hs-floating-input-permanentcountry" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                    focus:pt-6 focus:pb-2
                                                                    [&:not(:placeholder-shown)]:pt-6
                                                                    [&:not(:placeholder-shown)]:pb-2
                                                                    autofill:pt-6
                                                                    autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('permanentcountry') != null) ? old('permanentcountry') : $application->permanentcountry ?? '' }}"
                                                name="permanentcountry" style="text-transform: capitalize;">
                                            <label for="hs-floating-input-permanentcountry"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                    peer-focus:scale-90 peer-focus:translate-x-0.5
                                                                    peer-focus:-translate-y-1.5
                                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                    Country</label>
                                        </div>
                                        @if($errors->has('permanentcountry'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('permanentcountry') }}</p>
                                        @endif

                                        <div class="mt-4 -ml-4">
                                            <header>
                                                <h3 class="text-lg font-medium text-gray-900">
                                                    {{ __('Emergency Contact') }}
                                                </h3>

                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ __("Emergency contact details with their mailing address.") }}
                                                </p>
                                            </header>
                                        </div>

                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <!--Emergency Phone Number-->
                                            <input type="text" id="hs-floating-input-emergencyphone" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                            placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                            dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                            focus:pt-6
                                                            focus:pb-2
                                                            [&:not(:placeholder-shown)]:pt-6
                                                            [&:not(:placeholder-shown)]:pb-2
                                                            autofill:pt-6
                                                            autofill:pb-2" placeholder="012-12345678"
                                                value="{{old('emergencyphone')}} {{ $application->emergencyphone ?? '' }}"
                                                name="emergencyphone">
                                            <label for="hs-floating-input-emergencyphone"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                            peer-focus:scale-90
                                                            peer-focus:translate-x-0.5
                                                            peer-focus:-translate-y-1.5
                                                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                            peer-[:not(:placeholder-shown)]:scale-90
                                                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                            Emergency Phone Number
                                            </label>
                                        </div>
                                        @if($errors->has('emergencyphone'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('emergencyphone') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!--Emergency Name-->
                                            <input type="text" id="hs-floating-input-emergencyname" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                            placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                            dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                            focus:pt-6
                                                            focus:pb-2
                                                            [&:not(:placeholder-shown)]:pt-6
                                                            [&:not(:placeholder-shown)]:pb-2
                                                            autofill:pt-6
                                                            autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('emergencyname') != null) ? old('emergencyname') : $application->emergencyname ?? '' }}"
                                                name="emergencyname" style="text-transform: capitalize;">
                                            <label for="hs-floating-input-emergencyname"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                            peer-focus:scale-90
                                                            peer-focus:translate-x-0.5
                                                            peer-focus:-translate-y-1.5
                                                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                            peer-[:not(:placeholder-shown)]:scale-90
                                                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Emergency
                                                Contact Name</label>
                                        </div>
                                        @if($errors->has('emergencyname'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('emergencyname') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!--Relationship-->
                                            <select id="relationship-select" data-hs-select='{
                                                            "placeholder": "Select emergency contact relationship...",
                                                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                                            }' class="hidden" value="" name="relationship">>
                                                <option value="">Choose</option>
                                                <option value="R01" {{ old('relationship') == 'R01' ? 'selected' : (isset($application->relationship) ? $application->relationship == 'R01' ? 'selected' : '' : '' )}}>Spouse</option>
                                                <option value="R02" {{ old('relationship') == 'R02' ? 'selected' : (isset($application->relationship) ? $application->relationship == 'R02' ? 'selected' : '' : '' )}}>Sibling</option>
                                                <option value="R03" {{ old('relationship') == 'R03' ? 'selected' : (isset($application->relationship) ? $application->relationship == 'R03' ? 'selected' : '' : '' )}}>Parent</option>
                                                <option value="R04" {{ old('relationship') == 'R04' ? 'selected' : (isset($application->relationship) ? $application->relationship == 'R04' ? 'selected' : '' : '' )}}>Grandparent</option>
                                                <option value="others" {{ old('relationship')=='others' ? 'selected' : (isset($application->relationship) ? $application->relationship == 'others' ? 'selected' : '' : '' )}}>Others</option>
                                            </select>
                                            <div id="other-relationship-field" class="mt-2 hidden">
                                                <input type="text" name="other_relationship" class="w-full border border-gray-300 rounded-lg py-2 px-4 text-sm" placeholder="Please specify your relationship" />
                                            </div>
                                        </div>
                                        @if($errors->has('relationship'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('relationship') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!--Emergency Address-->
                                            <textarea id="hs-floating-input-emergencyaddress" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                            placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                            dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                            focus:pt-6
                                                            focus:pb-2
                                                            [&:not(:placeholder-shown)]:pt-6
                                                            [&:not(:placeholder-shown)]:pb-2
                                                            autofill:pt-6
                                                            autofill:pb-2
                                                            height: h-32" placeholder="" value=""
                                                name=" emergencyaddress" style="text-transform: capitalize;">{{ (old('emergencyaddress') != null) ? old('emergencyaddress') : $application->emergencyaddress ?? '' }}</textarea>
                                            <label for="hs-floating-input-emergencyaddress"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                            peer-focus:scale-90
                                                            peer-focus:translate-x-0.5
                                                            peer-focus:-translate-y-1.5
                                                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                            peer-[:not(:placeholder-shown)]:scale-90
                                                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Emergency
                                                Contact Address</label>
                                        </div>
                                        @if($errors->has('emergencyaddress'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('emergencyaddress') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/4">
                                            <input type="text" id="hs-floating-input-emergencycity" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                            placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                            dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                            focus:pt-6
                                                            focus:pb-2
                                                            [&:not(:placeholder-shown)]:pt-6
                                                            [&:not(:placeholder-shown)]:pb-2
                                                            autofill:pt-6
                                                            autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('emergencycity') != null) ? old('emergencycity') : $application->emergencycity ?? '' }}"
                                                name="emergencycity">
                                            <label for="hs-floating-input-emergencycity"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                            peer-focus:scale-90
                                                            peer-focus:translate-x-0.5
                                                            peer-focus:-translate-y-1.5
                                                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                            peer-[:not(:placeholder-shown)]:scale-90
                                                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">City / Town</label>

                                        </div>
                                        @if($errors->has('emergencycity'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('emergencycity') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/4">
                                            <input type="text" id="hs-floating-input-emergencypostcode" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                            placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                            dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                            focus:pt-6
                                                            focus:pb-2
                                                            [&:not(:placeholder-shown)]:pt-6
                                                            [&:not(:placeholder-shown)]:pb-2
                                                            autofill:pt-6
                                                            autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('emergencypostcode') != null) ? old('emergencypostcode') : $application->emergencypostcode ?? '' }}"
                                                name="emergencypostcode">
                                            <label for="hs-floating-input-emergencypostcode"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                            peer-focus:scale-90
                                                            peer-focus:translate-x-0.5
                                                            peer-focus:-translate-y-1.5
                                                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                            peer-[:not(:placeholder-shown)]:scale-90
                                                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Postcode</label>

                                        </div>
                                        @if($errors->has('emergencypostcode'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('emergencypostcode') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!-- Select -->
                                            <select id="emergencystate-select" data-hs-select='{
                                                            "placeholder": "Select emergency contact state...",
                                                            "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                            "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                            "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                            "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                            "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                            "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                                }' class="hidden" value="" name="emergencystate">>
                                                <option value="">Select emergency contact state</option>
                                                <option value="MYS01" {{ old('emergencystate')=='MYS01' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS01' ? 'selected' : '' : '' )}}>Johor</option>
                                                <option value="MYS02" {{ old('emergencystate')=='MYS02' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS02' ? 'selected' : '' : '' )}}>Kedah</option>
                                                <option value="MYS03" {{ old('emergencystate')=='MYS03' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS03' ? 'selected' : '' : '' )}}>Kelantan</option>
                                                <option value="MYS04" {{ old('emergencystate')=='MYS04' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS04' ? 'selected' : '' : '' )}}>Malacca</option>
                                                <option value="MYS05" {{ old('emergencystate')=='MYS05' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS05' ? 'selected' : '' : '' )}}>Negeri Sembilan</option>
                                                <option value="MYS06" {{ old('emergencystate')=='MYS06' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS06' ? 'selected' : '' : '' )}}>Pahang</option>
                                                <option value="MYS07" {{ old('emergencystate')=='MYS07' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS07' ? 'selected' : '' : '' )}}>Penang</option>
                                                <option value="MYS08" {{ old('emergencystate')=='MYS08' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS08' ? 'selected' : '' : '' )}}>Perak</option>
                                                <option value="MYS09" {{ old('emergencystate')=='MYS09' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS09' ? 'selected' : '' : '' )}}>Perlis</option>
                                                <option value="MYS10" {{ old('emergencystate')=='MYS10' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS10' ? 'selected' : '' : '' )}}>Sabah</option>
                                                <option value="MYS11" {{ old('emergencystate')=='MYS11' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS11' ? 'selected' : '' : '' )}}>Sarawak</option>
                                                <option value="MYS12" {{ old('emergencystate')=='MYS12' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS12' ? 'selected' : '' : '' )}}>Selangor</option>
                                                <option value="MYS13" {{ old('emergencystate')=='MYS13' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS13' ? 'selected' : '' : '' )}}>Terengganu</option>
                                                <option value="MYS14" {{ old('emergencystate')=='MYS14' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS14' ? 'selected' : '' : '' )}}>Wilayah Persekutuan Labuan</option>
                                                <option value="MYS15" {{ old('emergencystate')=='MYS15' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS15' ? 'selected' : '' : '' )}}>Wilayah Persekutuan Kuala Lumpur</option>
                                                <option value="MYS16" {{ old('emergencystate')=='MYS16' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'MYS16' ? 'selected' : '' : '' )}}>Wilayah Persekutuan Putrajaya</option>
                                                <option value="others" {{ old('emergencystate')=='others' ? 'selected' : (isset($application->emergencystate) ? $application->emergencystate == 'others' ? 'selected' : '' : '' )}}>Others</option>
                                            </select>
                                            <!-- End Select -->
                                            <!-- Input field for Other state, hidden by default -->
                                            <div id="other-emergencystate-field" class="mt-2 hidden">
                                                <input type="text" name="other_emergencystate" class="w-full border border-gray-300 rounded-lg py-2 px-4 text-sm" placeholder="Please specify your state">
                                            </div>
                                        </div>
                                        @if($errors->has('emergencystate'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('emergencystate') }}</p>
                                        @endif

                                        <!--emergency Country-->
                                        <div class="mt-2 relative w-full md:w-1/4">
                                            <input type="text" id="hs-floating-input-emergencycountry" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                    focus:pt-6 focus:pb-2
                                                                    [&:not(:placeholder-shown)]:pt-6
                                                                    [&:not(:placeholder-shown)]:pb-2
                                                                    autofill:pt-6
                                                                    autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('emergencycountry') != null) ? old('emergencycountry') : $application->emergencycountry ?? '' }}"
                                                name="emergencycountry">
                                            <label for="hs-floating-input-emergencycountry"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                    peer-focus:scale-90 peer-focus:translate-x-0.5
                                                                    peer-focus:-translate-y-1.5
                                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                    Country</label>
                                        </div>
                                        @if($errors->has('emergencycountry'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('emergencycountry') }}</p>
                                        @endif


                                        <!-- Save button -->
                                        {{-- <div class="mt-8">
                                            <hr class="mb-4 border-gray-300">
                                            @if (isset($application->tab01))
                                            @if ($application->tab01 == 1)
                                            Record saved successfully. Please proceed to the next tab.
                                            @endif
                                            @endif
                                            <br><button type="submit"
                                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                Save
                                            </button>
                                        </div>    --}}
                                        <!-- Save button -->
                                        <div class="mt-8">
                                            <hr class="mb-4 border-gray-300">
                                            @if (isset($application->tab01) && $application->tab01 == 1)
                                            <div class="text-blue-600 mb-4">
                                                Record saved successfully. Please proceed to the next tab.
                                            </div>
                                            @endif
                                            <button type="submit"
                                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Merdeka Scholarship: Guardian tab-->
                    <div id="hs-tab-to-select-10" class="{{ $step == 'parentdetails' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-10">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">
                            <div class=" flex flex-col dark:bg-neutral-800 dark:border-neutral-700">
                                {{-- <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Parents / Guardian details') }}
                                    </h2>
                                </header> --}}
                                <div class="mt-0 ml-3">
                                    {{-- {{
                                    //exit;
                                    }} --}}
                                    <!--Parent Details Form-->
                                    <form id="parentdetailsForm" name="parentdetailsForm"  method="POST" action="{{ route('apply.post', ['step' => 'parentdetails']) }}">
                                        @csrf

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Father / Male Guardian -->
                                            <div>
                                                <header>
                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Father / Male Guardian') }}
                                                    </h2>
                                                </header>
                                                <div class="mt-2 relative w-full md:w-1/2">
                                                    <input type="text" id="hs-floating-input-guardian_name" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                focus:pt-6 focus:pb-2
                                                                [&:not(:placeholder-shown)]:pt-6
                                                                [&:not(:placeholder-shown)]:pb-2
                                                                autofill:pt-6 autofill:pb-2" placeholder="Father / Guardian Name"
                                                        value="{{ (old('guardian_name') != null) ? old('guardian_name') : $guardian[0]->guardian_name ?? '' }}"
                                                        name="guardian_name">
                                                    <label for="hs-floating-input-guardian_name"
                                                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                peer-focus:scale-90
                                                                peer-focus:translate-x-0.5
                                                                peer-focus:-translate-y-1.5
                                                                peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                peer-[:not(:placeholder-shown)]:scale-90
                                                                peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                Father / Male Name</label>
                                            
                                                </div>
                                                @if($errors->has('guardian_name'))
                                                <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                                    {{
                                                    $errors->first('guardian_name') }}</p>
                                                @endif

                                                <!--Parent Relationship-->
                                                <div class="mt-2 relative w-full md:w-1/3">
                                                    <input type="text" id="hs-floating-input-parentrelationship" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                                        focus:pt-6
                                                                                        focus:pb-2
                                                                                        [&:not(:placeholder-shown)]:pt-6
                                                                                        [&:not(:placeholder-shown)]:pb-2
                                                                                        autofill:pt-6
                                                                                        autofill:pb-2" placeholder="03-1234-5678"
                                                        value="{{ (old('guardian_relationship') != null) ? old('guardian_name') : $guardian[0]->guardian_name ?? '' }}"
                                                        name="parentrelationship">
                                                    <label for="hs-floating-input-parentrelationship"
                                                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                                        peer-focus:scale-90
                                                                                        peer-focus:translate-x-0.5
                                                                                        peer-focus:-translate-y-1.5
                                                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                                        Parent Relationship</label>
                                            
                                                </div>
                                                @if($errors->has('parentrelationship'))
                                                <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                                    {{
                                                    $errors->first('parentrelationship') }}</p>
                                                @endif

                                                <!--Parent Occupation-->
                                                <div class="mt-2 relative w-full md:w-1/3">
                                                    <input type="text" id="hs-floating-input-parentoccupation" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                                        focus:pt-6
                                                                                        focus:pb-2
                                                                                        [&:not(:placeholder-shown)]:pt-6
                                                                                        [&:not(:placeholder-shown)]:pb-2
                                                                                        autofill:pt-6
                                                                                        autofill:pb-2" placeholder="03-1234-5678"
                                                        value=""
                                                        name="parentoccupation">
                                                    <label for="hs-floating-input-parentoccupation"
                                                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                                        peer-focus:scale-90
                                                                                        peer-focus:translate-x-0.5
                                                                                        peer-focus:-translate-y-1.5
                                                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                                        Parent Occupation</label>
                                            
                                                </div>
                                                @if($errors->has('parentoccupation'))
                                                <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                                    {{
                                                    $errors->first('parentoccupation') }}</p>
                                                @endif

                                                <!--Parent Phone Number-->
                                                <div class="mt-2 relative w-full md:w-1/3">
                                                    <input type="text" id="hs-floating-input-parentphone" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                        focus:pt-6
                                                                        focus:pb-2
                                                                        [&:not(:placeholder-shown)]:pt-6
                                                                        [&:not(:placeholder-shown)]:pb-2
                                                                        autofill:pt-6
                                                                        autofill:pb-2" placeholder="" name="parentphone"
                                                            value="">
                                                    <label for="hs-floating-input-parentphone"
                                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                        peer-focus:scale-90
                                                                        peer-focus:translate-x-0.5
                                                                        peer-focus:-translate-y-1.5
                                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                        Parent Phone Number</label>
                                                </div>
                                                @if($errors->has('parentphone'))
                                                <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                                    {{
                                                    $errors->first('parentphone') }}</p>
                                                @endif

                                                <!--Father Address-->
                                                <div class="mt-2 relative w-full md:w-1/3">
                                                    <input type="text" id="hs-floating-input-parentaddress" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                focus:pt-6
                                                                focus:pb-2
                                                                [&:not(:placeholder-shown)]:pt-6
                                                                [&:not(:placeholder-shown)]:pb-2
                                                                autofill:pt-6
                                                                autofill:pb-2" placeholder="03-1234-5678"
                                                        value=""
                                                        name="parentaddress">
                                                    <label for="hs-floating-input-parentaddress"
                                                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                peer-focus:scale-90
                                                                peer-focus:translate-x-0.5
                                                                peer-focus:-translate-y-1.5
                                                                peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                peer-[:not(:placeholder-shown)]:scale-90
                                                                peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                Address of Parent/Guardian</label>
                                            
                                                </div>
                                                @if($errors->has('parentaddress'))
                                                <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                                    {{
                                                    $errors->first('parentaddress') }}</p>
                                                @endif

                                                <!--Father's Staff ID-->
                                                <div class="mt-2 relative w-full md:w-1/3">
                                                    <input type="text" id="hs-floating-input-parentstaffid" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                focus:pt-6
                                                                focus:pb-2
                                                                [&:not(:placeholder-shown)]:pt-6
                                                                [&:not(:placeholder-shown)]:pb-2
                                                                autofill:pt-6
                                                                autofill:pb-2" placeholder="678954321"
                                                        value=""
                                                        name="parentstaffid">
                                                    <label for="hs-floating-input-parentstaffid"
                                                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                peer-focus:scale-90
                                                                peer-focus:translate-x-0.5
                                                                peer-focus:-translate-y-1.5
                                                                peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                peer-[:not(:placeholder-shown)]:scale-90
                                                                peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                Staff id of Parent/Guardian</label>
                                                </div>
                                                @if($errors->has('parentstaffid'))
                                                <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                                    {{
                                                    $errors->first('parentstaffid') }}</p>
                                                @endif
                                            </div>
                                            <div>
                                                <header>
                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Mother / Female Guardian') }}
                                                    </h2>
                                                </header>
                                                <!--Mother Name-->
                                                <div class="mt-2 relative w-full md:w-1/2">
                                                    <input type="text" id="hs-floating-input-parentname" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                focus:pt-6 focus:pb-2
                                                                [&:not(:placeholder-shown)]:pt-6
                                                                [&:not(:placeholder-shown)]:pb-2
                                                                autofill:pt-6 autofill:pb-2" placeholder="Mother / Guardian Name"
                                                        value="{{ (old('guardian_name') != null) ? old('guardian_name') : $guardian[1]->guardian_name ?? '' }}"
                                                        name="parentname">
                                                    <label for="hs-floating-input-parentname"
                                                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                peer-focus:scale-90
                                                                peer-focus:translate-x-0.5
                                                                peer-focus:-translate-y-1.5
                                                                peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                peer-[:not(:placeholder-shown)]:scale-90
                                                                peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                Mother / Guardian Name</label>
                                                </div>
                                                @if($errors->has('parentname'))
                                                <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                                    {{
                                                    $errors->first('parentname') }}</p>
                                                @endif
                                                <!--Mother Relationship-->
                                                <div class="mt-2 relative w-full md:w-1/3">
                                                    <input type="text" id="hs-floating-input-parentrelationship" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                    focus:pt-6 focus:pb-2
                                                                    [&:not(:placeholder-shown)]:pt-6
                                                                    [&:not(:placeholder-shown)]:pb-2
                                                                    autofill:pt-6 autofill:pb-2" placeholder="Mother / Guardian Relationship"
                                                        value=""
                                                        name="parentrelationship">
                                                    <label for="hs-floating-input-parentrelationship"
                                                        class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                    peer-focus:scale-90 peer-focus:translate-x-0.5
                                                                    peer-focus:-translate-y-1.5
                                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                    Mother / Guardian Relationship</label>
                                                </div>
                                                @if($errors->has('parentrelationship'))
                                                <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                                    {{
                                                    $errors->first('parentrelationship') }}</p>
                                                @endif
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Qualification Tab-->
                    <div id="hs-tab-to-select-2" class="{{ $step == 'academic' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-2">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">
                            <div class=" flex flex-col dark:bg-neutral-800 dark:border-neutral-700">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Academic Qualifications') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __("Applicant's highest academic qualification.") }}
                                    </p>
                                </header>
                                <div class="mt-6 ml-3">
                                    <!-- Academic Qualification Form -->
                                    <form id="academicForm" name="academicForm" method="POST" action="{{ route('apply.post', ['step' => 'academics']) }}">
                                        @csrf
                                        <div class="mt-2 relative w-full md:w-1/4">
                                            <!-- Level of Study -->
                                            <select id="hs-floating-input-studylevel" class="peer p-4 pt-6 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder-transparent focus:border-blue-500 focus:ring-blue-500 
                                                    disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 
                                                    dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600"
                                                    name="studylevel">
                                                    <option value="Degree" {{ old('studylevel') == 'Degree' ? 'selected' : (trim(isset($application->studylevel)) ? trim($application->studylevel) == 'Degree' ? 'selected' : '' : '' )}}>Bachelor Degree</option>
                                                    <option value="Master" {{ old('studylevel') == 'Master' ? 'selected' : (trim(isset($application->studylevel)) ? trim($application->studylevel) == 'Master' ? 'selected' : '' : '' )}}>Master</option>
                                                    <option value="PhD" {{ old('studylevel') == 'PhD' ? 'selected' : (trim(isset($application->studylevel)) ? trim($application->studylevel) == 'PhD' ? 'selected' : '' : '' )}}>PhD</option>
                                            </select>
                                            <label for="hs-floating-input-studylevel" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                peer-focus:scale-90 peer-focus:translate-x-0.5 peer-focus:-translate-y-1.5
                                                peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                peer-[:not(:placeholder-shown)]:scale-90
                                                peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                Level of Study
                                            </label>
                                        </div>
                                        @if($errors->has('studylevel'))
                                            <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                                {{ $errors->first('studylevel') }}
                                            </p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!--Course Name-->
                                            <input type="text" id="hs-floating-input-coursename" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('coursename') != null) ? old('coursename') : $application->coursename ?? '' }}"
                                                name="coursename" style="text-transform: capitalize;">
                                            <label for="hs-floating-input-coursename"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                        Program / Course Name</label>
                                    
                                        </div>
                                        @if($errors->has('coursename'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('coursename') }}</p>
                                        @endif
                                    
                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!--University Name-->
                                            <input type="text" id="hs-floating-input-universityname" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('universityname') != null) ? old('universityname') : $application->universityname ?? '' }}"
                                                name="universityname" style="text-transform: capitalize;">
                                            <label for="hs-floating-input-universityname"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">University Name</label>
                                        </div>
                                        @if($errors->has('universityname'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('universityname') }}</p>
                                        @endif
                                    
                                        <div class="mt-2 relative w-full md:w-1/4">
                                            <!--University Country-->
                                            <input type="text" id="hs-floating-input-universitycountry" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                                                            placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                                                            dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                                                            focus:pt-6
                                                                                                            focus:pb-2
                                                                                                            [&:not(:placeholder-shown)]:pt-6
                                                                                                            [&:not(:placeholder-shown)]:pb-2
                                                                                                            autofill:pt-6
                                                                                                            autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('universitycountry') != null) ? old('universitycountry') : $application->universitycountry ?? '' }}"
                                                name="universitycountry">
                                            <label for="hs-floating-input-universitycountry"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                                                            peer-focus:scale-90
                                                                                                            peer-focus:translate-x-0.5
                                                                                                            peer-focus:-translate-y-1.5
                                                                                                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                                                            peer-[:not(:placeholder-shown)]:scale-90
                                                                                                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">University
                                                Country</label>
                                        </div>
                                        @if($errors->has('universitycountry'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('universitycountry') }}</p>
                                        @endif
                                    
                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <!-- Commencement Year -->
                                            <input type="text" id="hs-floating-input-commencementyear" name="commencementyear"
                                                value="{{ old('commencementyear', $application->commencementyear ?? '') }}"
                                                class="peer p-4 pt-6 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder-transparent focus:border-blue-500 focus:ring-blue-500 
                                                        disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 
                                                        dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600"
                                                pattern="\d*"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                placeholder=" ">
                                            <label for="hs-floating-input-commencementyear" 
                                                    class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                                Commencement Year
                                            </label>
                                        </div>
                                        @if($errors->has('commencementyear'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('commencementyear') }}</p>
                                        @endif
                                    
                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <!-- Completion Year (Now as a Number-Only Text Field) -->
                                            <input type="text" id="hs-floating-input-completionyear" name="completionyear"
                                                value="{{ old('completionyear', $application->completionyear ?? '') }}"
                                                class="peer p-4 pt-6 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder-transparent focus:border-blue-500 focus:ring-blue-500 
                                                        disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 
                                                        dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600"
                                                pattern="\d*"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                placeholder=" ">
                                            <label for="hs-floating-input-completionyear" 
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                                Completion Year
                                            </label>
                                        </div>
                                        @if($errors->has('completionyear'))
                                            <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                                {{ $errors->first('completionyear') }}
                                            </p>
                                        @endif
                                    
                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <!-- Result (CGPA) -->
                                            <input type="text" id="hs-floating-input-result"
                                                class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                    focus:pt-6 focus:pb-2
                                                    [&:not(:placeholder-shown)]:pt-6
                                                    [&:not(:placeholder-shown)]:pb-2"
                                                placeholder="03-1234-5678"
                                                value="{{ old('result') ?? $application->result ?? '' }}" name="result"
                                                oninput="validateCGPA(this)">
                                            
                                            <label for="hs-floating-input-result"
                                                    class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                            peer-focus:scale-90 peer-focus:translate-x-0.5 peer-focus:-translate-y-1.5 peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                            peer-[:not(:placeholder-shown)]:scale-90 peer-[:not(:placeholder-shown)]:translate-x-0.5 peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                                Final score (CGPA)
                                            </label>
                                        </div>
                                        @if($errors->has('result'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('result') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!--Others Result-->
                                            <input type="text" id="hs-floating-input-resultother" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                        focus:pt-6 focus:pb-2
                                                                        [&:not(:placeholder-shown)]:pt-6
                                                                        [&:not(:placeholder-shown)]:pb-2
                                                                        autofill:pt-6
                                                                        autofill:pb-2" placeholder="03-1234-5678"
                                                value="{{ (old('resultother') != null) ? old('resultother') : $application->resultother ?? '' }}" name="resultother">
                                            <label for="hs-floating-input-resultother"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                        peer-focus:scale-90
                                                                        peer-focus:translate-x-0.5
                                                                        peer-focus:-translate-y-1.5
                                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                                        Final score (Others than CGPA)
                                            </label>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500 ml-3" id="hs-input-helper-text">
                                                Example: 1. First Class, 2. Second Class Upper, 
                                                <br>3. Second Class Lower , 4. Third Class & 5. Pass
                                            </p>
                                        </div>
                                        @if($errors->has('resultother'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('resultother') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                           {{-- {{$application->studyextension}} --}}
                                            <!-- Selection of extension taken during study -->                                            
                                            <select id="studyextension-select" data-hs-select='{"placeholder": "Any extension taken within your Duration of Study?",
                                                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                                                    }' class="hidden" name="studyextension">
                                                <option value="">Any extension taken within your Duration of Study?</option>
                                                <option value="Yes" {{ old('studyextension') == 'Yes' ? 'selected' : (trim(isset($application->studyextension)) ? trim($application->studyextension) == 'Yes' ? 'selected' : '' : '' )}}>Yes</option>
                                                <option value="No" {{ old('studyextension') == 'No' ? 'selected' : (trim(isset($application->studyextension)) ? trim($application->studyextension) == 'No' ? 'selected' : '' : '' )}}>No</option>
                                            </select>
                                            <!-- End Select -->
                                        </div>
                                        @if($errors->has('studyextension'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('studyextension') }}</p>
                                        @endif

                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <textarea id="hs-floating-input-reasonextension" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2
                                                        height: h-32" placeholder=""
                                                name="reasonextension" style="text-transform: capitalize;">{{ (old('reasonextension') != null) ? old('reasonextension') : $application->reasonextension ?? '' }}</textarea>
                                            <label for="hs-floating-input-reasonextension"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                                If Yes, Please state reason for extension of study 
                                            </label>
                                        </div>
                                        @if($errors->has('reasonextension'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{ $errors->first('reasonextension') }}
                                        </p>
                                        @endif

                                    <div class="mt-8">
                                        <hr class="mb-4 border-gray-300">
                                        @if (isset($application->tab02) && $application->tab02 == 1)
                                        <div class="text-blue-600 mb-4">
                                            Record saved successfully. Please proceed to the next tab.
                                        </div>
                                        @endif
                                        <button type="submit"
                                            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                            Save
                                        </button>
                                    </div>
                                    </form>
                                    <!-- End of Academic Qualification Form -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Merdeka Scholarship: SPM = Academics Qualification tab -->
                    <div id="hs-tab-to-select-3" class="{{ $step == 'spm' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-3">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">
                            <div class=" flex flex-col dark:bg-neutral-800 dark:border-neutral-700">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __(key: 'Academic Qualification') }}
                                    </h2>
                                
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __(key: "1. Applicant is required to fill in all details under the Secondary Education qualification. ") }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __(key: "2. Please fill in your academic qualification (at least one) where applicable for Tertiary
                                        Education.") }}
                                    </p>
                                </header>
                                <div class="mt-6 ml-3">
                                <!-- SPM Form -->
                                <form id="spmForm" name="spmForm" method="POST" action="{{ route('apply.post', ['step' => 'spm']) }}" >
                                    @csrf
                                    <div class="mt-2 relative w-full md:w-1/2">
                                        <!--SPM Result-->
                                        <!--Secondary Education - School/Institution Name-->
                                        <input type="text" id="hs-floating-input-spm_school" 
                                            class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                    focus:pt-6
                                                    focus:pb-2
                                                    [&:not(:placeholder-shown)]:pt-6
                                                    [&:not(:placeholder-shown)]:pb-2
                                                    autofill:pt-6
                                                    autofill:pb-2" placeholder="03-1234-5678"
                                            value="{{ (old('spm_school') != null) ? old('spm_school') : $academic_qualification->spm_school ?? '' }}"
                                            name="spm_school" style="text-transform: capitalize;">
                                        <label for="hs-floating-input-spm_school"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90
                                                    peer-focus:translate-x-0.5
                                                    peer-focus:-translate-y-1.5
                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                            School/Institution Name</label>
                                    </div>
                                    @if($errors->has('spm_school'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{
                                        $errors->first('spm_school') }}
                                    </p>
                                    @endif

                                    <div class="mt-2 relative w-full md:w-1/5">
                                        <!-- Secondary academicqualification - Commencement Year -->
                                        <input type="text" id="hs-floating-input-spm_commencement_year" name="spm_commencement_year"
                                            class="peer p-4 pt-6 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder-transparent focus:border-blue-500 focus:ring-blue-500 
                                                    disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 
                                                    dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600" 
                                            value="{{ old('spm_commencement_year', $academic_qualification->spm_commencement_year ?? '') }}"
                                            pattern="^\d{4}$" oninput="validateYear(this)" maxlength="4" placeholder=" ">
                                        <label for="hs-floating-input-spm_commencement_year"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90
                                                    peer-focus:translate-x-0.5
                                                    peer-focus:-translate-y-1.5
                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                            Commencement Year
                                        </label>
                                    </div>
                                    @if($errors->has('spm_commencement_year'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{ $errors->first('spm_commencement_year') }}
                                    </p>
                                    @endif

                                    <div class="mt-2 relative w-full md:w-1/5">
                                        <!-- Secondary academicqualification - Completion Year -->
                                        <input type="text" id="hs-floating-input-spm_completion_year" name="spm_completion_year"
                                            value="{{ old('spm_completion_year', $academic_qualification->spm_completion_year ?? '') }}"
                                            class="peer p-4 pt-6 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder-transparent focus:border-blue-500 focus:ring-blue-500 
                                                    disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 
                                                    dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600" pattern="\d{4}" inputmode="numeric" maxlength="4" oninput="validateYear(this)"
                                            placeholder=" ">
                                        <label for="hs-floating-input-spm_completion_year"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90
                                                    peer-focus:translate-x-0.5
                                                    peer-focus:-translate-y-1.5
                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                            Completion Year
                                        </label>
                                    </div>
                                    <!-- <p class="mt-1 text-sm text-gray-600">
                                                                            {{ __("Example: 2025") }}
                                                                        </p> -->
                                    
                                    @if($errors->has('spm_completion_year'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{ $errors->first('spm_completion_year') }}
                                    </p>
                                    @endif
                                    
                                    <div class="mt-2 relative w-full md:w-1/5">
                                        <!-- Secondary academicqualification - SPM Results -->
                                        <input type="text" id="hs-floating-input-spm_result" 
                                            class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                    focus:pt-6 focus:pb-2
                                                    [&:not(:placeholder-shown)]:pt-6
                                                    [&:not(:placeholder-shown)]:pb-2"
                                            value="{{ old('spm_result') ?? $academic_qualification->spm_result ?? '' }}" name="spm_result"
                                            pattern="[A-Za-z0-9+\- ]*" placeholder=" ">
                                    
                                        <label for="hs-floating-input-spm_result"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90 peer-focus:translate-x-0.5 peer-focus:-translate-y-1.5 peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90 peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                            SPM Results
                                        </label>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __("Example output: 6A+ 1A 3B.") }}
                                    </p>
                                    
                                    @if($errors->has('spm_result'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{ $errors->first('spm_result') }}
                                    </p>
                                    @endif


                                       <!-- Save button -->
                                    <div class="mt-8">
                                        <hr class="mb-4 border-gray-300">
                                        @if (isset($application->tab03) && $application->tab03 == 1)
                                        <div class="text-green-600 mb-4">
                                            Record saved successfully. Please proceed to the next tab.
                                        </div>
                                        @endif
                                        <button type="submit"
                                            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                            Save
                                        </button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hs-tab-to-select-4" class="{{ $step == 'skill' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-4">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">
                            <div class=" flex flex-col dark:bg-neutral-800 dark:border-neutral-700">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Skills and Extra Curricullar Activities') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __("Applicant's skills and extra curricular activities involments.") }}
                                    </p>
                                </header>
                                <div class="mt-6 ml-3">
                                    <form id="skillsForm" name="skillsForm" method="POST" action="{{ route('apply.post', ['step' => 'skills']) }}">
                                        @csrf
                                        <div class="mt-2 relative w-full md:w-1/2">
                                            <!--Personal Statement-->
                                            <textarea id="hs-floating-input-personalstatement" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2
                                                        height: h-32"
                                                placeholder="Write about your goals, aspirations, and achievements."
                                                name="personalstatement">{{ (old('personalstatement') != null) ? old('personalstatement') : $application->personalstatement ?? '' }}</textarea>
                                            <label for="hs-floating-input-personalstatement"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Personal Statement (Limit to 5000 characters)</label>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500 ml-3"
                                            id="hs-input-helper-text">Goals, aspirations, and achievements. 
                                        </p>
                                        </div>
                                    
                                        <div class="mt-2 relative w-full md:w-1/2">
                                            <!--Skills And Extracurricular-->
                                            <textarea id="hs-floating-input-skillsandextracurricular" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2
                                                        height: h-32"
                                                placeholder="Example: Participation in extracurricular activities, student council, youth work, associations, or NGOs."
                                                name="skillsandextracurricular">{{ (old('skillsandextracurricular') != null) ? old('skillsandextracurricular') : $application->skillsandextracurricular
                                                ?? '' }}</textarea>
                                            <label for="hs-floating-input-skillsandextracurricular"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Skills (Limit to 5000 characters)</label>
                                        </div>

                                        <div class="mt-2 relative w-full md:w-1/2">
                                            <!--Extracurricular Activity-->
                                            <textarea id="hs-floating-input-activityextra" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2
                                                        height: h-32"
                                                placeholder="Example: Participation in extracurricular activities, student council, youth work, associations, or NGOs."
                                                name="activityextra">{{ (old('activityextra') != null) ? old('activityextra') : $application->activityextra
                                                ?? '' }}</textarea>
                                            <label for="hs-floating-input-activityextra"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Extracurricular Activities (Limit to 5000 characters)</label>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500 ml-3"
                                                id="hs-input-helper-text">Participation in extracurricular activities, student council, youth work, associations, or NGOs. 
                                            </p> 
                                        </div>
                                       <!-- Save button -->
                                        {{-- <div class="mt-8">
                                            <hr class="mb-4 border-gray-300">
                                            @if (isset($application->tab04))
                                            @if ($application->tab04 == 1)
                                            Record saved successfully. Please proceed to the next tab.
                                            @endif
                                            @endif
                                            <button type="button" onclick="submitApplication()" id="submitBtn"
                                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                Save
                                            </button>
                                        </div> --}}
                                        <!-- Save button -->
                                        <div class="mt-8">
                                            <hr class="mb-4 border-gray-300">
                                            @if (isset($application->tab04) && $application->tab04 == 1)
                                            <div class="text-blue-600 mb-4">
                                                Record saved successfully. Please proceed to the next tab.
                                            </div>
                                            @endif
                                            <button type="submit"
                                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hs-tab-to-select-5" class="{{ $step == 'experience' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-5">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">
                            <div class=" flex flex-col dark:bg-neutral-800 dark:border-neutral-700">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Employment Information') }}
                                    </h2>
                                </header>
                                <div class="mt-6 ml-3">
                                    <form id="workForm" name="workForm" method="POST" action="{{ route('apply.post', ['step' => 'experience']) }}">
                                        @csrf
                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <!--Employment Status-->
                                            <!-- Add Unemployed -->
                                            <select id="employmentstatus-select" data-hs-select='{
                                                                "placeholder": "Select employment status",
                                                                "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                                "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                                "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                                "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                                "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                                "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                                                }' class="hidden" value=""
                                                name="employmentstatus">>
                                                <option value="">Select employment status</option>
                                                <option value="E" {{ old('employmentstatus')=='E' ? 'selected' : (isset($application->employmentstatus) ? $application->employmentstatus == 'E' ? 'selected' : '' : '' )}}>Employed</option>
                                                <option value="S" {{ old('employmentstatus')=='S' ? 'selected' : (isset($application->employmentstatus) ? $application->employmentstatus == 'S' ? 'selected' : '' : '' )}}>Self-Employed</option>
                                                <option value="U" {{ old('employmentstatus')=='U' ? 'selected' : (isset($application->employmentstatus) ? $application->employmentstatus == 'U' ? 'selected' : '' : '' )}}>Unemployed</option>
                                            </select>
                                            <!-- End Select -->
                                        </div>
                                        @if($errors->has('employmentstatus'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('employmentstatus') }}</p>
                                        @endif
                                    
                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!--Employer Name-->
                                            <input type="text" id="hs-floating-input-employername" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2" placeholder=""
                                                value="{{ (old('employername') != null) ? old('employername') : $application->employername ?? '' }}"
                                                name="employername" style="text-transform: capitalize;">
                                            <label for="hs-floating-input-employername"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                        peer-focus:scale-90
                                                        peer-focus:translate-x-0.5
                                                        peer-focus:-translate-y-1.5
                                                        peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                        peer-[:not(:placeholder-shown)]:scale-90
                                                        peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                        peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                        peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                        Name of Employer</label>
                                        </div>
                                        @if($errors->has('employername'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('employername') }}</p>
                                        @endif
                                    
                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!--Employer Address-->
                                            <textarea id="hs-floating-input-employeraddress" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                focus:pt-6 focus:pb-2
                                                                [&:not(:placeholder-shown)]:pt-6
                                                                [&:not(:placeholder-shown)]:pb-2
                                                                autofill:pt-6 autofill:pb-2
                                                                height: h-32" placeholder=""
                                                name="employeraddress" style="text-transform: capitalize;">{{ (old('employeraddress') != null) ? old('employeraddress') : $application->employeraddress ?? '' }}</textarea>
                                            <label for="hs-floating-input-employeraddress"
                                                    class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                peer-focus:scale-90
                                                                peer-focus:translate-x-0.5
                                                                peer-focus:-translate-y-1.5
                                                                peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                peer-[:not(:placeholder-shown)]:scale-90
                                                                peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                                    Address of Employer
                                            </label>
                                        </div>
                                        @if($errors->has('employeraddress'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('employeraddress') }}</p>
                                        @endif
                                    
                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <!-- Office Phone Number -->
                                            <input type="text" id="hs-floating-input-officephone"
                                                class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                            placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                            dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                            focus:pt-6 focus:pb-2
                                                            [&:not(:placeholder-shown)]:pt-6
                                                          [&:not(:placeholder-shown)]:pb-2
                                                          autofill:pt-6 autofill:pb-2"
                                                placeholder="XXX-XXXXXXX"
                                                value="{{ old('officephone') ?? $application->officephone ?? '' }}"
                                                name="officephone"
                                                oninput="formatPhoneNumber(this)">
                                            <label for="hs-floating-input-officephone"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90 peer-focus:translate-x-0.5 peer-focus:-translate-y-1.5 peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90 peer-[:not(:placeholder-shown)]:translate-x-0.5 peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                                Office Phone Number
                                            </label>
                                        </div>
                                        @if($errors->has('officephone'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('officephone') }}</p>
                                        @endif
                                    
                                        <div class="mt-2 relative w-full md:w-1/3">
                                            <!--Position-->
                                            <input type="text" id="hs-floating-input-position" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                                                                            placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                                                                            dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                                                                            focus:pt-6
                                                                                                            focus:pb-2
                                                                                                            [&:not(:placeholder-shown)]:pt-6
                                                                                                            [&:not(:placeholder-shown)]:pb-2
                                                                                                            autofill:pt-6
                                                                                                            autofill:pb-2" placeholder=""
                                                value="{{ (old('position') != null) ? old('position') : $application->position ?? '' }}" name="position">
                                            <label for="hs-floating-input-position"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                                                            peer-focus:scale-90
                                                                                                            peer-focus:translate-x-0.5
                                                                                                            peer-focus:-translate-y-1.5
                                                                                                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                                                            peer-[:not(:placeholder-shown)]:scale-90
                                                                                                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Position</label>
                                        </div>
                                        @if($errors->has('position'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('position') }}</p>
                                        @endif
                                    
                                        <div class="mt-2 relative w-full md:w-1/5">
                                            <!--Salary-->
                                            <input type="text" id="hs-floating-input-salary" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                        placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                        dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                        focus:pt-6
                                                        focus:pb-2
                                                        [&:not(:placeholder-shown)]:pt-6
                                                        [&:not(:placeholder-shown)]:pb-2
                                                        autofill:pt-6
                                                        autofill:pb-2" placeholder="" 
                                                        value="{{ old('salary', $application->salary ?? '') }}" name="salary"
                                                        oninput="formatSalaryInput(this)" inputmode="decimal"
                                                        data-raw-value="{{ old('salary', $application->salary ?? '') }}">
                                            <label for="hs-floating-input-salary"
                                                class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                                peer-focus:scale-90
                                                                peer-focus:translate-x-0.5
                                                                peer-focus:-translate-y-1.5
                                                                peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                                peer-[:not(:placeholder-shown)]:scale-90
                                                                peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                                peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                                peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Salary
                                                (RM)</label>
                                        </div>
                                        @if($errors->has('salary'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{
                                            $errors->first('salary') }}</p>
                                        @endif
                                      <!-- Save button -->
                                        {{-- <div class="mt-8">
                                            <hr class="mb-4 border-gray-300">
                                            @if (isset($application->tab05))
                                            @if ($application->tab05 == 1)
                                            Record saved successfully. Please proceed to the next tab.
                                            @endif
                                            @endif
                                            <div id="globalStatusMessage" class="mb-4 text-green-600 text-center"></div>
                                            <button type="button" onclick="submitApplication()" id="submitBtn"
                                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                Save
                                            </button> --}}
                                            <!-- Save button -->
                                            <div class="mt-8">
                                                <hr class="mb-4 border-gray-300">
                                                @if (isset($application->tab05) && $application->tab05 == 1)
                                                <div class="text-blue-600 mb-4">
                                                    Record saved successfully. Please proceed to the next tab.
                                                </div>
                                                @endif
                                                <button type="submit"
                                                    class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                    Save
                                                </button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hs-tab-to-select-6" class="{{ $step == 'study' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-6">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">
                            <div class=" flex flex-col dark:bg-neutral-800 dark:border-neutral-700">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Field of Study Information') }}
                                    </h2>
                        
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __("The applicant's choice of field of study.") }}
                                    </p>
                                </header>
                                <div class="mt-6 ml-3">
                                    <!-- Study Information Form -->
                                    <form id="studyForm" name="studyForm" method="POST" action="{{ route('apply.post', ['step' => 'study']) }}">
                                    @csrf
                                    <!--Applied Level of Study-->
                                    <div class="mt-2 relative w-full md:w-1/4">
                                        <select id="hs-floating-input-appliedlevelstudy" class="peer p-4 pt-6 block w-full border-gray-200 rounded-lg text-sm 
                                                placeholder-transparent focus:border-blue-500 focus:ring-blue-500 
                                                disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 
                                                dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600"
                                                name="appliedlevelstudy">
                                            <option value="Mast" {{ old('appliedlevelstudy', $application->appliedlevelstudy ?? '') == 'Mast' ? 'selected' : '' }}>Master</option>
                                            <option value="PhD" {{ old('appliedlevelstudy', $application->appliedlevelstudy ?? '') == 'PhD' ? 'selected' : '' }}>PhD</option>
                                        </select>
                                        <label for="hs-floating-input-appliedlevelstudy" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                            peer-focus:scale-90 peer-focus:translate-x-0.5 peer-focus:-translate-y-1.5
                                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                            peer-[:not(:placeholder-shown)]:scale-90
                                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                            Applied Level of Study
                                        </label>
                                    </div>
                                    @if($errors->has('appliedlevelstudy'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-appliedlevelstudy-error-helper">
                                            {{ $errors->first('appliedlevelstudy') }}
                                        </p>
                                    @endif

                                    <!--Major of Study-->
                                    <div class="mt-2 relative w-full md:w-1/4">
                                        <select id="hs-floating-input-majorstudy" class="peer p-4 pt-6 block w-full border-gray-200 rounded-lg text-sm 
                                                placeholder-transparent focus:border-blue-500 focus:ring-blue-500 
                                                disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 
                                                dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600"
                                                name="majorstudy">
                                            <option value="Acc"   {{ old('majorstudy', $application->majorstudy ?? '') == 'Acc' ? 'selected' : '' }}>Accountancy</option>
                                            <option value="ActS"  {{ old('majorstudy', $application->majorstudy ?? '') == 'ActS' ? 'selected' : '' }}>Actuarial Science</option>
                                            <option value="Arch"  {{ old('majorstudy', $application->majorstudy ?? '') == 'Arch' ? 'selected' : '' }}>Architecture</option>
                                            <option value="Art"   {{ old('majorstudy', $application->majorstudy ?? '') == 'Art' ? 'selected' : '' }}>Arts</option>
                                            <option value="Bness" {{ old('majorstudy', $application->majorstudy ?? '') == 'Bness' ? 'selected' : '' }}>Business</option>
                                            <option value="Comm"  {{ old('majorstudy', $application->majorstudy ?? '') == 'Comm' ? 'selected' : '' }}>Communication</option>
                                            <option value="Const" {{ old('majorstudy', $application->majorstudy ?? '') == 'Const' ? 'selected' : '' }}>Construction, Property & Real Estate</option>
                                            <option value="Eco"   {{ old('majorstudy', $application->majorstudy ?? '') == 'Eco' ? 'selected' : '' }}>Economics</option>
                                            <option value="Eng"   {{ old('majorstudy', $application->majorstudy ?? '') == 'Eng' ? 'selected' : '' }}>Engineering</option>
                                            <option value="Finc"  {{ old('majorstudy', $application->majorstudy ?? '') == 'Finc' ? 'selected' : '' }}>Finance</option>
                                            <option value="HR"    {{ old('majorstudy', $application->majorstudy ?? '') == 'HR' ? 'selected' : '' }}>Human Resources</option>
                                            <option value="IT"    {{ old('majorstudy', $application->majorstudy ?? '') == 'IT' ? 'selected' : '' }}>Information Technology</option>
                                            <option value="Law"   {{ old('majorstudy', $application->majorstudy ?? '') == 'Law' ? 'selected' : '' }}>Law</option>
                                            <option value="Mgt"   {{ old('majorstudy', $application->majorstudy ?? '') == 'Mgt' ? 'selected' : '' }}>Management</option>
                                            <option value="Mkt"   {{ old('majorstudy', $application->majorstudy ?? '') == 'Mkt' ? 'selected' : '' }}>Marketing</option>
                                            <option value="Math"  {{ old('majorstudy', $application->majorstudy ?? '') == 'Math' ? 'selected' : '' }}>Mathematics</option>
                                            <option value="Psyc"  {{ old('majorstudy', $application->majorstudy ?? '') == 'Psyc' ? 'selected' : '' }}>Psychology</option>
                                            <option value="SocS"  {{ old('majorstudy', $application->majorstudy ?? '') == 'SocS' ? 'selected' : '' }}>Social Science</option>
                                            <option value="Sce"   {{ old('majorstudy', $application->majorstudy ?? '') == 'Sce' ? 'selected' : '' }}>Science</option>
                                            <option value="Others" {{ old('majorstudy', $application->majorstudy ?? '') == 'Others' ? 'selected ' : '' }}>Others</option>
                                        </select>
                                        <label for="hs-floating-input-majorstudy" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                            peer-focus:scale-90 peer-focus:translate-x-0.5 peer-focus:-translate-y-1.5
                                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                            peer-[:not(:placeholder-shown)]:scale-90
                                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                            Major Study
                                        </label>
                                    </div>
                                    @if($errors->has('majorstudy'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                            {{ $errors->first('majorstudy') }}
                                        </p>
                                    @endif

                                    <!--Applied Course Title-->
                                    <div class="mt-2 relative w-full md:w-1/3">
                                        <input type="text" id="hs-floating-input-appliedcoursetitle" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                    focus:pt-6
                                                    focus:pb-2
                                                    [&:not(:placeholder-shown)]:pt-6
                                                    [&:not(:placeholder-shown)]:pb-2
                                                    autofill:pt-6
                                                    autofill:pb-2" placeholder=""
                                            value="{{ (old('appliedcoursetitle') != null) ? old('appliedcoursetitle') : $application->appliedcoursetitle ?? '' }}"
                                            name="appliedcoursetitle">
                                        <label for="hs-floating-input-appliedcoursetitle"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90
                                                    peer-focus:translate-x-0.5
                                                    peer-focus:-translate-y-1.5
                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Applied
                                            Course Title</label>
                                    </div>
                                    @if($errors->has('appliedcoursetitle'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{
                                        $errors->first('appliedcoursetitle') }}</p>
                                    @endif
                                    <!--list of uni-->
                                    <div class="mt-2 relative w-full md:w-1/2">
                                        <select data-hs-select='{
                                                    "placeholder": "Select University",
                                                    "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                    "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600",
                                                    "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
                                                    "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
                                                    "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 text-blue-600 dark:text-blue-500 \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
                                                    "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
                                                    }' class="hidden" name="university">
                                            <option value="">Select applied university</option>
                                            <option value="U01" {{ old('university')=='U01' ? 'selected' : (isset($application->university) ? $application->university == 'U01' ? 'selected' : '' : '' )}}>Oxford University, UK</option>
                                            <option value="U02" {{ old('university')=='U02' ? 'selected' : (isset($application->university) ? $application->university == 'U02' ? 'selected' : '' : '' )}}>University of Cambridge, UK</option>
                                            <option value="U03" {{ old('university')=='U03' ? 'selected' : (isset($application->university) ? $application->university == 'U03' ? 'selected' : '' : '' )}}>Imperial College London, UK</option>
                                            <option value="U04" {{ old('university')=='U04' ? 'selected' : (isset($application->university) ? $application->university == 'U04' ? 'selected' : '' : '' )}}>University College London, UK</option>
                                            <option value="U05" {{ old('university')=='U05' ? 'selected' : (isset($application->university) ? $application->university == 'U05' ? 'selected' : '' : '' )}}>University of Edinburgh, UK</option>
                                            <option value="U06" {{ old('university')=='U06' ? 'selected' : (isset($application->university) ? $application->university == 'U06' ? 'selected' : '' : '' )}}>Stanford University, USA</option>
                                            <option value="U07" {{ old('university')=='U07' ? 'selected' : (isset($application->university) ? $application->university == 'U07' ? 'selected' : '' : '' )}}>Massachusetts Institute of Technology, USA</option>
                                            <option value="U08" {{ old('university')=='U08' ? 'selected' : (isset($application->university) ? $application->university == 'U08' ? 'selected' : '' : '' )}}>Harvard University, USA</option>
                                            <option value="U09" {{ old('university')=='U09' ? 'selected' : (isset($application->university) ? $application->university == 'U09' ? 'selected' : '' : '' )}}>Princeton University, USA</option>
                                            <option value="U10" {{ old('university')=='U10' ? 'selected' : (isset($application->university) ? $application->university == 'U10' ? 'selected' : '' : '' )}}>California Institute of Technology, USA</option>
                                            <option value="U11" {{ old('university')=='U11' ? 'selected' : (isset($application->university) ? $application->university == 'U11' ? 'selected' : '' : '' )}}>ETH Zurich, Switzerland, Europe</option>
                                            <option value="U12" {{ old('university')=='U12' ? 'selected' : (isset($application->university) ? $application->university == 'U12' ? 'selected' : '' : '' )}}>Technical University of Munich, Germany, Europe</option>
                                            <option value="U13" {{ old('university')=='U13' ? 'selected' : (isset($application->university) ? $application->university == 'U13' ? 'selected' : '' : '' )}}>École Polytechnique Fédérale de Lausanne, Switzerland, Europe</option>
                                            <option value="U14" {{ old('university')=='U14' ? 'selected' : (isset($application->university) ? $application->university == 'U14' ? 'selected' : '' : '' )}}>LMU Munich, Germany, Europe</option>
                                            <option value="U15" {{ old('university')=='U15' ? 'selected' : (isset($application->university) ? $application->university == 'U15' ? 'selected' : '' : '' )}}>Paris Sciences et Lettres - PSL Research University Paris, France, Europe</option>
                                            <option value="U16" {{ old('university')=='U16' ? 'selected' : (isset($application->university) ? $application->university == 'U16' ? 'selected' : '' : '' )}}>Tsinghua University, China</option>
                                            <option value="U17" {{ old('university')=='U17' ? 'selected' : (isset($application->university) ? $application->university == 'U17' ? 'selected' : '' : '' )}}>Peking University, China</option>
                                            <option value="U18" {{ old('university')=='U18' ? 'selected' : (isset($application->university) ? $application->university == 'U18' ? 'selected' : '' : '' )}}>Shanghai Jiao Tong University, China</option>
                                            <option value="U19" {{ old('university')=='U19' ? 'selected' : (isset($application->university) ? $application->university == 'U19' ? 'selected' : '' : '' )}}>Fudan University, China</option>
                                            <option value="U20" {{ old('university')=='U20' ? 'selected' : (isset($application->university) ? $application->university == 'U20' ? 'selected' : '' : '' )}}>The University of Tokyo, Japan</option>
                                        </select>
                                        <!-- End Select -->
                                    </div>
                                    @if($errors->has('university'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{
                                        $errors->first('university') }}</p>
                                    @endif
                                    
                                    <!--Start date-->
                                    <div class="mt-2 relative w-full md:w-1/3">
                                        <input type="date" id="hs-floating-input-startdate" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                    focus:pt-6
                                                    focus:pb-2
                                                    [&:not(:placeholder-shown)]:pt-6
                                                    [&:not(:placeholder-shown)]:pb-2
                                                    autofill:pt-6
                                                    autofill:pb-2" placeholder=""
                                            value="{{ (old('startdate') != null) ? old('startdate') : $application->startdate ?? '' }}" name="startdate">
                                        <label for="hs-floating-input-startdate"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90
                                                    peer-focus:translate-x-0.5
                                                    peer-focus:-translate-y-1.5
                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Start Date</label>
                                    </div>
                                    @if($errors->has('startdate'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{
                                        $errors->first('startdate') }}</p>
                                    @endif
                                    
                                    <!--End date-->
                                    <div class="mt-2 relative w-full md:w-1/3">
                                        <input type="date" id="hs-floating-input-enddate" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                    focus:pt-6
                                                    focus:pb-2
                                                    [&:not(:placeholder-shown)]:pt-6
                                                    [&:not(:placeholder-shown)]:pb-2
                                                    autofill:pt-6
                                                    autofill:pb-2" placeholder=""
                                            value="{{ (old('enddate') != null) ? old('enddate') : $application->enddate ?? '' }}" name="enddate">
                                        <label for="hs-floating-input-enddate"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90
                                                    peer-focus:translate-x-0.5
                                                    peer-focus:-translate-y-1.5
                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">End Date</label>
                                    </div>
                                    @if($errors->has('enddate'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{
                                        $errors->first('enddate') }}</p>
                                    @endif
                                    
                                    <!--Period of Study-->
                                    <div class="mt-2 relative w-full md:w-1/3">
                                        <input type="text" id="hs-floating-input-studyperiod" 
                                            class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                    focus:pt-6 focus:pb-2
                                                    [&:not(:placeholder-shown)]:pt-6
                                                    [&:not(:placeholder-shown)]:pb-2
                                                    autofill:pt-6 autofill:pb-2" 
                                            placeholder=""
                                            value="{{ old('studyperiod') ?? $application->studyperiod ?? '' }}"
                                            name="studyperiod" readonly> <!-- Added readonly to prevent manual edits -->
                                        <label for="hs-floating-input-studyperiod"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90
                                                    peer-focus:translate-x-0.5
                                                    peer-focus:-translate-y-1.5
                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                            Period of Study
                                        </label>
                                    </div>
                                    @if($errors->has('studyperiod'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{
                                        $errors->first('studyperiod') }}</p>
                                    @endif

                                    <!--Mode of Study-->
                                    <div class="mt-2 relative w-full md:w-1/5">
                                        <select id="hs-floating-input-studymode" class="peer p-4 pt-6 block w-full border-gray-200 rounded-lg text-sm 
                                                placeholder-transparent focus:border-blue-500 focus:ring-blue-500 
                                                disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 
                                                dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600"
                                                name="studymode">
                                            <option value="MS01" {{ old('studymode', $application->studymode ?? '') == 'MS01' ? 'selected' : '' }}>Coursework</option>
                                            <option value="MS02" {{ old('studymode', $application->studymode ?? '') == 'MS02' ? 'selected' : '' }}>Research</option>
                                        </select>
                                        <label for="hs-floating-input-studymode" class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                            peer-focus:scale-90 peer-focus:translate-x-0.5 peer-focus:-translate-y-1.5
                                            peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                            peer-[:not(:placeholder-shown)]:scale-90
                                            peer-[:not(:placeholder-shown)]:translate-x-0.5
                                            peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                            peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">
                                            Mode of Study
                                        </label>
                                    </div>
                                    @if($errors->has('studymode'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{
                                        $errors->first('studymode') }}</p>
                                    @endif

                                    <!--Summary of Research Proposal-->
                                    <div class="mt-2 relative w-full md:w-1/2">
                                        <textarea id="hs-floating-input-researchproposalsummary" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                    focus:pt-6
                                                    focus:pb-2
                                                    [&:not(:placeholder-shown)]:pt-6
                                                    [&:not(:placeholder-shown)]:pb-2
                                                    autofill:pt-6
                                                    autofill:pb-2 h-32" placeholder=""
                                            name="researchproposalsummary">{{ (old('researchproposalsummary') != null) ? old('researchproposalsummary') : $application->researchproposalsummary ??
                                            '' }}</textarea>
                                        <label for="hs-floating-input-researchproposalsummary"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent  origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90
                                                    peer-focus:translate-x-0.5
                                                    peer-focus:-translate-y-1.5
                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500 ">Summary
                                            of Research Proposal
                                        </label>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500 ml-3"
                                            id="hs-input-helper-text">
                                                Example:
                                                    1.	A brief background or literature review of the research field. 2. Research Objectives / Problem Statement. 
                                                    3.	Scope of Study / Research Framework. 4.	Significance / Outcome / Impact / Contribution of the Study 
                                        </p>
                                    </div>
                                    @if($errors->has('researchproposalsummary'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{
                                        $errors->first('researchproposalsummary') }}</p>
                                    @endif
                                     
                                    <!--Latest Semester Result (CGPA) -->
                                    <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500 ml-3"
                                        id="hs-input-helper-text">
                                            This section below is only applicable to applicant who has already started their study period. 
                                    </p>
                                    <div class="mt-2 relative w-full md:w-1/4">
                                        <input type="text" id="hs-floating-input-cgpasemresult" 
                                            class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                    focus:pt-6 focus:pb-2
                                                    [&:not(:placeholder-shown)]:pt-6
                                                    [&:not(:placeholder-shown)]:pb-2
                                                    autofill:pt-6 autofill:pb-2" 
                                            placeholder=""
                                            value="{{ old('cgpasemresult', $application->cgpasemresult ?? '') }}"
                                            name="cgpasemresult"
                                            oninput="validateCGPA(this)">
                                        <label for="hs-floating-input-cgpasemresult"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90
                                                    peer-focus:translate-x-0.5
                                                    peer-focus:-translate-y-1.5
                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                            Latest Semester Result (CGPA)
                                        </label>
                                    </div>
                                    @if($errors->has('cgpasemresult'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{
                                        $errors->first('cgpasemresult') }}</p>
                                    @endif

                                    <!--Latest Semester Result (Other) -->
                                    <div class="mt-2 relative w-full md:w-1/4">
                                        <input type="text" id="hs-floating-input-othersemresult" class="peer p-4 block w-full border-gray-200 rounded-lg text-sm 
                                                    placeholder:text-transparent focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                                    dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:ring-neutral-600
                                                    focus:pt-6
                                                    focus:pb-2
                                                    [&:not(:placeholder-shown)]:pt-6
                                                    [&:not(:placeholder-shown)]:pb-2
                                                    autofill:pt-6
                                                    autofill:pb-2" placeholder=""  value="{{ old('othersemresult') ?? $application->othersemresult ?? '' }}" 
                                                    name="othersemresult">
                                        <label for="hs-floating-input-othersemresult"
                                            class="absolute top-0 start-0 p-4 h-full text-sm truncate pointer-events-none transition ease-in-out duration-100 border border-transparent origin-[0_0] dark:text-white peer-disabled:opacity-50 peer-disabled:pointer-events-none
                                                    peer-focus:scale-90
                                                    peer-focus:translate-x-0.5
                                                    peer-focus:-translate-y-1.5
                                                    peer-focus:text-gray-500 dark:peer-focus:text-neutral-500
                                                    peer-[:not(:placeholder-shown)]:scale-90
                                                    peer-[:not(:placeholder-shown)]:translate-x-0.5
                                                    peer-[:not(:placeholder-shown)]:-translate-y-1.5
                                                    peer-[:not(:placeholder-shown)]:text-gray-500 dark:peer-[:not(:placeholder-shown)]:text-neutral-500">
                                                    Latest Semester Result (Other than CGPA)
                                        </label>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500 ml-3"
                                            id="hs-input-helper-text">
                                                        Example: 1. First Class, 2. Second Class Upper, 3. Second Class Lower , 4. Third Class & 5. Pass
                                        </p>
                                    </div>
                                    @if($errors->has('othersemresult'))
                                    <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">
                                        {{
                                        $errors->first('othersemresult') }}</p>
                                    @endif
                                    
                                   <!-- Save button -->
                                {{-- <div class="mt-8">
                                    <hr class="mb-4 border-gray-300">
                                    @if (isset($application->tab06))
                                    @if ($application->tab06 == 1)
                                    Record saved successfully. Please proceed to the next tab.
                                    @endif
                                    @endif
                                    <div id="globalStatusMessage" class="mb-4 text-green-600 text-center"></div>
                                    <button type="button" onclick="submitApplication()" id="submitBtn"
                                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                        Save
                                    </button>
                                </div> --}}
                                <!-- Save button -->
                                <div class="mt-8">
                                    <hr class="mb-4 border-gray-300">
                                    @if (isset($application->tab06) && $application->tab06 == 1)
                                    <div class="text-blue-600 mb-4">
                                        Record saved successfully. Please proceed to the next tab.
                                    </div>
                                    @endif
                                    <button type="submit"
                                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                        Save
                                    </button>
                                </div>
                                    </form>
                                    <!-- End of Study Information -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hs-tab-to-select-7" class="{{ $step == 'document' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-7">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">
                            <div class=" flex flex-col dark:bg-neutral-800 dark:border-neutral-700">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Documents') }}
                                    </h2>
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __("Documents required to be submitted by the applicants. Click on choose file to upload your document or to replace the existing document, applicant can simply replace it by upload the new one.") }}  
                                        <span class="block mt-1"><strong>Note:</strong> {{ __("All documents must be verified by: Commissioner of Oath / Government Officer (Grade A) / Relevant Authorities (School Principal / Penghulu / Ketua Kampung / Pengerusi JKKK/MPKK/KRT / Jaksa Pendamai).") }}</span>
                                    </p>
                                </header>
                                
                                <div class="mt-6 ml-3">
                                    <!-- Document upload  -->
                                    <!-- MyKad -->
                                    <div
                                        class="flex flex-col bg-white border shadow-sm rounded-xl p-4 md:p-4 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                        <h4 class="text-lg font-bold text-gray-800 dark:text-white pt-0">
                                            My Kad
                                        </h4>
                                        <p class="mt-1 text-xs font-medium text-gray-500 dark:text-neutral-500">
                                            Front and back image of My Kad in <strong>ONE</strong> page.
                                        </p>
                                        <p class="mt-2 text-gray-500 dark:text-neutral-400">
                                            <form name="documentForm" method="post" action="/docupload" enctype="multipart/form-data" class="dropzone" id="mykad-form">
                                                @csrf
                                                <input type="hidden" name="doctype" id="doctype" value="D01" />
                                                <input class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent 
                                                        bg-clip-padding px-3 py-[0.32rem] text-base font-normal leading-[2.15] text-surface transition duration-300 ease-in-out file:-mx-3 
                                                        file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid 
                                                        file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 
                                                        focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                                                        id="formFileLg" name="uploadfile_mykad" type="file" 
                                                        accept=".doc, .docx, .pdf, .png, .jpg, .jpeg, .bmp"
                                                        onchange="this.form.submit()" />
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">DOC, DOCX, PDF, PNG, JPG or JPEG (MAX. 2 MB).</p>
                                            </form>

                                            @if($errors->has('uploadfile_mykad'))
                                                <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">{{ $errors->first('uploadFile_mykad') }}</p>
                                            @endif

                                            @if (session('message_mykad'))
                                            <p>{{ session('filename') }}</p>
                                            @else
                                            <p> Uploaded file: 
                                                @foreach ($documents as $document)
                                                    @if ($document->filetype == 'D01')
                                                        {{ $document->filename }}
                                                    @endif
                                                @endforeach
                                            </p>
                                            @endif

                                            @if (session('message_mykad'))
                                            <p>{{ session('message_mykad') }}</p>
                                            @endif
                                        </p>
                                    </div>
                                    <!-- End of MyKad -->
                                    
                                    <!-- Passport Photo -->
                                    <div
                                        class="flex flex-col bg-white border shadow-sm rounded-xl mt-2 p-4 md:p-4 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                        <h4 class="text-lg font-bold text-gray-800 dark:text-white pt-0">
                                            Passport Photo
                                        </h4>
                                        <p class="mt-1 text-xs font-medium text-gray-500 dark:text-neutral-500">
                                            Passport size picture <strong>200 kb</strong>.
                                        </p>
                                        <p class="mt-2 text-gray-500 dark:text-neutral-400">
                                        <form method="post" action="/docupload" enctype="multipart/form-data" id="passportphoto-form">
                                            @csrf
                                            {{-- <input type="file" name="uploadFile"> --}}
                                            <input type="hidden" name="doctype" id="doctype" value="D02" />
                                            <input
                                                class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent 
                                                        bg-clip-padding px-3 py-[0.32rem] text-base font-normal leading-[2.15] text-surface transition duration-300 ease-in-out file:-mx-3 
                                                        file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid 
                                                        file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 
                                                        focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                                                id="formFileLg" name="uploadfile_passport" type="file"
                                                accept=".png, .jpg, .jpeg" onchange="this.form.submit()" />
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG(MAX. 2 MB).</p>
                                        </form>

                                        @if (session('message_passport'))
                                            <p>{{ session('filename') }}</p>
                                        @else
                                        <p>
                                            Uploaded document:
                                                @foreach ($documents as $document)
                                                    @if ($document->filetype == 'D02')
                                                        {{ $document->filename }}
                                                    @endif
                                                @endforeach
                                        </p>
                                            {{-- <div class="inline-flex ml-3 mt-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cloud-upload">
                                                    <title>Uploaded Passport Photo</title>
                                                    <path d="M12 13v8" />
                                                    <path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242" />
                                                    <path d="m8 17 4-4 4 4" />
                                                </svg>
                                                Uploaded document:
                                                @foreach ($documents as $document)
                                                @if ($document->filetype == 'D02')
                                                    <span class="ml-2 text-blue-600 hover:text-blue-500 decoration-2 hover:decoration-white focus:outline-none opacity-70">
                                                        {{ $document->filename }}
                                                @endif
                                                @endforeach
                                            </div> --}}
                                        @endif

                                        @if($errors->has('uploadfile_passport'))
                                            <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">{{ $errors->first('uploadfile_passport') }}</p>
                                        @endif

                                        @if (session('message_passport'))
                                        <p>{{ session('message_passport') }}</p>
                                        @endif
                                        </p>
                                    </div>
                                    <!-- End of Passport Photo -->

                                    <!-- Academic Transcript -->
                                    <div
                                        class="flex flex-col bg-white border shadow-sm rounded-xl mt-2 p-4 md:p-4 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                        <h4 class="text-lg font-bold text-gray-800 dark:text-white pt-0">
                                            Academic Transcript
                                        </h4>
                                        <p class="mt-1 text-xs font-medium text-gray-500 dark:text-neutral-500">
                                            Certified copy of first degree or equivalent. Please provide both scroll and transcript in one single document.
                                        </p>
                                        <p class="mt-2 text-gray-500 dark:text-neutral-400">
                                        <form method="post" action="/docupload" enctype="multipart/form-data" class="dropzone" id="transcript-form">
                                            @csrf
                                            <input type="hidden" name="doctype" id="doctype" value="D03" />
                                            <input
                                                class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent 
                                                                                            bg-clip-padding px-3 py-[0.32rem] text-base font-normal leading-[2.15] text-surface transition duration-300 ease-in-out file:-mx-3 
                                                                                            file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid 
                                                                                            file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 
                                                                                            focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                                                id="formFileLg" name="uploadfile_transcript" type="file" 
                                                accept=".doc, .docx, .pdf," onchange="this.form.submit()" />
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">DOC, DOCX, PDF (MAX. 2 MB).</p>
                                        </form>

                                        @if($errors->has('uploadfile_transcript'))
                                            <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">{{ $errors->first('uploadFile_transcript') }}</p>
                                        @endif

                                        @if (session('message_transcript'))
                                        <p>{{ session('filename') }}</p>
                                        @else
                                        <p> Uploaded file:
                                            @foreach ($documents as $document)
                                            @if ($document->filetype == 'D03')
                                            {{ $document->filename }}
                                            @endif
                                            @endforeach
                                        </p>
                                        @endif

                                        @if (session('message_transcript'))
                                        <p>{{ session('message_transcript') }}</p>
                                        @endif
                                        </p>
                                    </div>
                                    <!-- End of Academic Transcript -->

                                    <!-- Offer Letter -->
                                    <div
                                        class="flex flex-col bg-white border shadow-sm rounded-xl mt-2 p-4 md:p-4 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                        <h4 class="text-lg font-bold text-gray-800 dark:text-white pt-0">
                                            University Offer Letter or Registration Slip
                                        </h4>
                                        <p class="mt-1 text-xs font-medium text-gray-500 dark:text-neutral-500">
                                            Provide your unconditional offer letter or the registration slip or the confirmation letter of the first semester of study
                                        </p>
                                        <p class="mt-2 text-gray-500 dark:text-neutral-400">
                                        <form method="post" action="/docupload" enctype="multipart/form-data" class="dropzone" id="offerletter-form">
                                            @csrf
                                            <input type="hidden" name="doctype" id="doctype" value="D04" />
                                            <input
                                                class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent 
                                                        bg-clip-padding px-3 py-[0.32rem] text-base font-normal leading-[2.15] text-surface transition duration-300 ease-in-out file:-mx-3 
                                                        file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid 
                                                        file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 
                                                        focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                                                id="formFileLg" name="uploadfile_offerletter" type="file" accept=".doc, .docx, .pdf,"
                                                onchange="this.form.submit()" />
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">DOC, DOCX, PDF (MAX. 2 MB).</p>
                                        </form>
                                    
                                        @if($errors->has('uploadfile_offerletter'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">{{ $errors->first('uploadfile_offerletter') }}</p>
                                        @endif

                                        @if (session('message_offerletter'))
                                        <p>{{ session('filename') }}</p>
                                        @else
                                        <p> Uploaded file:
                                            @foreach ($documents as $document)
                                            @if ($document->filetype == 'D04')
                                            {{ $document->filename }}
                                            @endif
                                            @endforeach
                                        </p>
                                        @endif
                                    
                                        @if (session('message_offerletter'))
                                        <p>{{ session('message_offerletter') }}</p>
                                        @endif
                                        </p>
                                    </div>
                                    <!-- End of Offer Letter -->

                                    <!-- Curriculum Vitae -->
                                    <div
                                        class="flex flex-col bg-white border shadow-sm rounded-xl mt-2 p-4 md:p-4 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                        <h4 class="text-lg font-bold text-gray-800 dark:text-white pt-0">
                                            Curriculum Vitae
                                        </h4>
                                        {{-- <p class="mt-1 text-xs font-medium text-gray-500 dark:text-neutral-500">
                                            Certified copy of first degree or equivalent. Please provide both scroll and transcript in one single document.
                                        </p> --}}
                                        <p class="mt-2 text-gray-500 dark:text-neutral-400">
                                        <form method="post" action="/docupload" enctype="multipart/form-data" class="dropzone" id="curriculumvitae-form">
                                            @csrf
                                            <input type="hidden" name="doctype" id="doctype" value="D05" />
                                            <input
                                                class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent 
                                                        bg-clip-padding px-3 py-[0.32rem] text-base font-normal leading-[2.15] text-surface transition duration-300 ease-in-out file:-mx-3 
                                                        file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid 
                                                        file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 
                                                        focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                                                id="formFileLg" name="uploadfile_curriculumvitae" type="file" accept=".doc, .docx, .pdf,"
                                                onchange="this.form.submit()" />
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">DOC, DOCX, PDF (MAX. 2 MB).</p>
                                        </form>
                                    
                                        @if($errors->has('uploadfile_curriculumvitae'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">{{ $errors->first('uploadfile_curriculumvitae') }}</p>
                                        @endif

                                        @if (session('message_curriculumvitae'))
                                        <p>{{ session('filename') }}</p>
                                        @else
                                        <p> Uploaded file:
                                            @foreach ($documents as $document)
                                            @if ($document->filetype == 'D05')
                                            {{ $document->filename }}
                                            @endif
                                            @endforeach
                                        </p>
                                        @endif
                                    
                                        @if (session('message_curriculumvitae'))
                                        <p>{{ session('message_curriculumvitae') }}</p>
                                        @endif
                                        </p>
                                    </div>
                                    <!-- End of Curriculum Vitae -->

                                    <!-- Proof of Employment -->
                                    <div
                                        class="flex flex-col bg-white border shadow-sm rounded-xl mt-2 mb-10 p-4 md:p-4 dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                        <h4 class="text-lg font-bold text-gray-800 dark:text-white pt-0">
                                            Proof of Employment
                                        </h4>
                                        <p class="mt-1 text-xs font-medium text-gray-500 dark:text-neutral-500">
                                            Provide one of the following documents as a proof of your employment
                                            <ul>
                                                <li>A copy of latest salary slip</li>
                                                <li>A copy of latest LHDN Income Statement (Employed/Self Employed)</li>
                                                <li>A copy of confirmation letter (Unemployed / Housewife)</li>
                                            </ul>
                                        </p>
                                        <p class="mt-2 text-gray-500 dark:text-neutral-400">
                                        <form method="post" action="/docupload" enctype="multipart/form-data" class="dropzone" id="employment-form">
                                            @csrf
                                            <input type="hidden" name="doctype" id="doctype" value="D06" />
                                            <input
                                                class="relative m-0 block w-full min-w-0 flex-auto cursor-pointer rounded border border-solid border-secondary-500 bg-transparent 
                                                                                            bg-clip-padding px-3 py-[0.32rem] text-base font-normal leading-[2.15] text-surface transition duration-300 ease-in-out file:-mx-3 
                                                                                            file:-my-[0.32rem] file:me-3 file:cursor-pointer file:overflow-hidden file:rounded-none file:border-0 file:border-e file:border-solid 
                                                                                            file:border-inherit file:bg-transparent file:px-3  file:py-[0.32rem] file:text-surface focus:border-primary focus:text-gray-700 
                                                                                            focus:shadow-inset focus:outline-none dark:border-white/70 dark:text-white  file:dark:text-white"
                                                id="formFileLg" name="uploadfile_employment" type="file" accept=".doc, .docx, .pdf,"
                                                onchange="this.form.submit()" />
                                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-300" id="file_input_help">DOC, DOCX, PDF (MAX. 2 MB).</p>
                                        </form>
                                    
                                        @if($errors->has('uploadfile_employment'))
                                        <p class="text-sm text-red-600 ml-2 mt-0" id="hs-validation-name-error-helper">{{
                                            $errors->first('uploadfile_employment') }}</p>
                                        @endif

                                        @if (session('message_employment'))
                                        <p>{{ session('filename') }}</p>
                                        @else
                                        <p> Uploaded file:
                                            @foreach ($documents as $document)
                                            @if ($document->filetype == 'D06')
                                            {{ $document->filename }}
                                            @endif
                                            @endforeach
                                        </p>
                                        @endif
                                    
                                        @if (session('message_employment'))
                                        <p>{{ session('message_employment') }}</p>
                                        @endif
                                        </p>
                                    </div>
                                    <!-- Save button -->
                                    {{-- <div class="mt-8">
                                        <hr class="mb-4 border-gray-300">
                                        @if (isset($application->tab07))
                                        @if ($application->tab07 == 1)
                                            All required document already uploaded. Please proceed to the next tab.
                                        @endif
                                        @endif
                                       
                                        <br><button type="button" onclick="submitApplication()" id="submitBtn"
                                            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                            Save
                                        </button>
                                    </div> --}}
                                    <!-- Save button -->
                                    <div class="mt-8">
                                        <hr class="mb-4 border-gray-300">
                                        @if (isset($application->tab07) && $application->tab07 == 1)
                                        <div class="text-blue-600 mb-4">
                                            All required document already uploaded. Please proceed to the next tab.
                                        </div>
                                        @endif
                                        <button type="submit"
                                            class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                            Save
                                        </button>
                                    </div>
                                    <!-- End of Proof of Employment -->

                                    <!-- End of document upload -->                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hs-tab-to-select-8" class="{{ $step == 'declaration' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-8">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">
                            <div class=" flex flex-col dark:bg-neutral-800 dark:border-neutral-700">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Declaration') }}
                                    </h2>
                        
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __("Application declaration. Please read and provide your consent to us.") }}
                                    </p>
                                </header>
                                <div class="mt-6 ml-3">
                                    <form id="declarationForm" name="declarationForm" method="POST" action="{{ route('apply.post', ['step' => 'declaration']) }}">
                                        @csrf
                                        <!-- Declaration 1 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            <label for="declaration01"
                                                class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                    1. I have no chronic illnesses, infectious diseases, or conditions requiring follow-up treatment.
                                                </span>
                                                <div class="flex ms-auto">
                                                    <label class="flex items-center mr-4">
                                                        <input type="radio" name="declaration01" id="dec1yes" value="yes" 
                                                            {{ old('declaration01') == 'yes' ? 'checked' : (isset($application->declaration01) ? $application->declaration01 == '1' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                    </label>
                                                    <label class="flex items-center">
                                                        <input type="radio" name="declaration01" id="dec1no" value="no"
                                                            {{ old('declaration01') == 'no' ? 'checked' : (isset($application->declaration01) ? $application->declaration01 == '0' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>

                                        <!-- Declaration 2 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            <label for="declaration02"
                                                class="flex mt-1 p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                    2. I have no psychiatric condition requiring follow-up treatment. 
                                                </span>
                                                <div class="flex ms-auto">
                                                    <label class="flex items-center mr-4">
                                                        <input type="radio" name="declaration02" id="dec1yes" value="yes" 
                                                            {{ old('declaration02') == 'yes' ? 'checked' : (isset($application->declaration02) ? $application->declaration02 == '1' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                    </label>
                                                    <label class="flex items-center">
                                                        <input type="radio" name="declaration02" id="dec1no" value="no"
                                                            {{ old('declaration02') == 'no' ? 'checked' : (isset($application->declaration02) ? $application->declaration02 == '0' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>
                                    
                                        <!-- Declaration 3 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            <label for="declaration03"
                                                class="flex mt-1 p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                    3. I have not been terminated by any sponsor for disciplinary action.
                                                </span>
                                                <div class="flex ms-auto">
                                                    <label class="flex items-center mr-4">
                                                        <input type="radio" name="declaration03" id="dec2yes" value="yes" 
                                                            {{ old('declaration03') == 'yes' ? 'checked' : (isset($application->declaration03) ? $application->declaration03 == '1' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                    </label>
                                                    <label class="flex items-center">
                                                        <input type="radio" name="declaration03" id="dec2no" value="no"
                                                            {{ old('declaration03') == 'no' ? 'checked' : (isset($application->declaration03) ? $application->declaration03 == '0' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>
                                    
                                        <!-- Declaration 4 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            <label for="declaration04"
                                                class="flex mt-1 p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                    4. I have never committed any criminal offences and being charged at any court in Malaysia.
                                                </span>
                                                <div class="flex ms-auto">
                                                    <label class="flex items-center mr-4">
                                                        <input type="radio" name="declaration04" id="dec3yes" value="yes"
                                                            {{ old('declaration04') == 'yes' ? 'checked' : (isset($application->declaration04) ? $application->declaration04 == '1' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                    </label>
                                                    <label class="flex items-center">
                                                        <input type="radio" name="declaration04" id="dec3no" value="no"
                                                            {{ old('declaration04') == 'no' ? 'checked' : (isset($application->declaration04) ? $application->declaration04 == '0' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>
                                    
                                        <!-- Declaration 5 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            <label for="declaration05"
                                                class="flex mt-1 p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                    5. I have no other scholarships/loans for the same level of study applied.
                                                </span>
                                                <div class="flex ms-auto">
                                                    <label class="flex items-center mr-4">
                                                        <input type="radio" name="declaration05" id="dec4yes" value="yes"
                                                            {{ old('declaration05') == 'yes' ? 'checked' : (isset($application->declaration05) ? $application->declaration05 == '1' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                    </label>
                                                    <label class="flex items-center">
                                                        <input type="radio" name="declaration05" id="dec4no" value="no"
                                                            {{ old('declaration05') == 'no' ? 'checked' : (isset($application->declaration05) ? $application->declaration05 == '0' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>
                                    
                                        <!-- Declaration 6 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            <label for="declaration06"
                                                class="flex mt-1 p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                    6. I hereby consent to and conscientiously declare that YTI reserves the right to decline the
                                                    application or withdraw
                                                    <p>sponsorship awarded at any time should any of the information provided are false.</p>
                                                </span>
                                                <div class="flex ms-auto">
                                                    <label class="flex items-center mr-4">
                                                        <input type="radio" name="declaration06" id="dec5yes" value="yes"
                                                            {{ old('declaration06') == 'yes' ? 'checked' : (isset($application->declaration06) ? $application->declaration06 == '1' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                    </label>
                                                    <label class="flex items-center">
                                                        <input type="radio" name="declaration06" id="dec4no" value="no"
                                                            {{ old('declaration06') == 'no' ? 'checked' : (isset($application->declaration06) ? $application->declaration06 == '0' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>
                                    
                                        <!-- Declaration 7 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            <label for="declaration07"
                                                class="flex mt-1 p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                    7. I hereby undertake and agree to comply with all the terms and conditions set forth by YTI at any
                                                    time.
                                                </span>
                                                <div class="flex ms-auto">
                                                    <label class="flex items-center mr-4">
                                                        <input type="radio" name="declaration07" id="dec6yes" value="yes"
                                                            {{ old('declaration07') == 'yes' ? 'checked' : (isset($application->declaration07) ? $application->declaration07 == '1' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                    </label>
                                                    <label class="flex items-center">
                                                        <input type="radio" name="declaration07" id="dec6no" value="no"
                                                            {{ old('declaration07') == 'no' ? 'checked' : (isset($application->declaration07) ? $application->declaration07 == '0' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>
                                    
                                        <!-- Declaration 8 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            <label for="declaration08"
                                                class="flex mt-1 p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                    8. I hereby declare in good faith that all information provided in this form are true.
                                                </span>
                                                <div class="flex ms-auto">
                                                    <label class="flex items-center mr-4">
                                                        <input type="radio" name="declaration08" id="dec7yes" value="yes"
                                                            {{ old('declaration08') == 'yes' ? 'checked' : (isset($application->declaration08) ? $application->declaration08 == '1' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                    </label>
                                                    <label class="flex items-center">
                                                        <input type="radio" name="declaration08" id="dec7no" value="no"
                                                            {{ old('declaration08') == 'no' ? 'checked' : (isset($application->declaration08) ? $application->declaration08 == '0' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>
                                    
                                        <!-- Declaration 9 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            <label for="declaration09"
                                                class="flex mt-1 p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                    9. I am committed to return to Malaysia after completing my studies and contribute to the country’s
                                                    development.
                                                </span>
                                                <div class="flex ms-auto">
                                                    <label class="flex items-center mr-4">
                                                        <input type="radio" name="declaration09" id="dec8yes" value="yes"
                                                            {{ old('declaration09') == 'yes' ? 'checked' : (isset($application->declaration09) ? $application->declaration09 == '1' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                    </label>
                                                    <label class="flex items-center">
                                                        <input type="radio" name="declaration09" id="dec8no" value="no"
                                                            {{ old('declaration09') == 'no' ? 'checked' : (isset($application->declaration09) ? $application->declaration09 == '0' ? 'checked' : '' : '' )}}
                                                            class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                        <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>
                                       <!-- Save button -->
                                        {{-- <div class="mt-8">
                                            <hr class="mb-4 border-gray-300">
                                            @if (isset($application->tab08))
                                            @if ($application->tab08 == 1)
                                            Record saved successfully. Please proceed to the next tab.
                                            @endif
                                            @endif
                                            <div id="globalStatusMessage" class="mb-4 text-green-600 text-center"></div>
                                            <button type="button" onclick="submitApplication()" id="submitBtn"
                                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                Save
                                            </button>
                                        </div> --}}
                                        <!-- Save button -->
                                        <div class="mt-8">
                                            <hr class="mb-4 border-gray-300">
                                            @if (isset($application->tab08) && $application->tab08 == 1)
                                            <div class="text-blue-600 mb-4">
                                                Record saved successfully. Please proceed to the next tab.
                                            </div>
                                            @endif
                                            <button type="submit"
                                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hs-tab-to-select-9" class="{{ $step == 'consent' ? '' : 'hidden' }}" role="tabpanel" aria-labelledby="hs-tab-to-select-item-9">
                        <div class="p-3 sm:p-0 ml-5 mr-5 mt-0 mb-5">
                            <div class=" flex flex-col dark:bg-neutral-800 dark:border-neutral-700">
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Consent') }}
                                    </h2>
                        
                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __("Application consent. Please read and provide your consent to us.") }}
                                    </p>
                                </header>
                                <div class="mt-6 ml-3">
                                    <form id="consentForm" name="consentForm" method="POST" action="{{ route('apply.post', ['step' => 'consent']) }}">
                                        @csrf
                                        <!-- Consent 1 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            {{-- <div class="declaration"> --}}
                                                <label for="consent1"
                                                    class="flex p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                    <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                        1. By submitting and signing this Declaration, I hereby agree and consent that YTI may collect,
                                                        obtain, store and process my personal date which I provide in this Declaration for the purposes of
                                                        processing this sponsorship application in accordance with the relevant provisions on personal data.
                                                    </span>
                                                    <div class="flex ms-auto">
                                                        <label class="flex items-center mr-4">
                                                            <input type="radio" name="consent01" id="consent01" value="yes"
                                                                {{ old('consent01') == 'yes' ? 'checked' : (isset($application->consent01) ? $application->consent01 == '1' ? 'checked' : '' : '' )}}
                                                                class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                            <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                        </label>
                                                        <label class="flex items-center">
                                                            <input type="radio" name="consent01" id="consent01" value="no"
                                                                {{ old('consent01') == 'no' ? 'checked' : (isset($application->consent01) ? $application->consent01 == '0' ? 'checked' : '' : '' )}}
                                                                class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                            <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                        </label>
                                                    </div>
                                                </label>
                                                {{--
                                            </div> --}}
                                        </div>
                                    
                                        <!-- Consent 2 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            {{-- <div class="declaration"> --}}
                                                <label for="consent2"
                                                    class="flex mt-1 p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                    <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                        2. I hereby agree and consent that YTI may:
                                                        <p>-Store and process my personal data for the purpose of verification and consideration of this
                                                            sponsorship application; and/or </p>
                                                        <p>-declare, supply and/or submit my personal data to the relevant Government authorities or third
                                                            parties, as required by law.</p>
                                                    </span>
                                                    <div class="flex ms-auto">
                                                        <label class="flex items-center mr-4">
                                                            <input type="radio" name="consent02" id="consent02" value="yes"
                                                            {{ old('consent02') == 'yes' ? 'checked' : (isset($application->consent02) ? $application->consent02 == '1' ? 'checked' : '' : '' )}}   
                                                                class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                            <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                        </label>
                                                        <label class="flex items-center">
                                                            <input type="radio" name="consent02" id="consent02" value="no"
                                                                {{ old('consent02') == 'no' ? 'checked' : (isset($application->consent02) ? $application->consent02 == '0' ? 'checked' : '' : '' )}}
                                                                class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                            <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                        </label>
                                                    </div>
                                                </label>
                                                {{--
                                            </div> --}}
                                        </div>
                                    
                                        <!-- Consent 3 -->
                                        <div class="grid sm:grid-cols-1 gap-2">
                                            {{-- <div class="declaration"> --}}
                                                <label for="consent3"
                                                    class="flex mt-1 p-3 w-full bg-white border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                                    <span class="text-sm text-gray-500 dark:text-neutral-400">
                                                        3. I hereby agree that all the above is true and it has been accurately recorded.
                                                        <p>In the event of any fraud and/or inaccuracy of the information even if it is unintentionally
                                                            provided while signing this Declaration, YTI reserves the right to reject this application or
                                                            terminate my sponsorship at any time, even if the offer has been awarded.</p>
                                                    </span>
                                                    <div class="flex ms-auto">
                                                        <label class="flex items-center mr-4">
                                                            <input type="radio" name="consent03" id="consent03" value="yes"
                                                                {{ old('consent03') == 'yes' ? 'checked' : (isset($application->consent03) ? $application->consent03 == '1' ? 'checked' : '' : '' )}}
                                                                class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                            <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">Yes</span>
                                                        </label>
                                                        <label class="flex items-center">
                                                            <input type="radio" name="consent03" id="consent03" value="no"
                                                                {{ old('consent03') == 'no' ? 'checked' : (isset($application->consent03) ? $application->consent03 == '0' ? 'checked' : '' : '' )}}
                                                                class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                                            <span class="ml-2 text-sm text-gray-500 dark:text-neutral-400">No</span>
                                                        </label>
                                                    </div>
                                                </label>
                                                {{--
                                            </div> --}}
                                        </div>
                                        <!-- Save button -->
                                        <div>
                                            @if (isset($application->user_id))
                                            <input type="hidden" id="tab01" name="tab01" value="{{ $application->tab01 }}" />
                                            <input type="hidden" id="tab02" name="tab02" value="{{ $application->tab02 }}" />
                                            <input type="hidden" id="tab03" name="tab03" value="{{ $application->tab03 }}" />
                                            <input type="hidden" id="tab04" name="tab04" value="{{ $application->tab04 }}" />
                                            <input type="hidden" id="tab05" name="tab05" value="{{ $application->tab05 }}" />
                                            <input type="hidden" id="tab06" name="tab06" value="{{ $application->tab06 }}" />
                                            <input type="hidden" id="tab07" name="tab07" value="{{ $application->tab07 }}" />
                                            <input type="hidden" id="tab08" name="tab08" value="{{ $application->tab08 }}" />
                                            <input type="hidden" id="tab09" name="tab09" value="{{ $application->tab09 }}" />
                                            <input type="hidden" id="tab10" name="tab10" value="{{ $application->tab10 }}" />
                                            @endif
                                        </div>
                                        <div class="mt-8">
                                            {{-- <button type="submit"
                                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                                Save
                                            </button> --}}
                                            
                                            <button type="submit" id="submitBtn" name="submitBtn"
                                                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 
                                                                                                    focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none" onclick="submitApplication()">
                                                Save & Submit Application
                                            </button>

                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Tabbed Form -->
            </div>
        </div>
    </div>
    {{-- </div> --}}

    {{-- <script>
        {!! Vite::content('resources/js/yti.main.js') !!}
    </script> --}}
    
    @section('scripts')
    
    <script> 
        // function fnShowPopup(messageText, alertType){
        //     $.notify({
        //             title: '<strong>YTI Scholarship</strong>',
        //             message: '<br />'+ messageText +'<br />'
        //         },
        //         {
        //             element: 'body',
        //             allow_dismiss: true,
        //             type: alertType,
        //             placement: {
        //                 from: "top",
        //                 align: "center"
        //             },
        //             template: ' <div data-notify="container" class="col-xs-11 col-sm-4 alert alert-{0}" role="alert" style="margin: 15px 0 15px 0; width: 450px; opacity: 0.5;">' +
        //             '               <button type="button" aria-hidden="true" class="close" data-notify="dismiss">&times;</button>' +
        //             '               <span data-notify="icon"></span> <span data-notify="title">{1}</span> ' +
        //             '               <span data-notify="message">{2}</span>' +
        //             '               <div class="progress" data-notify="progressbar">' +
        //             '                   <div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        //             '               </div>' +
        //             '               <a href="{3}" target="{4}" data-notify="url"></a>' +
        //             '           </div>'
        //         });
        // }

        //Study Period auto calculate
        document.addEventListener("DOMContentLoaded", function () {
            const startDateInput = document.getElementById("hs-floating-input-startdate");
            const endDateInput = document.getElementById("hs-floating-input-enddate");
            const studyPeriodInput = document.getElementById("hs-floating-input-studyperiod");

            function calculateStudyPeriod() {
                let startDate = new Date(startDateInput.value);
                let endDate = new Date(endDateInput.value);

                if (!isNaN(startDate) && !isNaN(endDate) && startDate <= endDate) {
                    let totalDays = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24)); // Total days
                    let years = Math.floor(totalDays / 365); // Get full years
                    let remainingDays = totalDays % 365; // Get leftover days after full years
                    let months = Math.floor(remainingDays / 30); // Approximate months
                    let days = remainingDays % 30; // Remaining days after months
                    
                    studyPeriodInput.value = `${years} years, ${months} months, ${days} days`;
                } else {
                    studyPeriodInput.value = "";
                }
            }

            startDateInput.addEventListener("change", calculateStudyPeriod);
            endDateInput.addEventListener("change", calculateStudyPeriod);
        });

        function validateCGPA(input) {
            let value = input.value;

            // Allow only numbers and decimal points
            value = value.replace(/[^0-9.]/g, '');

            // Ensure only one decimal point
            if ((value.match(/\./g) || []).length > 1) {
                value = value.substring(0, value.lastIndexOf('.'));
            }

            // Format to exactly 2 decimal places
            if (value.includes('.')) {
                let parts = value.split('.');
                parts[0] = parts[0].slice(0, 1); // Only allow 1 digit before the decimal
                parts[1] = parts[1].slice(0, 2); // Only allow 2 digits after the decimal
                value = parts.join('.');
            }

            // Ensure CGPA is within 0.00 - 4.00
            if (value !== "" && parseFloat(value) > 4.00) {
                value = "4.00";
            }

            input.value = value;
        }

        //For Emergency Phone Number
        document.addEventListener("DOMContentLoaded", function () {
            let emergencyInput = document.getElementById("hs-floating-input-emergencyphone");
            if (emergencyInput) {
                emergencyInput.addEventListener("input", function () {
                    formatMobileNumber(this); // Reuse the same function as mobile phone
                });
            }
        });
        function formatMobileNumber(input) {
            // Remove all non-numeric characters
            let phone = input.value.replace(/\D/g, '');
            // Limit to a max of 11 digits
            if (phone.length > 11) {
                phone = phone.substring(0, 11);
            }
            // Apply format based on length
            if (phone.length >= 8) {
                input.value = phone.substring(0, 3) + '-' + phone.substring(3);
            } else {
                input.value = phone; // Keep raw input if less than 8 digits
            }
        }

        // For Mobile phone number
        document.addEventListener("DOMContentLoaded", function () {
            let mobileInput = document.getElementById("hs-floating-input-mobilephone");
            if (mobileInput) {
                mobileInput.addEventListener("input", function () {
                    formatMobileNumber(this);
                });
            }
        });
        function formatMobileNumber(input) {
            // Remove all non-numeric characters
            let phone = input.value.replace(/\D/g, '');
            // Limit to a max of 11 digits
            if (phone.length > 11) {
                phone = phone.substring(0, 11);
            }
            // Apply proper formatting
            if (phone.length >= 4) {
                input.value = phone.substring(0, 3) + '-' + phone.substring(3);
            } else {
                input.value = phone; // Keep raw input if less than 4 digits
            }
        }


        // For Office and House phone number
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".phone-format").forEach(function(input) {
                input.addEventListener("input", function() {
                    formatPhoneNumber(this);
                });
            });
        });

        function formatPhoneNumber(input) {
            // Remove all non-numeric characters
            let phone = input.value.replace(/\D/g, '');

            // Limit to 10 digits
            if (phone.length > 10) {
                phone = phone.substring(0, 10);
            }

            // Format XX-XXXXXXXX
            if (phone.length > 2) {
                phone = phone.substring(0, 2) + '-' + phone.substring(2);
            }

            input.value = phone;
        }

        function validateCGPA(input) {
            // Allow only numbers with up to 2 decimal places
            input.value = input.value
                .replace(/[^0-9.]/g, '')        // Remove non-numeric and non-dot characters
                .replace(/(\..*)\./g, '$1')      // Prevent multiple dots
                .replace(/^0+(?!\.)/, '')        // Remove leading zeros unless it's "0."
                .replace(/^(\d+\.?\d{0,2}).*/, '$1'); // Limit to 2 decimal places
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Function to toggle the disable/enable state based on the employment status
            const employmentStatus = document.getElementById('employmentstatus-select');
            const fieldsToDisable = [
                document.getElementById('hs-floating-input-employername'),
                document.getElementById('hs-floating-input-employeraddress'),
                document.getElementById('hs-floating-input-officephone'),
                document.getElementById('hs-floating-input-position'),
                document.getElementById('hs-floating-input-salary')
            ];

            function toggleFields() {
                const isUnemployed = employmentStatus.value === 'U';

                fieldsToDisable.forEach(field => {
                    if (isUnemployed) {
                        field.setAttribute('disabled', true);
                        field.classList.add('opacity-50', 'cursor-not-allowed');
                    } else {
                        field.removeAttribute('disabled');
                        field.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                });
            }

            // Run the toggle function on page load and when the employment status changes
            toggleFields();
            employmentStatus.addEventListener('change', toggleFields);
        });
        
        document.addEventListener("DOMContentLoaded", function () {
            let studyExtensionSelect = document.getElementById("studyextension-select");
            let reasonExtensionTextarea = document.getElementById("hs-floating-input-reasonextension");

            function toggleTextarea() {
                if (studyExtensionSelect.value === "No") {
                    reasonExtensionTextarea.value = ""; // Clear the field if "No" is selected
                    reasonExtensionTextarea.readOnly = true; // Use readOnly instead of disabled
                    reasonExtensionTextarea.classList.add("opacity-50", "pointer-events-none");
                } else {
                    reasonExtensionTextarea.readOnly = false; // Allow input when other options are selected
                    reasonExtensionTextarea.classList.remove("opacity-50", "pointer-events-none");
                }
            }

            // Run on page load
            toggleTextarea();

            // Listen for changes
            studyExtensionSelect.addEventListener("change", toggleTextarea);
        });

        function submitApplication(){
            const status = 'complete';

            const data = new FormData();
            data.append('status', status);
            
            if (!document.getElementById('submitBtn').disabled) {
                
                fetch('/apply/complete', { // Replace '/update' with your actual route path
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token if required (for Laravel)
                    },
                    body: data
                })
                .then(response => {
                    if (response.ok) {
                        alert('Form submitted successfully. A confirmation email has been sent.');
                    } else {
                        throw new Error('Form submission failed.');
                    }
                })
                .then(data => {
                    console.log('Success:', data);
                    // Handle success response (optional)
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Handle error response (optional)
                });
            }
        }
        
        // Salary JavaScript function
        function formatSalaryInput(input) {
        let value = input.value.replace(/[^0-9.]/g, ''); // Remove non-numeric characters except '.'
        
        // Ensure only one decimal point is allowed
        let parts = value.split('.');
        if (parts.length > 2) {
        parts = [parts[0], parts.slice(1).join('')]; // Merge extra decimals into fractional part
        }
        
        // Remove leading zeros from the integer part
        parts[0] = parts[0].replace(/^0+/, '') || '0';
        
        // Limit to two decimal places
        if (parts[1]) {
        parts[1] = parts[1].substring(0, 2);
        }
        
        // Store raw numeric value without commas
        let rawValue = parts.join('.');
        
        // Format the integer part with commas for UI display
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        // Reconstruct the final formatted value with "RM" prefix
        let formattedValue = parts.join('.');
        
        // Set the input value with RM prefix (UI only)
        input.value = formattedValue ? `RM ${formattedValue}` : 'RM 0';
        
        // Store raw value without commas in a hidden input field
        input.setAttribute('data-raw-value', rawValue);
        }
    
        if (document.getElementById('appStatus').value == 'complete'){
            const personalForm      = document.forms['personalForm'];
            const parentdetailsForm = document.forms['parentdetailsForm'];
            const academicForm      = document.forms['academicForm'];
            const spmForm           = document.forms['spmForm'];
            const skillsForm        = document.forms['skillsForm'];
            const workForm          = document.forms['workForm'];
            const studyForm         = document.forms['studyForm'];

            // const documentForm      = document.forms['documentForm'];
            const mykadForm         = document.forms['mykad-form'];
            const passportForm      = document.forms['passportphoto-form'];
            const transcriptForm    = document.forms['transcript-form'];
            const offerLetterForm   = document.forms['offerletter-form'];
            const curriculumForm    = document.forms['curriculumvitae-form'];
            const employmentForm    = document.forms['employment-form'];

            const declarationForm   = document.forms['declarationForm'];
            const consentForm       = document.forms['consentForm'];
        

            const personalInputs      = personalForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const parentdetailsInputs = parentdetailsForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const academicInputs      = academicForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const spmInputs           = spmForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const skillsInputs        = skillsForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const workInputs          = workForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const studyInputs         = studyForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');

            // const documentInputs    = documentForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const mykadInput        = mykadForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const passporInput      = passportForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const transcriptInput   = transcriptForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const offerLetterInput  = offerLetterForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const curriculumInput   = curriculumForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const employmentInput   = employmentForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');

            const declarationInputs = declarationForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');
            const consentInputs     = consentForm.querySelectorAll('input[type="text"], select, textarea, input[type="file"], input[type="radio"], button');

            personalInputs.forEach(function(element) {
                element.disabled = true;
            });

            parentdetailsInputs.forEach(function(element){
                element.disabled = true;
            });

            academicInputs.forEach(function(element) {
            element.disabled = true;
            });

            spmInputs.forEach(function(element) {
            element.disabled = true;
            });

            skillsInputs.forEach(function(element) {
            element.disabled = true;
            });

            workInputs.forEach(function(element) {
            element.disabled = true;
            });

            studyInputs.forEach(function(element) {
            element.disabled = true;
            });

            mykadInput.forEach(function(element) {
            element.disabled = true;
            });
            passporInput.forEach(function(element) {
            element.disabled = true;
            });
            transcriptInput.forEach(function(element) {
            element.disabled = true;
            });
            offerLetterInput.forEach(function(element) {
            element.disabled = true;
            });
            curriculumInput.forEach(function(element) {
            element.disabled = true;
            });
            employmentInput.forEach(function(element) {
            element.disabled = true;
            });


            declarationInputs.forEach(function(element) {
            element.disabled = true;
            });

            consentInputs.forEach(function(element) {
            element.disabled = true;
            });
            
        }
        //added Others textboxes
        document.getElementById('race-select').addEventListener('change', function () {
            var otherRaceField = document.getElementById('other-race-field');
            if (this.value === 'others' || this.value === 'B04' || this.value === 'B05') {
                otherRaceField.classList.remove('hidden');
            } else {
                otherRaceField.classList.add('hidden');
            }
        });
        
        document.getElementById('birthstate-select').addEventListener('change', function () {
            var otherstateField = document.getElementById('other-state-field');
            if (this.value === 'others') {
                otherstateField.classList.remove('hidden');
            } else {
                otherstateField.classList.add('hidden');
            }
        });

        document.getElementById('permanentstate-select').addEventListener('change', function () {
            var otherpermanentstateField = document.getElementById('other-permanentstate-field');
            if (this.value === 'others') {
                otherpermanentstateField.classList.remove('hidden');
            } else {
                otherpermanentstateField.classList.add('hidden');
            }
        });

        document.getElementById('emergencystate-select').addEventListener('change', function () {
            var otheremergencystateField = document.getElementById('other-emergencystate-field');
            if (this.value === 'others') {
                otheremergencystateField.classList.remove('hidden');
            } else {
                otheremergencystateField.classList.add('hidden');
            }
        });

        document.getElementById('relationship-select').addEventListener('change', function () {
            var otherrelationshipField = document.getElementById('other-relationship-field');
            if (this.value === 'others') {
                otherrelationshipField.classList.remove('hidden');
            } else {
                otherrelationshipField.classList.add('hidden');
            }
        });
    </script>
    @stop    
</x-app-layout>

