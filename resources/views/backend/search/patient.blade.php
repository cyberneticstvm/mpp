@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Patient</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Patient Search</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Patient Search</h5>
                    </div>
                    {{ html()->form('POST', route('search.patient.fetch'))->class('theme-form')->open() }}
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label req">Query String</label>
                                {{ html()->text($name = 'query_string', old('query_string') ?? $query_string)->class('form-control form-control-lg')->placeholder('Search by Patient Name / Patient ID / Mobile')->required() }}
                                @error('query_string')
                                <small class="text-danger">{{ $errors->first('query_string') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-danger" onclick="window.history.back();">Cancel</a>
                        <button class="btn btn-primary btn-submit">Search</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table class="display table table-sm table-striped" id="basic-2">
                            <thead>
                                <th>SL No</th>
                                <th>Patient Name</th>
                                <th>Gender</th>
                                <th>Patient ID</th>
                                <th>Mobile Number</th>
                                <th>Address</th>
                                <th>Review / Consultation</th>
                                <th>History</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                @forelse($patients as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->patient_name }}</td>
                                    <td>{{ ucfirst($item->gender) }}</td>
                                    <td>{{ $item->patient_id }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->address }}</td>
                                    @if(!isConsultationCompleted($item->id))
                                    <td><a href="{{ route('consultation.create', encrypt($item->id)) }}" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Click here to review / consult this patient">Review / Conultation</a></td>
                                    @else
                                    <td class="text-success text-center">COMPLETED</td>
                                    @endif
                                    <td></td>
                                    <td>{!! $item->status() !!}</td>
                                    <td class="text-center"><a href="{{ route('patient.edit', encrypt($item->id)) }}"><i class="fa fa-edit text-warning fa-lg"></i></a></td>
                                    <td class="text-center"><a href="{{ route('patient.delete', encrypt($item->id)) }}" class="dlt"><i class="fa fa-trash text-danger fa-lg"></i></a></td>
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