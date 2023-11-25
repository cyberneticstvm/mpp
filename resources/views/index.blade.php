@extends("base")
@section("content")
<section class="wrapper bg-soft-primary" id="about">
  <div class="container pt-10 pt-lg-12 pt-xl-12 pt-xxl-10 pb-lg-10 pb-xl-10 pb-xxl-0">
    <div class="row gx-md-8 gx-xl-12 gy-10 align-items-center text-center text-lg-start">
      <div class="col-lg-6" data-cues="slideInDown" data-group="page-title" data-delay="900">
        <h1 class="display-1 mb-4 me-xl-5 mt-lg-n10">Grow Your Consultation with <br class="d-none d-md-block d-lg-none" /><span class="text-primary">Medical Prescription Pro.</span></h1>
        <p class="lead fs-24 lh-sm mb-7 pe-xxl-15">We help our doctors to generate super cool <br class="d-none d-md-block d-lg-none" /> <a href="/">Medical Prescription</a> online for their patients.</p>
        <div class="d-inline-flex me-2"><a href="{{ route('register') }}" class="btn btn-lg btn-grape rounded">Try it for Free</a></div>
        <div class="d-inline-flex"><a href="#wcu" class="btn btn-lg btn-outline-grape rounded scroll">Explore More</a></div>
      </div>
      <!--/column -->
      <div class="col-10 col-md-7 mx-auto col-lg-6 col-xl-5 ms-xl-5">
        <img class="img-fluid mb-n12 mb-md-n14 mb-lg-n19" src="{{ asset('/frontend/assets/img/illustrations/doctor.webp') }}" srcset="{{ asset('/frontend/assets/img/illustrations/doctor.webp') }}" data-cue="fadeIn" data-delay="300" alt="Medical Prescription Pro" />
      </div>
      <!--/column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <figure><img src="{{ asset('/frontend/assets/img/photos/clouds.png') }}" alt="Medical Prescription Pro"></figure>
