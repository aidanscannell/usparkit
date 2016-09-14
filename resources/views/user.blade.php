@extends('layouts.master')

@section('title')
  Profile | uSparkit
@stop

@section('head')
  <!--Page JS -->
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script type="text/javascript" src="/src/js/user.js"></script>
		<script type="text/javascript" src="/src/js/main.js"></script>
		<script type="text/javascript" src="/src/js/postAdvert.js"></script>
		<link href="/src/css/user.css" rel='stylesheet' type='text/css'>
		<style type='text/css'>
		.inv {
	      display: none;
	  }
		</style>
@stop

@section('content')
    <!-- banner start -->
    <!-- ================ -->
      <!-- breadcrumb start -->
      <!-- ================ -->
      <div class="breadcrumb-container">
        <div class="container">
          <ol class="breadcrumb">
            <li><i class="fa fa-home pr-10"></i><a class="link-dark" href="/">Home</a></li>
            <li class="active">{{ $display->pageUsernameSpace }}</li>
          </ol>
        </div>
      </div>
      <!-- breadcrumb end -->

    <!-- main-container start -->
    <!-- ================ -->
    <section class="main-container">
      <div class="container">

        @include('includes.message-block')
        <div class="row">
          <div class="main col-md-12">

            <!-- page-title start -->
            <h1 class="page-title">{{ $display->pageUsernameSpace }}</h1>
            <div class="separator-2"></div>
            <!-- page-title end -->

            <!-- Modal Start-->
            <?php //echo $advertModals; //echo $requestModals; ?>
            @foreach($sponsorship_adverts as $sponsorship_advert)
              <div class="modal fade" id="{{ $sponsorship_advert->modalRef2 }}{{ $sponsorship_advert->advert_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            		<div class="modal-dialog">
            			<div class="modal-content">
            				<div class="modal-header">
            					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            					<h4 class="modal-title" id="myModalLabel">{{ $display->pageUsernameSpace }} {{ $sponsorship_advert->modalRef3 }} {{ $sponsorship_advert->amount_units }}{{ $sponsorship_advert->amount }}{{ $sponsorship_advert->amount_units_percent }} in
                      @if ($sponsorship_advert->sponsorshipType == 'custom_stash')
                        Custom Stash
                      @elseif ($sponsorship_advert->sponsorshipType == 'voucher')
                        Vouchers
                      @elseif ($sponsorship_advert->sponsorshipType == 'gift_card')
                        Gift Cards
                      @elseif ($sponsorship_advert->sponsorshipType == 'donation')
                        Donations
                      @endif
                    </h4>
            				</div>
            				<div class="modal-body">
            					<div class="row">
            						<div class="col-md-6">
            							<a href="/User/{{ $sponsorship_advert->user }}"><img  src="/userz/{{ $sponsorship_advert->username }}/{{ $sponsorship_advert->avatar }}" alt=""></a>
            							<div id="statusui">

                            <div class="comments-form">
                          		<h4 class="title">Send a Private Message</h4>
                          		<form id="form" name="form" method="post" class="form" role="form" action="[[~[[*id]]]]" enctype="multipart/form-data">
                          	     <div class="form-group has-feedback">
                          				<label for="subject1">Subject</label>
                          				<input class="form-control" rows="8" id="subject{{ $sponsorship_advert->advert_id }}" placeholder="" onkeyup="statusMax(this,50)" required>
                          				<i class="fa fa-navicon form-control-feedback"></i>
                          			</div>
                          			<div class="form-group has-feedback">
                          				<label for="message1">Message</label>
                          				<textarea class="form-control" rows="3" id="message{{ $sponsorship_advert->advert_id }}" placeholder="" onkeyup="statusMax(this,300)" required></textarea>
                          				<i class="fa fa-envelope-o form-control-feedback"></i>
                          			</div>
                          			<button id="btn{{ $sponsorship_advert->advert_id }}" type="button" class="btn btn-default" onclick="postPm('{{ $sponsorship_advert->username }}','{{ Auth::user()->username }}','subject{{ $sponsorship_advert->advert_id }}','message{{ $sponsorship_advert->advert_id }}','btn{{ $sponsorship_advert->advert_id }}')">Post</button>
                          		</form>
                          	</div>

            							</div>
            						</div>
            						<div class="col-md-6">
            							<p>{!! $sponsorship_advert->sponsorshipDetails !!}</p>
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

          </div>
        </div>

        <!-- main start -->
        <!-- ================ -->
        <div class="row">

          <!--START of LEFT COLUMN-->
          <div class="col-lg-3 col-md-6 col-sm-8 col-xs-12" style="padding-bottom:10px;">
            <div class="center-block p-20 light-gray-bg">
              <div class="owl-carousel content-slider-with-controls">
                <div class="overlay-container overlay-visible">
      						<img src="/userz/{{ $pageOwner->username }}/{{ $pageOwner->avatar }}"  alt="">
      						<div class=" hidden-xs">
      							<div class="text">
      								<p></p>
      							</div>
      						</div>
      						<a href="/userz/{{ $pageOwner->username }}/{{ $pageOwner->avatar }}" class="popup-img overlay-link" title=""><i class="icon-plus-1"></i></a>
      					</div>

                <!-- START of PHOTOS MODAL -->
                @foreach($photos as $photo)
                  <div class="overlay-container overlay-visible">
          						<img src="/userz/{{ $pageOwner->username }}/{{ $photo->filename }}"  alt="">
          						<div class=" hidden-xs">
          							<div class="text">
          								<p>{{ $photo->gallery }}</p>
          							</div>
          						</div>
          						<a href="/userz/{{ $pageOwner->username }}/{{ $photo->filename }}" class="popup-img overlay-link" title="{{ $photo->gallery }}"><i class="icon-plus-1"></i></a>
          					</div>
                @endforeach
              </div>

              @if ($pageOwner->username == Auth::user()->username)
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              		<div class="modal-dialog">
              			<div class="modal-content">
              				<div class="modal-header">
              					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              					<h4 class="modal-title" id="myModalLabel">Manage Photos</h4>
              				</div>
              				<div class="modal-body">
              					<div class="row">
              						<div class="col-md-6 col-sm-6 col-xs-8">
              							<form id="photo_form" enctype="multipart/form-data" method="post" action="/resizeImagePost">
              								<h3>Add Photo</h3>
              								<input class="form-control" name="description" length="4" placeholder="Description" required/><br />
              								<span class="btn btn-default btn-file">Choose File<input type="file" name="image" accept="image/*" required></span>
              								<p><input class="btn btn-default" type="submit" value="Upload Photo Now"></p>
                              {{ csrf_field() }}
              							</form>
              						</div>
              						<div class="col-md-6 col-sm-6 col-xs-8">
              							<div class="row">
              							  <h3>Edit Photos</h3>
                              <a onclick="toggleSelectDelete('modalListDelete','modalListSelect')">Delete Photos</a>
                              &nbsp&nbsp&nbsp&nbsp
                              <a onclick="toggleSelectDelete('modalListSelect','modalListDelete')">Select a profile picture</a>
                              <div id="modalListSelect" style="display:none;">
                                @foreach($photos as $photo)
                                  <div class="col-md-4 col-sm-4 col-xs-4">
            												<div class="overlay-container overlay-visible">
            													<img src="/userz/{{ $pageOwner->username }}/thumb_{{ $photo->filename }}"  alt="">
            													<a id="selectlink{{ $photo->id }}" onclick="selectPhoto('{{ $photo->id }}')" value="Select"/>Select</a>
            												</div>
            											</div>
                                @endforeach
                              </div>
                              <div id="modalListDelete" style="display:none;">
                                @foreach($photos as $photo)
                                  <div class="col-md-4 col-sm-4 col-xs-4">
            												<div class="overlay-container overlay-visible">
            													<img src="/userz/{{ $pageOwner->username }}/thumb_{{$photo->filename }}"  alt="">
            													<a id="deletelink" onclick="return false;"  onmousedown="deletePhoto('{{ $photo->id }}')" value="Delete"/>Delete</a>
            												</div>
            											</div>
                                @endforeach
                              </div>
              							</div>
              						</div>
              					</div>
              				</div>
              				<div class="modal-footer">
              					<button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Close</button>
              				</div>
              			</div>
              		</div>
              	</div>

                <div id="photo_form">
                  <a data-toggle="modal" data-target="#myModal">Edit Photos</a>
                </div>
              @endif

            </div>
            <!-- END of PHOTOS MODAL -->

            <br>

            <!-- START of FRIENDS BUTTON -->
            <span id="friendBtn">
              @foreach($oFriends as $oFriend)
                @if( ($oFriend->user1 == Auth::user()->username && $oFriend->accepted == 1) || ($oFriend->user2 == Auth::user()->username && $oFriend->accepted == 1) )
                  <?php $display->isFriend = true; ?>
                @endif
              @endforeach
              @if($display->isFriend == true && Auth::user()->username != $pageOwner->username)
                <button class="btn btn-default" onclick="friendToggle('unfriend','{{ $pageOwner->username }}','friendBtn')">Unconnect</button>
              @elseif($display->isFriend == false && $pageOwner->username != Auth::user()->username)
                <button class="btn btn-default" onclick="friendToggle('friend','{{ $pageOwner->username }},'friendBtn')">Request Connection</button>
              @endif
            </span>
            <!-- END of FRIENDS BUTTON -->

            <!-- START of FRIENDS HTML -->
            @if ($pageOwner->username == Auth::user()->username && $oFriends->count() > 0)
            <div class="center-block p-5 light-gray-bg">
              <div class="container" style="width:100%;">
                @if ($pageOwner->username == $user->username)
                	<h3>{{ $pageOwner->username }}'s <strong>Connections </strong> </h3><a href="/Connections">View all</a>
                @endif
                <div class="row grid-space-3">

                  @foreach ($friendsLogic as $logic)
                    @if ($pageOwner->username == $user->username)
                      <div class="col-md-6 col-sm-6">
                        <div class="image-box shadow bordered text-center mb-20">
                          <div class="overlay-container">
                            <img src="/userz/{{ $logic->username }}/thumb_{{ $logic->avatar }}" alt="">
                            <div class="overlay-top">
                              <div class="text" style="padding-left:0px;">
                                <h3><a href="/User/{{ $logic->username }}">{{ $logic->username }}</a></h3>
                              </div>
                            </div>
                            <div class="overlay-bottom">
                              <p class="small">
                                @if ($logic->userType == 'looking_to_get_sponsored')
                             			Seeking Sponsorship
                             		@elseif($logic->userType == 'looking_to_sponsor')
                             			Offering Sponsorship
                             		@endif
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                		@endif
                	@endforeach

                </div>
              </div>
            </div>
            @endif
            <!-- END of FRIENDS HTML -->



          </div>
          <!--END of LEFT COLUMN-->

          <!--START of MIDDLE COLUMN-->
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="padding-bottom:10px;">
            <div class="center-block p-30 light-gray-bg border-clear ">
              @if ($pageOwner->username == Auth::user()->username)
                <a class="btn-sm-link link-dark pull-right" value="Edit" onclick="makeEditable(wysiwyg,wysiwygData)"><i class="fa fa-reply"></i>Edit</a>
              @endif
              <div id="wysiwygData">
                @if ($pageOwner->username == Auth::user()->username)
                  @if($pageOwner->userType == 'looking_to_get_sponsored' && $pageOwner->About == '')
                    <h3>Add a description about your club/society here.</h3>
                  @elseif ($pageOwner->userType == 'looking_to_sponsor' && $pageOwner->About == '')
                    <h3>Add a description about your organisation here.</h3>
                  @else
                    {!! $pageOwner->About !!}
                  @endif
                @else
                  @if ($pageOwner->About == '')
                    <h3>{{ $display->pageUsernameSpace }}</h3>
                  @else
                    {!! $pageOwner->About !!}
                  @endif
                @endif

              </div>
              <form action="php_parsers/wysiwygParser.php" name="wysiwyg" id="wysiwyg" method="post" style="display:none">
                <div id="wysiwyg_cp" style="padding:8px; width:100%;">
                  <h3> Editor </h3>
                  <p>Use the editor to create your description. Check out some great examples <a href="">here</a>.</p>
                  <a onClick="iHeading()" value="H" id="H" class="wysiwygBtn" title="Heading">Heading</a>
                  <a onClick="iSubHeading()" value="SH" id="H" class="wysiwygBtn" title="Sub Heading">Sub Heading</a>
                  <a onClick="iBold()" value="B" id="B" class="wysiwygBtn" title="Bold">Bold</a>
                  <a onClick="iUnderline()" value="U" id="U" class="wysiwygBtn" title="Underline">Underline</a>
                  <a onClick="iItalic()" value="Italic" id="I" class="wysiwygBtn" title="Italic">Italic</a>
                  <a onClick="iHorizontalRule()" value="HR" id="HR" class="wysiwygBtn" title="Insert Horizontal Line">Horizontal Line</a>
                  <a onClick="iUnorderedList()" value="UL" id="numericalList" class="wysiwygBtn" title="Numerical List">Numerical List</a>
                  <a onClick="iOrderedList()" value="OL" id="bulletList" class="wysiwygBtn" title="Bullet List">Bullet List</a>
                  <a onClick="iLink()" value="Link" id="Link" class="wysiwygBtn" title="Insert Link">Link</a>
                </div>
                <iframe onload="iFrameOn();" name="richTextField" id="richTextField" src="/userz/{{ $user->username }}/wysiwyg_{{ $user->username }}.html" style="border:#000000 1px solid; width:100%; height:300px;"></iframe>
                <input name="wysiwygBtn" id="wysiwygBtn" class="btn btn-default" type="button" value="Submit Data" onClick="submit_form()"/>
                <span id="wysiwygStatus"></span>
              </form>
            </div>

            <br>

            <div class="center-block p-30 light-gray-bg border-clear ">
              @if ($pageOwner->username != Auth::user()->username)
                <a class="btn-sm-link link-dark pull-right" value="Edit" onclick="toggleElement('privateMessageForm')"><i class="fa fa-pencil"></i>Send Private Message</a>
              @endif
              <!-- START of PM or ADVERT FORM -->
              <div id="privateMessageForm" style="display:none;">
                  <div class="center-block p-30 light-gray-bg border-clear "><div class="comments-form">
                    <h2 class="title">Send a Private Message</h2>
                    <form id="form" name="form" method="post" class="form" role="form" action="[[~[[*id]]]]" enctype="multipart/form-data">
              		    <div class="form-group has-feedback">
                        <label for="subject1">Subject</label>
                        <input class="form-control" rows="8" id="subject1" placeholder="" onkeyup="statusMax(this,50)" required>
                        <i class="fa fa-navicon form-control-feedback"></i>
                      </div>
                      <div class="form-group has-feedback">
                        <label for="message1">Message</label>
                        <textarea class="form-control" rows="8" id="message1" placeholder="" onkeyup="statusMax(this,300)" required></textarea>
                        <i class="fa fa-envelope-o form-control-feedback"></i>
                      </div>
                      <button id="pmBtn" type="button" class="btn btn-default" onclick="postPm(\''.$pageOwner->username.'\',\''.$user->username.'\',\'subject1\',\'message1\')">Post</button>
                    </form>
                  </div>
                </div>
              </div>
              @include('includes.sponsorshipAdvertModal')
              <!-- breakkkk -->
              @include('includes.sponsorshipRequestModal')
              @if ($pageOwner->userType == 'looking_to_sponsor' && $pageOwner->username == Auth::user()->username)
            		<a data-toggle="modal" data-target="#advertFormModal" href="#myModalAdvert">Create Sponsorship Advert</a>
            	@elseif ($pageOwner->userType == 'looking_to_get_sponsored' && $pageOwner->username == Auth::user()->username)
            		<a data-toggle="modal" data-target="#requestFormModal" href="#myModalAdvert">Create Sponsorship Request</a>
            	@endif
              <!-- END of PM or ADVERT FORM -->
            </div>


          </div>
          <!--END of MIDDLE COLUMN-->


          <!-- START of RIGHT SIDEBAR -->
          <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12" style="padding-bottom:10px;">
            <div class="center-block p-20 light-gray-bg border-clear">
              <div class="sidebar">
                <div class="block clearfix">
                  <h4 class="title">{{ $display->pageUsernameSpace }}'s Sponsorship Adverts</h4>
                  <div class="separator-2"></div>

                  @foreach($sponsorship_adverts as $sponsorship_advert)
                    <div class="media margin-clear">
            					<div class="media-left">
            						<div class="overlay-container">
            							<img class="media-object" src="/userz/{{ $sponsorship_advert->user }}/{{ $sponsorship_advert->avatar }}" alt="">
            							<a class="overlay-link small" data-toggle="modal" data-target="{{ $sponsorship_advert->modalRef }}{{ $sponsorship_advert->advert_id }}"><i class="fa fa-link"></i></a>
            						</div>
            					</div>
            					<div class="media-body">
            						<h6 class="media-heading"><a>
                          @if ($sponsorship_advert->sponsorshipType == 'custom_stash')
                      			Custom Stash
                      		@elseif ($sponsorship_advert->sponsorshipType == 'voucher')
                      			Voucher
                      		@elseif ($sponsorship_advert->sponsorshipType == 'gift_card')
                      			Gift Card
                      		@elseif ($sponsorship_advert->sponsorshipType== 'donation')
                      			Donation
                      		@endif
                        </a></h6>
            						<p class="small margin-clear"><i class="fa fa-calendar pr-10"></i>{{ $sponsorship_advert->day }} {{ $sponsorship_advert->monthName }} {{ $sponsorship_advert->year }}</p>
            					</div>
            					<hr>
            				</div>
                  @endforeach

                  <div class="text-right space-top">
                    <a href="/Sponsorship-Adverts" class="link-dark"><i class="fa fa-plus-circle pl-5 pr-5"></i>More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- END of RIGHT SIDEBAR -->
        </div>
        <!-- END of PAGE ROW -->
      </div>
      <!-- END of PAGE CONTAINER -->
  </section>
  <!-- END of MAIN CONTAINER -->

  <script type="text/javascript">
    //Show extra form fields depending on selection FOR ADVERT MODAL
    document
        .getElementById('sponsorship_type')
        .addEventListener('change', function () {
            'use strict';
            var vis = document.querySelector('.vis'),
                sponsorship_type = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'inv';
            }
            if (sponsorship_type !== null ) {
                sponsorship_type.className = 'vis';
            }
    });
    //Show extra form fields depending on selection FOR REQUEST MODAL
    document
        .getElementById('sponsorship_typeR')
        .addEventListener('change', function () {
            'use strict';
            var vis = document.querySelector('.vis'),
                sponsorship_typeR = document.getElementById(this.value);
            if (vis !== null) {
                vis.className = 'inv';
            }
            if (sponsorship_typeR !== null ) {
                sponsorship_typeR.className = 'vis';
            }
    });
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
  <script src="/src/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script>
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
  <script src="/src/js/postAdvert.js" type="text/javascript"></script>
  <script src="/src/js/user.js" type="text/javascript"></script>

@endsection
