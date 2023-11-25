<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EmailController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfc',
        ]);
        $user = User::where('email', $request->email)->firstOrFail();
        $user->update(['password_reset_token' => Str::random(60)]);
        Mail::to($user->email)->send(new ForgotPasswordEmail($user));
        return redirect()->back()->with("success", "Password reset url was sent to your email successfully");
    }
}
