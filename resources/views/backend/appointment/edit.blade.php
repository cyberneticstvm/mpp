@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Update Appointment</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Update Appointment</li>
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
                    {{ html()->form('POST', route('appointment.update', $appointment->id))->class('theme-form')->open() }}
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label req">Patient Name</label>
                                {{ html()->text('patient_name', $appointment->patient_name)->class('form-control')->placeholder('Patient Name')->required() }}
                                @error('patient_name')
                                <small class="text-danger">{{ $errors->first('patient_name') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Date of Birth</label>
                                {{ html()->text('dob', $appointment->dob->format('d, F Y'))->class('datepicker-here form-control digits')->attribute('data-language', 'en')->attribute('data-position', 'top left')->attribute('readonly', 'true')->placeholder('day, month year') }}
                            </div>
                            <div class="col-md-1 form-group">
                                <label class="control-label">Age</label>
                                {{ html()->text('age', $appointment->age)->class('form-control digits')->maxlength('3')->placeholder('0') }}
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Old</label>
                                {{ html()->select('old', array('years' => 'Years', 'months' => 'Months', 'days' => 'Days'), $appointment->old)->class('form-control')->placeholder('Select') }}
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label req">Mobile Number</label>
                                {{ html()->text('mobile', $appointment->mobile)->class('form-control')->maxlength('10')->placeholder('0123456789')->required() }}
                                @error('mobile')
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label req">Place / Address</label>
                                {{ html()->text('address', $appointment->address)->class('form-control')->placeholder('Place / Address')->required() }}
                                @error('address')
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label req">Appointment Date</label>
                                {{ html()->text('appointment_date', $appointment->appointment_date->format('d, F Y'))->class('datepicker-here form-control digits')->attribute('data-language', 'en')->attribute('data-position', 'top left')->attribute('readonly', 'true')->placeholder('day, month year')->required() }}
                                @error('appointment_date')
                                <small class="text-danger">{{ $errors->first('appointment_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label req">Appointment Time</label>
                                {{ html()->text('appointment_time', $appointment->appointment_time->format('h:iA'))->class('form-control input-group clockpicker')->attribute('data-placement', 'top')->attribute('data-alignt', 'left')->attribute('data-autoclose', 'true')->attribute('readonly', 'true')->placeholder('H:m')->required() }}
                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                @error('appointment_time')
                                <small class="text-danger">{{ $errors->first('appointment_time') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-light show_available_slots">Show Available Slots</a>
                        <a class="btn btn-danger" onclick="window.history.back();">Cancel</a>
                        <button class="btn btn-primary btn-submit">Update</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@include("backend.drawer.appointment-slots");
@endsection