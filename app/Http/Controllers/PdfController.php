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
        $pdf = PDF::loadView('backend.pdf.prescription.all', compact('consultation'));
        /*$pdf->output();
        $canvas = $pdf->getDomPDF()->getCanvas();

        $height = $canvas->get_height();
        $width = $canvas->get_width();

        $canvas->set_opacity(.2, "Multiply");

        $canvas->set_opacity(.2);

        $canvas->page_text(
            $width / 5,
            $height / 2,
            'Medical Prescription Pro',
            null,
            30,
            array(0, 0, 0),
            2,
            2,
            -30
        );*/
        return $pdf->stream($consultation->medical_record_number . '.pdf');
    }
}
