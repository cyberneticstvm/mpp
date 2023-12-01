<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::whereNull('consultation_id')->whereDate('appointment_date', Carbon::today())->orderBy('appointment_time')->get();
        return view('backend.appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'patient_name' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'address' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
        ]);
        try {
            $input = $request->all();
            $input['dob'] = ($request->dob) ? Carbon::createFromFormat('d, F Y', $request->dob)->format('Y-m-d') : NULL;
            $input['appointment_date'] = Carbon::createFromFormat('d, F Y', $request->appointment_date)->format('Y-m-d');
            $input['appointment_time'] = Carbon::createFromFormat('h:iA', $request->appointment_time)->format('H:i:s');
            $input['user_id'] = Auth::id();
            $input['profile_id'] = Session::get('profile');
            $input['created_by'] = Session::get('profile');
            $input['updated_by'] = Session::get('profile');
            Appointment::create($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", "Selected time slot already allotted!")->withInput($request->all());
        }
        return redirect()->route('appointment.all')->with("success", "Appointment created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $appointments = Appointment::withTrashed()->whereNull('consultation_id')->orderByDesc('appointment_date')->get();
        return view('backend.appointment.all', compact('appointments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $appointment = Appointment::findOrFail(decrypt($id));
        return view('backend.appointment.edit', compact('appointment'));
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
            'appointment_date' => 'required',
            'appointment_time' => 'required',
        ]);
        try {
            $input = $request->all();
            $input['dob'] = ($request->dob) ? Carbon::createFromFormat('d, F Y', $request->dob)->format('Y-m-d') : NULL;
            $input['appointment_date'] = Carbon::createFromFormat('d, F Y', $request->appointment_date)->format('Y-m-d');
            $input['appointment_time'] = Carbon::createFromFormat('h:iA', $request->appointment_time)->format('H:i:s');
            $input['updated_by'] = Session::get('profile');
            Appointment::findOrFail($id)->update($input);
        } catch (Exception $e) {
            return redirect()->back()->with("error", "Selected time slot already allotted!")->withInput($request->all());
        }
        return redirect()->route('appointment.all')->with("success", "Appointment updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Appointment::findOrFail(decrypt($id))->delete();
        return redirect()->route('appointment.all')->with("success", "Appointment deleted successfully");
    }
}
