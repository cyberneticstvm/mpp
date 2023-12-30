@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Contact Us</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
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
                            <h4 class="card-title mb-0">Message Us</h4>
                        </div>
                        <div class="card-body">
                            {{ html()->form('POST', route('contact.submit'))->class('')->open() }}
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
                                <label class="form-label">Email Address</label>
                                {{ html()->email('email', old('email') ?? Auth::user()->email)->class('form-control')->placeholder('Email Address')->if(Auth::user()->email_verified_at != '', function($q){
                                        return $q->attribute('readonly', 'true');
                                    }) }}
                                @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <h6 class="form-label">Your Message</h6>
                                {{ html()->textarea('message', old('message'))->class('form-control')->placeholder('Your Message')->rows('10') }}
                                @error('message')
                                <small class="text-danger">{{ $errors->first('message') }}</small>
                                @enderror
                            </div>
                            <div class="form-footer">
                                <button class="btn btn-primary btn-block btn-submit">Submit</button>
                            </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">Email / WhatsApp</h4>
                        </div>
                        <div class="card-body">
                            <div class="card xl-none">
                                <div class="ecommerce-widget card-body">
                                    <div class="row">
                                        <div class="col-12"><span>Email</span>
                                            <h3 class="total-num"><a href="mailto:contact@medicalprescription.pro">contact@medicalprescription.pro</a></h3>
                                        </div>
                                        <div class="col-12 mt-3"><span>WhatsApp</span>
                                            <h3 class="total-num">+91 9188848860</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection