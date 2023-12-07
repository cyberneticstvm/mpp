@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Consultation / Medical Record List</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Consultation / Medical Record List</li>
                    </ol>
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
                                <th>Patient ID</th>
                                <th>MRN</th>
                                <th>Review Date</th>
                                <th>Prescription</th>
                                <th>Edit</th>
                            </thead>
                            <tbody>
                                @forelse($consultations as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->patient?->patient_name }}</td>
                                    <td>{{ $item->patient?->patient_id }}</td>
                                    <td>{{ $item->medical_record_number }}</td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center"><a href="{{ route('consultation.edit', encrypt($item->id)) }}"><i class="fa fa-edit text-warning fa-lg"></i></a></td>
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