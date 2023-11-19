<?php

return [
    'sms' => [
        'sender_id' => env('SENDER_ID', ''),
        'sms_buddy_api_key' => env('SMS_BUDDY_API_KEY', ''),
        'text_local_api_key' => env('TEXT_LOCAL_API_KEY', ''),
        'otp_template_id' => env('OTP_TEMPLATE_ID', ''),
    ]
];
