@extends("base")
@section("content")
<section class="wrapper bg-light pt-21">
    <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-7 col-xl-6 col-xxl-5 mx-auto mt-n20">
                <div class="card">
                    <div class="card-body p-11 text-center">
                        <h2 class="mb-3 text-start">Login to Medical Prescription Pro</h2>
                        <form class="text-start mb-3">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" placeholder="Username" id="loginName">
                                <label for="loginName">Username</label>
                            </div>
                            <div class="form-floating password-field mb-4">
                                <input type="password" class="form-control" placeholder="Password" id="loginPassword">
                                <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                <label for="loginPassword">Password</label>
                            </div>
                            <a class="btn btn-primary rounded-pill btn-login w-100 mb-2">Login</a>
                        </form>
                        <!-- /form -->
                        <div class="divider-icon my-4">or</div>
                        <p class="mb-1"><a href="#" class="hover">Prefer OTP Login?</a></p>
                        <p class="mb-1"><a href="#" class="hover">Forgot Password?</a></p>
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