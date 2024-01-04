<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    private $key, $secret;

    public function __construct()
    {
        $this->key = env('RAZOR_PAY_TEST_ID');
        $this->secret = env('RAZOR_PAY_TEST_SECRET');
    }

    public function paidInvoices()
    {
        $invoices = collect();
        return view('backend.invoices.paid', compact('invoices'));
    }

    public function pendingInvoices()
    {
        $invoices = collect();
        return view('backend.invoices.pending', compact('invoices'));
    }

    public function show()
    {
        $api = new Api($this->key, $this->secret);
        try {
            $order = $api->order->create(array('receipt' => '123', 'amount' => 1000, 'currency' => 'INR', 'notes' => array('key1' => 'value3', 'key2' => 'value2')));
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return view('backend.invoices.show', compact('order'));
    }

    public function payment(Request $request)
    {
        $api = new Api($this->key, $this->secret);
        /*$orderData = [
            'receipt'         => 'rcptid_11',
            'amount'          => 39900, // 39900 rupees in paise
            'currency'        => 'INR'
        ];
        $razorpayOrder = $api->order->create($orderData);
        dd($razorpayOrder);*/
    }

    public function success(Request $request)
    {
        $data = $request->all();
        return view('backend.invoices.success', compact('data'));
    }

    public function failed($error)
    {
        return view('backend.invoices.failed', compact('error'));
    }
}
