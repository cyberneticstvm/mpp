<?php

namespace App\Http\Controllers;

use App\Exports\ExportAppointments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function exportAppointments(Request $request)
    {
        return Excel::download(new ExportAppointments($request), 'appointments.xlsx');
    }
}
