<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="... group" novalidate>
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full peer" type="text" name="name" 
                :value="old('name')" required autofocus autocomplete="name" 
                placeholder=" " pattern="^[A-Za-z@'\\s]+$" />
            <span id="name-error" class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                Name can only contain letters, @, and single quotes.
            </span>
            @error('name')
                <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- MyKad -->
        <div class="mt-4">
            <x-input-label for="mykad" :value="__('MyKad Number')" />
            <x-text-input id="mykad" class="block mt-1 w-full peer" type="text" name="mykad" 
                :value="old('mykad')" required maxlength="14" placeholder=" " pattern="\d{6}-\d{2}-\d{4}" />
            <span id="mykad-error" class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                MyKad must be in the format 000000-00-0000.
            </span>
            @error('mykad')
                <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full peer" type="email" name="email" 
                :value="old('email')" placeholder=" " required
                pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}" 
                title="Please enter a valid email address." 
                onpaste="return false;" oncopy="return false;" oncut="return false;" />
            <span id="email-error" class="mt-2 hidden text-sm text-red-500">
                Please enter a valid email address.
            </span>
            @error('email')
                <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Confirm Email Address -->
        <div class="mt-4">
            <x-input-label for="email_confirmation" :value="__('Confirm Email')" />
            <x-text-input id="email_confirmation" class="block mt-1 w-full peer" type="email" name="email_confirmation" 
                :value="old('email_confirmation')" placeholder=" " required
                pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}" 
                title="Please enter a valid email address." 
                onpaste="return false;" oncopy="return false;" oncut="return false;" />
            <span id="email-error" class="mt-2 hidden text-sm text-red-500">
                Please enter a valid email address.
            </span>
            @error('email_confirmation')
                <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full peer" type="password" name="password" 
                required autocomplete="new-password" placeholder=" " 
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d|.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{12,}$" />
            <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                Password must:
                <ul class="list-disc pl-6">
                    <li>Be at least 12 characters long.</li>
                    <li>Include uppercase and lowercase letters.</li>
                    <li>Include at least one number or special character.</li>
                </ul>
            </span>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full peer" type="password"
                name="password_confirmation" required autocomplete="new-password" placeholder=" " 
                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d|.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{12,}$" />
            <span class="mt-2 hidden text-sm text-red-500 peer-[&:not(:placeholder-shown):not(:focus):invalid]:block">
                Password must be at least 12 characters and include at least 3 of the following: uppercase letters, lowercase letters, numbers, or special characters.
            </span>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Secret Question -->
        <div class="mt-4">
            <x-input-label for="secret_question">Select a Secret Question</x-input-label>
            <select id="secret_question" class="block mt-1 w-full" name="secret_question" required
                onchange="toggleSecretAnswer()">
                <option value="" disabled selected>Select a secret question</option>
                <option value="your_first_pet">What was the name of your first pet?</option>
                <option value="mother_maiden_name">What is your mother's maiden name?</option>
                <option value="favorite_food">What is your favorite food?</option>
                <option value="first_school">What was the name of your first school?</option>
            </select>
            @if ($errors->has('secret_question'))
                <span class="text-danger">{{ $errors->first('secret_question') }}</span>
            @endif
        </div>
        
        <!-- Secret Answer -->
        <div class="mt-4" id="secret_answer_group" style="display: none;">
            <x-input-label for="secret_answer">Answer to Secret Question</x-input-label>
            <textarea id="secret_answer" class="block mt-1 w-full" name="secret_answer" rows="3"></textarea>
            @if ($errors->has('secret_answer'))
                <span class="text-danger">{{ $errors->first('secret_answer') }}</span>
            @endif
        </div>
        
        <br>

        <!-- Terms and Conditions Agreement with Checkbox -->
        <div class="mt-4">
            <label for="pdpa_check" class="inline-flex items-center">
                <input id="pdpa_check" type="checkbox" class="form-checkbox rounded text-blue-600" name="pdpa_check" value="1" required>
                <span class="ml-2">
                    I agree to the 
                    <a href="#" class="text-blue-600 hover:underline" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-basic-modal" data-hs-overlay="#hs-basic-modal">
                        terms and conditions and privacy policy.
                    </a>
                </span>
            </label>
            <x-input-error :messages="$errors->get('pdpa_check')" class="mt-2" />
        </div>

        <!-- Register Button -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('welcome') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ms-4 group-invalid:pointer-events-none group-invalid:opacity-30" type="submit" id="register-button" disabled>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Modal for Privacy Statement (Content remains, but no checkbox or Agree button) -->
    <div id="hs-basic-modal" class="modal hs-overlay hs-overlay-open:opacity-100 hs-overlay-open:duration-500 hidden size-full fixed top-0 start-0 z-[80] opacity-0 overflow-x-hidden transition-all overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-basic-modal-label">
            <div class="modal-content lg:max-w-4xl lg:w-full m-3 lg:mx-auto ">
                <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                        <h3 id="hs-basic-modal-label" class="font-bold text-gray-800 dark:text-white">
                            Privacy Statement
                        </h3>
                        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-basic-modal">
                            <span class="sr-only">Close</span>
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18"></path>
                                <path d="m6 6 12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-4 overflow-y-auto max-h-[70vh]">
                        <p class="text-gray-800 dark:text-neutral-400">
                            In accordance with the Personal Data Protection Act 2010 of Malaysia, this Privacy Statement explains: (i) the type of personal data we collect and how we collect it; (ii) how we use your personal data; (iii) the parties that we disclose that personal data to; and (iv) the choices we offer, including how to access and update your personal data. By submitting your personal data, you consent to the use of that personal data as set out in this statement. Any changes will be published herein on this website.
                        </p>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Information Collected</h4>
                        <ol class="mt-2 text-gray-800 dark:text-neutral-400">
                            <li>1.1 We may collect personal data from you from a variety of sources, including personal data we collect from you directly or with your authorization pursuant to this application, when you visit our websites and from other sources permitted by law.</li>
                            <li>1.2 Information which we collect generally includes any data, which include but are not limited to:</li>
                        </ol>

                        <!-- <ol class="list-disc space-y-3 text-sm" start="1.1">
                            <li>We may collect personal data from you from a variety of sources, including personal data we collect from you directly or with your authorization pursuant to this application, when you visit our websites and from other sources permitted by law.</li>
                            <li>Information which we collect generally includes any data, which include but are not limited to:
                                </li>
                            <li></li>
                            </ol> -->
                        <!-- <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            1.1 We may collect personal data from you from a variety of sources, including personal data we collect from you directly or with your authorization pursuant to this application, when you visit our websites and from other sources permitted by law.
                        </p>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            1.2 Information which we collect generally includes any data, which include but are not limited to:
                        </p> -->
                        <ol class="list-disc pl-5 text-gray-800 dark:text-neutral-400 roman-numerals">
                            <li>Your name, home address, email address, phone number, date of birth, age, gender, race, National Registration Identification Card (NRIC), employment (if applicable) as well as financial information.</li>
                            <li>Personal information collected pursuant to you making and submitting this application.</li>
                            </ol>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Use of the personal data</h4>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            1. The personal data that we gather and collect is used in the ordinary course of our business including the processing of, verification and deliberation of your application.
                        </p>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            2. Provision of your information is compulsory. If you do not provide your personal data to be used for the purposes as mentioned herein may result in us not being able to process your application, which shall not render us responsible or liable for.
                        </p>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Disclosure of the personal data</h4>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            1. We shall not disclose your personal data to any third parties unless we have obtained your consent.
                        </p>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            2. You further consent that we are allowed to share the personal data among our group of companies and (if applicable) third party service provider (who have agreed to keep your personal data confidential) in carrying out our business (particularly for purposes of the application) but only in circumstances when such sharing conforms to law, our policies and practices. 
                        </p>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            3. Not with standing the generality of this Privacy Statement, we may disclose your personal data to other third parties where such disclosure: 
                        </p>
                        
                            <ol class="list-decimal pl-5 text-gray-800 dark:text-neutral-400 roman-numerals">
                                <li>is in compliance with any judicial order or legal requirements;</li>
                                <li>is requested or authorised by you; and is lawfully permitted or required.</li>
                            </ol>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Security of the Information</h4>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            1. We are committed to keep your personal data secure. We have approriate physical, technical and administrative procedures in place to protect your personal data from loss, misuse or alteration. 
                        </p>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Retention of the Information</h4>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            1. Your personal data shall be stored in the server and in the proper storage place maintained/provided by us. 
                        </p>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            2. The period of retention of your Information varies depending on the types of documents and is maintained in accordance with our internal retention policies and procedures.
                        </p>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Accuracy of the Information</h4>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            1. We take steps to keep your personal data accurate, complete, not misleading and up-to-date.
                        </p>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            2. Please ensure the accuracy and completeness of all personal data which you disclose or share. Please update and notify us in writing of any changes in the personal data.
                        </p>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Access to the Information</h4>
                        <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            You have the right to access your personal data maintained by us and to request for the update or correction of the personal data that is inaccurate or misleading, by sending in your request in writing to the following address: 
                        </p>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Education Department</h4>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Permodalan Nasional Berhad</h4>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Level 78, Menara Merdeka 118,</h4>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Presint Merdeka 118,</h4>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">50118 Kuala Lumpur.</h4>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Phone: +603 2639 3105/ +603 2693 4547</h4>
                        <h4 class="mt-4 font-semibold text-gray-800 dark:text-white">Email : edd@pnb.com.my</h4>
                        <!-- <p class="mt-2 text-gray-800 dark:text-neutral-400">
                            By clicking the "Agree" button, you hereby indicate and acknowledge that you have read and understood the PDPA Notice and hereby consent and agree for us to process your personal data.
                        </p> -->
                    </div>
                    
                    <div class="flex flex-col items-start py-3 px-4 border-t dark:border-neutral-700">
                        <!-- <label class="inline-flex items-center">
                            <input id="pdpa_check" type="checkbox" class="form-checkbox rounded text-blue-600" name="pdpa_check" value="1" required>
                            <span class="ml-2 text-gray-800 dark:text-neutral-400"> {{ __('I agree to the terms and conditions and privacy policy.') }}</span>
                        </label>
                        <x-input-error :messages="$errors->get('pdpa_check')" class="mt-2" /> -->

                        <div class="mt-3 flex justify-end w-full">
                            <!-- <button type="button" id="save-changes" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" 
                            disabled data-hs-overlay="#hs-basic-modal">
                                Agree
                            </button> -->
                            <button type="button" class="py-2 px-3 ml-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" data-hs-overlay="#hs-basic-modal">
                                Close
                            </button>
                        </div>
                    </div>
                 <!-- Mandatory Checkbox for Consent -->
        <!-- <div class="mt-4">
            <label for="pdpa_check" class="inline-flex items-center">
                <input id="pdpa_check" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="pdpa_check" value="1"
                    required>
                <span class="ms-2 text-sm text-gray-600">
                    {{ __('I agree to the terms and conditions and privacy policy.') }}
                </span>
            </label>
            <x-input-error :messages="$errors->get('pdpa_check')" class="mt-2" />
        </div> -->
                </div>
            </div>

    <style>
        .roman-numerals {
            list-style-type: upper-roman;
        }
    </style>

    <script>
        // Toggle secret answer visibility based on selected secret question
        function toggleSecretAnswer() {
            const answerGroup = document.getElementById("secret_answer_group");
            const selectedQuestion = document.getElementById("secret_question").value;
            answerGroup.style.display = selectedQuestion ? "block" : "none";
        }

        // Validate MyKad format (example using simple regex)
        document.getElementById('mykad').addEventListener('input', function() {
            const mykad = this.value;
            const mykadError = document.getElementById('mykad-error');
            if (!/^\d{6}-\d{2}-\d{4}$/.test(mykad)) {
                mykadError.classList.remove('hidden');
            } else {
                mykadError.classList.add('hidden');
            }
        });

        // Validate Email format
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value;
            const emailError = document.getElementById('email-error');
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                emailError.classList.remove('hidden');
            } else {
                emailError.classList.add('hidden');
            }
        });

        // Enable register button only when form is valid and checkbox is checked
        document.addEventListener('DOMContentLoaded', () => {
            const registerButton = document.getElementById('register-button');
            const form = document.querySelector('form');
            const pdpaCheck = document.getElementById('pdpa_check');

            const toggleRegisterButton = () => {
                registerButton.disabled = !(form.checkValidity() && pdpaCheck.checked);
            };

            form.addEventListener('input', toggleRegisterButton);
            pdpaCheck.addEventListener('change', toggleRegisterButton);
            toggleRegisterButton();
        });
    </script>
</x-guest-layout>
