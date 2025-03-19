<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
// use App\Notifications\ResetPassword;
use App\Models\User;
use SendsPassw;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;


class ResetPasswordController extends Controller
{
    /**
     * Show the form to reset the password.
     */
    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password-form', [
            'token' => $token,
            'email' => $request->query('email'),  // Access email from query string
        ]);
        // return view('auth.reset-password-form');
    }

    /**
     * Handle the password reset request.
     */
    public function reset(Request $request)
    {
    
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required|min:12|confirmed',
        //     'token' => 'required',
        // ]);
        // dd($request->all());
        // // echo $email."<br />";
        // // echo $password. " -- ". $token;
        // // exit;
       

        // $status = Password::reset(
        //     $request->only('email', 'password', 'password_confirmation', 'token'),
        //     function ($user, $password) {
        //         $user->forceFill([
        //             'password' => Hash::make($password),
        //         ])->save();
        //     }
        // );

        // // dd($request->all());

        // return $status === Password::PASSWORD_RESET
        //     ? redirect('/login')->with('success', 'Your password has been reset.')
        //     : back()->withErrors(['email' => __($status)]);

        // $email = $request->input('email');
        // $password = Hash::make($request->input('password'));

        // dd($request->all()); 
         // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:12|confirmed',
            'token' => 'required',
        ]);

        // Verify the token and email in the database
        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();
        
        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['email' => 'Invalid or expired token.']);
        }

        // Check if the token has expired (you can define your own expiration time)
        if (Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['email' => 'The password reset link has expired.']);
        }

        // Update the user's password
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

    //    DB::table('users')
    //    ->where('email', $request->email)
    //    ->update(['password' => Hash::make($request->password)]);

        // Delete the reset token
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        // Redirect with success message
        return redirect()->route('welcome')->with('success', 'Your password has been reset.');

    }
}
  