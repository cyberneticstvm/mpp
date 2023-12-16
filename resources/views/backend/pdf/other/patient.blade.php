@extends("backend.pdf.other.base")
@section("content")
<div class="row mt-3">
    <div class="text-center">Patient Report Between {{ $request->from_date }} and {{ $request->to_date }}</div>
</div>
<div class="row mt-3">
    <table width="100%">
        <thead>
            <tr>
                <th>SL No</th>
                <th>Patient Name</th>
                <th>Patient ID</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Registered On</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->patient_name }}</td>
                <td>{{ $item->patient_id }}</td>
                <td>{{ $item->age }}</td>
                <td>{{ ucfirst($item->gender) }}</td>
                <td>{{ $item->mobile }}</td>
                <td>{{ $item->address }}</td>
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