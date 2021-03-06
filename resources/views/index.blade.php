@extends('layouts.master')
@section('content')
<div class="page-hero-section bg-image hero-home-1" style="background-image: url(../assets/img/bg_hero_1.svg);">
  <div class="hero-caption pt-5">
    <div class="container h-100">
      <div class="row align-items-center h-100">
        <div class="col-lg-6 wow fadeInUp">
          <div class="badge mb-2"><span class="icon mr-1"><span class="mai-globe"></span></span> #2 Editor Choice App of 2020</div>
          <h1 class="mb-4">Manage your Finance easier</h1>
          <p class="mb-4">Mobster has features to view and manage <br>
          our finances, such as transfer, and statistics.</p>
          <a href="{{route('dashboard')}}" class="btn btn-primary rounded-pill">Start now!</a>
        </div>
        <div class="col-lg-6 d-none d-lg-block wow zoomIn">
          <div class="img-place mobile-preview shadow floating-animate">
            <img src="../assets/img/app_preview_1.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Clients -->
<div class="page-section mt-5">
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-lg-3 py-3 wow zoomIn">
        <div class="img-place client-img">
          <img src="../assets/img/clients/alter_sport.png" alt="">
        </div>
      </div>
      <div class="col-sm-6 col-lg-3 py-3 wow zoomIn">
        <div class="img-place client-img">
          <img src="../assets/img/clients/cleaning_service.png" alt="">
        </div>
      </div>
      <div class="col-sm-6 col-lg-3 py-3 wow zoomIn">
        <div class="img-place client-img">
          <img src="../assets/img/clients/creative_photo.png" alt="">
        </div>
      </div>
      <div class="col-sm-6 col-lg-3 py-3 wow zoomIn">
        <div class="img-place client-img">
          <img src="../assets/img/clients/global_tv.png" alt="">
        </div>
      </div>
    </div>
  </div>
</div> <!-- End clients -->

<div class="position-realive bg-image" style="background-image: url(../assets/img/pattern_1.svg);">

<div class="page-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-5 py-3">
        <div class="img-place mobile-preview shadow wow zoomIn">
          <img src="../assets/img/app_preview_2.png" alt="">
        </div>
      </div>
      <div class="col-lg-6 py-3 mt-lg-5">
        <div class="iconic-list">
          <div class="iconic-item wow fadeInUp">
            <div class="iconic-md iconic-text bg-warning fg-white rounded-circle">
              <span class="mai-cube"></span>
            </div>
            <div class="iconic-content">
              <h5>Powerful Features</h5>
              <p class="fs-small">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore</p>
            </div>
          </div>
          <div class="iconic-item wow fadeInUp">
            <div class="iconic-md iconic-text bg-info fg-white rounded-circle">
              <span class="mai-shield"></span>
            </div>
            <div class="iconic-content">
              <h5>Fully Secured</h5>
              <p class="fs-small">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore</p>
            </div>
          </div>
          <div class="iconic-item wow fadeInUp">
            <div class="iconic-md iconic-text bg-indigo fg-white rounded-circle">
              <span class="mai-desktop-outline"></span>
            </div>
            <div class="iconic-content">
              <h5>Easy Monitoring</h5>
              <p class="fs-small">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-1 py-3 mt-lg-5 wow fadeInUp">
        <h1 class="mb-4">Ecommerce business opperate easilly</h1>
        <p class="mb-4">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quos, molestiae, perspiciatis laboriosam quia placeat recusandae repudiandae corrupti similique delectus, aliquam commodi possimus eveniet optio magnam quis vel. Reiciendis, fuga excepturi.</p>
        <a href="#" class="btn btn-outline-primary rounded-pill">How it works</a>
      </div>
      <div class="col-lg-5 py-3">
        <div class="img-place mobile-preview shadow wow zoomIn">
          <img src="../assets/img/app_preview_3.png" alt="">
        </div>
      </div>
    </div>
  </div>
</div>

</div>


