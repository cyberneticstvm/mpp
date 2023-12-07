@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Create Patient</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Patient</li>
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
                        <h5>Register Patient</h5><span>Create New Patient</span>
                    </div>
                    {{ html()->form('POST', route('patient.save', $appointment->id))->class('theme-form')->open() }}
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label req">Patient Name</label>
                                {{ html()->text('patient_name', $appointment->patient_name ?? old('patient_name'))->class('form-control')->placeholder('Patient Name')->required() }}
                                @error('patient_name')
                                <small class="text-danger">{{ $errors->first('patient_name') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label req">Gender</label>
                                {{ html()->select('gender', array('male' => 'Male', 'female' => 'Female', 'other' => 'Other'), $appointment->gender ?? old('gender'))->class('form-control')->placeholder('Select') }}
                                @error('gender')
                                <small class="text-danger">{{ $errors->first('gender') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Date of Birth</label>
                                {{ html()->text('dob', $appointment->dob ? $appointment->dob->format('d, F Y') : old('dob'))->class('datepicker-here form-control digits')->attribute('data-language', 'en')->attribute('data-position', 'top left')->attribute('readonly', 'true')->placeholder('day, month year') }}
                            </div>
                            <div class="col-md-1 form-group">
                                <label class="control-label">Age</label>
                                {{ html()->text('age', $appointment->age ?? old('age'))->class('form-control digits')->maxlength('3')->placeholder('0') }}
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Old</label>
                                {{ html()->select('old', array('years' => 'Years', 'months' => 'Months', 'days' => 'Days'), $appointment->old ?? old('old'))->class('form-control')->placeholder('Select') }}
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label req">Mobile Number</label>
                                {{ html()->text('mobile', $appointment->mobile ?? old('mobile'))->class('form-control')->maxlength('10')->placeholder('0123456789')->required() }}
                                @error('mobile')
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label req">Place / Address</label>
                                {{ html()->text('address', $appointment->address ?? old('address'))->class('form-control')->placeholder('Place / Address')->required() }}
                                @error('address')
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Email Id (Optional)</label>
                                {{ html()->email('email', $appointment->email ?? old('email'))->class('form-control')->placeholder('Email Id') }}
                                @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-danger" onclick="window.history.back();">Cancel</a>
                        @if(Session::has('exists'))
                        <button class="btn btn-primary btn-submit">Continue as New Patient</button>
                        @else
                        <button class="btn btn-primary btn-submit">Register Patient</button>
                        @endif
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection