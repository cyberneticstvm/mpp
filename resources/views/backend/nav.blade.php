<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{ asset('/backend/assets/images/dashboard/1.png') }}" alt="">
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="{{ route('dashboard') }}">
            <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6>
        </a>
        <p class="mb-0 font-roboto">{{ profile()?->name ?? '' }}</p>
        <ul>
            <li><span><span class="counter">19.8</span>k</span>
                <p>Patients</p>
            </li>
            <li><span>Since</span>
                <p>{{ Auth::user()->created_at->format('M/Y') }}</p>
            </li>
            <li><span><span class="counter">95.2</span>k</span>
                <p>Consultations </p>
            </li>
        </ul>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>General </h6>
                        </div>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="home"></i><span>Dashboard</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('dashboard') }}">Default Dashboard</a></li>
                            <li><a href="{{ route('dragable.dashboard') }}">Dragable Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="users"></i><span>Patient</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('appointment.all') }}">All Appointments</a></li>
                            <li><a href="{{ route('appointment') }}">Today's Appointments</a></li>
                            <li><a href="{{ route('patient') }}">Patient List</a></li>
                            <li><a href="{{ route('consultation') }}">Consultation (Medical Record)</a></li>
                            <li><a href="{{ route('document') }}">Document Upload</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="user-plus"></i><span>Doctor</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('user.profile') }}">Profile</a></li>
                            <li><a href="{{ route('settings') }}">Settings</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Reports </h6>
                        </div>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-plus"></i><span>Reports</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="{{ route('report.appointment') }}">Appointment</a></li>
                            <li><a href="{{ route('report.patient') }}">Patient</a></li>
                            <li><a href="{{ route('report.consultation') }}">Consultation</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Billing & Support </h6>
                        </div>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="file-text"></i><span>Billing</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="gallery.html">Paid Invoices</a></li>
                            <li><a href="gallery.html">Pending Invoices</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="headphones"></i><span>Support</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="gallery.html">Contact</a></li>
                            <li><a href="gallery.html">Feedback</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="award"></i><span>Referral</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="gallery.html">Details</a></li>
                            <li><a href="gallery.html">Terms & conditions</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>