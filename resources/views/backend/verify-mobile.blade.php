<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Medical Prescription Pro.">
    <meta name="keywords" content="medical prescription, consultation, medical records, digital medical prescription, online medical prescription">
    <meta name="author" content="Cybernetics">
    <link rel="icon" href="{{ asset('/backend/assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/backend/assets/images/favicon.png') }}" type="image/x-icon">
    <title>Medical Prescription Pro - Verify Mobile Number</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/css/fontawesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/css/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/css/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/css/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/css/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/css/sweetalert2.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/css/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('/backend/assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/backend/assets/css/responsive.css') }}">
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="theme-loader">
            <div class="loader-p"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <section>
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="login-card">
                        <div class="login-main">
                            <form class="theme-form login-form" method="post" action="{{ route('verify.mobile.number') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ encrypt($user->id) }}" />
                                <h4 class="mb-3">Verify Mobile Number</h4>
                                <p>Medical Prescription Pro has been sent an OTP to your registered mobile number. Please verify your mobile number with that otp.</p><br />
                                <div class="form-group">
                                    <p class="text-center"><label>Enter OTP</label></p>
                                    <div class="row">
                                        <div class="col">
                                            <input class="form-control text-center opt-text" type="text" name="num1" placeholder="0" maxlength="1">
                                        </div>
                                        <div class="col">
                                            <input class="form-control text-center opt-text" type="text" name="num2" placeholder="0" maxlength="1">
                                        </div>
                                        <div class="col">
                                            <input class="form-control text-center opt-text" type="text" name="num3" placeholder="0" maxlength="1">
                                        </div>
                                        <div class="col">
                                            <input class="form-control text-center opt-text" type="text" name="num4" placeholder="0" maxlength="1">
                                        </div>
                                        <div class="col">
                                            <input class="form-control text-center opt-text" type="text" name="num5" placeholder="0" maxlength="1">
                                        </div>
                                        <div class="col">
                                            <input class="form-control text-center opt-text" type="text" name="num6" placeholder="0" maxlength="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block btn-submit" type="submit">Verify </button>
                                </div>
                            </form>
                            <div class="login-main mt-3">
                                <span class="reset-password-link">Didn't receive OTP?</span>
                                <a class="btn-link text-danger" href="{{ route('resend.verification.otp', encrypt($user->id)) }}"> Resend</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page-wrapper end-->
    <!-- latest jquery-->
    <script src="{{ asset('/backend/assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('/backend/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('/backend/assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/config.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('/backend/assets/js/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('/backend/assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('/backend/assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('/backend/assets/js/script.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script>
        $(function() {
            "use strict"
            $(document).on("keyup", ".opt-text", function() {
                $(this).parent().next().find("input").focus();
            })
        })
    </script>
</body>

</html>