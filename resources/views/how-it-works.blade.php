@extends('layouts.master')

@section('title')
    How It Works | uSparkit
@endsection

@section('content')

  <!-- breadcrumb start -->
  <div class="breadcrumb-container">
    <div class="container">
      <ol class="breadcrumb">
        <li><i class="fa fa-home pr-10"></i><a class="link-dark" href="/">Home</a></li>
        <li class="active">How It Works</li>
      </ol>
    </div>
  </div>
  <!-- breadcrumb end -->

  <!-- page-title start -->
  <!-- ================ -->
  <div class="default-translucent-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-8 text-center col-md-offset-2 pv-20">
            <h3 class="page-title text-center" style="color:#ECECEA;font-size:50px;padding:50px;">How <b>uSpark</b>It Works</h3>
            <h3 class="title object-non-visible" style="color:#ECECEA;" data-animation-effect="fadeIn" data-effect-delay="100">We Provide You With The Connetions</h3>
            <div class="separator object-non-visible mt-10" style="color:#ECECEA;" data-animation-effect="fadeIn" data-effect-delay="100"></div>
            <h4 class="text-center object-non-visible" style="color:#ECECEA;" data-animation-effect="fadeIn" data-effect-delay="100">uSparkit offers a unique opportunity for both companies and organisations seeking sponsorship. Read below to discover how it works.</h4>
            <div class="separator object-non-visible mt-10" style="color:#ECECEA;" data-animation-effect="fadeIn" data-effect-delay="100"></div>
            <h4 class="text-center object-non-visible" style="color:#ECECEA;" data-animation-effect="fadeIn" data-effect-delay="100"><a href="#buildProfile" class="btn btn-gray-transparent btn-sm btn-animated margin-clear">Build Your Profile</a> | <a href="#findSponsor" class="btn btn-gray-transparent btn-sm btn-animated margin-clear">Find a Match</a> | <a href="#connectSponsor" class="btn btn-gray-transparent btn-sm btn-animated margin-clear">Connect With Match</a> | <a href="#engageSponsor" class="btn btn-gray-transparent btn-sm btn-animated margin-clear">Engage With Match</a></h4>

          </div>
        </div>
      </div>
  </div>
  <!-- page-title end -->

  <!-- main-container start -->
  <!-- ================ -->
  <section class="main-container border-clear light-gray-bg padding-bottom-clear">
    <div class="separator"></div>

    <div style="width:100%; background-color:#74AFAD;" id="buildProfile">
      <div class="image-box style-4">
        <div class="row grid-space-0">
          <div class="col-md-6 col-md-push-6">
            <div class="overlay-container">
              <img src="src/images/buildProfile2.png" alt="" style="width:80%;margin-left: auto;margin-right: auto;padding:10px;">
              <div class="overlay-to-top">
                <p class="small margin-clear"><em>Some info <br> Lorem ipsum dolor sit</em></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-md-pull-6">
            <div class="body text-right">
              <div class="pv-30 visible-lg"></div>
              <h2 style="color:#ECECEA;">Build Your Profile</h2>
                <h3 class="margin-clear" style="color:#ECECEA;">How To Build a Good Profile</h3>
                <p style="color:#ECECEA;"> Upload good images for you profile. </p>
              <br>
              <a href="#" class="btn btn-default btn-sm btn-animated margin-clear">How to Build A Good Profile<i class="fa fa-arrow-right pl-10"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="width:100%; background-color:#413c38;" id="findSponsor">
      <div class="image-box space-top style-4">
        <div class="row grid-space-0">
          <div class="col-md-6">
            <div class="body text-left">
              <!--<div class="pv-30 visible-lg"></div>-->
              <h2 style="color:#ECECEA;">Find Companies to Sponsor You</h2>
                <p style="color:#ECECEA;">
                  <ul style="color:#ECECEA;">
                    <li><h3 class="margin-clear" style="color:#ECECEA;">Browse Sponsorship <span class="text-default">Adverts</span></h3></li>
                    <p style="padding-left:30px;">Search through active sponsorsip <span class="text-default">adverts</span> posted by companies using our easy search.</p>
                    <br>
                    <h3 style="color:#ECECEA; padding-left:100px;">or</h3>
                    <li><h3 class="margin-clear" style="color:#ECECEA;">Post a Sponsorship <span class="text-default">Request</span></h3></li>
                    <p style="padding-left:30px;">Create a <span class="text-default">request</span> detailing the type, value, eligible sponsors and some general details about what you are offering.</p>
                    <br>
                    <h3 style="color:#ECECEA; padding-left:100px;">or</h3>
                    <br>
                    <li><a class="btn btn-default btn-sm btn-animated margin-clear">Search Sponsors</a></li>
                  <ul>
                </p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="body">
              <!--<div class="pv-30 visible-lg"></div>-->
              <h2 style="color:#ECECEA;">Find Clubs/Societies To Sponsor</h2>
              <p class="margin-clear" style="color:#ECECEA;">
                <ul style="color:#ECECEA;">
                  <li><h3 class="margin-clear" style="color:#ECECEA;">Browse Sponsorship <span class="text-default">Requests</span></h3></li>
                  <p style="padding-left:30px;">Search through active sponsorsip <span class="text-default">requests</span> posted by companies using our easy search.</p>
                  <br>
                  <h3 style="color:#ECECEA; padding-left:100px;">or</h3>
                  <li><h3 class="margin-clear" style="color:#ECECEA;">Post a Sponsorship <span class="text-default">Advert</span></h3></li>
                  <p style="padding-left:30px;">Create an <span class="text-default">advert</span> detailing the type of sponsorship, the value of the sponsorship, the groups that are eligible and some general details about what sponsorship you are looking for.</p>
                  <br>
                  <h3 style="color:#ECECEA; padding-left:100px;">or</h3>
                  <br>
                  <li><a class="btn btn-default btn-sm btn-animated margin-clear">Search Seekers</a></li>
                <ul>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="width:100%; background-color:#74AFAD;" id="connectSponsor">
      <div class="image-box style-4">
        <div class="row grid-space-0">
          <div class="col-md-6 col-md-push-6">
            <div class="overlay-container">
              <img src="src/images/requestConnection.png" alt="" style="width:80%;margin-left: auto;margin-right: auto;padding:10px;">
              <div class="overlay-to-top">
                <p class="small margin-clear"><em>Some info <br> Lorem ipsum dolor sit</em></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-md-pull-6">
            <div class="body text-right">
              <div class="pv-30 visible-lg"></div>
              <h2 style="color:#ECECEA;">Form Connections</h2>
                <h3 class="margin-clear" style="color:#ECECEA;">Send and receive connection requests</h3>
                <p class="margin-clear" style="color:#ECECEA;">Check out your connections profiles.</p>
                <br>
              <a href="#" class="btn btn-default btn-sm btn-animated margin-clear">Connections<i class="fa fa-arrow-right pl-10"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="width:100%; background-color:#413c38;" id="engageSponsor">
      <div class="image-box space-top style-4">
        <div class="row grid-space-0">
          <div class="col-md-6">
            <div class="overlay-container">
              <img src="src/images/service-1.jpg" alt="">
              <div class="overlay-to-top">
                <p class="small margin-clear" style="color:#ECECEA;"><em>Some info <br> Lorem ipsum dolor sit</em></p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="body">
              <div class="pv-30 visible-lg"></div>
              <h2 style="color:#ECECEA;">Engage With Sponsors</h2>
              <p class="margin-clear" style="color:#ECECEA;">	</p>
              <br>
              <a href="#" class="btn btn-default btn-sm btn-animated margin-clear">Search Sponsorship Adverts<i class="fa fa-arrow-right pl-10"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
  <!-- main-container end -->

@endsection
