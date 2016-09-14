@extends('layouts.master')

@section('title')
    404 | uSparkit
@endsection

@section('content')

  <!-- main-container start -->
    <section class="main-container jumbotron light-gray-bg text-center margin-clear">
      <div class="container">
        <div class="row">
          <!-- main start -->
          <div class="main col-md-6 col-md-offset-3 pv-40">
            <h1 class="page-title"><span class="text-default">404</span></h1>
            <h2>Ooops! Page Not Found</h2>
            <p>The requested URL was not found on this server. Make sure that the website address displayed in the address bar of your browser is spelled and formatted correctly.</p>
            <!--<form role="search">
              <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Search">
                <i class="fa fa-search form-control-feedback"></i>
              </div>
            </form>-->
            <a href="/" class="btn btn-default btn-animated btn-lg">Return Home <i class="fa fa-home"></i></a>
          </div>
          <!-- main end -->
        </div>
      </div>
    </section>
    <!-- main-container end -->

@endsection
