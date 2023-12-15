<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Patient;
use App\Rules\dateDifferenceInDays;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function appointment()
    {
        $inputs = array('from_date' => date('d, F Y'), 'to_date' => date('d, F Y'), 'profile' => profile()->id);
        $data = [];
        return view('backend.report.appointment', compact('inputs', 'data'));
    }

    public function appointmentFetch(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => ['required', new dateDifferenceInDays($request)],
            'profile' => 'required',
        ]);
        $inputs = array('from_date' => $request->from_date, 'to_date' => $request->to_date, 'profile' => $request->profile);
        $fdate = Carbon::createFromFormat('d, F Y', $request->from_date)->format('Y-m-d');
        $fdate = Carbon::parse($fdate)->startOfDay();
        $tdate = Carbon::createFromFormat('d, F Y', $request->to_date)->format('Y-m-d');
        $tdate = Carbon::parse($tdate)->endOfDay();
        $data = Appointment::where('user_id', Auth::id())->where('profile_id', $request->profile)->whereBetween('created_at', [$fdate, $tdate])->latest()->get();
        return view('backend.report.appointment', compact('inputs', 'data'));
    }

    public function patient()
    {
        $inputs = array('from_date' => date('d, F Y'), 'to_date' => date('d, F Y'), 'profile' => profile()->id);
        $data = [];
        return view('backend.report.patient', compact('inputs', 'data'));
    }

    public function patientFetch(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => ['required', new dateDifferenceInDays($request)],
            'profile' => 'required',
        ]);
        $inputs = array('from_date' => $request->from_date, 'to_date' => $request->to_date, 'profile' => $request->profile);
        $fdate = Carbon::createFromFormat('d, F Y', $request->from_date)->format('Y-m-d');
        $fdate = Carbon::parse($fdate)->startOfDay();
        $tdate = Carbon::createFromFormat('d, F Y', $request->to_date)->format('Y-m-d');
        $tdate = Carbon::parse($tdate)->endOfDay();
        $data = Patient::where('user_id', Auth::id())->where('profile_id', $request->profile)->whereBetween('created_at', [$fdate, $tdate])->latest()->get();
        return view('backend.report.patient', compact('inputs', 'data'));
    }

    public function consultation()
    {
        $inputs = array('from_date' => date('d, F Y'), 'to_date' => date('d, F Y'), 'profile' => profile()->id);
        $data = [];
        return view('backend.report.consultation', compact('inputs', 'data'));
    }

    public function consultationFetch(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => ['required', new dateDifferenceInDays($request)],
            'profile' => 'required',
        ]);
        $inputs = array('from_date' => $request->from_date, 'to_date' => $request->to_date, 'profile' => $request->profile);
        $fdate = Carbon::createFromFormat('d, F Y', $request->from_date)->format('Y-m-d');
        $fdate = Carbon::parse($fdate)->startOfDay();
        $tdate = Carbon::createFromFormat('d, F Y', $request->to_date)->format('Y-m-d');
        $tdate = Carbon::parse($tdate)->endOfDay();
        $data = Consultation::where('user_id', Auth::id())->where('profile_id', $request->profile)->whereBetween('created_at', [$fdate, $tdate])->latest()->get();
        return view('backend.report.consultation', compact('inputs', 'data'));
    }
}
