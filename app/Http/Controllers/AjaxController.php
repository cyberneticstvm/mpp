<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Diagnosis;
use App\Models\Symptom;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    public function getAppointments(Request $request)
    {
        $this->validate($request, [
            'appointment_date' => 'required',
        ]);
        try {
            $appointment_date = Carbon::createFromFormat('d, F Y', $request->appointment_date)->format('Y-m-d');
            $appointments = getAppointmentTimeList($appointment_date);
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return response()->json(['appointments' => json_encode($appointments)]);
    }

    public function saveSymptom(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) :
            return response()->json([
                'error' => $validator->errors()->first()
            ]);
        endif;
        $sid = Symptom::insertGetId([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'profile_id' => Session::get('profile'),
        ]);
        $data = Symptom::where('id', $sid)->firstOrFail();
        return response()->json([
            'success' => "Symptom created successfully",
            'data' => $data,
        ]);
    }

    public function saveDiagnosis(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) :
            return response()->json([
                'error' => $validator->errors()->first()
            ]);
        endif;
        $sid = Diagnosis::insertGetId([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'profile_id' => Session::get('profile'),
        ]);
        $data = Diagnosis::where('id', $sid)->firstOrFail();
        return response()->json([
            'success' => "Diagnosis created successfully",
            'data' => $data,
        ]);
    }
}
