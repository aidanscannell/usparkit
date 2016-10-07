<header class="header fixed  dark clearfix ">
  <div style="padding-left:2%;padding-right:2%;">
    <div class="row">
      <div class="col-md-2">
        <!-- header-left start -->
        <div class="header-left clearfix">

          <!-- logo -->
          <div id="logo" class="logo">
            <a href="/"><img id="logo_img" src="/src/images/Plln_logo_orange.png" alt="uSparkit"></a>
          </div>

          <!-- name-and-slogan -->
          <div class="site-slogan">
            Spark It In The Sponsorship Marketplace
          </div>

        </div>
        <!-- header-left end -->

      </div>
      <div class="col-md-10">
        <!-- header-right start -->
        <div class="header-right clearfix">
          <!-- main-navigation start -->
          <div class="main-navigation  animated with-dropdown-buttons">
            <!-- navbar start -->
            <nav class="navbar navbar-default" role="navigation">
              <div class="container-fluid">

                <!-- Toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                  <!-- main-menu -->
                  <ul class="nav navbar-nav " id="nav">

                    @unless (Auth::user())
                        <li><a href="/Sponsor">Sponsor</a></li>
                        <li><a href="/Get-Sponsored">Get Sponsored</a></li>
                        <li><a href="/How-It-Works">How It Works</a></li>
                        <li><a href="/Sign-Up">Sign Up</a></li>
                        <li><a href="/Log-In">Log In</a></li>
                    @endunless

                    @if (Auth::user())
                        <li><a href="/How-It-Works">How It Works</a></li>
                        @if(Auth::user()->userType == 'looking_to_sponsor')
                            <li><a href="/Sponsorship-Feed">Sponsor</a></li>
                        @endif
                        @if(Auth::user()->userType == 'looking_to_get_sponsored')
                            <li><a href="/Sponsorship-Feed">Get Sponsored</a></li>
                        @endif
                        <li><a href="/User/{{ Auth::user()->username }}">{{ Auth::user()->username }}</a></li>
                        <li class='dropdown active'>
                          <a  data-toggle='dropdown'>My Account</a>
                          <ul class='dropdown-menu' id='headerList'>
                            <li><a href="/Notifications/{{ Auth::user()->username }}" title="Notifications">Notifications</a></li>
                            <li><a href="/Messages/{{ Auth::user()->username}}" title="Messages">Messages</a></li>
                            <li><a class='dropdown-toggle' href='/Connections'>Connections</a></li>
                            <li></li>
                            <li><a class='dropdown-toggle' href='/Change-Password'>Change Password</a></li>
                            <li><a class='dropdown-toggle' href='/Log-Out'>Log Out</a></li>
                          </ul>
                        </li>
                    @endif
                  </ul>

                </div>
              </nav>
              <!-- navbar end -->

            </div>
            <!-- main-navigation end -->
          </div>
          <!-- header-right end -->

        </div>
      </div>
    </div>
  </div>

</header>
