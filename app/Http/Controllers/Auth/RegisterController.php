<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
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

        // Optional: Check if email already exists (redundant if using validation unique)
        if (User::where('email', $request->email)->exists()) {
            return redirect(route('verification.notice'));
        }

        $data['pdpa_check'] = $request->has('pdpa_check') ? 1 : 0;
        $capitalizedName = ucwords(strtolower($request->name));

        $user = User::create([
            'uuid' => Str::uuid(),
            'name' => $capitalizedName,
            'mykad' => $request->mykad,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'secret_question' => $secret_question,
            'secret_answer' => $request->input('secret_answer'),
            'pdpa_check' => 1,
        ]);

          return redirect()->route('welcome')
           ->with('success', 'Signup successful. Please log in.');
        // event(new Registered($user));
        //  return redirect()->route('verification.notice');
         
        //     ->with('status', "Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.");
    }

    public function register(Request $request): RedirectResponse
    {
        return $this->store($request);
    }

     public function showRegistrationForm(): View
    {
        return $this->create();
    }

}
