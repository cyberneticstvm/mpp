<?php

namespace App\Http\Controllers;

use App\Exports\ExportAppointments;
use App\Exports\ExportConsultations;
use App\Exports\ExportPatients;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function exportAppointments(Request $request)
    {
        return Excel::download(new ExportAppointments($request), 'appointments.xlsx');
    }

    public function exportPatients(Request $request)
    {
        return Excel::download(new ExportPatients($request), 'patients.xlsx');
    }

    public function exportConsultations(Request $request)
    {
        return Excel::download(new ExportConsultations($request), 'consultations.xlsx');
    }
}
