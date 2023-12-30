<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Message;
use App\Models\Referral;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelperController extends Controller
{
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
}
