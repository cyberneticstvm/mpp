<?php

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Profile;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

function profile()
{
    return Profile::find(Session::get('profile'));
}

function settings()
{
    return Setting::where('user_id', Auth::id())->firstOrFail();
}

function sendOtpForLoginViaSmsBuddy($message, $mobile)
{
    $apikey = Config::get('myconfig.sms.sms_buddy_api_key');
    $sender = Config::get('myconfig.sms.sender_id');
    $otp_template = Config::get('myconfig.sms.otp_template_id');

    $ch = curl_init('https://thesmsbuddy.com/api/v1/sms/send');
    curl_setopt($ch, CURLOPT_POST, true);
    $data = [
        'key' => $apikey,
        'type' => '1',
        'to' => '91' . $mobile,
        'sender' => $sender,
        'message' => $message,
        'template_id' => $otp_template,
    ];
    $jsonData = json_encode($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function sendOtpForLoginViaTextLocal($message, $mobile)
{
    $apikey = urlencode(Config::get('myconfig.sms.text_local_api_key'));
    $sender = urlencode(Config::get('myconfig.sms.sender_id'));
    $message = rawurlencode($message);
    $numbers = array('91' . $mobile);
    $numbers = implode(',', $numbers);
    $data = array('apikey' => $apikey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
    $ch = curl_init('https://api.textlocal.in/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function sendOtpForMobileNumberVerificationViaTextLocal($message, $mobile)
{
    $apikey = urlencode(Config::get('myconfig.sms.text_local_api_key'));
    $sender = urlencode(Config::get('myconfig.sms.sender_id'));
    $message = rawurlencode($message);
    $numbers = array('91' . $mobile);
    $numbers = implode(',', $numbers);
    $data = array('apikey' => $apikey, 'numbers' => $numbers, 'sender' => $sender, 'message' => $message);
    $ch = curl_init('https://api.textlocal.in/send/');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function sendOtpForMobileNumberVerificationViaSmsBuddy($message, $mobile)
{
    $apikey = Config::get('myconfig.sms.sms_buddy_api_key');
    $sender = Config::get('myconfig.sms.sender_id');
    $otp_template = Config::get('myconfig.sms.otp_template_id_for_mobile_verification');
    $ch = curl_init('https://thesmsbuddy.com/api/v1/sms/send');
    curl_setopt($ch, CURLOPT_POST, true);
    $data = [
        'key' => $apikey,
        'type' => '1',
        'to' => '91' . $mobile,
        'sender' => $sender,
        'message' => $message,
        'template_id' => $otp_template,
    ];
    $jsonData = json_encode($data);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function getAppointmentTimeList($date)
{
    $arr = [];
    $endtime = Carbon::parse(settings()->appointment_end)->toTimeString();
    $starttime = Carbon::parse(settings()->appointment_start)->toTimeString();
    $interval = settings()->appointment_duration;
    if ($date) :
        $starttime = ($starttime < Carbon::now()->toTimeString() && Carbon::parse($date)->toDate() == Carbon::today()) ? Carbon::now()->endOfHour()->addSecond()->toTimeString() : $starttime;

        $start = strtotime($starttime);

        $appointment = Appointment::select('appointment_time as atime')->whereDate('appointment_date', $date)->where('user_id', Auth::id())->where('profile_id', Session::get('profile'))->pluck('atime')->toArray();
        while ($start <= strtotime($endtime)) :
            $disabled = in_array(Carbon::parse(date('h:i A', $start))->toTimeString(), $appointment) ? 'disabled' : NULL;
            $arr[] = [
                'time' => date('h:iA', $start),
                'id' => Carbon::parse(date('h:i A', $start))->toTimeString(),
                'disabled' => $disabled,
            ];
            $start = strtotime('+' . $interval . ' minutes', $start);
        endwhile;
    endif;
    return $arr;
}

function generatePatientId()
{
    return DB::table('patients')->selectRaw("CONCAT_WS('-', 'MPP-P', IFNULL(MAX(CAST(SUBSTRING_INDEX(patient_id, '-', -1) AS INTEGER))+1, 1)) AS pid")->first();
}

function generateMedicalRecordNumber()
{
    return DB::table('consultations')->selectRaw("CONCAT_WS('-', 'MPP-MRN', IFNULL(MAX(CAST(SUBSTRING_INDEX(medical_record_number, '-', -1) AS INTEGER))+1, 1)) AS mrn")->first();
}

function isConsultationCompleted($patient_id)
{
    $consultation = Consultation::where('patient_id', $patient_id)->whereDate('created_at', Carbon::today())->first();
    if ($consultation)
        return true;
    else
        return false;
}
