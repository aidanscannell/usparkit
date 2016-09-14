@extends('layouts.master')

@section('title')
  Connections | uSparkit
@stop

@section('head')
  <style type="text/css">
  .chosen-select {
    width:180px;
  }
  .inv {
      display: none;
  }
  </style>
@stop

@section('content')
  <!-- banner start -->
  <div class="banner default-translucent-bg" style="background-image:url('images/page-about-me-banner.jpg');background-position:50% 0;">
    <!-- breadcrumb start -->
    <div class="breadcrumb-container">
      <div class="container">
        <ol class="breadcrumb">
          <li><i class="fa fa-home pr-10"></i><a class="link-dark" href="/">Home</a></li>
          <li class="active">Connections</li>
        </ol>
      </div>
    </div>
    <!-- breadcrumb end -->
    <div class="container">
      <div class="row">
        <div class="col-md-8 text-center col-md-offset-2 pv-20">
          <h1 class="title object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">Connections</h1>
          <div class="separator object-non-visible mt-10" data-animation-effect="fadeIn" data-effect-delay="100"></div>
          <p class="text-center object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">Search to discover new connections.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- banner end -->

  <!-- section start -->
  <!-- ================ -->
  <div class="light-gray-bg section">
    <div class="container">
      <h3>Search Users:</h3>
      <!-- filters start -->
      <div class="sorting-filters text-center mb-20">
        <form class="form-inline" action="<?php //echo $_SERVER['PHP_SELF']; ?>" method="post" enctype=”multipart/form-data”>
          <div class="row">

            <div class="col-lg-3 col-md-3 col-xs-12">
              <div class="form-group has-feedback">
                <label for="inputName" class="control-label">User Type:</label>
                <div class="">
                  <select id="userType" name="userType" class="form-control" onfocus="emptyElement('status')">
                    <option value=""></option>
                    <option value="looking_to_sponsor">Offering Sponsorship</option>
                    <option value="looking_to_get_sponsored">Seeking Sponsorship</option>
                  </select>
                  <i class="form-control-feedback"></i>
                </div>
              </div>
            </div>

            <div id="looking_to_get_sponsored" class="inv">
              <div class="col-lg-3 col-md-3 col-xs-12">
                <div class="form-group has-feedback">
                  <label for="inputLastName" class="control-label">University:</label>
                  <div class="">
                  <select id="university" name="university" class="form-control" onfocus="emptyElement('status')">
                    <option value="AllUniversities">All Universities</option>
                    @include('includes.lists.university-list')
                  </select>
                  <i class="form-control-feedback"></i>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-3 col-xs-12">
                <div class="form-group has-feedback">
                  <label for="clubType" class="control-label">Club/Society type:</label>
                  <div class="">
                  <select id="clubType" name="clubType" class="form-control" onfocus="emptyElement('status')">
                    <option value="AllTypes">All Types</option>
                    <optgroup label="Sports">
                      @include('includes.lists.sports-list')
                    </optgroup>
                    <optgroup label="Others">
                      @include('includes.lists.others-list')
                    </optgroup>
                    <option value="Other">Other</option>
                  </select>
                  <i class="form-control-feedback"></i>
                  </div>
                </div>
              </div>
            </div>

            <div id="looking_to_sponsor" class="inv">
              <div class="col-lg-3 col-md-3 col-xs-12">
                <div class="form-group has-feedback">
                  <label for="inputLastName" class="control-label">Organisation Type:</label>
                  <div class="">
                      <select id="organisationType" name="organisationType" class="form-control" onfocus="emptyElement('status')">
                        <option value="AllTypes">All Types</option>
                        @include('includes.lists.organisation-list')
                      </select>
                    <i class="form-control-feedback"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-3 col-xs-12">
              <div class="form-group">
                <button type="submit" class="btn btn-default" onclick="search()">Search <i class="icon-search"></i></button>
                <span id="searchStatus"><?php //echo $search_output; ?></span>
              </div>
            </div>

          </div>
        </form>
      </div>
      <!-- filters end -->
    </div>
  </div>
  <!-- section end -->


  <!-- section start -->
  <!-- ================ -->
  <?php //echo $searchUsers; ?>
  <!-- section end -->

  <!-- section start -->
  <!-- ================ -->
  <section class="section pv-40 clearfix">
    <div class="container light-gray-bg">
      <h3>Your <strong>Connections </strong></h3>
      <div class="row grid-space-3">
        <?php //echo $friendsHTMLnew; ?>
      </div>
    </div>
  </section>
  <!-- section end -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
  <script src="/src/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="/src/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

  <!-- Show extra form fields depending on selection -->
  <script>
    document
        .getElementById('userType')
        .addEventListener('change', function () {
            'use strict';
            var vis = document.querySelector('.vis'),
                userType = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'inv';
            }
            if (userType !== null ) {
                userType.className = 'vis';
            }
    });
  </script>
@stop
