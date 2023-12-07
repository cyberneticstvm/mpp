@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Update Patient</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Update Patient</li>
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
                        <h5>Update Patient</h5><span>Update Patient</span>
                    </div>
                    {{ html()->form('POST', route('patient.update', $patient->id))->class('theme-form')->open() }}
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label req">Patient Name</label>
                                {{ html()->text('patient_name', $patient->patient_name ?? old('patient_name'))->class('form-control')->placeholder('Patient Name')->required() }}
                                @error('patient_name')
                                <small class="text-danger">{{ $errors->first('patient_name') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Date of Birth</label>
                                {{ html()->text('dob', $patient->dob ? $patient->dob->format('d, F Y') : old('dob'))->class('datepicker-here form-control digits')->attribute('data-language', 'en')->attribute('data-position', 'top left')->attribute('readonly', 'true')->placeholder('day, month year') }}
                            </div>
                            <div class="col-md-1 form-group">
                                <label class="control-label">Age</label>
                                {{ html()->text('age', $patient->age ?? old('age'))->class('form-control digits')->maxlength('3')->placeholder('0') }}
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Old</label>
                                {{ html()->select('old', array('years' => 'Years', 'months' => 'Months', 'days' => 'Days'), $patient->old ?? old('old'))->class('form-control')->placeholder('Select') }}
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label req">Mobile Number</label>
                                {{ html()->text('mobile', $patient->mobile ?? old('mobile'))->class('form-control')->maxlength('10')->placeholder('0123456789')->required() }}
                                @error('mobile')
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label req">Place / Address</label>
                                {{ html()->text('address', $patient->address ?? old('address'))->class('form-control')->placeholder('Place / Address')->required() }}
                                @error('address')
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Email Id (Optional)</label>
                                {{ html()->email('email', $patient->email ?? old('email'))->class('form-control')->placeholder('Email Id') }}
                                @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-danger" onclick="window.history.back();">Cancel</a>
                        <button class="btn btn-primary btn-submit">Update Patient</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection