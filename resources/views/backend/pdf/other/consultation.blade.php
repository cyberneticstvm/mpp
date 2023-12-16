@extends("backend.pdf.other.base")
@section("content")
<div class="row mt-3">
    <div class="text-center">Consultation Report Between {{ $request->from_date }} and {{ $request->to_date }}</div>
</div>
<div class="row mt-3">
    <table width="100%">
        <thead>
            <tr>
                <th>SL No</th>
                <th>Patient Name</th>
                <th>Patient ID</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>MRN</th>
                <th>Consult. Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($consultations as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->patient->patient_name }}</td>
                <td>{{ $item->patient->patient_id }}</td>
                <td>{{ $item->patient->mobile }}</td>
                <td>{{ $item->patient->address }}</td>
                <td>{{ $item->medical_record_number }}</td>
                <td>{{ $item->created_at->format('d/M/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No records found!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection