<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/template-admin/production/images/favicon.ico" type="image/ico" />

    <title>SI Surat Menyurat</title>

    <!-- Bootstrap -->
    <link href="/template-admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/template-admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/template-admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/template-admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="/template-admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/template-admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="/template-admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/template-admin/build/css/custom.min.css" rel="stylesheet">

    

    <style>
        .hover-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"> <span>SI Surat Menyurat</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix">

                        <div class="profile_info">
                            <span>Selamat Datang,</span>
                            <h2><?= session()->get('name') ?></h2>
                        </div>

                    </div>

                    <br />

                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>Sidebar</h3>
                            <ul class="nav side-menu">
                                <li><a href="/pegawai/dashboard"><i class="fa fa-home"></i> Dashboard </a></li>
                                <li><a href="/pegawai/disposisi"><i class="fa fa-share"></i> Disposisi </a></li>
                                <li><a href="/logout"><i class="fa fa-power-off"></i> Logout </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



            <!-- page content -->
            <div class="right_col" role="main">
                <!-- Konten Utama -->
                <?= $this->renderSection('content') ?>
            </div>
            <!-- /page content -->


        </div>
    </div>



    <!-- jQuery -->
    <script src="/template-admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/template-admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="/template-admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/template-admin/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="/template-admin/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="/template-admin/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/template-admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/template-admin/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/template-admin/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/template-admin/vendors/Flot/jquery.flot.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/template-admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/template-admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/template-admin/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/template-admin/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/template-admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/template-admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/template-admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/template-admin/vendors/moment/min/moment.min.js"></script>
    <script src="/template-admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/template-admin/build/js/custom.min.js"></script>

    <!-- Bootstrap 5 JS Bundle (termasuk Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>