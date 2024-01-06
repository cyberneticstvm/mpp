<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $invoices = Invoice::where('user_id', Auth::id())->where('payment_status', 'success')->latest()->get();
        return view('backend.invoices.paid', compact('invoices'));
    }

    public function pendingInvoices()
    {
        $invoices = Invoice::where('user_id', Auth::id())->whereIn('payment_status', ['pending', 'hold'])->latest()->get();
        return view('backend.invoices.pending', compact('invoices'));
    }

    public function show(string $id)
    {
        $invoice = Invoice::findOrFail(decrypt($id));
        $api = new Api($this->key, $this->secret);
        try {
            $order = $api->order->create(array('receipt' => $invoice->invoice_number, 'amount' => $invoice->amount * 100, 'currency' => 'INR', 'notes' => array('user_id' => $invoice->user_id, 'invoice' => $invoice->invoice_number)));
            Invoice::where('id', $invoice->id)->update(['rpay_order_id' => $order->id]);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return view('backend.invoices.show', compact('order', 'invoice'));
    }

    public function success(Request $request)
    {
        $data = $request->all();
        Invoice::where('user_id', Auth::id())->where('rpay_order_id', $data['razorpay_order_id'])->update(['payment_status' => 'success', 'rpay_payment_id' => $data['razorpay_payment_id'], 'rpay_signature' => $data['razorpay_signature'], 'paid_date' => Carbon::now()]);
        return view('backend.invoices.success', compact('data'));
    }

    public function failed($error)
    {
        return view('backend.invoices.failed', compact('error'));
    }
}
