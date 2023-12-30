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
                        <li class="breadcrumb-item active">Patient Report</li>
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
                        <h5>Patient Report</h5>
                    </div>
                    {{ html()->form('POST', route('report.patient.fetch'))->class('theme-form')->open() }}
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
                                {{ html()->select($name = 'profile', profiles()->pluck('name', 'id'), old('profile') ?? $inputs['profile'])->class('form-control form-control-lg')->placeholder('Select Profile')->required() }}
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
                        <div class="row">
                            <div class="col-6">
                                <h5>Report</h5>
                            </div>
                            <div class="col-6 dropdown-basic text-end">
                                <div class="dropdown text-start">
                                    <div class="btn-group mb-0">
                                        <button class="dropbtn btn-primary" type="button" data-bs-original-title="" title="">Download <span><i class="icofont icofont-arrow-down"></i></span></button>
                                        <div class="dropdown-content"><a href="{{ route('patient.excel.export', ['from_date' => $inputs['from_date'], 'to_date' => $inputs['to_date'], 'profile' => encrypt($inputs['profile'])]) }}" target="_blank"><i class="fa fa-file-excel-o text-success"></i> Excel</a><a href="{{ route('patient.pdf.export', ['from_date' => $inputs['from_date'], 'to_date' => $inputs['to_date'], 'profile' => encrypt($inputs['profile'])]) }}" target="_blank"><i class="fa fa-file-pdf-o text-danger"></i> Pdf</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="display table table-sm table-striped" id="basic-2">
                            <thead>
                                <th>SL No</th>
                                <th>Patient Name</th>
                                <th>Patient ID</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Mobile Number</th>
                                <th>Address</th>
                                <th>Registered On</th>
                            </thead>
                            <tbody>
                                @forelse($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->patient_name }}</td>
                                    <td>{{ $item->patient_id }}</td>
                                    <td>{{ $item->age }}</td>
                                    <td>{{ ucfirst($item->gender) }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->address }}</td>
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