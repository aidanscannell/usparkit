@extends('layouts.master')

@section('title')
    Sponsor | uSparkit
@endsection

@section('content')

    <!-- breadcrumb start -->
    <!-- ================ -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li><i class="fa fa-home pr-10"></i><a class="link-dark" href="/">Home</a></li>
          <li class="active">Sponsor</li>
        </ol>
      </div>
    </div>
    <!-- breadcrumb end -->

    <div class="container light-gray-bg">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <br />
          <h1 style="text-align: center;">Why Sponsor University Clubs and Societies?</h1>
          <div class="separator-2"></div>
          <br />

        </div>
      </div>

    </div>

    <!-- banner start -->
    <!-- ================ -->
    <div class="dark-bg banner pv-40">
      <div class="container clearfix">

        <!-- slideshow start -->
        <!-- ================ -->
        <div class="slideshow">

          <!-- slider revolution start -->
          <!-- ================ -->
          <div class="slider-banner-container">
            <div class="slider-banner-boxedwidth">
              <ul class="slides">
                <!-- slide 1 start -->
                <!-- ================ -->
                <li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Premium HTML5 Template">

                <!-- main image -->
                <img src="src/images/ubscSponsorshipExample.jpg" alt="slidebg1" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover">

                <!-- Transparent Background -->
                <div class="tp-caption dark-translucent-bg"
                  data-x="center"
                  data-y="bottom"
                  data-speed="600"
                  data-start="0">
                </div>

                </li>
                <!-- slide 1 end -->

                <!-- slide 2 start -->
                <!-- ================ -->
                <li data-transition="random" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Clean and Simple Design">

                <!-- main image -->
                <img src="src/images/berSponsorshipExample.jpg" alt="slidebg2" data-bgposition="center top"  data-bgrepeat="no-repeat" data-bgfit="cover">

                <!-- Transparent Background -->
                <div class="tp-caption dark-translucent-bg"
                  data-x="center"
                  data-y="bottom"
                  data-speed="600"
                  data-start="0">
                </div>

                </li>
                <!-- slide 2 end -->
              </ul>
              <div class="tp-bannertimer"></div>
            </div>
          </div>
          <!-- slider revolution end -->

        </div>
        <!-- slideshow end -->

      </div>
    </div>
    <!-- banner end -->


  <!-- section start -->
  <!-- ================ -->
  <div class="light-gray-bg section">
    <div class="container">

      <h3 style="text-align: center;">There are 2.5 million students in the UK, contributing over £20 billion to the economy!</h3>

      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="progress style-1">
            <span class="text"></span>
            <div class="progress-bar progress-bar-default" data-animate-width="90%">
              <span class="label object-non-visible" data-animation-effect="fadeInLeftSmall" data-effect-delay="1000">Increased Brand Perception/Affinity</span>
            </div>
          </div>
          <div class="progress style-1">
            <span class="text"></span>
            <div class="progress-bar progress-bar-gray" data-animate-width="80%">
              <span class="label object-non-visible" data-animation-effect="fadeInLeftSmall" data-effect-delay="1000">Increased Consideration of Brand</span>
            </div>
          </div>
          <div class="progress style-1">
            <span class="text"></span>
            <div class="progress-bar progress-bar-dark" data-animate-width="87%">
              <span class="label object-non-visible" data-animation-effect="fadeInLeftSmall" data-effect-delay="1000">Students Will Recommend To Friends</span>
            </div>
          </div>
        </div>
      </div>

      <br />
      <h2 style="text-align: center;">Social Events, Competitions, Facebook Pages and Websites</h2>
      <h3 style="text-align: center;">They have an extremely powerful outreach!</h3>
      <br />

      <h3 style="text-align: center;">Search Through </h3>
      <br />
      <!-- filters start -->
      <div class="sorting-filters text-center mb-20">
        <form class="form-inline">
          <div class="form-group">
            <label>Type</label>
            <select class="form-control">
              <option selected="selected">All Types</option>
              <option>Custom Stash/Clothing</option>
              <option>Donation</option>
              <option>Gift Card</option>
              <option>Voucher</option>
            </select>
          </div>
          <div class="form-group">
            <label>Eligible Groups</label>
            <select class="form-control">
              <?php //include_once('php_includes/html/sportsList.html'); ?>
              <?php //echo $sportsList; ?>
            </select>
          </div>
          <div class="form-group">
            <label>Location</label>
            <select class="form-control">
              <?php //include_once('php_includes/html/sportsList.html'); ?>
              <?php //echo $sportsList; ?>
            </select>
          </div>

          <div class="form-group">
            <a href="#" class="btn btn-default">Submit</a>
          </div>
        </form>
      </div>
      <!-- filters end -->
    </div>
  </div>
  <!-- section end -->


  <!--<div id="status">0 | 0</div>-->
  <div id="wrapperRealSize">
    <div class="container">
      <div class="col-sm-3 col-xs-12">

      </div>


      <!-- main start -->
      <!-- ================ -->
      <div class="main col-sm-9 col-xs-12">
        <!-- page-title start -->
        <!-- ================ -->
        <h1 class="page-title">Active Sponsorship Advertisements</h1>
        <div class="separator-2"></div>
        <!-- page-title end -->


        <!-- Modal -->
            <?php //echo $advertModals; ?>

        <!-- masonry grid start -->
        <!-- ================ -->
        <div class="masonry-grid row">
          <div id="wrap">
            <?php //echo $pinItem; ?>
          </div>
        </div>

      </div>

    </div>
  </div>

@endsection
