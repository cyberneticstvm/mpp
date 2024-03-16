<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-K6G5NL70DD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-K6G5NL70DD');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Medical Prescription Pro is an Online Medical Prescription generator for Doctors, Clinics and Hospitals">
    <meta name="keywords" content="Medical Prescription Pro, Digital Prescription, Online Prescription, Patient Management, Consultation">
    <meta name="author" content="Cybernetics">
    <title>Medical Prescription Pro - Online Patient Management and Prescription Maker</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('/frontend/assets/img/favicon1.png') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/colors/grape.css') }}">
    <link rel="preload" href="{{ asset('/frontend/assets/css/fonts/urbanist.css') }}" as="style" onload="this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('/frontend/assets/css/mpp.css') }}">
    <script id='pixel-script-poptin' src='https://cdn.popt.in/pixel.js?id=6832a9b595cb8' async='true'></script>

    <!-- Meta Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '947589910213593');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=947589910213593&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Meta Pixel Code -->
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
                                    <a class="nav-link scroll" href="#about">About MPP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scroll" href="#wcu">Why choose Us!</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scroll" href="#pricing">Pricing</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scroll" href="#solution">Our Solutions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link scroll" href="#contact">Contact</a>
                                </li>
                            </ul>
                            <!-- /.navbar-nav -->
                        </div>
                        <!-- /.offcanvas-body -->
                    </div>
                    <!-- /.navbar-collapse -->
                    <div class="navbar-other w-100 d-flex ms-auto">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item d-md-block">
                                <a href="{{ route('login') }}" class="btn btn-sm btn-primary rounded">Login</a>
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
    <footer class="bg-white" id="contact">
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
                                <h5 class="mb-1">WhatsApp</h5>
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
                                <h5 class="mb-1">Connect with us</h5>
                                <nav class="nav social social-muted mb-0 text-md-end">
                                    <a href="https://facebook.com/medicalprescriptionpro" target="_blank"><i class="uil uil-facebook-f"></i></a>
                                    <a href="https://www.instagram.com/medicalprescriptionpro" target="_blank"><i class="uil uil-instagram"></i></a>
                                </nav>
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
                    <a href="{{ route('privacy.policy') }}">Privacy Policy</a>
                    <a href="{{ route('terms.of.use') }}">Terms of Use</a>
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
    <script src="{{ asset('/backend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/theme.js') }}"></script>
    <script src="{{ asset('/frontend/assets/js/mpp.js') }}"></script>
    @include("backend.message")
</body>

</html>