@extends("base")
@section("content")
<section class="wrapper bg-light pt-21">
    <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
                <div class="card">
                    <div class="card-body p-11 text-center">
                        <h2 class="mb-3 text-start">Sign Up to Medical Prescription Pro</h2>
                        <p class="lead mb-6 text-start">Sign Up takes less than a minute.</p>
                        <form class="text-start mb-3" method="post" action="">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                                <label>Doctor / Clinic / Hospital Name</label>
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                                <label>Username</label>
                                @error('username')
                                <small class="text-danger">{{ $errors->first('username') }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" placeholder="Mobile" name="mobile" maxlength="10" value="{{ old('mobile') }}">
                                <label>Mobile Number</label>
                                @error('mobile')
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                                @enderror
                            </div>
                            <div class="form-floating password-field mb-4">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                <label>Password</label>
                                @error('password')
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div>
                            <div class="form-floating password-field mb-4">
                                <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                <label>Confirm Password</label>
                                @error('password_confirmation')
                                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                                @enderror
                            </div>
                            <div class="form-floating mb-4">
                                <select class="form-control" name="plan">
                                    <option value="free" {{ old() == 'free' ? 'selected' : '' }}>30 Days Free Trial</option>
                                    <option value="basic" {{ old() == 'basic' ? 'selected' : '' }}>Basic - ₹1.00 / Consultation</option>
                                    <option value="premium" {{ old() == 'premium' ? 'selected' : '' }}>Premium - ₹3.00 / Consultation</option>
                                </select>
                                <label>Plan</label>
                                @error('plan')
                                <small class="text-danger">{{ $errors->first('plan') }}</small>
                                @enderror
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="terms">
                                <label class="form-check-label" for="flexCheckDefault">I agree to the <a href="{{ route('terms.of.use') }}">Terms of Use</a> and <a href="{{ route('privacy.policy') }}">Privacy Policy</a></label>
                                @error('terms')
                                <small class="text-danger">{{ $errors->first('terms') }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-submit rounded-pill btn-login w-100 mb-2">Sign Up</button>
                        </form>
                        <!-- /form -->
                        <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="hover">Sign in</a></p>
                        <!--/.social -->
                    </div>
                    <!--/.card-body -->
                </div>
                <!--/.card -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
@endsection