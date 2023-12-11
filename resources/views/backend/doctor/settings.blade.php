@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Settings</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">Personal Settings</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            {{ html()->form('POST', route('personal.settings.update'))->class('')->open() }}
                            @csrf
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media"> <img class="img-70 rounded-circle" alt="" src="{{ asset('/backend/assets/images/dashboard/1.png') }}">
                                        <div class="media-body">
                                            <h3 class="mb-1 f-20 txt-primary">{{ Auth::user()->name }}</h3>
                                            <p class="f-12">Subscription Plan: {{ ucfirst(Auth::user()->plan) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h6 class="form-label">Your Bio</h6>
                                {{ html()->textarea('bio', old('bio') ?? Auth::user()->bio)->class('form-control')->placeholder('Your Bio')->rows('5') }}
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                {{ html()->email('email', old('email') ?? Auth::user()->email)->class('form-control')->placeholder('Email Address')->if(Auth::user()->email_verified_at != '', function($q){
                                        return $q->attribute('readonly', 'true');
                                    }) }}
                                @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mobile Number</label>
                                {{ html()->text('mobile', old('mobile') ?? Auth::user()->mobile)->class('form-control')->placeholder('Mobile')->if(Auth::user()->mobile != '', function($q){
                                        return $q->attribute('readonly', 'true');
                                    })->maxlength('10') }}
                                @error('mobile')
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                {{ html()->password('password', '')->class('form-control')->placeholder('******') }}
                                @error('password')
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                {{ html()->password('password_confirmation', '')->class('form-control')->placeholder('******') }}
                                @error('password_confirmation')
                                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                                @enderror
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary btn-block btn-submit">Update</button>
                            </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    {{ html()->form('POST', route('general.settings.update'))->class('card')->acceptsFiles()->open() }}
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">General Settings</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="profile-title">
                                <h6>Prescription Settings </h6>
                                <small>These details will display in Prescription. It helps to personalize your prescription. This is premium plan feature.</small>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Hospital / Clinic / Doctor Name</label>
                                    {{ html()->text('name', old('name') ?? settings()->name)->class('form-control')->placeholder('Hospital / Clinic / Doctor Name') }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Contact Number</label>
                                    {{ html()->text('contact_number', old('contact_number') ?? settings()->contact_number)->class('form-control')->maxlength('10')->placeholder('Hospital / Clinic / Doctor Contact Number') }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    {{ html()->textarea('address', old('address') ?? settings()->address)->class('form-control')->rows('5')->placeholder('Hospital / Clinic / Doctor Address') }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Logo Image <small>(1500px X 500px Transparent Image and Max Size 1MB)</small></label>
                                    {{ html()->file('logo', '')->class('form-control') }}
                                    <small><a href="{{ (settings()->logo) ? asset(settings()->logo) : '' }}" target="_blank" class="text-info">Logo</a></small>
                                    @error('logo')
                                    <small class="text-danger">{{ $errors->first('logo') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Watermark Image <small>(Max Size 1MB)</small></label>
                                    {{ html()->file('watermark_image', '')->class('form-control') }}
                                    <small><a href="{{ (settings()->watermark_image) ? asset(settings()->watermark_image) : '' }}" target="_blank" class="text-info">Watermark Image</a></small>
                                    @error('watermark_image')
                                    <small class="text-danger">{{ $errors->first('watermark_image') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Watermark Text</label>
                                    {{ html()->text('watermark_text', old('watermark_text') ?? settings()->watermark_text)->class('form-control')->placeholder('Watermark Text') }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Watermark Preference</label>
                                    {{ html()->select('watermark_preference', array('image' => 'Image Watermark', 'text' => 'Text Watermark', 'no' => 'No Watermark'), settings()->watermark_preference)->class('form-control')->placeholder('Select') }}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="profile-title">
                                <h6>Appointment Settings </h6>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Appointment Start Time</label>
                                    {{ html()->text('appointment_start', old('appointment_start') ?? settings()->appointment_start?->format('h:iA'))->class('form-control input-group clockpicker')->attribute('data-placement', 'top')->attribute('data-alignt', 'left')->attribute('data-autoclose', 'true')->attribute('readonly', 'true')->placeholder('H:m')->required() }}
                                    @error('appointment_start')
                                    <small class="text-danger">{{ $errors->first('appointment_start') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Appointment End Time</label>
                                    {{ html()->text('appointment_end', old('appointment_end') ?? settings()->appointment_end?->format('h:iA'))->class('form-control input-group clockpicker')->attribute('data-placement', 'top')->attribute('data-alignt', 'left')->attribute('data-autoclose', 'true')->attribute('readonly', 'true')->placeholder('H:m')->required() }}
                                    @error('appointment_end')
                                    <small class="text-danger">{{ $errors->first('appointment_end') }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Default Duration / Appointment</label>
                                    {{ html()->select('appointment_duration', array('10' => '10 Minutes', '15' => '15 Minutes', '20' => '20 Minutes', '25' => '25 Minutes', '30' => '30 Minutes'), old('appointment_duration') ?? settings()->appointment_duration)->class('form-control')->placeholder('Select') }}
                                    @error('appointment_duration')
                                    <small class="text-danger">{{ $errors->first('appointment_duration') }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="profile-title">
                                <h6>SMS Settings </h6>
                                <small>This is premium plan feature and will cost ₹0.50 for each sms extra.</small>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group m-t-15 m-checkbox-inline mb-0">
                                    <div class="checkbox checkbox-primary">
                                        <input id="inline-1" type="checkbox" name="next_visit_followup_sms" value="1" {{ (settings()->next_visit_followup_sms == 1) ? 'checked' : '' }}>
                                        <label for="inline-1">Next Visit Followup <i class="fa fa-info text-info" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Trigger sms in the morning to the patient who have scheduled next review date as today"></i></label>
                                    </div>
                                    <div class="checkbox checkbox-primary">
                                        <input id="inline-2" type="checkbox" name="appointment_scheduled_sms" value="1" {{ (settings()->appointment_scheduled_sms == 1) ? 'checked' : '' }}>
                                        <label for="inline-2">Appointment Scheduled <i class="fa fa-info text-info" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Trigger sms to the patient when schedule an appointment."></i></label>
                                    </div>
                                    <div class="checkbox checkbox-primary">
                                        <input id="inline-3" type="checkbox" name="appointment_updated_sms" value="1" {{ (settings()->appointment_updated_sms == 1) ? 'checked' : '' }}>
                                        <label for="inline-3">Appointment Updated <i class="fa fa-info text-info" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Trigger sms to the patient when update the scheduled appointment."></i></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary btn-submit" type="submit">Update</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection