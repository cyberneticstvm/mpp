<?php

return [
    'sms' => [
        'sender_id' => env('SENDER_ID', ''),
        'sms_buddy_api_key' => env('SMS_BUDDY_API_KEY', ''),
        'text_local_api_key' => env('TEXT_LOCAL_API_KEY', ''),
        'otp_template_id' => env('OTP_TEMPLATE_ID', ''),
        'otp_template_id_for_mobile_verification' => env('OTP_MOBILE_VERIFICATION_TEMPLATE_ID', ''),
    ],

    'rpay' => [
        'rpay_id' => env('RAZOR_PAY_ID'),
        'rpay_secret' => env('RAZOR_PAY_SECRET'),
    ]
];
