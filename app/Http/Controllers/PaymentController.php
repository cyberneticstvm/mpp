<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function payment()
    {
        $api = new Api(env('RAZOR_PAY_TEST_ID'), env('RAZOR_PAY_TEST_SECRET'));
        $orderData = [
            'receipt'         => 'rcptid_11',
            'amount'          => 39900, // 39900 rupees in paise
            'currency'        => 'INR'
        ];
        $razorpayOrder = $api->order->create($orderData);
        dd($razorpayOrder);
    }
}
