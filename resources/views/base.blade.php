<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Medical Prescription Pro is an Online Medical Prescription generator for Doctors, Clinics and Hospitals">
    <meta name="keywords" content="Medical Prescription Pro, Digital Prescription, Online Prescription">
    <meta name="author" content="Cybernetics">
    <title>Medical Prescription Pro - Online Prescription Maker</title>
    <link rel="shortcut icon" href="{{ asset('/frontend/assets/img/favicon1.png') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/colors/grape.css') }}">
    <link rel="preload" href="{{ asset('/frontend/assets/css/fonts/urbanist.css') }}" as="style" onload="this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/mpp.css') }}">
</head>

<body>
    <div class="content-wrapper">
        <header class="wrapper bg-soft-primary">
            <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
                <div class="container flex-lg-row flex-nowrap align-items-center">
                    <div class="navbar-brand w-100">
                        <a href="/" class="logo">
                            <img src="{{ asset('/frontend/assets/img/logo-mpp-dark.png') }}" srcset="{{ asset('/frontend/assets/img/logo-mpp-dark.png') }}" alt="Medical Prescription Pro Logo" />
                        </a>
                    </div>
                    <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
                        <div class="offcanvas-header d-lg-none">
                            <h3 class="text-white fs-30 mb-0">Medical Prescription Pro</h3>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/" data-bs-toggle="dropdown">About MPP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/" data-bs-toggle="dropdown">How it works!</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/" data-bs-toggle="dropdown">Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/" data-bs-toggle="dropdown">Our Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/" data-bs-toggle="dropdown">Contact</a>
                                </li>
                            </ul>
                            <!-- /.navbar-nav -->
                        </div>
                        <!-- /.offcanvas-body -->
                    </div>
                    <!-- /.navbar-collapse -->
                    <div class="navbar-other w-100 d-flex ms-auto">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item d-none d-md-block">
                                <a href="/" class="btn btn-sm btn-primary rounded">Login</a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <button class="hamburger offcanvas-nav-btn"><span></span></button>
                            </li>
                        </ul>
                        <!-- /.navbar-nav -->
                    </div>
                    <!-- /.navbar-other -->
                </div>
                <!-- /.container -->
            </nav>
            <!-- /.navbar -->
        </header>
        <!-- /header -->
        @yield("content")
    </div>
    <!-- /.content-wrapper -->
    <footer class="bg-white">
        <div class="container pt-8 pt-md-10 pb-7">
            <div class="row gx-lg-0 gy-6">
                <div class="col-lg-4">
                    <div class="widget logo">
                        <img class="mb-4" src="{{ asset('/frontend/assets/img/logo-mpp-dark.png') }}" srcset="{{ asset('/frontend/assets/img/logo-mpp-dark.png') }}" alt="Medical Prescription Pro" />
                        <p class="lead mb-0">We are trusted by over 100+ doctors. Join them by using our services and grow your business.</p>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-lg-3 offset-lg-2">
                    <div class="widget">
                        <div class="d-flex flex-row">
                            <div>
                                <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                            </div>
                            <div>
                                <h5 class="mb-1">Phone (WhatsApp)</h5>
                                <p class="mb-0"><a href="tel:+919188848860">+91 9188848860</a></p>
                            </div>
                        </div>
                        <!--/div -->
                    </div>
                    <!-- /.widget -->
                    <!-- /.widget -->
                    <div class="widget">
                        <div class="d-flex flex-row">
                            <div>
                                <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-envelope"></i> </div>
                            </div>
                            <div class="align-self-start justify-content-start">
                                <h5 class="mb-1">Email</h5>
                                <email><a href="mailto:contact@medicalprescription.pro">contact@medicalprescription.pro</a></email>
                            </div>
                        </div>
                        <!--/div -->
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-lg-3">
                    <div class="widget">
                        <div class="d-flex flex-row">
                            <div>
                                <div class="icon text-primary fs-28 me-4 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
                            </div>
                            <div class="align-self-start justify-content-start">
                                <h5 class="mb-1">Address</h5>
                                <address>Head Office: Trivandrum, Kerala</address>
                            </div>
                        </div>
                        <!--/div -->
                    </div>
                </div>
                <!-- /column -->
            </div>
            <!--/.row -->
            <hr class="mt-13 mt-md-14 mb-7" />
            <div class="d-md-flex align-items-center justify-content-between">
                <p class="mb-2 mb-lg-0">© {{ date('Y') }} <a href="https://cybernetics.me" target="_blank">Cybernetics Technologies</a>. All rights reserved.</p>
                <nav class="nav social social-muted mb-0 text-md-end">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Use</a>
                </nav>
                <!-- /.social -->
            </div>
        </div>
        <!-- /.container -->
    </footer>
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <script src="{{ asset('/frontend/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/theme.js') }}"></script>
</body>

</html>