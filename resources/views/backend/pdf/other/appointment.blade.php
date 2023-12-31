@extends("backend.pdf.other.base")
@section("content")
<div class="row mt-3">
    <div class="text-center">Appointment Report Between {{ $request->from_date }} and {{ $request->to_date }}</div>
</div>
<div class="row mt-3">
    <table width="100%">
        <thead>
            <tr>
                <th>SL No</th>
                <th>Patient Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>App. Date</th>
                <th>App. Time</th>
                <th>Created On</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->patient_name }}</td>
                <td>{{ $item->age }}</td>
                <td>{{ ucfirst($item->gender) }}</td>
                <td>{{ $item->mobile }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->appointment_date->format('d/M/Y') }}</td>
                <td>{{ $item->appointment_time->format('h:i a') }}</td>
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