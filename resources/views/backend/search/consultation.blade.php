@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Consultation</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Consultation Search</li>
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
                        <h5>Consultation Search</h5>
                    </div>
                    {{ html()->form('POST', route('search.consultation.fetch'))->class('theme-form')->open() }}
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label req">Query String</label>
                                {{ html()->text($name = 'query_string', old('query_string') ?? $query_string)->class('form-control form-control-lg')->placeholder('Search by Name / ID / Mobile / MRN')->required() }}
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
                <div class="card" style="min-height: 350px;">
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
                                    <td>{{ $item->review_date?->format('d, F Y') }}</td>
                                    <td class="dropdown-basic">
                                        <div class="dropdown">
                                            <a class="btn btn-outline-primary btn-sm">Print <span><i class="icofont icofont-arrow-down"></i></span></a>
                                            <div class="dropdown-content">
                                                <a href="{{ route('prescription.all.pdf', encrypt($item->id)) }}" target="_blank">All</a>
                                                <a href="{{ route('prescription.clinic.pdf', encrypt($item->id)) }}" target="_blank">Clinical</a>
                                                <a href="{{ route('prescription.medicine.pdf', encrypt($item->id)) }}" target="_blank">Medicine / Drugs</a>
                                                <a href="{{ route('prescription.test.pdf', encrypt($item->id)) }}" target="_blank">Tests Adviced</a>
                                            </div>
                                        </div>
                                    </td>
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