<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    public function getAppointments(Request $request)
    {
        $this->validate($request, [
            'appointment_date' => 'required',
        ]);
        try {
            $appointment_date = Carbon::createFromFormat('d, F Y', $request->appointment_date)->format('Y-m-d');
            $appointments = Appointment::selectRaw("appointment_time as atime")->whereDate('appointment_date', $appointment_date)->where('user_id', Auth::id())->where('profile_id', Session::get('profile'))->get();
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return response()->json(['appointments' => $appointments]);
    }
}
