<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use QrCode;

class PdfController extends Controller
{
    protected $qrcode;
    public function __construct()
    {
        $this->qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(qrCodeText()));
    }
    public function prescriptionAll(string $id)
    {
        $consultation = Consultation::findOrFail(decrypt($id));
        $qrcode = $this->qrcode;
        $pdf = PDF::loadView('backend.pdf.prescription.all', compact('consultation', 'qrcode'));
        return $pdf->stream($consultation->medical_record_number . '.pdf');
    }

    public function prescriptionClinic(string $id)
    {
        $consultation = Consultation::findOrFail(decrypt($id));
        $qrcode = $this->qrcode;
        $pdf = PDF::loadView('backend.pdf.prescription.clinic', compact('consultation', 'qrcode'));
        return $pdf->stream($consultation->medical_record_number . '.pdf');
    }

    public function prescriptionMedicine(string $id)
    {
        $consultation = Consultation::findOrFail(decrypt($id));
        $qrcode = $this->qrcode;
        $pdf = PDF::loadView('backend.pdf.prescription.medicine', compact('consultation', 'qrcode'));
        return $pdf->stream($consultation->medical_record_number . '.pdf');
    }

    public function prescriptionTest(string $id)
    {
        $consultation = Consultation::findOrFail(decrypt($id));
        $qrcode = $this->qrcode;
        $pdf = PDF::loadView('backend.pdf.prescription.test', compact('consultation', 'qrcode'));
        return $pdf->stream($consultation->medical_record_number . '.pdf');
    }

    public function exportAppointments(Request $request)
    {
        $fdate = Carbon::createFromFormat('d, F Y', $request->from_date)->format('Y-m-d');
        $fdate = Carbon::parse($fdate)->startOfDay();
        $tdate = Carbon::createFromFormat('d, F Y', $request->to_date)->format('Y-m-d');
        $tdate = Carbon::parse($tdate)->endOfDay();
        $appointments = Appointment::where('user_id', Auth::id())->where('profile_id', decrypt($request->profile))->whereBetween('created_at', [$fdate, $tdate])->latest()->get();
        $qrcode = $this->qrcode;
        $pdf = PDF::loadView('backend.pdf.other.appointment', compact('appointments', 'qrcode'));
        return $pdf->stream('appointments.pdf');
    }
}
