@extends("backend.pdf.prescription.base")
@section("content")
<div class="row mt-3">
    <p>Tests Advised</p>
    <div class="border" style="width: 10%;"></div>
    <div class="text">{{ $consultation->tests?->pluck('name')->implode(',') ?? 'NA' }}</div>
</div>
@endsection