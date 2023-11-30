@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Create Appointment</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Appointment</li>
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
                        <h5>Appointment</h5><span>Create New Appointment</span>
                    </div>
                    <div class="card-body">
                        <div class="stepwizard">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step"><a class="btn btn-primary" href="#step-1"><i class="fa fa-user"></i></a>
                                    <p>Patient Details</p>
                                </div>
                                <div class="stepwizard-step"><a class="btn btn-light" href="#step-2"><i class="fa fa-clock-o"></i></a>
                                    <p>Appointment Time</p>
                                </div>
                            </div>
                        </div>
                        {{ html()->form('POST', route('appointment.save'))->open() }}
                        @csrf
                        <div class="setup-content" id="step-1">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label class="control-label req">Patient Name</label>
                                        {{ html()->text('name', old('name'))->class('form-control')->placeholder('Patient Name')->required() }}
                                        @error('name')
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">Date of Birth</label>
                                        {{ html()->text('dob', old('dob'))->class('datepicker-here form-control digits')->attribute('data-language', 'en')->attribute('data-position', 'top left')->attribute('readonly', 'true')->placeholder('day, month year') }}
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label class="control-label">Age</label>
                                        {{ html()->text('age')->class('form-control digits')->maxlength('3')->placeholder('0') }}
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label class="control-label">Old</label>
                                        {{ html()->select('old', array('years' => 'Years', 'months' => 'Months', 'days' => 'Days'), old('old'))->class('form-control')->placeholder('Select') }}
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label class="control-label req">Mobile Number</label>
                                        {{ html()->text('mobile', old('mobile'))->class('form-control')->maxlength('10')->placeholder('0123456789')->required() }}
                                        @error('mobile')
                                        <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label req">Place / Address</label>
                                        {{ html()->text('address', old('address'))->class('form-control')->placeholder('Place / Address')->required() }}
                                        @error('address')
                                        <small class="text-danger">{{ $errors->first('address') }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label req">Appointment Date</label>
                                        {{ html()->text('appointment_date', old('appointment_date'))->class('datepicker-here form-control digits')->attribute('data-language', 'en')->attribute('data-position', 'top left')->attribute('readonly', 'true')->placeholder('day, month year')->required() }}
                                        @error('appointment_date')
                                        <small class="text-danger">{{ $errors->first('appointment_date') }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-light nextBtn pull-right" type="button">Next</button>
                            </div>
                        </div>
                        <div class="setup-content" id="step-2">
                            <div class="col-xs-12">
                                <div class="row">

                                </div>
                                <button class="btn btn-primary btn-submit pull-right" type="submit">Save</button>
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection