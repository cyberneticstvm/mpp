@extends("base")
@section("content")
<section class="wrapper bg-light pt-21">
    <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
                <div class="card">
                    <div class="card-body p-11 text-center">
                        <h2 class="mb-3 text-start">Forgot Password?</h2>
                        <form class="text-start mb-3" method="post" action="{{ route('forgot.password') }}">
                            @csrf
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email ID" id="email">
                                <label for="email">Email ID</label>
                                @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary rounded-pill btn-submit btn-login w-100 mb-2">Request</button>
                        </form>
                        <!-- /form -->
                        <div class="divider-icon my-4">or</div>
                        <p class="mb-0">Already have an account? <a href="{{ route('login') }}" class="hover">Sign in</a></p>
                        <p class="mb-0">Don't have an account? <a href="{{ route('register') }}" class="hover">Sign up</a></p>
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