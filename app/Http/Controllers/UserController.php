<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $otpmessage, $otp, $otpmobileverificationmessage;

    public function __construct()
    {
        $this->otp = random_int(100000, 999999);
        $this->otpmessage = "Dear User, Your OTP for login to MEDICAL PRESCRIPTION PRO is " . $this->otp . " valid for 15 minutes. Please do not share this OTP.";
        $this->otpmobileverificationmessage = "Dear User, Your OTP for mobile number verification in MEDICAL PRESCRIPTION PRO is " . $this->otp . " valid for 15 minutes. Please do not share this OTP.";
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
            $input['subscription'] = 'monthly';
            $input['plan_expired_at'] = Carbon::now()->addDays(30);
            $user = User::create($input);
            Profile::create([
                'user_id' => $user->id,
                'name' => $user->username,
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return view('backend.register-success', compact('user'));
    }

    public function verifyMobileNumberForm($user_id)
    {
        $user = User::findOrFail(decrypt($user_id));
        $message = $this->otpmobileverificationmessage;
        $user->update(["otp" => $this->otp]);
        Otp::create([
            'user_id' => $user->id,
            'mobile' => $user->mobile,
            'otp' => $this->otp,
            'description' => 'verification',
        ]);
        //$res = sendOtpForMobileNumberVerificationViaTextLocal($message, $user->mobile);
        return view('backend.verify-mobile', compact('user'));
    }

    public function resendVerificationOtp($user_id)
    {
        try {
            $otpcount = Otp::where('user_id', decrypt($user_id))->whereDate('created_at', '>=', Carbon::now()->subHour())->count();
            if ($otpcount >= 3) :
                return redirect()->back()->with("warning", "Your request for otp exceeds the limit. Please try after 1 hour");
            endif;
            $user = User::findOrFail(decrypt($user_id));
            $message = $this->otpmobileverificationmessage;
            $user->update(["otp" => $this->otp]);
            Otp::create([
                'user_id' => $user->id,
                'mobile' => $user->mobile,
                'otp' => $this->otp,
                'description' => 'verification',
            ]);
            //$res = sendOtpForMobileNumberVerificationViaTextLocal($message, $user->mobile);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "OTP has been successfully resent.");
    }

    public function verifyMobileNumber(Request $request)
    {
        $otp = $request->num1 . $request->num2 . $request->num3 . $request->num4 . $request->num5 . $request->num6;
        $user = User::where('id', decrypt($request->user_id))->where('otp', $otp)->first();
        if ($user) :
            Auth::login($user);
            $user->update(['mobile_verified_at' => Carbon::now(), 'otp' => NULL]);
            return redirect()->intended('dashboard')->withSuccess('User logged in successfully');
        else :
            return redirect()->back()->with("error", "Invalid OTP.");
        endif;
    }

    public function dashboard()
    {
        return view('backend.dash');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        try {
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->intended('dashboard')
                    ->withSuccess('User logged in successfully');
            }
            return redirect()->back()->with("error", "Invalid Credentials")->withInput($request->all());
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
    }

    public function otpLoginValidate(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|numeric|digits:10',
        ]);
        $user = User::where('mobile', $request->mobile)->firstOrFail();
        return redirect()->route('form.verify.mobile.number', encrypt($user->id))->with("success", "OTP has been sent to your mobile number.");
    }

    public function passwordReset($token)
    {
        $user = User::where('password_reset_token', $token)->firstOrFail();
        return view('reset-password', compact('user'));
    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);
        $user = User::findOrFail(decrypt($request->user_id))->update(['password' => bcrypt($request->password), 'password_reset_token' => NULL]);
        return redirect('/login')->with("success", "Password has been reset successfully");
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with("success", "User logged out successfully");
    }
}
