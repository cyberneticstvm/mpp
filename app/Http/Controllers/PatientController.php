<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::withTrashed()->where('user_id', Auth::id())->where('profile_id', Session::get('profile'))->whereDate('created_at', Carbon::today())->latest()->get();
        return view('backend.patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        if (decrypt($id) > 0) :
            $appointment = Appointment::findOrFail(decrypt($id));
        else :
            $appointment =
                (object) [
                    'id' => 0,
                    'patient_name' => NULL,
                    'dob' => NULL,
                    'age' => NULL,
                    'old' => NULL,
                    'mobile' => NULL,
                    'address' => NULL,
                    'email' => NULL,
                ];
        endif;
        return view('backend.patient.create', compact('appointment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'patient_name' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
            'email' => 'nullable|email:rfs,dns',
        ]);
        $patient = Patient::where('mobile', $request->mobile)->get();
        if ($patient->isEmpty() || Session::has('exists')) :
            $input = $request->all();
            $input['dob'] = ($request->dob) ? Carbon::createFromFormat('d, F Y', $request->dob)->format('Y-m-d') : NULL;
            $input['appointment_id'] = $id;
            $input['patient_id'] = generatePatientId()->pid;
            $input['user_id'] = Auth::id();
            $input['profile_id'] = Session::get('profile');
            $input['created_by'] = Session::get('profile');
            $input['updated_by'] = Session::get('profile');
            $patient = Patient::create($input);
            if ($id > 0) :
                Appointment::findOrFail($id)->update(['patient_id' => $patient->id]);
            endif;
            if (Session::has('exists')) :
                Session::forget('exists');
            endif;
        else :
            Session::put('exists', true);
            return redirect()->back()->with('warning', 'We found an existing records with provided Mobile Number')->withInput($request->all());
        endif;
        return redirect()->route('patient')->with("success", "Patient created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = Patient::findOrFail(decrypt($id));
        return view('backend.patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'patient_name' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
            'email' => 'nullable|email:rfs,dns',
        ]);
        $input = $request->all();
        $input['dob'] = ($request->dob) ? Carbon::createFromFormat('d, F Y', $request->dob)->format('Y-m-d') : NULL;
        $input['updated_by'] = Session::get('profile');
        Patient::findOrFail($id)->update($input);
        return redirect()->route('patient')->with("success", "Patient updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Patient::findOrFail(decrypt($id))->delete();
        return redirect()->route('patient')->with("success", "Patient deleted successfully");
    }
}