<div class="page-section bg-dark fg-white">
  <div class="container">
    <h1 class="text-center">Why Choose Mobster</h1>

    <div class="row justify-content-center mt-5">
      <div class="col-md-6 col-lg-3 py-3">
        <div class="card card-body border-0 bg-transparent text-center wow zoomIn">
          <div class="mb-3">
            <img src="../assets/img/icons/rocket.svg" alt="">
          </div>
          <p class="fs-large">Very Fast</p>
          <p class="fs-small fg-grey">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 py-3">
        <div class="card card-body border-0 bg-transparent text-center wow zoomIn" data-wow-delay="200ms">
          <div class="mb-3">
            <img src="../assets/img/icons/testimony.svg" alt="">
          </div>
          <p class="fs-large">Happy Client</p>
          <p class="fs-small fg-grey">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 py-3">
        <div class="card card-body border-0 bg-transparent text-center wow zoomIn" data-wow-delay="400ms">
          <div class="mb-3">
            <img src="../assets/img/icons/promotion.svg" alt="">
          </div>
          <p class="fs-large">Free Ads</p>
          <p class="fs-small fg-grey">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 py-3">
        <div class="card card-body border-0 bg-transparent text-center wow zoomIn" data-wow-delay="600ms">
          <div class="mb-3">
            <img src="../assets/img/icons/coins.svg" alt="">
          </div>
          <p class="fs-large">Save Money</p>
          <p class="fs-small fg-grey">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 py-3">
        <div class="card card-body border-0 bg-transparent text-center wow zoomIn" data-wow-delay="800ms">
          <div class="mb-3">
            <img src="../assets/img/icons/support.svg" alt="">
          </div>
          <p class="fs-large">24/7 Support</p>
          <p class="fs-small fg-grey">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 py-3">
        <div class="card card-body border-0 bg-transparent text-center wow zoomIn" data-wow-delay="1000ms">
          <div class="mb-3">
            <img src="../assets/img/icons/laptop.svg" alt="">
          </div>
          <p class="fs-large">Full Features</p>
          <p class="fs-small fg-grey">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-section bg-image" style="background-image: url(../assets/img/pattern_2.svg);">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-5 mb-5 mb-lg-0 wow fadeInUp">
        <h1 class="mb-4">Pricing Plan</h1>
        <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores inventore maxime ipsa eligendi quibusdam velit maiores adipisci odit, exercitationem cumque iusto at debitis reiciendis a, ipsum aliquam reprehenderit. Sed, delectus.</p>
        <a href="#" class="btn btn-gradient btn-split-icon rounded-pill">
          <span class="icon mai-call-outline"></span> Custom Plan
        </a>
      </div>
      <div class="col-lg-7">
        <div class="pricing-table">
          <div class="pricing-item active wow zoomIn">
            <div class="pricing-header">
              <h5>Business Plan</h5>
              <h1 class="fw-normal">$49.00</h1>
            </div>
            <div class="pricing-body">
              <ul class="theme-list">
                <li class="list-item">Push Notification</li>
                <li class="list-item">Unlimited Bandwith</li>
                <li class="list-item">Realtime Database</li>
                <li class="list-item">Monthly Backup</li>
                <li class="list-item">24/7 Support</li>
              </ul>
            </div>
            <button class="btn btn-dark">Choose Plan</button>
          </div>
          <div class="pricing-item wow zoomIn" data-wow-delay="200ms">
            <div class="pricing-header">
              <h5>Starter Plan</h5>
              <h1 class="fw-normal">$24.00</h1>
            </div>
            <div class="pricing-body">
              <ul class="theme-list">
                <li class="list-item">Push Notification</li>
                <li class="list-item">Unlimited Bandwith</li>
                <li class="list-item">Realtime Database</li>
                <li class="list-item">Monthly Backup</li>
                <li class="list-item">24/7 Support</li>
              </ul>
            </div>
            <button class="btn btn-dark">Choose Plan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page-section bg-image bg-image-overlay-dark" style="background-image: url(../assets/img/bg_testimonials.jpg);">
  <div class="container fg-white">
    <div class="row">
      <div class="col-md-8 col-lg-6 offset-lg-1 wow fadeInUp">
        <h2 class="mb-5 fg-white fw-normal">Customer Stories</h2>
        <p class="fs-large font-italic">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia voluptates facere explicabo! Rerum necessitatibus cum qui veritatis reprehenderit, neque sapiente consequatur atque eaque molestias, est, quod totam quo laudantium ratione.</p>
        <p class="fs-large fg-grey fw-medium mb-5">John Doe, UI Designer</p>

        <a href="#" class="btn btn-outline-light rounded-pill">Read Stories <span class="mai-chevron-forward"></span></a>
      </div>
    </div>
  </div>
</div>

<div class="page-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 py-3 mb-5 mb-lg-0">
        <div class="img-place w-lg-75 wow zoomIn">
          <img src="../assets/img/illustration_contact.svg" alt="">
        </div>
      </div>
      <div class="col-lg-5 py-3">
        <h1 class="wow fadeInUp">Need a help? <br>
        Don't worry just contact us</h1>

        <form method="POST" class="mt-5">
          <div class="form-group wow fadeInUp">
            <label for="name" class="fw-medium fg-grey">Fullname</label>
            <input type="text" class="form-control" id="name">
          </div>

          <div class="form-group wow fadeInUp">
            <label for="email" class="fw-medium fg-grey">Email</label>
            <input type="text" class="form-control" id="email">
          </div>

          <div class="form-group wow fadeInUp">
            <label for="message" class="fw-medium fg-grey">Message</label>
            <textarea rows="6" class="form-control" id="message"></textarea>
          </div>

          <div class="form-group mt-4 wow fadeInUp">
            <button type="submit" class="btn btn-primary">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection