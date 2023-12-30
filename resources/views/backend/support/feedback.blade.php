@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Feedback</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Feedback</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">Feedback</h4>
                        </div>
                        <div class="card-body">
                            {{ html()->form('POST', route('feedback.submit'))->class('')->open() }}
                            @csrf
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
                                <h6 class="form-label">Your Feedback</h6>
                                {{ html()->textarea('feedback', old('feedback'))->class('form-control')->placeholder('Your Feedback')->rows('10') }}
                                @error('feedback')
                                <small class="text-danger">{{ $errors->first('feedback') }}</small>
                                @enderror
                            </div>
                            <div class="form-group m-t-15 m-checkbox-inline mb-0">
                                <div class="checkbox checkbox-primary">
                                    <input id="inline-1" type="checkbox" name="recommend" value="1">
                                    <label for="inline-1">Willing to recommend Medical Prescription Pro to your colleagues or friends?</label>
                                </div>
                                <div class="checkbox checkbox-primary">
                                    <input id="inline-2" type="checkbox" name="publish" value="1">
                                    <label for="inline-2">No objection to publish this feedback to Medical Prescription Pro website</label>
                                </div>
                            </div>
                            <div class="form-footer mt-3">
                                <button class="btn btn-primary btn-block btn-submit">Submit</button>
                            </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection