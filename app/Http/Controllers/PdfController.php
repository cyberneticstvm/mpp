<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use PDF;
use QrCode;

class PdfController extends Controller
{
    public function prescriptionAll(string $id)
    {
        $consultation = Consultation::findOrFail(decrypt($id));
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(qrCodeText()));
        $pdf = PDF::loadView('backend.pdf.prescription.all', compact('consultation', 'qrcode'));
        return $pdf->stream($consultation->medical_record_number . '.pdf');
    }

    public function prescriptionClinic(string $id)
    {
        $consultation = Consultation::findOrFail(decrypt($id));
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(qrCodeText()));
        $pdf = PDF::loadView('backend.pdf.prescription.clinic', compact('consultation', 'qrcode'));
        return $pdf->stream($consultation->medical_record_number . '.pdf');
    }

    public function prescriptionMedicine(string $id)
    {
        $consultation = Consultation::findOrFail(decrypt($id));
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(qrCodeText()));
        $pdf = PDF::loadView('backend.pdf.prescription.medicine', compact('consultation', 'qrcode'));
        return $pdf->stream($consultation->medical_record_number . '.pdf');
    }

    public function prescriptionTest(string $id)
    {
        $consultation = Consultation::findOrFail(decrypt($id));
        $qrcode = base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate(qrCodeText()));
        $pdf = PDF::loadView('backend.pdf.prescription.test', compact('consultation', 'qrcode'));
        return $pdf->stream($consultation->medical_record_number . '.pdf');
    }
}
