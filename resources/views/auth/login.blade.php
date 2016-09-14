@extends('layouts.master')

@section('title')
    Log In | uSparkit
@endsection

@section('head')

@endsection

@section('content')

  <!-- breadcrumb start -->
  <div class="breadcrumb-container">
    <div class="container">
      <ol class="breadcrumb">
        <li><i class="fa fa-home pr-10"></i><a href="index.php">Home</a></li>
        <li class="active">Login</li>
      </ol>
    </div>
  </div>
  <!-- breadcrumb end -->

  <!-- Display login unsuccessful message -->
  <?php //echo $passwordIncorect; ?>

  <!-- main-container start -->
  <div class="main-container dark-translucent-bg">
    <div class="container">
      <div class="row">
        <!-- main start -->
        <div class="main object-non-visible" data-animation-effect="fadeInUpSmall" data-effect-delay="100">
          <div class="form-block center-block p-30 light-gray-bg border-clear">
            <h2 class="title">Login</h2>
            <form class="form-horizontal" id="loginform"  action="{{ '/Log-In' }}" method="POST">
              <div class="form-group has-feedback">
                <label for="inputUserName" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" onfocus="emptyElement('status')" maxlength="88" required>
                  <i class="fa fa-envelope form-control-feedback"></i>
                </div>
              </div>
              <div class="form-group has-feedback">
                <label for="inputPassword" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="emptyElement('status')" maxlength="100" required>
                  <i class="fa fa-lock form-control-feedback"></i>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-8">
                  <button type="submit" class="btn btn-group btn-default btn-animated" id="loginbtn" >Log In <i class="fa fa-user"></i></button>
                  <p id="status"></p>
                  <ul class="space-top">
                    <li><a href="Forgot-Password">Forgot your password?</a></li>
                  </ul>
                </div>
              </div>
              <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
          </div>
          <p class="text-center space-top">Don't have an account yet? <a href="Sign-Up">Sign up</a> now.</p>
        </div>
        <!-- main end -->
      </div>
    </div>
  </div>
  <!-- main-container end -->

@endsection
