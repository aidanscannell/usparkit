@extends('layouts.master')

@section('title')
    Sign Up | uSparkit
@endsection

@section('head')
		<style type="text/css">
  		.inv {
  		    display: none;
  		}
  		.input, textarea{
  		    background-color:#666;
  		    color: #FFF;
  		}
		</style>
    <script src="src/js/signup.js"></script>
		<script>
		$(document).ready(function() {
		    $("#clubType").on("change", function() {
		        if ($(this).val() === "Other") {
		            $("#otherName").show();
		        }
		        else {
		            $("#otherName").hide();
		        }
		    });
		});
		</script>

@endsection

@section('content')
  <!-- breadcrumb start -->
  <div class="breadcrumb-container">
    <div class="container">
      <ol class="breadcrumb">
        <li><i class="fa fa-home pr-10"></i><a href="/">Home</a></li>
        <li class="active">Sign Up</li>
      </ol>
    </div>
  </div>
  <!-- breadcrumb end -->

  <!-- main-container start -->
  <div class="main-container dark-translucent-bg">
    <div class="container">
      <div class="row">
        <!-- main start -->
        <div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
          <div class="form-block center-block p-40 light-gray-bg border-clear">
            <h2 class="title">Sign Up</h2>
            <form name="signupform" id="signupform" method="POST" action="{{ '/Sign-Up' }}" class="form-horizontal" role="form">
              @include('includes.message-block')
              <div class="form-group has-feedback {{ $errors->has('userType') ? 'has-error' : ''}}">
                <label for="inputName" class="col-sm-4 control-label">User Type: <span class="text-danger small">*</span></label>
                <div class="col-sm-7">
                  <select id="userType" name="userType" class="form-control" onfocus="emptyElement('status')">
                    <option value=""></option>
                    <option value="looking_to_sponsor">Looking to Sponsor</option>
                    <option value="looking_to_get_sponsored">Looking to Get Sponsored</option>
                  </select>
                  <i class="form-control-feedback"></i>
                  <div class="alert alert-info" role="alert" id="userTypeInfo" style="display:none;">
                    If you are a company/organisation looking to offer sponsorship then select 'Looking to Sponsor'. If you are a University Club or Society seeking sponsorship then selecet 'Looking to Get Sponsored'.
                  </div>
                </div>
                <div class="col-lg-1">
                  <a href="#" class="fa fa-info  btn-alert" onclick="toggleElement('userTypeInfo')"></a>
                </div>
              </div>

              <div id="looking_to_sponsor" class="inv">
                <div class="form-group has-feedback {{ $errors->has('sponsor') ? 'has-error' : ''}}">
                  <label for="inputLastName" class="col-sm-4 control-label">Organisation Type: <span class="text-danger small">*</span></label>
                  <div class="col-sm-7">
                      <select id="sponsor" name="sponsor" class="form-control" onfocus="emptyElement('status')">
                        <option value=""></option>
                        @include('includes.lists.organisation-list')
                      </select>
                    <i class="form-control-feedback"></i>
                    <div class="alert alert-info" role="alert" id="sponsorInfo" style="display:none;">
                      Select the most apppropriate organisation type.
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <a href="#" class="fa fa-info  btn-alert" onclick="toggleElement('sponsorInfo')"></a>
                  </div>
                </div>
              </div>

              <div id="looking_to_get_sponsored" class="inv">
                <div class="form-group has-feedback {{ $errors->has('university') ? 'has-error' : ''}}">
                  <label for="inputLastName" class="col-sm-4 control-label">University: <span class="text-danger small">*</span></label>
                  <div class="col-sm-7">
                    <select id="university" name="university" class="form-control" onfocus="emptyElement('status')">
                      <option value=""></option>
                      <option value="NonUniversityOrganisation">Non-University Organisation</option>
                      @include('includes.lists.university-list')
                    </select>
                    <i class="form-control-feedback"></i>
                    <div class="alert alert-info" role="alert" id="universityInfo" style="display:none;">
                      Select your clubs/societies university.
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <a href="#" class="fa fa-info  btn-alert" onclick="toggleElement('universityInfo')"></a>
                  </div>
                </div>

                <div class="form-group has-feedback {{ $errors->has('groupType') ? 'has-error' : ''}}">
                  <label for="clubType" class="col-sm-4 control-label">Club/Society Type: <span class="text-danger small">*</span></label>
                  <div class="col-sm-7">
                    <select id="clubType" name="groupType" class="form-control" onfocus="emptyElement('status')">
                      <option value=""></option>
                      <optgroup label="Sports">
                        @include('includes.lists.sports-list')
                      </optgroup>
                      <optgroup label="Others">
                        @include('includes.lists.others-list')
                      </optgroup>
                      <option value="Other">Other</option>
                    </select>
                    <i class="form-control-feedback"></i>
                    <div class="alert alert-info" role="alert" id="clubTypeInfo" style="display:none;">
                      Select the most appropriate club/society type or select other and manually enter your type if it is not displayed in list.
                    </div>
                  </div>
                  <div class="col-lg-1">
                    <a href="#" class="fa fa-info  btn-alert" onclick="toggleElement('clubTypeInfo')"></a>
                  </div>
                </div>
                <div class="form-group has-feedback" id="otherName" style="display: none;">
                  <label for="clubTypeOther" class="col-sm-5 control-label">Other <span class="text-danger small">*</span></label>
                  <div class="col-sm-5">
                    <input id="clubTypeOther" name="clubTypeOther" type="text" class="form-control" name="otherclubType">
                  </div>
                </div>
              </div>

              <div class="form-group has-feedback {{ $errors->has('username') ? 'has-error' : ''}}">
                <label for="inputUserName" class="col-sm-4 control-label">User Name: <span class="text-danger small">*</span></label>
                <div class="col-sm-7">
                  <input id="username" name="username" class="form-control" type="text"  maxlength="50" value="{{ Request::old('username') }}" required>
                  <i class="fa fa-user form-control-feedback"></i>
                  <div class="alert alert-info" role="alert" id="usernameInfo" style="display:none;">
                    Enter a username between 3 and 50 characters.
                  </div>
                </div>
                <div class="col-lg-1">
                  <a href="#" class="fa fa-info  btn-alert" onclick="toggleElement('usernameInfo')"></a>
                </div>
              </div>

              <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : ''}}">
                <label for="inputEmail" class="col-sm-4 control-label">Email: <span class="text-danger small">*</span></label>
                <div class="col-sm-7">
                  <input id="email" name="email" class="form-control" type="text" onfocus="emptyElement('status')" onkeyup="restrict('email')" value="{{ Request::old('email') }}" required>
                  <i class="fa fa-envelope form-control-feedback"></i>
                  <div class="alert alert-info" role="alert" id="emailInfo" style="display:none;">
                    Enter a valid email that can be used for account activation and future logging in.
                  </div>
                </div>
                <div class="col-lg-1">
                  <a href="#" class="fa fa-info  btn-alert" onclick="toggleElement('emailInfo')"></a>
                </div>
              </div>

              <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : ''}}">
                <label for="inputPassword" class="col-sm-4 control-label">Password: <span class="text-danger small">*</span></label>
                <div class="col-sm-7">
                  <input id="password" name="password" class="form-control" type="password" onfocus="emptyElement('status')" maxlength="16" required>
                  <i class="fa fa-lock form-control-feedback"></i>
                  <div class="alert alert-info" role="alert" id="passwordInfo" style="display:none;">
                    Enter a password containing lowercase characters, uppercase characters, numeric characters and symbols between 10 and 100 characters long.
                  </div>
                </div>
                <div class="col-lg-1">
                  <a href="#" class="fa fa-info  btn-alert" onclick="toggleElement('passwordInfo')"></a>
                </div>
              </div>

              <div class="form-group has-feedback">
                <label for="inputPassword" class="col-sm-4 control-label">Re-Type Password: <span class="text-danger small">*</span></label>
                <div class="col-sm-7">
                  <input id="password_confirmation" name="password_confirmation" class="form-control" type="password" onfocus="emptyElement('status')" maxlength="16" required>
                  <i class="fa fa-lock form-control-feedback"></i>
                </div>
              </div>

              <div class="form-group has-feedback {{ $errors->has('country') ? 'has-error' : ''}}">
                <label for="inputCountry" class="col-sm-4 control-label">Country: <span class="text-danger small">*</span></label>
                <div class="col-sm-7">
                  <select id="country" name="country" class="form-control" onfocus="emptyElement('status')">
                    <option></option>
                    @include('includes.lists.country-list')
                  </select>
                  <i class="form-control-feedback"></i>
                  <div class="alert alert-info" role="alert" id="countryInfo" style="display:none;">
                    Select your universities country.
                  </div>
                </div>
                <div class="col-lg-1">
                  <a href="#" class="fa fa-info  btn-alert" onclick="toggleElement('countryInfo')"></a>
                </div>
              </div>

              <div class="form-group has-feedback {{ $errors->has('check') ? 'has-error' : ''}}">
                <div class="col-sm-offset-4 col-sm-7">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" id="check" name="check" value="yes" required> Accept our <a href="privacyPolicy.php">privacy policy</a> and <a href="customerAgreement.php">customer agreement</a>
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-8">
                  <button type="submit" id="signupbtn" name="signupbtn" class="btn btn-group btn-default btn-animated">Sign Up <i class="fa fa-check"></i></button>
                  <span id="status"></span>
                </div>
              </div>
              <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
          </div>
        </div>
        <!-- main end -->
      </div>
    </div>
  </div>
  <!-- main-container end -->


@endsection

@section('postFooter')
  <!-- Show extra form fields depending on selection -->
	<script type="text/javascript">
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
@endsection
