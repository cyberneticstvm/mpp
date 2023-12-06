@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>All Appointment List</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">All Appointment List</li>
                    </ol>
                </div>
                <div class="col-sm-6 text-end">
                    <a class="btn btn-primary" href="{{ route('appointment.create') }}">Create New</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="display table table-sm table-striped" id="basic-2">
                            <thead>
                                <th>SL No</th>
                                <th>Patient Name</th>
                                <th>Mobile Number</th>
                                <th>Address</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Register</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                @forelse($appointments as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->patient_name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td class="text-center">{{ $item->appointment_date->format('d, F Y') }}</td>
                                    <td>{!! $item->appointment_time->format('h:i A') !!}</td>
                                    <td><a href="{{ route('patient.create', encrypt($item->id)) }}" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Click here to register this patient">Register</a></td>
                                    <td>{!! $item->status() !!}</td>
                                    <td class="text-center"><a href="{{ route('appointment.edit', encrypt($item->id)) }}"><i class="fa fa-edit text-warning fa-lg"></i></a></td>
                                    <td class="text-center"><a href="{{ route('appointment.delete', encrypt($item->id)) }}" class="dlt"><i class="fa fa-trash text-danger fa-lg"></i></a></td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection