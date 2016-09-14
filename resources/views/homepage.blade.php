@extends('layouts.master')

@section('title')
    uSparkit
@endsection

@section('aboveHeader')

  <!-- banner start -->
  <div class="banner header-top clearfix">

    <!-- slideshow start -->
    <div class="slideshow">

      <!-- slider revolution start -->
      <!-- ================ -->
      <div class="slider-banner-container">
        <div class="slider-banner-fullwidth-big-height">
          <ul class="slides">

            <!-- slide 1 start -->
            <li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="uSparkit">

            <!-- main image -->
            <img src="src/images/uSparkitLogo.jpg" alt="slidebg2" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover">

            <!-- Transparent Background -->
            <div class="tp-caption dark-translucent-bg"
              data-x="center"
              data-y="bottom"
              data-speed="600"
              data-start="0">
            </div>

            <!-- LAYER NR. 1 -->
            <div class="tp-caption sfb fadeout large_white"
              data-x="left"
              data-y="180"
              data-speed="500"
              data-start="1000"
              data-easing="easeOutQuad">u<span class="text-default">Sparkit</span><br> Boost your sponsorship
            </div>

            <!-- LAYER NR. 2 -->
            <div class="tp-caption sfb fadeout large_white tp-resizeme hidden-xs"
              data-x="left"
              data-y="300"
              data-speed="500"
              data-start="1300"
              data-easing="easeOutQuad"><div class="separator-2 light"></div>
            </div>

            <!-- LAYER NR. 3 -->
            <div class="tp-caption sfb fadeout medium_white hidden-xs"
              data-x="left"
              data-y="320"
              data-speed="500"
              data-start="1300"
              data-easing="easeOutQuad"
              data-endspeed="600">A unique opportunity for both <strong>companies</strong> and <strong>university clubs/societies</strong>.
            </div>

            <!-- LAYER NR. 4 -->
            <div class="tp-caption sfb fadeout small_white"
              data-x="left"
              data-y="430"
              data-speed="500"
              data-start="1600"
              data-easing="easeOutQuad"
              data-endspeed="600">
              <a href="Get-Sponsored" class="btn btn-dark btn-default btn-animated">Get Sponsored <i class="fa fa-arrow-right"></i></a>
              <a href="Sponsor" class="btn btn-dark btn-default btn-animated">Sponsor <i class="fa fa-arrow-right"></i></a>
              <br />
              <a href="How-It-Works" class="text-default">How It Works <i class="fa fa-question-circle"></i></a>
            </div>

            </li>
            <!-- slide 1 end -->

          </ul>
          <div class="tp-bannertimer"></div>
        </div>
      </div>
      <!-- slider revolution end -->

    </div>
    <!-- slideshow end -->

  </div>
  <!-- banner end -->
@endsection

