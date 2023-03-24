<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield("title")</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/css/ionicons.min.css">

@yield("custom_css")
<!-- Theme style -->
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="/css/skins/skin-blue.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="/dashboard" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">{{ env("APP_NAME") }}</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">{{ env("APP_NAME") }}</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account Menu -->
                    <li style="color: #fff;margin-top: 5px">Wallet Balance <br/>Rs. {{ Auth::user()->balance }}</li>
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ asset(Auth::user()->photograph) }}" class="user-image" alt="User Image"
                                 width="160px" height="160px">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ asset(Auth::user()->photograph) }}" class="img-circle" alt="User Image"
                                     width="160px" height="160px">

                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{ Auth::user()->email }}</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/transactions/new" class="btn btn-default btn-flat">Wallet Recharge</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/logout" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset(Auth::user()->photograph) }}" class="img-circle" alt="User Image" width="160px"
                         height="160px">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Main Menu</li>
                <!-- Optionally, you can add icons to the links -->
                <li><a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-credit-card"></i> <span>Pan Cards</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/pans/apply">Apply new PAN</a></li>
                        <li><a href="/pans/apply">Change/Reprint/Correction PAN</a></li>
                        <li><a href="/pans">Submitted Forms</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-money"></i> <span>My Wallet</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/transactions/new">Recharge Wallet</a></li>
                        <li><a href="/transactions">Transaction List</a></li>
                    </ul>
                </li>
                @if (($notifications = auth()->user()->notifications()->where(["status" => 1])->count()) > 0)
                    <li><a href="/notifications"><i class="fa fa-bell-o"></i> <span>Notifications</span>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-red">{{ $notifications }}</small>
                            </span></a></li>
                @else
                    <li><a href="/notifications"><i class="fa fa-bell-o"></i> <span>Notifications</span></a></li>
                @endif

            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content container-fluid">
            @yield("content")
        </section>
    </div>

    @include("includes.footer")
</div>
<!-- jQuery 3 -->
<script src="/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/adminlte.min.js"></script>
@yield("scripts")
</body>
</html>