@extends("base")
@section("content")
<section class="wrapper bg-soft-primary">
  <div class="container pt-10 pt-lg-12 pt-xl-12 pt-xxl-10 pb-lg-10 pb-xl-10 pb-xxl-0">
    <div class="row gx-md-8 gx-xl-12 gy-10 align-items-center text-center text-lg-start">
      <div class="col-lg-6" data-cues="slideInDown" data-group="page-title" data-delay="900">
        <h1 class="display-1 mb-4 me-xl-5 mt-lg-n10">Grow Your Business with <br class="d-none d-md-block d-lg-none" /><span class="text-primary">Medical Prescription Pro.</span></h1>
        <p class="lead fs-24 lh-sm mb-7 pe-xxl-15">We help our doctors to generate super cool <br class="d-none d-md-block d-lg-none" /> <a href="/">Medical Prescription</a> online for their patients.</p>
        <div class="d-inline-flex me-2"><a href="#" class="btn btn-lg btn-grape rounded">Try it for Free</a></div>
        <div class="d-inline-flex"><a href="#" class="btn btn-lg btn-outline-grape rounded">Explore More</a></div>
      </div>
      <!--/column -->
      <div class="col-10 col-md-7 mx-auto col-lg-6 col-xl-5 ms-xl-5">
        <img class="img-fluid mb-n12 mb-md-n14 mb-lg-n19" src="{{ asset('/frontend/assets/img/illustrations/3d11.png') }}" srcset="{{ asset('/frontend/assets/img/illustrations/3d11@2x.png 2x') }}" data-cue="fadeIn" data-delay="300" alt="Medical Prescription Pro" />
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
        <h3 class="display-4 mb-9">The full service we are offering is specifically designed to meet your business needs.</h3>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
    <div class="row gx-md-8 gy-8 mb-15 mb-md-17 text-center">
      <div class="col-md-6 col-lg-3">
        <div class="px-md-3 px-lg-0 px-xl-3">
          <img src="{{ asset('/frontend/assets/img/icons/solid/globe-2.svg') }}" class="svg-inject icon-svg icon-svg-md solid-mono text-grape mb-5" alt="" />
          <h4>SEO Services</h4>
          <p class="mb-2">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida eget metus cras justo.</p>
          <a href="#" class="more hover">Learn More</a>
        </div>
      </div>
      <!--/column -->
      <div class="col-md-6 col-lg-3">
        <div class="px-md-3 px-lg-0 px-xl-3">
          <img src="{{ asset('/frontend/assets/img/icons/solid/code.svg') }}" class="svg-inject icon-svg icon-svg-md solid-mono text-grape mb-5" alt="" />
          <h4>Web Design</h4>
          <p class="mb-2">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida eget metus cras justo.</p>
          <a href="#" class="more hover">Learn More</a>
        </div>
      </div>
      <!--/column -->
      <div class="col-md-6 col-lg-3">
        <div class="px-md-3 px-lg-0 px-xl-3">
          <img src="{{ asset('/frontend/assets/img/icons/solid/team.svg') }}" class="svg-inject icon-svg icon-svg-md solid-mono text-grape mb-5" alt="" />
          <h4>Social Engagement</h4>
          <p class="mb-2">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida eget metus cras justo.</p>
          <a href="#" class="more hover">Learn More</a>
        </div>
      </div>
      <!--/column -->
      <div class="col-md-6 col-lg-3">
        <div class="px-md-3 px-lg-0 px-xl-3">
          <img src="{{ asset('/frontend/assets/img/icons/solid/devices.svg') }}" class="svg-inject icon-svg icon-svg-md solid-mono text-grape mb-5" alt="" />
          <h4>App Development</h4>
          <p class="mb-2">Nulla vitae elit libero, a pharetra augue. Donec id elit non mi porta gravida eget metus cras justo.</p>
          <a href="#" class="more hover">Learn More</a>
        </div>
      </div>
      <!--/column -->
    </div>
    <!--/.row -->
    <div class="row gx-3 gy-10 mb-14 mb-md-16 align-items-center">
      <div class="col-lg-6">
        <figure><img class="w-auto" src="{{ asset('/frontend/assets/img/illustrations/3d8.png') }}" srcset="{{ asset('/frontend/assets/img/illustrations/3d8@2x.png 2x') }}" alt="" /></figure>
      </div>
      <!--/column -->
      <div class="col-lg-5 ms-auto">
        <h2 class="fs-16 text-uppercase text-grape mb-3">Why Choose Us?</h2>
        <h3 class="display-4 mb-8">So here a few reasons why our valued customers choose us.</h3>
        <div class="row gy-6">
          <div class="col-md-6">
            <div class="d-flex flex-row">
              <div>
                <img src="{{ asset('/frontend/assets/img/icons/solid/lamp.svg') }}" class="svg-inject icon-svg icon-svg-xs solid-mono text-grape me-4" alt="" />
              </div>
              <div>
                <h4 class="mb-1">Creativity</h4>
                <p class="mb-0">Curabitur blandit lacus porttitor ridiculus mus.</p>
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
                <p class="mb-0">Curabitur blandit lacus porttitor ridiculus mus.</p>
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
                <p class="mb-0">Curabitur blandit lacus porttitor ridiculus mus.</p>
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
                <p class="mb-0">Curabitur blandit lacus porttitor ridiculus mus.</p>
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
    <div class="row gx-3 gy-10 gy-lg-0 mb-15 mb-md-17 align-items-center">
      <div class="col-lg-5 mx-auto order-lg-2">
        <figure><img class="w-auto" src="{{ asset('/frontend/assets/img/illustrations/3d5.png') }}" srcset="{{ asset('/frontend/assets/img/illustrations/3d5@2x.png 2x') }}" alt="" /></figure>
      </div>
      <!--/column -->
      <div class="col-lg-5 me-auto">
        <h2 class="fs-16 text-uppercase text-grape mb-3">Our Solutions</h2>
        <h3 class="display-4 mb-5 pe-xxl-5">Just sit & relax while we take care of your business needs.</h3>
        <p class="mb-6">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Praesent commodo cursus. Maecenas sed diam eget risus varius blandit sit amet non magna. Praesent commodo cursus magna.</p>
        <div class="row align-items-center counter-wrapper gy-6">
          <div class="col-md-6">
            <h3 class="counter counter-lg mb-1">99.7%</h3>
            <h6 class="fs-17 mb-1">Customer Satisfaction</h6>
            <span class="ratings five"></span>
          </div>
          <!--/column -->
          <div class="col-md-6">
            <h3 class="counter counter-lg mb-1">4x</h3>
            <h6 class="fs-17 mb-1">New Visitors</h6>
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
            <h2 class="fs-16 text-uppercase text-primary mb-3">Happy Customers</h2>
            <h3 class="display-4 mb-10 px-xxl-10">Don't take our word for it. See what customers are saying about us.</h3>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
        <div class="row gx-lg-8 gx-xl-12 align-items-center">
          <div class="col-lg-5 ms-auto col-xl-4 d-none d-lg-flex">
            <div class="img-mask mask-3"><img src="{{ asset('/frontend/assets/img/photos/about28.jpg') }}" srcset="{{ asset('/frontend/assets/img/photos/about28@2x.jpg 2x') }}" alt="" /></div>
          </div>
          <!--/column -->
          <div class="col-lg-6 col-xl-6 col-xxl-5 me-auto">
            <div class="swiper-container dots-start dots-closer mb-6" data-margin="30" data-dots="true">
              <div class="swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="border-0 fs-lg mb-0">
                      <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum ligula porta felis euismod semper. Cras justo odio consectetur nulla dapibus curabitur blandit faucibus.”</p>
                      <div class="blockquote-details">
                        <div class="info ps-0">
                          <h5 class="mb-1">Coriss Ambady</h5>
                          <p class="mb-0">Financial Analyst</p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!--/.swiper-slide -->
                  <div class="swiper-slide">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="border-0 fs-lg mb-0">
                      <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum ligula porta felis euismod semper. Cras justo odio consectetur nulla dapibus curabitur blandit faucibus.”</p>
                      <div class="blockquote-details">
                        <div class="info ps-0">
                          <h5 class="mb-1">Cory Zamora</h5>
                          <p class="mb-0">Marketing Specialist</p>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!--/.swiper-slide -->
                  <div class="swiper-slide">
                    <span class="ratings five mb-3"></span>
                    <blockquote class="border-0 fs-lg mb-0">
                      <p>“Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum ligula porta felis euismod semper. Cras justo odio consectetur nulla dapibus curabitur blandit faucibus.”</p>
                      <div class="blockquote-details">
                        <div class="info ps-0">
                          <h5 class="mb-1">Nikolas Brooten</h5>
                          <p class="mb-0">Sales Manager</p>
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
    <div class="row gy-6 mb-15 mb-md-17">
      <div class="col-lg-4">
        <h2 class="fs-16 text-uppercase text-primary mt-lg-18 mb-3">Our Pricing</h2>
        <h3 class="display-4 mb-3">We offer great and premium prices.</h3>
        <p>Enjoy a <a href="#" class="hover">free 30-day trial</a> and experience the full service. No credit card required!</p>
        <a href="#" class="btn btn-primary rounded mt-2">See All Prices</a>
      </div>
      <!--/column -->
      <div class="col-lg-7 offset-lg-1 pricing-wrapper">
        <div class="pricing-switcher-wrapper switcher justify-content-start justify-content-lg-end">
          <p class="mb-0 pe-3">Monthly</p>
          <div class="pricing-switchers">
            <div class="pricing-switcher pricing-switcher-active"></div>
            <div class="pricing-switcher"></div>
            <div class="switcher-button bg-primary"></div>
          </div>
          <p class="mb-0 ps-3">Yearly <span class="text-red">(Save 30%)</span></p>
        </div>
        <div class="row gy-6 mt-5">
          <div class="col-md-6">
            <div class="pricing card shadow-lg card-border-top border-soft-primary">
              <div class="card-body pb-12">
                <div class="prices text-dark text-center">
                  <div class="price price-show justify-content-start"><span class="price-currency">$</span><span class="price-value">19</span> <span class="price-duration">mo</span></div>
                  <div class="price price-hide price-hidden justify-content-start"><span class="price-currency">$</span><span class="price-value">199</span> <span class="price-duration">yr</span></div>
                </div>
                <!--/.prices -->
                <h4 class="card-title mt-2">Premium Plan</h4>
                <ul class="icon-list bullet-primary mt-7 mb-8">
                  <li><i class="uil uil-check fs-21"></i><span><strong>5</strong> Projects </span></li>
                  <li><i class="uil uil-check fs-21"></i><span><strong>100K</strong> API Access </span></li>
                  <li><i class="uil uil-check fs-21"></i><span><strong>200MB</strong> Storage </span></li>
                  <li><i class="uil uil-check fs-21"></i><span> Weekly <strong>Reports</strong></span></li>
                  <li><i class="uil uil-check fs-21"></i><span> 7/24 <strong>Support</strong></span></li>
                </ul>
                <a href="#" class="btn btn-primary rounded">Choose Plan</a>
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
                  <div class="price price-show justify-content-start"><span class="price-currency">$</span><span class="price-value">49</span> <span class="price-duration">mo</span></div>
                  <div class="price price-hide price-hidden justify-content-start"><span class="price-currency">$</span><span class="price-value">499</span> <span class="price-duration">yr</span></div>
                </div>
                <!--/.prices -->
                <h4 class="card-title mt-2">Corporate Plan</h4>
                <ul class="icon-list bullet-primary mt-7 mb-8">
                  <li><i class="uil uil-check fs-21"></i><span><strong>20</strong> Projects </span></li>
                  <li><i class="uil uil-check fs-21"></i><span><strong>300K</strong> API Access </span></li>
                  <li><i class="uil uil-check fs-21"></i><span><strong>500MB</strong> Storage </span></li>
                  <li><i class="uil uil-check fs-21"></i><span> Weekly <strong>Reports</strong></span></li>
                  <li><i class="uil uil-check fs-21"></i><span> 7/24 <strong>Support</strong></span></li>
                </ul>
                <a href="#" class="btn btn-primary rounded">Choose Plan</a>
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
        <figure><img class="w-auto" src="{{ asset('/frontend/assets/img/illustrations/3d3.png') }}" srcset="{{ asset('/frontend/assets/img/illustrations/3d3@2x.png 2x') }}" alt="" /></figure>
      </div>
      <!--/column -->
      <div class="col-lg-5 ms-auto">
        <h2 class="fs-16 text-uppercase text-primary mb-3">Let’s Talk</h2>
        <h3 class="display-4 mb-3">Let's make something great together. We are trusted by over 5000+ clients.</h3>
        <p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Maecenas faucibus mollis interdum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
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
        <h2 class="fs-16 text-uppercase text-primary mb-3">Analyze Now</h2>
        <h3 class="display-4 mb-0">Wonder how much faster your website can go? Easily check your SEO Score now.</h3>
      </div>
      <!-- /column -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-5 mx-auto">
        <form action="#">
          <div class="form-floating input-group">
            <input type="url" class="form-control border-0" placeholder="Enter Website URL" id="analyze">
            <label for="analyze">Enter Website URL</label>
            <button class="btn btn-primary" type="button">Analyze</button>
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