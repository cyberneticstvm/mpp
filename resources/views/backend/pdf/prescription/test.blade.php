@extends("backend.pdf.prescription.base")
@section("content")
<div class="row mt-3">
    <p>Tests Advised</p>
    <div class="border" style="width: 10%;"></div>
    <div class="text">{{ $consultation->tests?->pluck('name')->implode(',') }}</div>
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