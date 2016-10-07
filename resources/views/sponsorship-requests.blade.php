@extends('layouts.master')

@section('title')
    Sponsorship Requests | uSparkit
@stop

@section('head')
<style type="text/css">
.chosen-select {
  width:150px;
}
</style>
<script src="/src/js/ajax.js"></script>
@stop

@section('content')

    <!-- banner start -->
    <!-- ================ -->
    <div class="banner default-translucent-bg" style="background-image:url('/src/images/page-about-me-banner.jpg');background-position:50% 0;">
      <!-- breadcrumb start -->
      <!-- ================ -->
      <div class="breadcrumb-container">
        <div class="container">
          <ol class="breadcrumb">
            <li><i class="fa fa-home pr-10"></i><a class="link-dark" href="/">Home</a></li>
            <li class="active">Sponsorship Requests</li>
          </ol>
        </div>
      </div>
      <!-- breadcrumb end -->
      <div class="container">
        <div class="row">
          <div class="col-md-8 text-center col-md-offset-2 pv-20">
            <h1 class="title object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">Sponsroship Requests</h1>
            <div class="separator object-non-visible mt-10" data-animation-effect="fadeIn" data-effect-delay="100"></div>
            <p class="text-center object-non-visible" data-animation-effect="fadeIn" data-effect-delay="100">Search to find a club or society to sponsor.</p>
          </div>
        </div>
      </div>
    </div>
    <!-- banner end -->

    <!-- ADVERT SEARCH START -->
    <?php //include_once 'php_includes/advertSearch.php' ?>

    <div class="light-gray-bg section">
      <div class="container">
        @include('includes.message-block')
        <h3>Search Requests:</h3>
        <!-- filters start -->
        <div class="sorting-filters text-center mb-20">
          <form class="form-inline" action="/Sponsorship-Feed" method="post" enctype=”multipart/form-data”>
            <div class="row">
              <div class="col-lg-2 col-md-3 col-xs-12">
                <div class="form-group">
                  <label>Sponsorship Type</label>
                  <select data-placeholder="Select Type"  class="chosen-select" style="width=200px" multiple tabindex="6" id="type" name="sponsorshipType[]" required>
                    <option value="all">All</option>
                    <option value="custom_stash">Custom Stash/Clothing</option>
                    <option value="donation">Donation</option>
                    <option value="gift_card">Gift Card</option>
                    <option value="voucher">Voucher</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-2 col-md-3 col-xs-12">
                <div class="form-group">
                  <label>Group Type </label>
                    <select data-placeholder="Group Type"  class="chosen-select"  multiple tabindex="6" id="GroupType" name="GroupType[]">
                      <option value="AllTypes">All Types</option>
                      <optgroup label="Sports">
                        @include('includes.lists.sports-list')
                      </optgroup>
                      <optgroup label="Others">
                        @include('includes.lists.others-list')
                      </optgroup>
                    </select>
                </div>
              </div>

              <div class="col-lg-2 col-md-3 col-xs-12">
                <div class="form-group">
                  <label>University </label>
                    <select data-placeholder="University"  class="chosen-select"  multiple tabindex="6" id="universitySearch" name="universitySearch[]">
                      <option value="AllUniversities">All Universities</option>
                      <optgroup label="United Kingdom">
                        @include('includes.lists.university-list')
                      </optgroup>
                    </select>
                </div>
              </div>

              <div class="col-lg-2 col-md-3 col-xs-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-default" onclick="requestSearch()">Search <i class="icon-search"></i></button>
                  <span id="searchStatus"><?php //echo $search_output; ?></span>
                </div>
              </div>
            </div>
            {{ csrf_field() }}
          </form>
        </div>
        <!-- filters end -->
      </div>
    </div>

    <!-- ADVERT SEARCH END -->


    <!--<div id="status">0 | 0</div>-->
    <div id="wrapperRealSize">
      <div class="container">

        <!-- main start -->
        <!-- ================ -->
        <div class="main col-sm-9 col-xs-12">
          <!-- page-title start -->
          <!-- ================ -->
          <h1 class="page-title">Active Sponsorship Advertisements</h1>
          <div class="separator-2"></div>
          <!-- page-title end -->


          <!-- Modal -->
          @foreach($adverts as $advert)
            <div class="modal fade" id="requestModal{{ $advert->advert_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          		<div class="modal-dialog">
          			<div class="modal-content">
          				<div class="modal-header">
          					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    @if ($advert->amount_units == 'amount')
                        <h4 class="modal-title" id="myModalLabel">{{ $advert->pageUsernameSpace }} is Seeking Sponsorship up to £{{ $advert->amount }} in {{ $advert->modalSponsorshipType }}</h4>
                    @elseif($advert->amount_units == 'percent')
                        <h4 class="modal-title" id="myModalLabel">{{ $advert->pageUsernameSpace }} is Seeking Sponsorship up to {{ $advert->amount }}% in {{ $advert->modalSponsorshipType }}</h4>
                    @endif
          				</div>
          				<div class="modal-body">
          					<div class="row">
          						<div class="col-md-6">
          							<a href="/User/{{ $advert->user }}"><img  src="/userz/{{ $advert->user }}/{{ $advert->avatar }}" alt="{{ $advert->user }}"></a>
          							<div id="statusui">

                          <div class="comments-form">
                        		<h4 class="title">Send a Private Message</h4>
                        		<form id="form" name="form" method="post" class="form" role="form" action="[[~[[*id]]]]" enctype="multipart/form-data">
                      	      <div class="form-group has-feedback">
                        				<label for="subject1">Subject</label>
                        				<input class="form-control" rows="8" id="subject{{ $advert->advert_id }}" placeholder="" required>
                        				<i class="fa fa-navicon form-control-feedback"></i>
                        			</div>
                        			<div class="form-group has-feedback">
                        				<label for="message1">Message</label>
                        				<textarea class="form-control" rows="3" id="message{{ $advert->advert_id }}" placeholder=""  required></textarea>
                        				<i class="fa fa-envelope-o form-control-feedback"></i>
                        			</div>
                        			<button id="btn{{ $advert->advert_id }}" type="button" class="btn btn-default">Post</button>
                        		</form>
                        	</div>

          							</div>
          						</div>
          						<div class="col-md-6">
          							<p>{!! $advert->sponsorshipDetails !!}</p>
          						</div>
          					</div>
          				</div>
          				<div class="modal-footer">
          					<button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
          				</div>
          			</div>
          		</div>
          	</div>
          @endforeach

          <!-- masonry grid start -->
          <!-- ================ -->
          <div class="masonry-grid row">
            <div id="wrap">

              @foreach($adverts as $advert)
                <div class="masonry-grid-item col-sm-4">
        					<!-- blogpost start -->
        					<article class="blogpost shadow light-gray-bg bordered" data-effect-delay="100">
        						<div class="overlay-container" style="height:250px;width:100%;">
        							<img src="/userz/{{ $advert->user }}/{{ $advert->avatar }}" alt=""  align="middle">
        							<a class="overlay-link" data-toggle="modal" data-target="#requestModal{{ $advert->advert_id }}"><i class="fa fa-link"></i></a>
        						</div>
        						<header>
        							<h2>{{ $advert->sponsorshipType }}</h2>
                      @if ($advert->amount_units == 'amount')
        							    <h4>Of value up to £{{ $advert->amount }}</h4>
                      @elseif($advert->amount_units == 'percent')
                          <h4>Of value up to {{ $advert->amount }}%</h4>
                      @endif

        							<div class="post-info">
        								<span class="post-date">
        									<i class="icon-calendar"></i>
        									<span class="day">{{ $advert->day }}</span>
        									<span class="month">{{ $advert->monthName }}</span>
        									<span class="time">{{ $advert->time }}</span>
        								</span>
        								<span class="submitted"><i class="icon-user-1"></i> by <a href="/User/{{ $advert->user }}">{{ $advert->pageUsernameSpace }}</a></span>
        							</div>
        						</header>
        						<div class="blogpost-content" style="line-height: 1.5em;height: 3em;overflow: hidden;width: 80%;">
        							{{ $advert->eligibleGroups }}
        						</div>
        					</article>
        					<!-- blogpost end -->
        				</div>
              @endforeach

            </div>
          </div>

        </div>


      </div>
    </div>

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


@stop
