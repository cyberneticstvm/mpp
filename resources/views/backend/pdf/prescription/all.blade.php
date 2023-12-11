@extends("backend.pdf.prescription.base")
@section("content")
<div class="row mt-3">
    <p>Clinical Details</p>
    <div class="border" style="width: 10%;"></div>
    <table class="table table-bordered mt-3" width="100%">
        <tr>
            <td width="50%">
                <desc>Medical History:</desc><br />
                <div class="text me-3">
                    {{ $consultation->medical_history ?? 'NA' }}
                </div>
            </td>
            <td width="50%">
                <desc>Examination:</desc><br />
                <div class="text">
                    {{ $consultation->examination ?? 'NA' }}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4"><br /></td>
        </tr>
        <tr>
            <td width="50%">
                <desc>Symptoms:</desc><br />
                <div class="text me-3">
                    {{ $consultation->symptoms?->pluck('name')->implode(',') }}
                </div>
            </td>
            <td width="50%">
                <desc>Diagnosis:</desc><br />
                <div class="text">
                    {{ $consultation->diagnoses?->pluck('name')->implode(',') }}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4"><br /></td>
        </tr>
        <tr>
            <td width="50%">
                <desc>Investigation:</desc><br />
                <div class="text me-3">
                    {{ $consultation->investigation ?? 'NA' }}
                </div>
            </td>
            <td width="50%">
                <desc>Advice / Referrals:</desc><br />
                <div class="text">
                    {{ $consultation->advice ?? 'NA' }}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4"><br /></td>
        </tr>
        <tr>
            <td width="50%">
                <desc>Is allergic to any drugs?:</desc><br />
                <div class="text me-3">
                    {{ $consultation->allergic_drugs ?? 'NA' }}
                </div>
            </td>
            <td width="50%">
                <desc>Notes / Remarks:</desc><br />
                <div class="text">
                    {{ $consultation->notes ?? 'NA' }}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="4"><br /></td>
        </tr>
        <tr>
            <td width="50%">
                <desc>Surgery Advised?:</desc><br />
                <div class="text me-3">
                    {{ ucfirst($consultation->surgery_advised) }}
                </div>
            </td>
            <td width="50%">
                <desc>Next Review Date:</desc><br />
                <div class="text">
                    {{ $consultation->review_date?->format('d, F Y') }}
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="row mt-3">
    <p>Drug / Medicine Details</p>
    <div class="border" style="width: 10%;"></div>
</div>
@endsection