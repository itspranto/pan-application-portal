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
        <a href="/admin/dashboard" class="logo">
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
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span>{{ \App\Admin::admin()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                <p>
                                    {{ \App\Admin::admin()->name }}
                                    <small>{{ \App\Admin::admin()->email }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="/admin/logout" class="btn btn-default btn-flat">Sign out</a>
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
                    <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ \App\Admin::admin()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Main Menu</li>
                <!-- Optionally, you can add icons to the links -->
                <li><a href="/admin/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-user"></i> <span>Agents</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/list/users/all">All Agents</a></li>
                        <li><a href="/admin/list/users/pending">Pending</a></li>
                        <li><a href="/admin/list/users/active">Active</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-credit-card"></i> <span>PAN Cards</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a href="#"><span>All PANs</span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/admin/list/pans/all">All PANs</a></li>
                                <li><a href="/admin/list/pans/all?type=1">All New PANs</a></li>
                                <li><a href="/admin/list/pans/all?type=2">All Correction PANs</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><span>Pending (Need Upload) PANs</span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/admin/list/pans/pending">All Pending PANs</a></li>
                                <li><a href="/admin/list/pans/pending?type=1">All Pending New PANs</a></li>
                                <li><a href="/admin/list/pans/pending?type=2">All Pending Correction PANs</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><span>Accepted PANs</span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/admin/list/pans/active">All Accepted PANs</a></li>
                                <li><a href="/admin/list/pans/active?type=1">All Accepted New PANs</a></li>
                                <li><a href="/admin/list/pans/active?type=2">All Accepted Correction PANs</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><span>Rejected PANs</span>
                                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="/admin/list/pans/rejected">All Rejected PANs</a></li>
                                <li><a href="/admin/list/pans/rejected?type=1">All Rejected New PANs</a></li>
                                <li><a href="/admin/list/pans/rejected?type=2">All Rejected Correction PANs</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-money"></i> <span>Transactions</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/list/transactions/all">All Transactions</a></li>
                        <li><a href="/admin/list/transactions/pending">Pending Transactions</a></li>
                        <li><a href="/admin/list/transactions/active">Completed Transactions</a></li>
                    </ul>
                </li>

            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content container-fluid">
            @include("includes.message")
            @include("includes.errors")
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