@section('content')

  </div>
  <!-- header-container end -->


  <!--<section class="main-container border-clear padding-bottom-clear">-->

    <!--<div class="container">-->

      <!--<div class="light-gray-bg p-20 border-clear " style="margin-bottom:10px;">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <h1 style="text-align: center;">Sponsorship for your club/society</h1>
              <h3 style="text-align: center;">Connect with brands and local businesses near you, for free. What does your club/society need?</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <div class="ph-20 feature-box text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
                <span class="icon large  circle"><img src="src/images/Stash_Icon.png"></span>
                <h3>Custom Stash/Clothing</h3>
                <div class="separator clearfix"></div>
                <p class="text-muted"></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="ph-20 feature-box text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="200">
                <span class="icon large circle"><img src="src/images/Donate_Icon.png"></i></span>
                <h3>Donations</h3>
                <div class="separator clearfix"></div>
                <p class="text-muted"></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="ph-20 feature-box text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                <span class="icon large circle"><img src="src/images/Discount_Icon.png"></span>
                <h3>Gift Cards</h3>
                <div class="separator clearfix"></div>
                <p class="text-muted"></p>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="ph-20 feature-box text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                <span class="icon large circle"><img src="src/images/Discount_Icon.png"></span>
                <h3>Vouchers</h3>
                <div class="separator clearfix"></div>
                <p class="text-muted"></p>
              </div>
            </div>
          </div>
        </div>
      </div>-->
      <div class="light-gray-bg p-20 border-clear " style="margin-bottom:10px;">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <h1 style="text-align: center;">Sponsorship for your club/society</h1>
              <h3 style="text-align: center;">Connect with brands and local businesses near you, for free. What does your club/society need?</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-sm-6">
              <div class="ph-20 feature-box text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
                <span class="icon large  circle"><img src="src/images/Stash_Icon.png"></span>
                <h3>Custom Stash/Clothing</h3>
                <div class="separator clearfix"></div>
                <p class="text-muted"></p>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="ph-20 feature-box text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="200">
                <span class="icon large circle"><img src="src/images/Donate_Icon.png"></i></span>
                <h3>Donations</h3>
                <div class="separator clearfix"></div>
                <p class="text-muted"></p>
              </div>
            </div>
            <div class="col-md-4 col-sm-6">
              <div class="ph-20 feature-box text-center object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                <span class="icon large circle"><img src="src/images/Discount_Icon.png"></span>
                <h3>Discount & Deals</h3>
                <div class="separator clearfix"></div>
                <p class="text-muted"></p>
              </div>
            </div>
          </div>
        </div>
      </div>


      <section class="robject-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">
        <div class="container">
          <div class="isotope-container-fitrows row grid-space-10">
            <div class="col-sm-6 col-md-3 isotope-item web-design">
              <div class="image-box style-2 mb-20 mt-20  text-center ">
                <div class="item active">
                  <div class="overlay-container">
                    <img src="src/images/Profile_Icon.png" style="height:170px; margin-left: auto;margin-right: auto" alt="">
                  </div>
                </div>
                <div class="body shadow light-gray-bg p-20">
                  <h3>1. Build Your Profile</h3>
                  <div class="separator"></div>
                  <p>Sign up and build the best profile that you can.</p>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-3 isotope-item web-design">
              <div class="image-box style-2 mb-20 mt-20 text-center">
                <div class="item active">
                  <div class="overlay-container">
                    <img src="src/images/Connected_Icon.png" style="height:170px; margin-left: auto;margin-right: auto" alt="">
                  </div>
                </div>
                <div class="body shadow light-gray-bg ">
                  <h3>2. Find Your Perfect Match</h3>
                  <div class="separator"></div>
                  <p>Browse active sponsorship adverts/requests or post your own to find the perfect match.</p>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-3 isotope-item web-design">
              <div class="image-box style-2 mb-20 mt-20 text-center">
                <div class="item active">
                  <div class="overlay-container">
                    <img src="src/images/Connected_Icon.png" style="height:170px; margin-left: auto;margin-right: auto" alt="">
                  </div>
                </div>
                <div class="body shadow light-gray-bg ">
                  <h3>3. Connect and Engage</h3>
                  <div class="separator"></div>
                  <p>Connect with your perfect match and send them a message to start the sponsorship negotiations.</p>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-3 isotope-item web-design">
              <div class="image-box style-2 mb-20 mt-20 text-center">
                <div class="item active">
                  <div class="overlay-container">
                    <img src="src/images/Deal_Icon.png" style="height:170px; margin-left: auto;margin-right: auto" alt="">
                  </div>
                </div>
                <div class="body shadow light-gray-bg ">
                  <h3>4. Benefit From Your Sponsorship</h3>
                  <div class="separator"></div>
                  <p>Once you have completed the sponsorship agreementyou can both reap the rewards.</p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>


      <section class="object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">
        <div class="full-width-section dark-bg">

          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="dark-bg p-20 text-right">
                <h3>The<strong> Benefits</strong> of Sponsorship</h3>
                <ul class="list-icons" id="listYo">
                  <li>Raise brand awareness and create preference<i class="icon-check-1"></i></li>
                  <li>Create positive PR and raise awareness of the organisation as a whole <i class="icon-check-1"></i></li>
                  <li>Provide attractive content for a range of products and services <i class="icon-check-1"></i></li>
                  <li>Build brand positioning through associative imagery <i class="icon-check-1"></i></li>
                  <li>Support a sales promotion campaign <i class="icon-check-1"></i></li>
                  <li>Create internal emotional commitment to the brand <i class="icon-check-1"></i></li>
                  <li>Act as corporate hospitality that promotes good relations with clients <i class="icon-check-1"></i></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="full-text-container  border-bottom-clear">
                <h2>Why <strong>Choose Us</strong></h2>
                <div class="separator-2 visible-lg"></div>
                <p>Sponsorship. It’s the often overlooked, key component to a powerful marketing strategy. </p>
                <div class="separator-3 visible-lg"></div>
                <a href="Sponsor" class="btn btn-default btn-animated">Sponsor <i class="pl-5 fa fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- section end -->


      <div class="separator"></div>
        <div class="testimonial text-center">
          <div class="testimonial-image">
            <img src="src/images/aidanOscar.jpg" alt="Jane Doe" title="Jane Doe" class="img-circle">
          </div>
          <h3>Our Promise</h3>
          <div class="separator"></div>
          <div class="testimonial-body">
            <blockquote>
              <p>uSparkit was set up by Aidan Scannell and Oscar Radevsky to make sponsorship easier for both sponsors and university clubs/societies. We hope to increase the sponsorship recieved by university groups so that they can reach their potential.</p>
            </blockquote>
            <div class="testimonial-info-1">- Aidan Scannell & Oscar Radevsky</div>
            <div class="testimonial-info-2">By uSparkit</div>
          </div>
        </div>

      <!--</div>-->

    <!--</section>-->

@endsection
