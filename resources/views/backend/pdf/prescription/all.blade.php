@extends("backend.pdf.prescription.base")
@section("content")
<div class="row mt-3">
    <p>Clinical Details</p>
    <div class="border" style="width: 10%;"></div>
    <table class="table mt-1" width="100%">
        <tr>
            <td width="50%">
                Medical History<br />
                <div class="text">{{ $consultation->medical_history ?? 'NA' }}</div>
            </td>
            <td width="50%">
                Examination<br />
                <div class="text">{{ $consultation->examination ?? 'NA' }}</div>
            </td>
        </tr>
        <tr>
            <td colspan="2"><br /></td>
        </tr>
        <tr>
            <td width="50%">
                Symptoms:<br />
                <div class="text me-3">
                    {{ $consultation->symptoms?->pluck('name')->implode(',') ?? 'NA' }}
                </div>
            </td>
            <td width="50%">
                Diagnosis:<br />
                <div class="text">
                    {{ $consultation->diagnoses?->pluck('name')->implode(',') ?? 'NA' }}
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2"><br /></td>
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
            <td colspan="2"><br /></td>
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
            <td colspan="2"><br /></td>
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
                    {{ $consultation->review_date?->format('d, F Y') ?? 'NA' }}
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="row mt-3">
    <p>Drug / Medicine Details</p>
    <div class="border" style="width: 10%;"></div>
    <table class="table mt-1" width="100%">
        <tr>
            <th class="text"><strong>SL</strong></th>
            <th class="text"><strong>Medicine</strong></th>
            <th class="text"><strong>Qty</strong></th>
            <th class="text"><strong>Dosage</strong></th>
            <th class="text"><strong>Duration</strong></th>
            <th class="text"><strong>Notes</strong></th>
        </tr>
        @forelse($consultation->medicines as $key => $item)
        <tr>
            <td class="text">{{ $key + 1 }}.</td>
            <td class="text">
                {{ $item->medicine->name }}
            </td>
            <td class="text">
                {{ $item->qty }}
            </td>
            <td class="text">
                {{ $item->dosage }}
            </td>
            <td class="text">
                {{ $item->duration }}
            </td>
            <td class="text">
                {{ $item->notes }}
            </td>
        </tr>
        @empty
        <tr>
            <td class="text">NA</td>
            <td class="text">NA</td>
            <td class="text">NA</td>
            <td class="text">NA</td>
            <td class="text">NA</td>
            <td class="text">NA</td>
        </tr>
        @endforelse
    </table>
</div>
<div class="row mt-3">
    <p>Tests Advised</p>
    <div class="border" style="width: 10%;"></div>
    <div class="text">{{ $consultation->tests?->pluck('name')->implode(',') ?? 'NA' }}</div>
</div>
<div class="mt-5">
    <span class="text">Consultation Date & Time: {{ $consultation->created_at->format('d, F Y h:i a') }}</span>
</div>
<div class="row">
    <div class="text-end">
        {{ profile()->name }}<br />
        <span class="text">{{ profile()->designation }}</span><br />
        <span class="text">Reg No: {{ profile()->registration_number }}</span>
    </div>
</div>
@endsection