</section>
<!-- /section -->
<section class="wrapper bg-white">
  <div class="container pt-15 pb-15 pb-md-17">
    <div class="row text-center">
      <div class="col-md-10 offset-md-1 col-xxl-8 offset-xxl-2">
        <h2 class="fs-16 text-uppercase text-primary mb-3">What We Do?</h2>
        <h3 class="display-4 mb-9">The full service we are offering is specifically designed to meet your consultation needs.</h3>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
    <div class="row gx-md-8 gy-8 mb-15 mb-md-17 text-center">
      <div class="col-md-6 col-lg-3">
        <div class="px-md-3 px-lg-0 px-xl-3">
          <img src="{{ asset('/frontend/assets/img/icons/solid/devices.svg') }}" class="svg-inject icon-svg icon-svg-md solid-mono text-grape mb-5" alt="" />
          <h4>Doctor Registration</h4>
          <p class="mb-2">Register as a doctor and explore our full featured functionalities such as interactive dashboard, individual settings for doctors, provision for reminder to patients, <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" title="Multi Factor Authentication">MFA</a> etc..</p>
          <a href="javascript:void(0)" class="more hover">And More..</a>
        </div>
      </div>
      <!--/column -->
      <div class="col-md-6 col-lg-3">
        <div class="px-md-3 px-lg-0 px-xl-3">
          <img src="{{ asset('/frontend/assets/img/icons/solid/checked.svg') }}" class="svg-inject icon-svg icon-svg-md solid-mono text-grape mb-5" alt="" />
          <h4>Patient Registration</h4>
          <p class="mb-2">Doctor can register their patients for consultation and manage it such as provision for edit, provision for search old patients, provision for set review date and consultation fee..</p>
          <a href="javascript:void(0)" class="more hover">And More..</a>
        </div>
      </div>
      <!--/column -->
      <div class="col-md-6 col-lg-3">
        <div class="px-md-3 px-lg-0 px-xl-3">
          <img src="{{ asset('/frontend/assets/img/icons/solid/list.svg') }}" class="svg-inject icon-svg icon-svg-md solid-mono text-grape mb-5" alt="" />
          <h4>Medical Prescription</h4>
          <p class="mb-2">Doctor can prepare prescription inlcluding symptoms, diagnosis, lab advices, medicines etc.. And provision for recall old prescriptions and creating medicine database..</p>
          <a href="javascript:void(0)" class="more hover">And More..</a>
        </div>
      </div>
      <!--/column -->
      <div class="col-md-6 col-lg-3">
        <div class="px-md-3 px-lg-0 px-xl-3">
          <img src="{{ asset('/frontend/assets/img/icons/solid/cloud-download.svg') }}" class="svg-inject icon-svg icon-svg-md solid-mono text-grape mb-5" alt="" />
          <h4>Download Prescription</h4>
          <p class="mb-2">Doctor can download a super cool prescription in PDF format once the consultation has been completed. And there is a provision to share the prescription to the patients..</p>
          <a href="javascript:void(0)" class="more hover">And More..</a>
        </div>
      </div>
      <!--/column -->
    </div>
    <!--/.row -->
    <div class="row gx-3 gy-10 mb-14 mb-md-16 align-items-center" id="wcu">
      <div class="col-lg-6">
        <figure><img class="w-auto" src="{{ asset('/frontend/assets/img/illustrations/doc.png') }}" srcset="{{ asset('/frontend/assets/img/illustrations/doc.png') }}" alt="" /></figure>
      </div>
      <!--/column -->
      <div class="col-lg-5 ms-auto">
        <h2 class="fs-16 text-uppercase text-grape mb-3">Why Choose Us?</h2>
        <h3 class="display-4 mb-8">So here a few reasons why our valued doctors choose us.</h3>
        <div class="row gy-6">
          <div class="col-md-6">
            <div class="d-flex flex-row">
              <div>
                <img src="{{ asset('/frontend/assets/img/icons/solid/lamp.svg') }}" class="svg-inject icon-svg icon-svg-xs solid-mono text-grape me-4" alt="" />
              </div>
              <div>
                <h4 class="mb-1">Problem Solving</h4>
                <p class="mb-0">Clearly identify and understand the problem. Be specific about what needs to be addressed.</p>
              </div>
            </div>
          </div>
          <!--/column -->
          <div class="col-md-6">
            <div class="d-flex flex-row">
              <div>
                <img src="{{ asset('/frontend/assets/img/icons/solid/bulb.svg') }}" class="svg-inject icon-svg icon-svg-xs solid-mono text-grape me-4" alt="" />
              </div>
              <div>
                <h4 class="mb-1">Innovative Thinking</h4>
                <p class="mb-0">Stay curious and open-minded. Ask questions about how things work and why they are the way they are.</p>
              </div>
            </div>
          </div>
          <!--/column -->
          <div class="col-md-6">
            <div class="d-flex flex-row">
              <div>
                <img src="{{ asset('/frontend/assets/img/icons/solid/puzzle.svg') }}" class="svg-inject icon-svg icon-svg-xs solid-mono text-grape me-4" alt="" />
              </div>
              <div>
                <h4 class="mb-1">Rapid Solutions</h4>
                <p class="mb-0">Identify the most critical aspects of the problem that need immediate attention.</p>
              </div>
            </div>
          </div>
          <!--/column -->
          <div class="col-md-6">
            <div class="d-flex flex-row">
              <div>
                <img src="{{ asset('/frontend/assets/img/icons/solid/headphone.svg') }}" class="svg-inject icon-svg icon-svg-xs solid-mono text-grape me-4" alt="" />
              </div>
              <div>
                <h4 class="mb-1">Top-Notch Support</h4>
                <p class="mb-0">Prioritize the needs and concerns of the customer.</p>
              </div>
            </div>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!--/column -->
    </div>
    <!--/.row -->
    <div class="row gx-3 gy-10 gy-lg-0 mb-15 mb-md-17 align-items-center" id="solution">
      <div class="col-lg-5 mx-auto order-lg-2">
        <figure><img class="w-auto" src="{{ asset('/frontend/assets/img/illustrations/doc-sit.webp') }}" srcset="{{ asset('/frontend/assets/img/illustrations/doc-sit.webp') }}" alt="" /></figure>
      </div>
      <!--/column -->
      <div class="col-lg-5 me-auto">
        <h2 class="fs-16 text-uppercase text-grape mb-3">Our Solutions</h2>
        <h3 class="display-4 mb-5 pe-xxl-5">Just sit & relax while we take care of your consultation needs.</h3>
        <p class="mb-6">Aim for simple and straightforward solutions. Complexity can lead to delays and complications. Prioritize solutions that can be implemented quickly without unnecessary complications. Establish realistic timelines for implementing solutions. Be mindful of deadlines and prioritize actions accordingly.</p>
        <div class="row align-items-center counter-wrapper gy-6">
          <div class="col-md-6">
            <h3 class="counter counter-lg mb-1">99%</h3>
            <h6 class="fs-17 mb-1">Customer Satisfaction</h6>
            <span class="ratings five"></span>
          </div>
          <!--/column -->
          <div class="col-md-6">
            <h3 class="counter counter-lg mb-1">4x</h3>
            <h6 class="fs-17 mb-1">New Doctors</h6>
            <span class="ratings five"></span>
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!--/column -->
    </div>
    <!--/.row -->
    <div class="card bg-soft-primary rounded-4 mb-15 mb-md-17">
      <div class="card-body py-14 px-lg-0">
        <div class="row text-center">
          <div class="col-lg-8 offset-lg-2">
            <h2 class="fs-16 text-uppercase text-primary mb-3">Happy Doctors</h2>
            <h3 class="display-4 mb-10 px-xxl-10">Don't take our word for it. See what doctors are saying about us.</h3>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row gx-lg-8 gx-xl-12 align-items-center">
          <div class="col-lg-5 ms-auto col-xl-4 d-none d-lg-flex">
            <div class="img-mask mask-3"><img src="{{ asset('/frontend/assets/img/photos/doc-green.webp') }}" srcset="{{ asset('/frontend/assets/img/photos/doc-green.webp') }}" alt="" /></div>
          </div>
          <!--/column -->
          <div class="col-lg-6 col-xl-6 col-xxl-5 me-auto">
            <div class="swiper-container dots-start dots-closer mb-6" data-margin="30" data-dots="true">
              <div class="swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="border-0 fs-lg mb-0">
                      <p>“From the very first consultation, I have been impressed with the flow and professionalism. MPP able to demonstrate medical concepts in a clear and understandable manner. Which helps me to generate a super cool Medical Prescription.”</p>
                      <div class="blockquote-details">
                        <div class="info ps-0">
                          <h5 class="mb-1">Coriss Ambady</h5>
                          <p class="mb-0">Consultant, General Medicine</p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!--/.swiper-slide -->
                  <div class="swiper-slide">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="border-0 fs-lg mb-0">
                      <p>“Very useful app. MPP helps me to generate good looking medical prescription for my patients. And Im also able to track my patient details and manage my consultation. Thanks to MPP Team”</p>
                      <div class="blockquote-details">
                        <div class="info ps-0">
                          <h5 class="mb-1">Cory Zamora</h5>
                          <p class="mb-0">Consultant, Ophthalmology</p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!--/.swiper-slide -->
                  <div class="swiper-slide">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="border-0 fs-lg mb-0">
                      <p>“From the very first consultation, I have been impressed with the flow and professionalism. MPP able to demonstrate medical concepts in a clear and understandable manner. Which helps me to generate a super cool Medical Prescription.”</p>
                      <div class="blockquote-details">
                        <div class="info ps-0">
                          <h5 class="mb-1">Nikolas Brooten</h5>
                          <p class="mb-0">Consultant, Pediatrician</p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!--/.swiper-slide -->
                </div>
                <!--/.swiper-wrapper -->
              </div>
              <!-- /.swiper -->
            </div>
            <!-- /.swiper-container -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!--/.card-body -->
    </div>
    <!--/.card -->
    <div class="row gy-6 mb-15 mb-md-17" id="pricing">
      <div class="col-lg-4">
        <h2 class="fs-16 text-uppercase text-primary mt-lg-18 mb-3">Our Pricing</h2>
        <h3 class="display-4 mb-3">We offer great and affordable prices.</h3>
        <p>Enjoy a <a href="{{ route('register') }}" class="hover">free 30-day trial</a> and experience the full service. <strong>No credit card required!</strong>. After the trial period, you will be charged monthly. You can cancel your subscription anytime you wish.</p>
        <a href="{{ route('register') }}" class="btn btn-primary rounded mt-2">Try it for Free</a>
      </div>
      <!--/column -->
      <div class="col-lg-7 offset-lg-1 pricing-wrapper">
        <!--<div class="pricing-switcher-wrapper switcher justify-content-start justify-content-lg-end">
          <p class="mb-0 pe-3">Monthly</p>
          <div class="pricing-switchers">
            <div class="pricing-switcher pricing-switcher-active"></div>
            <div class="pricing-switcher"></div>
            <div class="switcher-button bg-primary"></div>
          </div>
          <p class="mb-0 ps-3">Yearly <span class="text-red">(Save upto 30%)</span></p>
        </div>-->
        <div class="row gy-6 mt-5">
          <div class="col-md-6">
            <div class="pricing card shadow-lg card-border-top border-soft-primary">
              <div class="card-body pb-12">
                <div class="prices text-dark text-center">
                  <div class="price price-show justify-content-start"><span class="price-currency">₹</span><span class="price-value">1.00</span> <span class="price-duration">Consultation</span></div>
                  <div class="price price-hide price-hidden justify-content-start"><span class="price-currency">₹</span><span class="price-value">9,999.00</span> <span class="price-duration">yr</span></div>
                </div>
                <!--/.prices -->
                <h4 class="card-title mt-2">Basic Plan</h4>
                <div class="priceitems">
                  <div class="item item-show">
                    <ul class="icon-list bullet-primary mt-7 mb-8">
                      <li><i class="uil uil-check fs-21"></i><span>First 1000 consultations, ₹1.00 / Consultation</span></li>
                      <li><i class="uil uil-check fs-21"></i><span>1001-5000 consultations, ₹0.75 / Consultation</span></li>
                      <li><i class="uil uil-check fs-21"></i><span>5001 and above consultations, ₹0.50 / Consultation</span></li>
                    </ul>
                  </div>
                  <div class="item item-hide item-hidden">
                    <span>All inclusive</span>
                  </div>
                </div>
                <div>
                  <ul class="icon-list bullet-primary mt-7 mb-8">
                    <li><i class="uil uil-check fs-21"></i><span>Patient Appointments</span></li>
                    <li><i class="uil uil-check fs-21"></i><span>Patient Registration</span></li>
                    <li><i class="uil uil-check fs-21"></i><span>Patient Consultation</span></li>
                    <li><i class="uil uil-check fs-21"></i><span>Medical Prescription</span></li>
                  </ul>
                </div>
                <a href="{{ route('register') }}" class="btn btn-primary rounded">Choose Plan</a>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.pricing -->
          </div>
          <!--/column -->
          <div class="col-md-6 popular">
            <div class="pricing card shadow-lg card-border-top border-soft-primary">
              <div class="card-body pb-12">
                <div class="prices text-dark text-center">
                  <div class="price price-show justify-content-start">
                    <span class="price-currency">₹</span>
                    <span class="price-value">3.00</span>
                    <span class="price-duration">Consultation</span>
                  </div>
                  <div class="price price-hide price-hidden justify-content-start">
                    <span class="price-currency">₹</span>
                    <span class="price-value">14,999.00</span>
                    <span class="price-duration">yr</span>
                  </div>
                </div>
                <!--/.prices -->
                <h4 class="card-title mt-2">Premium Plan</h4>
                <div class="priceitems">
                  <div class="item item-show">
                    <ul class="icon-list bullet-primary mt-7 mb-8">
                      <li><i class="uil uil-check fs-21"></i><span>First 1000 consultations, ₹3.00 / Consultation</span></li>
                      <li><i class="uil uil-check fs-21"></i><span>1001-5000 consultations, ₹2.50 / Consultation</span></li>
                      <li><i class="uil uil-check fs-21"></i><span>5001 and above consultations, ₹2.00 / Consultation</span></li>
                    </ul>
                  </div>
                  <div class="item item-hide item-hidden">
                    <span>All inclusive</span>
                  </div>
                </div>
                <ul class="icon-list bullet-primary mt-7 mb-8">
                  <li><i class="uil uil-check fs-21"></i><span>Everything in basic plan +</span></li>
                  <li><i class="uil uil-check fs-21"></i><span>Patient followup for next visit *</span></li>
                  <li><i class="uil uil-check fs-21"></i><span>Prescription Sharing</span></li>
                  <li><i class="uil uil-check fs-21"></i><span>Own Logo and Watermark</span></li>
                  <li><i class="uil uil-check fs-21"></i><span>Multiple Profiles</span></li>
                  <li><i class="uil uil-check fs-21"></i><span>Document Upload</span></li>
                </ul>
                <div class="text-small">* Email followup is always free. If opt SMS followup, ₹0.50 would be charged for each followup.</div>
                <br />
                <a href="{{ route('register') }}" class="btn btn-primary rounded">Choose Plan</a>
              </div>
              <!--/.card-body -->
            </div>
            <!--/.pricing -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!--/column -->
    </div>
    <!--/.row -->
    <div class="row gx-3 gy-10 gy-lg-0 align-items-center">
      <div class="col-lg-6">
        <figure><img class="w-auto" src="{{ asset('/frontend/assets/img/illustrations/doc-together.webp') }}" srcset="{{ asset('/frontend/assets/img/illustrations/doc-together.webp') }}" alt="" /></figure>
      </div>
      <!--/column -->
      <div class="col-lg-5 ms-auto">
        <h2 class="fs-16 text-uppercase text-primary mb-3">Let’s Talk</h2>
        <h3 class="display-4 mb-3">Let's make something great together. We are trusted by over 100+ Doctors.</h3>
        <p>In situations where time is of the essence, it's crucial to balance the need for speed with the requirement for effective and sustainable solutions. Whether in a professional setting or in daily life, the ability to generate speedy yet viable solutions is valuable.</p>
        <a href="#" class="btn btn-primary rounded mt-2">Join Us</a>
      </div>
      <!--/column -->
    </div>
    <!--/.row -->
  </div>
  <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper bg-soft-primary">
  <div class="container py-14 py-md-16">
    <div class="row mb-8">
      <div class="col-lg-8 mx-auto text-center">
        <h2 class="fs-16 text-uppercase text-primary mb-3">Request a Callback</h2>
        <h3 class="display-4 mb-0">Wonder how the things going on? Request a Callback now.</h3>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-5 mx-auto">
        <form action="#">
          <div class="form-floating input-group">
            <input type="text" maxlength="10" class="form-control border-0" placeholder="Enter Mobile Number" id="mobile">
            <label for="mobile">Enter Mobile Number</label>
            <button class="btn btn-primary" type="button">Request</button>
          </div>
        </form>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
  <figure><img src="{{ asset('/frontend/assets/img/photos/clouds.png') }}" alt=""></figure>
</section>
<!-- /section -->
@endsection