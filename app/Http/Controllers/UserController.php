<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $otpmessage, $otp;

    public function __construct()
    {
        $this->otp = random_int(100000, 999999);
        $this->otpmessage = "Dear User, Your OTP for login to MEDICAL PRESCRIPTION PRO is " . $this->otp . " valid for 15 minutes. Please do not share this OTP.";
    }
    public function login(Request $request)
    {
        //            
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'mobile' => 'required|numeric|digits:10',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'plan' => 'required',
            'terms' => 'accepted',
        ]);
        try {
            $input = $request->all();
            $input['plan_expired_at'] = Carbon::now()->addDays(30);
            $input['otp'] = $this->otp;
            $user = User::create($input);
            $message = $this->otpmessage;
            $res = sendSMSBuddy($message, $request->mobile);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return view('backend.verify-mobile', compact('user'));
    }
}
