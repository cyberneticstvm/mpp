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
                        <li class="breadcrumb-item active">Consultation Report</li>
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
                        <h5>Consultation Report</h5>
                    </div>
                    {{ html()->form('POST', route('report.consultation.fetch'))->class('theme-form')->open() }}
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label req">From Date</label>
                                {{ html()->text('from_date', old('from_date') ?? $inputs['from_date'])->class('datepicker-here form-control digits')->attribute('data-language', 'en')->attribute('data-position', 'top left')->attribute('readonly', 'true')->placeholder('day, month year') }}
                                @error('from_date')
                                <small class="text-danger">{{ $errors->first('from_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label req">To Date</label>
                                {{ html()->text('to_date', old('to_date') ?? $inputs['to_date'])->class('datepicker-here form-control digits')->attribute('data-language', 'en')->attribute('data-position', 'top left')->attribute('readonly', 'true')->placeholder('day, month year') }}
                                @error('to_date')
                                <small class="text-danger">{{ $errors->first('to_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label req">Profile</label>
                                {{ html()->select($name = 'profile', profile()->pluck('name', 'id'), old('profile') ?? $inputs['profile'])->class('form-control form-control-lg')->placeholder('Select Profile')->required() }}
                                @error('profile')
                                <small class="text-danger">{{ $errors->first('profile') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-danger" onclick="window.history.back();">Cancel</a>
                        <button class="btn btn-primary btn-submit">Fetch</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Report</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="display table table-sm table-striped" id="basic-2">
                            <thead>
                                <th>SL No</th>
                                <th>Patient Name</th>
                                <th>Patient ID</th>
                                <th>Patient Mobile</th>
                                <th>Patient Adress</th>
                                <th>MRN</th>
                                <th>Consultation Date</th>
                            </thead>
                            <tbody>
                                @forelse($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->patient->patient_name }}</td>
                                    <td>{{ $item->patient->patient_id }}</td>
                                    <td>{{ $item->patient->mobile }}</td>
                                    <td>{{ $item->patient->address }}</td>
                                    <td>{{ $item->medical_record_number }}</td>
                                    <td>{{ $item->created_at->format('d, F Y') }}</td>
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