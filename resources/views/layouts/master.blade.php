<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Benjides">
    <meta name="theme-color" content="#212121">

    <title>
      @yield('title') | Terra Battle Z
    </title>

    @include('layouts.favicons')

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/devicons.min.css') }}" rel='stylesheet'>
    @yield('css')
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body role="document">
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}">Terra Battle Z</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Characters<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('characters') }}">All</a></li>
                <li><a href="{{ url('class/Z') }}">Z Class</a></li>
                <li><a href="{{ url('class/SS') }}">SS Class</a></li>
                <li><a href="{{ url('class/S') }}">S Class</a></li>
                <li><a href="{{ url('class/A') }}">A Class</a></li>
                <li><a href="{{ url('class/B') }}">B Class</a></li>
                <li><a href="{{ url('class/C') }}">C Class</a></li>
                <li><a href="{{ url('class/D') }}">D Class</a></li>
              </ul>
            </li>
            <li>
              <a href="{{url('/items')}}">Items</a>
            </li>
            <li>
              <a href="{{url('/skills')}}">Skills</a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                Companions
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('companions') }}">All</a></li>
                <li><a href="{{ url('class/Z') }}">Z Class</a></li>
                <li><a href="{{ url('class/SS') }}">SS Class</a></li>
                <li><a href="{{ url('class/S') }}">S Class</a></li>
                <li><a href="{{ url('class/A') }}">A Class</a></li>
                <li><a href="{{ url('class/B') }}">B Class</a></li>
                <li><a href="{{ url('class/C') }}">C Class</a></li>
                <li><a href="{{ url('class/D') }}">D Class</a></li>
              </ul>
            </li>
            <li>
              <a href="{{url('/eidolons')}}">Eidolons</a>
            </li>
          </ul>



        </div><!--/.nav-collapse -->
      </div>
    </nav>

      @yield('content')

    <footer class="container footer">
      <div class="row">
        <div class="col-md-12">
          <hr>
        </div>
        <div class="col-xs-12 col-md-8">
          <p>
            Copyright © <?php echo date('Y') ?> <a href="{{ url('/') }}" data-ytta-id="-">Terra Battle Z</a>.
            All rights reserved. Terra Battle logo and all related images are registered trademarks or trademarks of
            <a target="_blank" href="http://www.mistwalkercorp.com/en/" data-ytta-id="-">Mistwalker Corporation</a>.
          </p>

          <p>
            Disclaimer: This is an unofficial site and has no connections with Mistwalker Game Design Studio.
            Use of our website and the content is at your own risk. We assume no responsibility for, and offer no warranties or representations regarding, the accuracy, reliability, completeness or timeliness of any of the content.
          </p>
        </div>
        <div class="social-media col-xs-12 col-md-4 text-right">
          <a href="https://twitter.com/TerraBattleZ" class="twitter-follow-button" data-show-count="false" data-size="large" data-dnt="true">Follow @TerraBattleZ</a>
          <script>
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
          </script>
          <p>
            <span class="devicons devicons-openshift" style="color:#e53935"></span>
            <span class="devicons devicons-laravel"   style="color:#ef6c00"></span>
            <span class="devicons devicons-bootstrap" style="color:#4a148c"></span>.
          </p>
          Fork me on <a href="https://github.com/benjides/TerraBattleZ">GitHub</a></span>.

        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    @yield('js')
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-64042538-1', 'auto');
      ga('send', 'pageview');
    </script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
