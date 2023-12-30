<?php

namespace App\Http\Controllers;

use App\Models\Callback;
use App\Models\Otp;
use App\Models\Profile;
use App\Models\Quote;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
            'mobile' => 'required|numeric|digits:10|unique:users,mobile',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'plan' => 'required',
            'terms' => 'accepted',
        ]);
        try {
            $input = $request->all();
            $input['subscription'] = 'monthly';
            $input['plan_expired_at'] = Carbon::now()->addDays(30);
            $input['referral_code'] = time();
            $user = User::create($input);
            Profile::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'consultation_fee' => 0,
            ]);
            Setting::insert([
                'user_id' => $user->id,
                'appointment_start' => Carbon::createFromFormat('h:iA', '09:00AM')->format('H:i:s'),
                'appointment_end' => Carbon::createFromFormat('h:iA', '07:00PM')->format('H:i:s'),
                'appointment_duration' => 15,
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
        $res = sendOtpForMobileNumberVerificationViaTextLocal($message, $user->mobile);
        return view('backend.verify-mobile', compact('user'));
    }

    public function resendVerificationOtp($user_id)
    {
        try {
            $otpcount = Otp::where('user_id', decrypt($user_id))->whereDate('created_at', '>=', Carbon::now()->subHour())->count();
            if ($otpcount >= 3) :
                exit("Your request for otp exceeds the limit. Please try after 1 hour");
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
            $res = sendOtpForMobileNumberVerificationViaTextLocal($message, $user->mobile);
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
            return redirect()->intended('/dashboard/default')->withSuccess('User logged in successfully');
        else :
            return redirect()->back()->with("error", "Invalid OTP.");
        endif;
    }

    public function dashboard()
    {
        $quote = Quote::inRandomOrder()->limit(1)->first();
        $profiles = Profile::where('user_id', Auth::id())->pluck('name', 'id');
        return view('backend.dash', compact('quote', 'profiles'));
    }

    public function dragableDashboard()
    {
        return view('backend.dash-drag');
    }

    public function profileUpdate(Request $request)
    {
        Session::put('profile', $request->profile);
        if (Session::has('profile')) :
            return redirect()->route('dashboard')
                ->withSuccess('User profile updated successfully!');
        else :
            return redirect()->route('dashboard')
                ->withError('Please update profile!');
        endif;
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
                return redirect()->intended('/dashboard/default')
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

    public function settings()
    {
        $settings = Setting::where('user_id', Auth::id())->first();
        return view('backend.doctor.settings', compact('settings'));
    }

    public function personalSettingsUpdate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'mobile' => 'nullable|numeric|digits:10|unique:users,mobile,' . Auth::id(),
            'password' => 'nullable|confirmed|min:6',
            'password_confirmation' => 'nullable',
        ]);
        $user = User::findOrFail(Auth::id());
        $pwd = ($request->password) ? bcrypt($request->password) : $user->getOriginal('password');
        $user->update([
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $pwd,
            'bio' => $request->bio,
        ]);
        return redirect()->back()->with("success", "Personal settings updated successfully");
    }

    public function generalSettingsUpdate(Request $request)
    {
        $this->validate($request, [
            'appointment_start' => 'required',
            'appointment_end' => 'required',
            'appointment_duration' => 'required',
            'logo' => 'sometimes|required|mimes:jpg,jpeg,png,webp|max:1024',
            'watermark_image' => 'sometimes|required|mimes:jpg,jpeg,png,webp|max:1024',
        ]);
        $setting = Setting::where('user_id', Auth::id())->firstOrFail();
        $start = Carbon::createFromFormat('h:iA', $request->appointment_start)->format('H:i:s');
        $end = Carbon::createFromFormat('h:iA', $request->appointment_end)->format('H:i:s');
        $logo = $setting->getOriginal('logo');
        $watermark_image = $setting->getOriginal('watermark_image');
        if ($request->file('logo')) :
            $url = uploadFile($request->file('logo'), $path = 'uploads/assets/' . Auth::id() . '/logo');
            $logo = $url;
        endif;
        if ($request->file('watermark_image')) :
            $url = uploadFile($request->file('watermark_image'), $path = 'uploads/assets/' . Auth::id() . '/watermark');
            $watermark_image = $url;
        endif;
        Setting::findOrFail($setting->id)->update([
            'name' => $request->name,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'appointment_start' => $start,
            'appointment_end' => $end,
            'appointment_duration' => $request->appointment_duration,
            'watermark_text' => $request->watermark_text,
            'watermark_image' => $watermark_image,
            'watermark_preference' => $request->watermark_preference,
            'logo' => $logo,
            'next_visit_followup_sms' => $request->next_visit_followup_sms ?? 0,
            'appointment_scheduled_sms' => $request->appointment_scheduled_sms ?? 0,
            'appointment_updated_sms' => $request->appointment_updated_sms ?? 0,
        ]);
        return redirect()->back()->with("success", "General settings updated successfully");
    }

    public function requestCallback(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|numeric|digits:10',
        ]);
        Callback::create([
            'mobile' => $request->mobile,
            'status' => 'pending',
        ]);
        return redirect()->back()->with("success", "Thank You! Your callback request received successfully. Our team will reach out you shortly.");
    }
}
