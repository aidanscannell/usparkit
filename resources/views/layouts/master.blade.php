@yield('headPHP')
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>@yield('title')</title>

    <meta charset="utf-8">
    <meta name="description" content="Sponsorship Website">
    <meta name="author" content="Aidan Scannell">
    <meta name="keywords" content="Sponsorship, University">

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS of multi select on user page -->
    <link rel="stylesheet" href="/src/chosen/docsupport/style.css">
    <link rel="stylesheet" href="/src/chosen/docsupport/prism.css">
    <link rel="stylesheet" href="/src/chosen/chosen.css">

    <!-- Favicon -->
    <!--<link rel="shortcut icon" href="">-->

    <!-- Web Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

    <!-- Bootstrap core CSS -->
    <link href="/src/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="/src/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link href="/src/fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Fontello CSS -->
    <link href="/src/fonts/fontello/css/fontello.css" rel="stylesheet">

    <!-- Plugins -->
    <link href="/src/plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="/src/plugins/rs-plugin/css/settings.css" rel="stylesheet">
    <link href="/src/css/animations.css" rel="stylesheet">
    <link href="/src/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/src/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="/src/plugins/hover/hover-min.css" rel="stylesheet">

    <!-- the project core CSS file -->
    <link href="/src/css/style.css" rel="stylesheet" >

    <!-- Color Scheme (In order to change the color scheme, replace the blue.css with the color scheme that you prefer)-->
    <link href="/src/css/skins/orange.css" rel="stylesheet">

    <!-- Custom css -->
    <link href="/src/css/custom.css" rel="stylesheet">
    <style>
      #headerList li {
          list-style-type: none;
      }
      footer{
        padding-top: 0px;
      }
    </style>

    <script type="text/javascript" src="/src/js/jquery.min.js"></script>

    <!-- ALERT, CONFRIM, PROMPT -->
    <!-- JS dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/src/bootstrap/js/bootstrap.min.js"></script>
    <!-- bootbox code -->
    <script src="/src/js/bootbox.min.js"></script>
    <!-- Private messaging js-->
    <script src="/src/js/messaging.js"></script>

    @yield('head')
</head>
<body>

  <!-- scrollToTop -->
  <div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>

  <!-- page wrapper start -->
  <div class="page-wrapper">

    <!-- header-container start -->
    <div class="header-container">

      @yield('aboveHeader')

      <div id="headerWrap">
        @include('includes.master-includes.header')
      </div>

      @yield('content')

      @include('includes.master-includes.footer')

    <!-- page wrapper start -->
    </div>

  <!-- header-container start -->
  </div>

    <!-- JavaScript files placed at the end of the document so the pages load faster -->
    <!-- ================================================== -->
    <!-- Jquery and Bootstap core js files -->
    <script type="text/javascript" src="/src/plugins/jquery.min.js"></script>
    <script type="text/javascript" src="/src/bootstrap/js/bootstrap.min.js"></script>

    <!-- Modernizr javascript -->
    <script type="text/javascript" src="/src/plugins/modernizr.js"></script>

    <!-- jQuery Revolution Slider  -->
    <script type="text/javascript" src="/src/plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="/src/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    <!-- Isotope javascript -->
    <script type="text/javascript" src="/src/plugins/isotope/isotope.pkgd.min.js"></script>

    <!-- Magnific Popup javascript -->
    <script type="text/javascript" src="/src/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Appear javascript -->
    <script type="text/javascript" src="/src/plugins/waypoints/jquery.waypoints.min.js"></script>

    <!-- Count To javascript -->
    <script type="text/javascript" src="/src/plugins/jquery.countTo.js"></script>

    <!-- Parallax javascript -->
    <script src="/src/plugins/jquery.parallax-1.1.3.js"></script>

    <!-- Contact form -->
    <script src="/src/plugins/jquery.validate.js"></script>

    <!-- Google Maps javascript -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;signed_in=true"></script>
    <script type="text/javascript" src="/src/js/google.map.config.js"></script>

    <!-- Owl carousel javascript -->
    <script type="text/javascript" src="/src/plugins/owl-carousel/owl.carousel.js"></script>

    <!-- SmoothScroll javascript -->
    <script type="text/javascript" src="/src/plugins/jquery.browser.js"></script>
    <script type="text/javascript" src="/src/plugins/SmoothScroll.js"></script>

    <!-- Initialization of Plugins -->
    <script type="text/javascript" src="/src/js/template.js"></script>

    <!-- Custom Scripts -->
    <script type="text/javascript" src="/src/js/main.js"></script>
    <script type="text/javascript" src="/src/js/ajax.js"></script>

    <script type="text/javascript">
    function reloadPage(){
    location.reload();
    }
    </script>

    @yield('postFooter')

  </body>
</html>
