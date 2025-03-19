<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Notifications\AccountActivated;

class EmailVerificationController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/dashboard?verified=1');
        }
    
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
    
             // Send email verification success notification
            $request->user()->notify(new AccountActivated());

        }
    
        return redirect()->intended('/dashboard?verified=1');
    }
}