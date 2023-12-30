@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid general-widget">
        <div class="row">
            <div class="col-xl-6 xl-100 box-col-12">
                <div class="card">
                    <div class="cal-date-widget card-body">
                        <div class="row">
                            <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                                <div class="cal-info text-center">
                                    <div>
                                        <h2>{{ date('d') }}</h2>
                                        <div class="d-inline-block"><span class="b-r-dark pe-3">{{ date('M') }}</span><span class="ps-3">{{ date('Y') }}</span></div>
                                        <p class="f-16 text-success">"{{ $quote->quote ?? '' }}"</p>
                                        <div class="text-end">by, {{ $quote->author ?? '' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
                                <div class="cal-datepicker">
                                    <div class="datepicker-here float-sm-end" data-language="en"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-xl-3 xl-25 col-lg-6 box-col-6">
                <div class="card social-widget-card">
                    <div class="card-body">
                        <div class="redial-social-widget radial-bar-70" data-label="50%"><i class="fa fa-history font-primary"></i></div>
                        <h5 class="b-b-light">Appointments</h5>
                        <div class="row">
                            <div class="col text-center b-r-light"><span>Today</span>
                                <h4 class="counter mb-0">{{ appointments()->whereDate('created_at', \Carbon\Carbon::today())->count() }}</h4>
                            </div>
                            <div class="col text-center"><span>This Month</span>
                                <h4 class="counter mb-0">{{ appointments()->whereMonth('created_at', \Carbon\Carbon::today())->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 xl-25 col-lg-6 box-col-6">
                <div class="card social-widget-card">
                    <div class="card-body">
                        <div class="redial-social-widget radial-bar-70" data-label="50%"><i class="fa fa-check font-primary"></i></div>
                        <h5 class="b-b-light">Registrations</h5>
                        <div class="row">
                            <div class="col text-center b-r-light"><span>Today</span>
                                <h4 class="counter mb-0">{{ patients()->whereDate('created_at', \Carbon\Carbon::today())->count() }}</h4>
                            </div>
                            <div class="col text-center"><span>This Month</span>
                                <h4 class="counter mb-0">{{ patients()->whereMonth('created_at', \Carbon\Carbon::today())->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 xl-25 col-lg-6 box-col-6">
                <div class="card social-widget-card">
                    <div class="card-body">
                        <div class="redial-social-widget radial-bar-70" data-label="50%"><i class="fa fa-stethoscope font-primary"></i></div>
                        <h5 class="b-b-light">Consultations</h5>
                        <div class="row">
                            <div class="col text-center b-r-light"><span>Today</span>
                                <h4 class="counter mb-0">{{ consultations()->whereDate('created_at', \Carbon\Carbon::today())->count() }}</h4>
                            </div>
                            <div class="col text-center"><span>This Month</span>
                                <h4 class="counter mb-0">{{ consultations()->whereMonth('created_at', \Carbon\Carbon::today())->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3 xl-25 col-lg-6 box-col-6">
                <div class="card social-widget-card">
                    <div class="card-body">
                        <div class="redial-social-widget radial-bar-70" data-label="50%"><i class="fa fa-refresh font-primary"></i></div>
                        <h5 class="b-b-light">Reviews</h5>
                        <div class="row">
                            <div class="col text-center b-r-light"><span>Today</span>
                                <h4 class="counter mb-0">{{ consultations()->where('review', 1)->whereDate('created_at', \Carbon\Carbon::today())->count() }}</h4>
                            </div>
                            <div class="col text-center"><span>This Month</span>
                                <h4 class="counter mb-0">{{ consultations()->where('review', 1)->whereMonth('created_at', \Carbon\Carbon::today())->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!Session::has('profile'))
<div class="modal fade" id="profileSelector" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="profileSelector" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Select User Profile</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <div class="form-group">
                                <label>Select User Profile</label>
                                {{ html()->select($name = 'profile', $value = $profiles, NULL)->class('form-control form-control-lg')->placeholder('Select Profile')->required() }}
                                @error('profile')
                                <small class="text-danger">{{ $errors->first('profile') }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-submit" type="submit">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection