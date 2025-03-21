<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use App\Notifications\AccountActivated;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();
        $secret_question = "";
        switch($data["secret_question"]){
            case "your_first_pet":  
                $secret_question = "What was the name of your first pet?";
                break;
            
            case "mother_maiden_name":
                $secret_question = "What is your mother's maiden name?";
                break;

            case "favorite_food":  
                $secret_question = "What is your favorite food?";
                break;
            
            case "first_school":
                $secret_question = "What was the name of your first school?";
                break;
            
            default:
                $secret_question = "";
                break;
        }

        $request->validate([
            'name' => ['required', 'string', 'regex:/^[A-Za-z@\'\s]+$/', 'max:200'],
            'mykad' => [
                'required',
                'string',
                'regex:/^\d{6}-\d{2}-\d{4}$/',  // Enforces the format 000000-00-0000
                Rule::unique('users', 'mykad'),
            ],
            'email'=> [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:12',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d|.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{12,}$/',
                'max:16',
            ],
            'secret_question' => ['required', 'string', 'max:255'],
            'secret_answer' => ['required', 'string', 'max:255'],
            'pdpa_check' => 'required|accepted',
        ], [
            'mykad.unique' => 'MyKad Number has already been used, please try another',
            'email.unique' => 'Email has already been used, please try another',
            'mykad.regex'  => 'MyKad must be in the format 000000-00-0000',
        ]);

        
         // Check if email already exists
        // if (\App\Models\User::where('email', $request->email)->exists()) {
        //     return redirect(route('verification.notice'));
        // }

        // Assign pdpa_chec to a value based on whether it's checked
        $data['pdpa_check'] = $request->has('pdpa_check') ? 1 : 0;
        $capitalizedName = ucwords(strtolower($request->name));

        // Generate verification code
        $verificationCode = rand(100000, 999999);  //baru tambah

        $user = User::create([
            'uuid' => Str::uuid(),
            'name' => $capitalizedName,
            'mykad' => $request->mykad,
            // 'email' => $request->email,
            'email' => strtolower($request->email), 
            'password' => Hash::make($request->password),
            'secret_question' => $secret_question,
            'secret_answer' => $request->input('secret_answer'),
            'pdpa_check' => 1,
            'verification_code' => $verificationCode,  //baru tambah
            'is_verified' => false,  //baru tambah
        ]);

        // event(new Registered($user));
        Mail::to($user->email)->send(new VerificationMail($user,$verificationCode));
        return redirect()->route('verification.notice')->with('popup_message', 'Thanks for signing up! Before getting started, could you verify your email address? A new verification code has been sent to the email address you provided during registration.');
        

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        // return redirect(route('verification.notice'));
        // return redirect(route('welcome'))->with('success', 'Signup successful, please check your email to activate your account.');
    }

    public function showVerificationForm(): View
    {
        return view('auth.verify');
    }

    public function verify(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'verification_code' => 'required|array|size:6',
            'verification_code.*' => 'required|string|size:1',
        ]);
        $verificationCode = implode('', $request->input('verification_code'));

        // $user = User::where('email', $request->email)
        //     ->where('verification_code', $request->verification_code)
        //     ->first();

        // $user = User::where('email', strtolower($request->email))
        // ->where('verification_code', $request->verification_code)
        // ->first();
        $user = User::whereRaw('LOWER(email) = ?', [strtolower($request->email)])
        // ->where('verification_code', $request->verification_code)
        ->whereRaw('CAST(verification_code AS CHAR) = ?', [$verificationCode])
        ->first();


        if (!$user) {
            return back()->withErrors(['verification_code' => 'Invalid verification code.']);
        }

        // // Mark user as verified
        // $user->update([
        //     'is_verified' => true,
        //     'verification_code' => null, 
        // ]);
        $user->is_verified = true;
        $user->verification_code = null;
        $user->save();

        return redirect()->route('login')->with('status', 'Your account has been verified. You may now log in.');
    }

}
