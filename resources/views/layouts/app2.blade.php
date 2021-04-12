<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--    <link rel="icon" href="images/favicon.ico" type="image/ico" />--}}

    <title>Helpdesk </title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/') }}/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/') }}/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('vendors/') }}/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('vendors/') }}/iCheck/skins/flat/green.css" rel="stylesheet">

    <link href="{{ asset('vendors/') }}/google-code-prettify/bin/prettify.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="{{ asset('vendors/') }}/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{ asset('vendors/') }}/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="{{ asset('vendors/') }}/starrr/dist/starrr.css" rel="stylesheet">


    <!-- bootstrap-progressbar -->
    <link href="{{ asset('vendors/') }}/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('vendors/') }}/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/') }}/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('build/') }}/css/custom.min.css" rel="stylesheet">

    <!-- Data table -->
    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link href="{{ asset('vendors/') }}/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('vendors/') }}/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('vendors/') }}/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('vendors/') }}/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('vendors/') }}/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Sweetalert -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

    <style>
        #floating-alert {
            z-index: 10;
            position: fixed;
            width: 20%;
            height:50px;
            right:1%;
            transform:translateX(2%);
            bottom:30px;
        }
    </style>
</head>

<body class="nav-md">
<div class="container body">
    @php
        $id_user    = Auth::user()->id;
        $akses = AccessHelp::get_access($id_user);
    @endphp
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2>{{ Auth::user()->name }}</h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                        @foreach ($akses as $menu)
                            @if($menu->parent == 1 AND $menu->slug != 'data' AND $menu->slug != 'jadwal' AND $menu->slug != 'input')
                                <li><a href="{{ url($menu->slug) }}"><i class="fa fa-home"></i>{{$menu->nama_menu}}</a></li>
                            @endif
                        @endforeach

                        </ul>
                    </div>

                    <div class="menu_section">
                        <ul class="nav side-menu">
                            <h3>User role</h3>
                            @foreach($akses as $sub)
                                @if($sub->parent == 1 AND $sub->slug == 'data' || $sub->slug == 'jadwal' || $sub->slug == 'input')
                                <li><a><i class="{{ $sub->icon }}"></i> {{ $sub->nama_menu }} <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        @foreach($akses as $submenu)
                                        @if($sub->id == $submenu->child)
                                            <li><a href="{{ url($submenu->slug) }}">{{ $submenu->nama_menu }}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                               id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                <img src="images/img.jpg" alt="">{{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="javascript:;"> Profile</a>
                                <a class="dropdown-item" href="javascript:;">
                                    <span class="badge bg-red pull-right">50%</span>
                                    <span>Settings</span>
                                </a>
                                <a class="dropdown-item" href="javascript:;">Help</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                            </div>
                        </li>

                        <li role="presentation" class="nav-item dropdown open">
                            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                               data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green">6</span>
                            </a>
                            <ul class="dropdown-menu list-unstyled msg_list" role="menu"
                                aria-labelledby="navbarDropdown1">
                                <li class="nav-item">
                                    <a class="dropdown-item">
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item">
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item">
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="dropdown-item">
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"/></span>
                                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <div class="text-center">
                                        <a class="dropdown-item">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                @yield('content')
            </div>
        </div>
        <!-- /page content -->

        <!-- show error -->
        @if (count($errors) > 0)
            <div id="floating-alert" class="container">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <!-- show error -->


        <!-- show notif -->
        @if (session('alert-success'))
            <div id="floating-alert" class="container">
                <div class="alert alert-success">
                    <strong>{{ session('alert-success') }}</strong>
                </div>
            </div>
        @endif
        @if (session('alert-danger'))
            <div id="floating-alert" class="container">
                <div class="alert alert-danger">
                    <strong>{{ session('alert-danger') }}</strong>
                </div>
            </div>
        @endif
        @if (session('alert-warning'))
            <div id="floating-alert" class="container">
                <div class="alert alert-warning">
                    <strong>{{ session('alert-warning') }}</strong>
                </div>
            </div>
        @endif
        <!-- show notif -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src=" {{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('vendors/') }}/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('vendors/') }}/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="{{ asset('vendors/') }}/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="{{ asset('vendors/') }}/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="{{ asset('vendors/') }}/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('vendors/') }}/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="{{ asset('vendors/') }}/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="{{ asset('vendors/') }}/skycons/skycons.js"></script>
<!-- Flot -->
<script src="{{ asset('vendors/') }}/Flot/jquery.flot.js"></script>
<script src="{{ asset('vendors/') }}/Flot/jquery.flot.pie.js"></script>
<script src="{{ asset('vendors/') }}/Flot/jquery.flot.time.js"></script>
<script src="{{ asset('vendors/') }}/Flot/jquery.flot.stack.js"></script>
<script src="{{ asset('vendors/') }}/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="{{ asset('vendors/') }}/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="{{ asset('vendors/') }}/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="{{ asset('vendors/') }}/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="{{ asset('vendors/') }}/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="{{ asset('vendors/') }}/jqvmap/dist/jquery.vmap.js"></script>
<script src="{{ asset('vendors/') }}/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="{{ asset('vendors/') }}/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('vendors/') }}/moment/min/moment.min.js"></script>
<script src="{{ asset('vendors/') }}/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('build/') }}/js/custom.min.js"></script>

<!-- Datatables -->
<script src="{{ asset('vendors') }}/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="{{ asset('vendors') }}/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="{{ asset('vendors') }}/jszip/dist/jszip.min.js"></script>
<script src="{{ asset('vendors') }}/pdfmake/build/pdfmake.min.js"></script>
<script src="{{ asset('vendors') }}/pdfmake/build/vfs_fonts.js"></script>
<!-- jQuery Smart Wizard -->
<script src="{{ asset('vendors') }}/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>

<!-- sweet alert-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- alert-->

<!-- bootstrap-wysiwyg -->
<script src="{{ asset('vendors') }}/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="{{ asset('vendors') }}/google-code-prettify/src/prettify.js"></script>
<script src="{{ asset('vendors') }}/jquery.hotkeys/jquery.hotkeys.js"></script>
<!-- jQuery Tags Input -->
<script src="{{ asset('vendors') }}/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('vendors') }}/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="{{ asset('vendors') }}/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="{{ asset('vendors') }}/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="{{ asset('vendors') }}/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

<script>
    window.setTimeout(function() {
        $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 4000);

    window.setTimeout(function() {
        $(".alert-danger").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 4000);

    window.setTimeout(function() {
        $(".alert-warning").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 4000);
</script>
</body>
</html>
