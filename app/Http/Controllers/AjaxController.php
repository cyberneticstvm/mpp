<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Diagnosis;
use App\Models\Document;
use App\Models\Medicine;
use App\Models\Symptom;
use App\Models\Test;
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
        $data = Symptom::where('id', $sid)->where('user_id', Auth::id())->firstOrFail();
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
        $did = Diagnosis::insertGetId([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'profile_id' => Session::get('profile'),
        ]);
        $data = Diagnosis::where('id', $did)->where('user_id', Auth::id())->firstOrFail();
        return response()->json([
            'success' => "Diagnosis created successfully",
            'data' => $data,
        ]);
    }

    public function saveTest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) :
            return response()->json([
                'error' => $validator->errors()->first()
            ]);
        endif;
        $did = Test::insertGetId([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'profile_id' => Session::get('profile'),
        ]);
        $data = Test::where('id', $did)->where('user_id', Auth::id())->firstOrFail();
        return response()->json([
            'success' => "Test created successfully",
            'data' => $data,
        ]);
    }

    public function saveMedicine(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) :
            return response()->json([
                'error' => $validator->errors()->first()
            ]);
        endif;
        $mid = Medicine::insertGetId([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'profile_id' => Session::get('profile'),
        ]);
        $data = Medicine::where('id', $mid)->where('user_id', Auth::id())->firstOrFail();
        return response()->json([
            'success' => "Medicine created successfully",
            'data' => $data,
        ]);
    }

    public function getMedicines()
    {
        $data = Medicine::distinct('name')->where('user_id', Auth::id())->orderBy('name')->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    /*public function getDocuments(string $txt)
    {
        $documents = Document::leftJoin('patients as p', 'documents.patient_id', 'p.id')->selectRaw("documents.id, documents.document, documents.mrn, documents.description, DATE_FORMAT(documents.created_at, '%d %M %Y') AS created_at, p.patient_id")->where('documents.user_id', Auth::id())->when($txt != '', function ($query) use ($txt) {
            return $query->where('documents.mrn', 'like', '%' . $txt . '%');
        })->get();
        return response()->json(['documents' => json_encode($documents)]);
    }*/
}
