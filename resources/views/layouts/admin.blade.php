<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title') | Admin TBZ</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('/css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    @yield('css')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style media="screen">
      .zmdi{
        margin: 5px;
      }
    </style>
</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/admin') }}">Terra Battle Z</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown pull-right">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        {{ ucfirst(Auth::user()->username) }}  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                          <a href="{{ url('/admin/bugs')}}"><i class="zmdi zmdi-bug"></i> Bugs</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                          <a href="{{ url('/admin/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ url('/admin') }}"><i class="zmdi zmdi-widgets"></i> Dashboard</a>
                        </li>
                        @if (Auth::user()->isAdmin())
                        <li>
                            <a href="{{url('/admin/users')}}"><i class="zmdi zmdi-accounts-alt"></i> Users</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/news')}}"><i class="zmdi zmdi-comments"></i> News</a>
                        </li>
                        @endif
                        <li>
                            <a href="#"><i class="zmdi zmdi-account"></i> Characters<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/admin/characters') }}">Characters</a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/races') }}">Race</a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/classes') }}">Class</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{url('/admin/items')}}"><i class="zmdi zmdi-wrench"></i> Items</a>
                        </li>
                        <li>
                            <a href="#"><i class="zmdi zmdi-fire"></i></i> Skills<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/admin/skills') }}">Skills</a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/affections') }}">Affections</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{url('/admin/companions')}}"><i class="zmdi zmdi-flare"></i> Companions</a>
                        </li>
                        <li>
                            <a href="{{url('/admin/eidolons')}}"><i class="zmdi zmdi-input-power"></i> Eidolons</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @yield('content')

            <footer>
              <div class="col-md-12">
                <hr>
              </div>
              <p>
                © {{date('Y')}} Admin dashboard created by <a href="#">@benjides</a>
              </p>
              <p>
                All rights belongs to their respective owners.
              </p>
            </footer>
        </div>
        <!-- /#page-wrapper -->



    </div>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('/js/sb-admin-2.js')}}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('/js/metisMenu.min.js') }}"></script>

    @yield('js')
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-64042538-1', 'auto');
      ga('send', 'pageview');
    </script>

</body>

</html>
