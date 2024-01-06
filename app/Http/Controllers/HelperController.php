<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Feedback;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Message;
use App\Models\MppSetting;
use App\Models\Referral;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    public function sitemap()
    {
        return response()->view('sitemap')->header('Content-Type', 'text/xml');
    }

    public function robots()
    {
        return response()->view('robots')->header('Content-Type', 'text/plain');
    }

    public function contact()
    {
        return view('backend.support.contact');
    }

    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfs,dns',
            'message' => 'required',
        ]);
        Message::create([
            'user_id' => Auth::id(),
            'profile_id' => profile()->id,
            'message' => $request->message,
            'email' => $request->email,
            'status' => 'pending',
        ]);
        return redirect()->back()->with("success", "Message submitted successfully");
    }

    public function feedback()
    {
        return view('backend.support.feedback');
    }

    public function feedbackSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:rfs,dns',
            'feedback' => 'required',
        ]);
        Feedback::create([
            'user_id' => Auth::id(),
            'profile_id' => profile()->id,
            'feedback' => $request->feedback,
            'email' => $request->email,
            'recommend' => $request->recommend ?? 0,
            'publish' => $request->publish ?? 0,
        ]);
        return redirect()->back()->with("success", "Feedback submitted successfully");
    }

    public function referral()
    {
        $ref = Referral::where('user_id', Auth::id())->first();
        return view('backend.referral.index', compact('ref'));
    }

    public function referralSubmit(Request $request)
    {
        $this->validate($request, [
            'referral_code' => 'required',
        ]);
        $user = User::where('referral_code', $request->referral_code)->where('id', '!=', Auth::id())->firstOrFail();
        if ($user) :
            $referral = Referral::where('user_id', Auth::id())->where('referral_code', $user->referral_code)->first();
            if ($referral) :
                return redirect()->back()->with("error", "Referral Code already been updated");
            else :
                Referral::create([
                    'user_id' => Auth::id(),
                    'referral_code' => $request->referral_code,
                ]);
                return redirect()->back()->with("success", "Referral code updated successfully");
            endif;
        else :
            return redirect()->back()->with("error", "Invalid Referral Code");
        endif;
    }

    public function test()
    {
        /*$mpp = MppSetting::findOrFail(1);
        $users = User::where('plan', 'basic')->get();
        $from = Carbon::now()->startOfMonth()->subMonth()->startOfDay();
        $to = Carbon::now()->endOfMonth()->subMonth()->endOfDay();
        foreach ($users as $key => $user) :
            $consultations = Consultation::leftJoin('users as u', 'u.id', 'consultations.user_id')->whereBetween('consultations.created_at', [$from, $to])->where('consultations.user_id', $user->id)->whereDate('consultations.created_at', '>', 'u.plan_expired_at')->select('consultations.id')->get();
            $qty = $consultations->count();
            $qty_first = $consultations->take(1000)->count();
            $qty_second = $consultations->skip(1000)->take(4000)->count();
            $qty_third = $consultations->skip(5000)->count();
            $total_first = $qty_first * $mpp->basic_first;
            $total_second = $qty_second * $mpp->basic_second;
            $total_third = $qty_third * $mpp->basic_third;
            $invoice_number = generateInvoiceNumber()->ino;
            DB::transaction(function () use ($invoice_number, $user, $mpp, $qty, $qty_first, $qty_second, $qty_third, $total_first, $total_second, $total_third) {
                $invoice = Invoice::create([
                    'invoice_number' => $invoice_number,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'qty' => $qty,
                    'amount' => $total_first + $total_second + $total_third,
                    'due_date' => Carbon::now()->addDays(10)->endOfDay(),
                    'payment_status' => 'pending',
                ]);
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'slab' => 'first',
                    'plan' => 'basic',
                    'qty' => $qty_first,
                    'price' => $mpp->basic_first,
                    'total' => $total_first,
                ]);
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'slab' => 'second',
                    'plan' => 'basic',
                    'qty' => $qty_second,
                    'price' => $mpp->basic_second,
                    'total' => $total_second,
                ]);
                InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'user_id' => $user->id,
                    'month' => Carbon::now()->startOfMonth()->subMonth()->month,
                    'year' => Carbon::now()->startOfMonth()->subMonth()->year,
                    'slab' => 'third',
                    'plan' => 'basic',
                    'qty' => $qty_third,
                    'price' => $mpp->basic_third,
                    'total' => $total_third,
                ]);
            });
        endforeach;*/
    }
}
