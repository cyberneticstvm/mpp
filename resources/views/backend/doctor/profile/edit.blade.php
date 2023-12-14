@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Update Profile</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Update Profile</li>
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
                        <h5>Update Profile</h5><span>Update Profile</span>
                    </div>
                    {{ html()->form('POST', route('user.profile.update', $profile->id))->class('theme-form')->open() }}
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label class="control-label req">Profile Name</label>
                                {{ html()->text('name', $profile->name ?? old('name'))->class('form-control')->placeholder('Profile Name')->required() }}
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label req">Designation / Qualification</label>
                                {{ html()->text('designation', $profile->designation ?? old('designation'))->class('form-control')->placeholder('Designation') }}
                                @error('designation')
                                <small class="text-danger">{{ $errors->first('designation') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3 form-group">
                                <label class="control-label">Registration Number</label>
                                {{ html()->text('registration_number', $profile->registration_number ?? old('registration_number'))->class('form-control')->placeholder('Registration Number') }}
                                @error('registration_number')
                                <small class="text-danger">{{ $errors->first('registration_number') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2 form-group">
                                <label class="control-label">Consultation Fee</label>
                                {{ html()->text('consultation_fee', $profile->consultation_fee ?? old('consultation_fee'))->class('form-control digits')->placeholder('0.00') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-danger" onclick="window.history.back();">Cancel</a>
                        <button class="btn btn-primary btn-submit">Update</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection