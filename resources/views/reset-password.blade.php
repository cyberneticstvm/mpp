@extends("base")
@section("content")
<section class="wrapper bg-light pt-21">
    <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
                <div class="card">
                    <div class="card-body p-11 text-center">
                        <h2 class="mb-3 text-start">Reset Password</h2>
                        <form class="text-start mb-3" method="post" action="{{ route('password.reset') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ encrypt($user->id) }}" />
                            <div class="form-floating password-field mb-4">
                                <input type="password" class="form-control" name="password" placeholder="******" id="loginPassword">
                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                <label for="loginPassword">Password</label>
                                @error('password')
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div>
                            <div class="form-floating password-field mb-4">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="******" id="password_confirmation">
                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                <label for="password_confirmation">Password</label>
                                @error('password_confirmation')
                                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill btn-submit btn-login w-100 mb-2">Reset Password</button>
                        </form>
                        <!-- /form -->
                        <div class="divider-icon my-4">or</div>
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