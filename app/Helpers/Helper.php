<?php

use Illuminate\Support\Facades\Config;

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
