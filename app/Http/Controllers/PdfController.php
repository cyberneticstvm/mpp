<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Invoice;
use App\Models\Patient;
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
        $pdf = PDF::loadView('backend.pdf.other.appointment', compact('appointments', 'qrcode', 'request'));
        return $pdf->stream('appointments.pdf');
    }

    public function exportPatients(Request $request)
    {
        $fdate = Carbon::createFromFormat('d, F Y', $request->from_date)->format('Y-m-d');
        $fdate = Carbon::parse($fdate)->startOfDay();
        $tdate = Carbon::createFromFormat('d, F Y', $request->to_date)->format('Y-m-d');
        $tdate = Carbon::parse($tdate)->endOfDay();
        $patients = Patient::where('user_id', Auth::id())->where('profile_id', decrypt($request->profile))->whereBetween('created_at', [$fdate, $tdate])->latest()->get();
        $qrcode = $this->qrcode;
        $pdf = PDF::loadView('backend.pdf.other.patient', compact('patients', 'qrcode', 'request'));
        return $pdf->stream('patients.pdf');
    }

    public function exportConsultations(Request $request)
    {
        $fdate = Carbon::createFromFormat('d, F Y', $request->from_date)->format('Y-m-d');
        $fdate = Carbon::parse($fdate)->startOfDay();
        $tdate = Carbon::createFromFormat('d, F Y', $request->to_date)->format('Y-m-d');
        $tdate = Carbon::parse($tdate)->endOfDay();
        $consultations = Consultation::where('user_id', Auth::id())->where('profile_id', decrypt($request->profile))->whereBetween('created_at', [$fdate, $tdate])->latest()->get();
        $qrcode = $this->qrcode;
        $pdf = PDF::loadView('backend.pdf.other.consultation', compact('consultations', 'qrcode', 'request'));
        return $pdf->stream('consultations.pdf');
    }

    public function invoice(string $id)
    {
        $invoice = Invoice::findOrFail(decrypt($id));
        $qrcode = $this->qrcode;
        $pdf = PDF::loadView('backend.pdf.other.invoice', compact('invoice', 'qrcode'));
        return $pdf->stream($invoice->invoice_number . '.pdf');
    }
}
