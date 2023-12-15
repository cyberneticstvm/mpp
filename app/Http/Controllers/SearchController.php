<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function appointment()
    {
        $query_string = '';
        $appointments = [];
        return view('backend.search.appointment', compact('appointments', 'query_string'));
    }

    public function appointmentFetch(Request $request)
    {
        $this->validate($request, [
            'query_string' => 'required',
        ]);
        $query_string = $request->query_string;
        $appointments = Appointment::withTrashed()->where('user_id', Auth::id())->when($request->query_string != '', function ($q) use ($request) {
            return $q->where('patient_name', 'like', '%' . $request->query_string . '%')->orWhere('mobile', 'like', '%' . $request->query_string . '%');
        })->orderByDesc('appointment_date')->get();
        return view('backend.search.appointment', compact('appointments', 'query_string'));
    }

    public function patient()
    {
        $query_string = '';
        $patients = [];
        return view('backend.search.patient', compact('patients', 'query_string'));
    }

    public function patientFetch(Request $request)
    {
        $this->validate($request, [
            'query_string' => 'required',
        ]);
        $query_string = $request->query_string;
        $patients = Patient::withTrashed()->where('user_id', Auth::id())->when($request->query_string != '', function ($q) use ($request) {
            return $q->where('patient_name', 'like', '%' . $request->query_string . '%')->orWhere('mobile', 'like', '%' . $request->query_string . '%')->orWhere('patient_id', 'like', '%' . $request->query_string . '%');
        })->latest()->get();
        return view('backend.search.patient', compact('patients', 'query_string'));
    }

    public function consultation()
    {
        $query_string = '';
        $consultations = [];
        return view('backend.search.consultation', compact('consultations', 'query_string'));
    }

    public function consultationFetch(Request $request)
    {
        $this->validate($request, [
            'query_string' => 'required',
        ]);
        $query_string = $request->query_string;
        $consultations = Consultation::where('user_id', Auth::id())->whereHas('patient', function ($q) use ($request) {
            return $q->where('patient_name', 'like', '%' . $request->query_string . '%')->orWhere('mobile', 'like', '%' . $request->query_string . '%')->orWhere('patient_id', 'like', '%' . $request->query_string . '%')->orWhere('medical_record_number', 'like', '%' . $request->query_string . '%');
        })->latest()->get();
        return view('backend.search.consultation', compact('consultations', 'query_string'));
    }
}
