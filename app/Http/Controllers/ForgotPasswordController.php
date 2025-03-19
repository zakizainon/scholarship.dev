<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

// use App\Notifications\ResetPassword;
use App\Models\User;




class ForgotPasswordController extends Controller
{
     /**
     * Display the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send the password reset link to the user's email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // dd($request->all());
    $request->validate([
        'email' => 'required|email',
    ]);

    // Check if the user exists in the database
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        // If user not found, redirect back with error
        return redirect()->back()->with('fail', 'No account found with this email.');
    }

     // Generate a token
     $token = Str::random(60);

     // Insert the token into the custom password reset table
     DB::table('password_reset_tokens')->updateOrInsert(
         ['email' => $request->email],
         [
            'token' => Hash::make($token),  // Hash the token
             'created_at' => Carbon::now()
         ]
     );

    $resetLink = url('password/reset-form/' . $token) . '?email=' . urlencode($request->email);

    // Send the reset password email
    Mail::send('auth.reset-password', ['resetLink' => $resetLink], function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Reset Your Password');
    });

    // Redirect back with success message
    return redirect("/")->with('success', 'Password reset link has been sent to your email address.');

    }

    
}
