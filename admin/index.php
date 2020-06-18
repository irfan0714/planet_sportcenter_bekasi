<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="./plugins/images/favicon.png">
    <title>Admin</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="./plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="./plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="./plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="./plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="./plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/default.css" id="theme" rel="stylesheet">
    <link href="../css/jquery-confirm.min.css" rel="stylesheet" type="text/css" media="screen" />  
    <link href="../css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    
    <!-- jQuery -->
    <script src="./plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="./plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <!--Counter js -->
    <script src="./plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="./plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!-- chartist chart -->
    <script src="./plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="./plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="./plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/dashboard1.js"></script>
    <script src="./plugins/bower_components/toast-master/js/jquery.toast.js"></script>

    <script src="../js/jquery-confirm.min.js"></script>
    <script src="../js/bootstrap-datepicker.min.js"></script>
</head>

<body class="fix-header">
    <?php 
        session_start();
        include "../koneksi.php";

        if(empty($_SESSION)){
            echo "<script>window.location='login.html'</script>";
        }
    ?>
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="dashboard.html">
                        <!-- Logo icon image, you can use font-icon also --><b>
                            <!--This is dark logo icon-->
                            <!-- <img src="./plugins/images/admin-logo.png" alt="home" class="dark-logo" /> -->
                            <!--This is light logo icon-->
                            <!-- <img src="./plugins/images/admin-logo-dark.png" alt="home" class="light-logo" /> -->
                        </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                            <!--This is dark logo text--><img src="./plugins/images/admin-text.png" alt="home"
                                class="dark-logo" />
                            <!--This is light logo text--><img src="./plugins/images/admin-text-dark.png" alt="home"
                                class="light-logo" />
                        </span> </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg"
                            href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    </li>
                    <li>
                        <a class="profile-pic" href="#"> <img src="./plugins/images/users/user.png" alt="user-img"
                                width="36" class="img-circle"><b class="hidden-xs"><?php echo $_SESSION['username']; ?> </b></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span
                            class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="?p=dashboard" class="waves-effect "><i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="?p=pesanan" class="waves-effect"><i class="fa fa-shopping-bag fa-fw" aria-hidden="true"></i>Pesanan</a>
                    </li>
                    <li>
                        <a href="?p=pelanggan" class="waves-effect"><i class="fa fa-users fa-fw" aria-hidden="true"></i>Pelanggan</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="waves-effect"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>Laporan<i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="fa-ul">
                            <li>
                                <a href="?p=laporan" class="waves-effect">
                                   <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>Laporan Penjualan
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="waves-effect"><i class="fa fa-gears fa-fw" aria-hidden="true"></i>Master <i class="fa fa-angle-right pull-right"></i></a> 
                        <ul class="fa-ul">
                            <li>
                                <a href="?p=harga" class="waves-effect">
                                   <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>Harga
                                </a>
                            </li>
                            <li>
                                <a href="?p=lapangan" class="waves-effect">
                                   <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>Lapangan
                                </a>
                            </li>
                            <li>
                                <a href="?p=jenis-lapangan" class="waves-effect">
                                   <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>Jenis Lapangan
                                </a>
                            </li>
                            <li>
                                <a href="?p=waktu" class="waves-effect">
                                   <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>Waktu
                                </a>
                            </li>
                            <li>
                                <a href="?p=hari" class="waves-effect">
                                   <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>Hari
                                </a>
                            </li>
                            <li>
                                <a href="?p=user" class="waves-effect">
                                   <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>User
                                </a>
                            </li>
                            <!-- <li>
                                <a href="?p=bank" class="waves-effect">
                                   <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>Bank
                                </a>
                            </li> -->
                        </ul>
                    </li>
                    

                    <li>
                        <a href="proses.php?action=logout" class="waves-effect"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php 
                    if(isset($_GET['p']))
                    {
                        if($_GET['p'] == 'dashboard')
                        {
                            include "dashboard.php";
                        }
                        else if($_GET['p'] == 'pesanan')
                        {
                            include "pesanan.php";
                        }
                        else if($_GET['p'] == 'pelanggan')
                        {
                            include "pelanggan.php";
                        }
                        else if($_GET['p'] == 'laporan')
                        {
                            include "laporan.php";
                        }
                        else if($_GET['p'] == 'harga')
                        {
                            include "harga.php";
                        }
                        else if($_GET['p'] == 'lapangan')
                        {
                            include "lapangan.php";
                        }
                        else if($_GET['p'] == 'jenis-lapangan')
                        {
                            include "jenis_lapangan.php";
                        }
                        else if($_GET['p'] == 'waktu')
                        {
                            include "waktu.php";
                        }
                        else if($_GET['p'] == 'hari')
                        {
                            include "hari.php";
                        }
                        else if($_GET['p'] == 'user')
                        {
                            include "user.php";
                        }
                        else
                        {
                            include "dashboard.php";
                        }
                    }
                    else
                    {
                        include "dashboard.php";
                    }
                ?>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2020 &copy; Admin</footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- /#wrapper -->
</body>

</html>