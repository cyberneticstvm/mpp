@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Referral</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Referral</li>
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
                            <h5>Your Referral Code: <span class="txt-primary">{{ Auth::user()->referral_code }}</span></h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="profile-title">
                                    <div class="media-body">
                                        <h3 class="mb-1 f-20 txt-primary">{{ Auth::user()->name }}</h3>
                                        <p class="f-12">If you are signed up via a referral, please update the referral code from the person who referred you. Then only, the person who referred you can avail the discount offerred by MPP.</p>
                                    </div>
                                </div>
                            </div>
                            {{ html()->form('POST', route('referral.submit'))->class('')->open() }}
                            @csrf
                            @if($ref)
                            <h5 class="mb-1 f-20 txt-primary">Referred by: {{ $ref->referral_code }}</hf>
                                @else
                                <div class="mb-3">
                                    <label class="form-label">Referral Code</label>
                                    {{ html()->text('referral_code', old('referral_code'))->class('form-control')->if(0, function($q){
                                    return $q->attribute('disabled', 'true');
                                })->placeholder('Referral Code') }}
                                    @error('referral_code')
                                    <small class="text-danger">{{ $errors->first('referral_code') }}</small>
                                    @enderror
                                </div>
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block btn-submit">Update</button>
                                </div>
                                {{ html()->form()->close() }}
                                @endif
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h4 class="card-title mb-0">Terms & Conditions</h4>
                        </div>
                        <div class="card-body">
                            <div class="card xl-none">
                                <div class="ecommerce-widget card-body">
                                    <div class="row">
                                        <ol>
                                            <li>For each referral, you will get 20% discount on current / referred month bill.</li>
                                            <li>The user referred by you should signup using one of our plans to avail the discount.</li>
                                            <li>If you referred 5 or more referrals in a month, you will be eligible for 100% discount on current / referred month bill.</li>
                                            <li>To avail the discount, the user referred by you must update your referral code on their Referral Dashboard.</li>
                                        </ol>
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