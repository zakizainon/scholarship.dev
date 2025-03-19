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
            'mykad' => ['required', 'digits:12', 'min:12', 'max:12', Rule::unique('users', 'mykad'), ], // Ensure MyKad is unique in the `users` table
            'email'=>  [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
            ],
            'password' => [
                            'required',
                            'confirmed',
                            'min:12', // Minimum 12 characters
                            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d|.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{12,}$/',
                            'max:16', // Enforce a maximum if needed (e.g., 16 for stronger security)
                          ],
            'secret_question' => ['required', 'string', 'max:255'],
            'secret_answer' => ['required', 'string', 'max:255'],
            'pdpa_check' => 'required|accepted',
        ], [
            'mykad.unique' => 'This MyKad number is already taken.',
        ]);

        
         // Check if email already exists
        if (\App\Models\User::where('email', $request->email)->exists()) {
            return redirect(route('verification.notice'));
        }

        // Assign pdpa_chec to a value based on whether it's checked
        $data['pdpa_check'] = $request->has('pdpa_check') ? 1 : 0;

        $user = User::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'mykad' => $request->mykad,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'secret_question' => $secret_question,
            'secret_answer' => $request->input('secret_answer'),
            'pdpa_check' => 1,
        ]);

        event(new Registered($user));
        

        // Auth::login($user);

        // return redirect(route('dashboard', absolute: false));
        return redirect(route('verification.notice'));
        // return redirect(route('welcome'))->with('success', 'Signup successful, please check your email to activate your account.');
    }

}
