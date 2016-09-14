@extends('layouts.master')

@section('title')
    Get Sponsored | uSparkit
@endsection

@section('content')

  <!-- banner start -->
    <!-- ================ -->
    <div class="banner default-translucent-bg" style="background-image:url('images/page-about-me-banner.jpg');background-position:50% 0;">
      <!-- breadcrumb start -->
      <!-- ================ -->
      <div class="breadcrumb-container">
        <div class="container">
          <ol class="breadcrumb">
            <li><i class="fa fa-home pr-10"></i><a class="link-dark" href="/">Home</a></li>
            <li class="active">News Feed</li>
          </ol>
        </div>
      </div>
      <!-- breadcrumb end -->
      <div class="container">
        <div class="row">
          <div class="col-md-8 text-center col-md-offset-2 pv-20">
            <h1 class="title object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">Sponsorship Adverts</h1>
            <div class="separator object-non-visible mt-10" data-animation-effect="fadeIn" data-effect-delay="100"></div>
            <p class="text-center object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">Browse to see current sponsorship adverts .</p>
          </div>
        </div>
      </div>
    </div>
    <!-- banner end -->

    <!-- section start -->
    <!-- ================ -->
    <div class="light-gray-bg section">
      <div class="container">
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
          <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group has-feedback">
              <label for="inputUserName" class="col-sm-3 control-label">Search For:</label>
              <div class="col-sm-8">
                <input class="form-control" id="feedSearch" placeholder="" onfocus="emptyElement('status')" name="searchquery" type="text" size="20" maxlength="88" required>
                <i class="icon-search form-control-feedback"></i>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-8">
                <button type="submit" name="myBtn" class="btn btn-group btn-default btn-animated" id="loginbtn" onclick="login()">Search <i class="icon-search"></i></button>
                <p id="status"></p>
              </div>
            </div>
          </form>
          <?php //echo $search_output; ?>
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
