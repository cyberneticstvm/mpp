<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{ asset('/backend/assets/images/dashboard/1.png') }}" alt="">
        <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="{{ route('dashboard') }}">
            <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6>
        </a>
        <p class="mb-0 font-roboto">{{ Auth::user()->email }}</p>
        <ul>
            <li><span><span class="counter">19.8</span>k</span>
                <p>Follow</p>
            </li>
            <li><span>Since</span>
                <p>{{ Auth::user()->created_at->format('M/Y') }}</p>
            </li>
            <li><span><span class="counter">95.2</span>k</span>
                <p>Follower </p>
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
                            <li><a href="index.html">Default</a></li>
                            <li><a href="dashboard-02.html">Dragable Dashboard</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="home"></i><span>Patient</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="index.html">Appointment</a></li>
                            <li><a href="dashboard-02.html">Patient Registration</a></li>
                            <li><a href="dashboard-02.html">Consutation</a></li>
                            <li><a href="dashboard-02.html">Document Upload</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="home"></i><span>Doctor</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="index.html">Profile</a></li>
                            <li><a href="dashboard-02.html">Settings</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Reports </h6>
                        </div>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="box"></i><span>Patient</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="state-color.html">Appointment</a></li>
                            <li><a href="state-color.html">Consultation</a></li>
                            <li><a href="state-color.html">Review</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Billing & Support </h6>
                        </div>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="image"></i><span>Billing</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="gallery.html">Paid Invoices</a></li>
                            <li><a href="gallery.html">Pending Invoices</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="image"></i><span>Support</span></a>
                        <ul class="nav-submenu menu-content">
                            <li><a href="gallery.html">Contact</a></li>
                            <li><a href="gallery.html">Feedback</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>