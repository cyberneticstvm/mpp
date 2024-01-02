<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Diagnosis;
use App\Models\Medicine;
use App\Models\Month;
use App\Models\Symptom;
use App\Models\Test;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use DB;

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

    public function getAppointmentData()
    {
        /*$appointments = DB::table('months as m')->leftJoin('appointments AS a', function ($q) {
            return $q->on(DB::raw('MONTH(a.created_at)'), '=', 'm.id')->where('a.user_id', Auth::id())->where('a.profile_id', profile()->id);
        })->selectRaw("COUNT(a.id) AS acount, m.short_name AS month, YEAR(a.created_at) AS ayear")->groupBy('m.id', 'month', 'ayear')->orderBy('m.id')->get();*/

        $appointments = Month::leftJoin('appointments as a', function ($q) {
            $q->on('a.created_at', '>=', DB::raw('LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH'));
            $q->on('a.created_at', '<', DB::raw('LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH + INTERVAL 1 MONTH'))->where('a.user_id', Auth::id())->where('a.profile_id', profile()->id);
        })->select(DB::raw("LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH AS date, COUNT(a.id) AS acount, CONCAT_WS('/', DATE_FORMAT(LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH, '%b'), DATE_FORMAT(LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH, '%y')) AS month"))->groupBy('date', 'months.id')->orderByDesc('date')->get();

        $registrations = Month::leftJoin('patients as a', function ($q) {
            $q->on('a.created_at', '>=', DB::raw('LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH'));
            $q->on('a.created_at', '<', DB::raw('LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH + INTERVAL 1 MONTH'))->where('a.user_id', Auth::id())->where('a.profile_id', profile()->id);
        })->select(DB::raw("LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH AS date, COUNT(a.id) AS acount, CONCAT_WS('/', DATE_FORMAT(LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH, '%b'), DATE_FORMAT(LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH, '%y')) AS month"))->groupBy('date', 'months.id')->orderByDesc('date')->get();

        $consultations = Month::leftJoin('consultations as a', function ($q) {
            $q->on('a.created_at', '>=', DB::raw('LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH'));
            $q->on('a.created_at', '<', DB::raw('LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH + INTERVAL 1 MONTH'))->where('a.user_id', Auth::id())->where('a.profile_id', profile()->id);
        })->select(DB::raw("LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH AS date, COUNT(a.id) AS acount, CONCAT_WS('/', DATE_FORMAT(LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH, '%b'), DATE_FORMAT(LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL months.id MONTH, '%y')) AS month"))->groupBy('date', 'months.id')->orderByDesc('date')->get();

        return json_encode([
            'aps' => $appointments,
            'pat' => $registrations,
            'con' => $consultations,
        ]);
    }
}
