<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/template-admin/production/images/favicon.ico" type="image/ico" />

    <title>SI Surat Menyurat</title>

    <link href="/template-admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template-admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/template-admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="/template-admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="/template-admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link href="/template-admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <link href="/template-admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

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
                        <a href="index.html" class="site_title"><span>SI Surat Menyurat</span></a>
                    </div>

                    <div class="clearfix"></div>

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
                                <?php
                                // --- Dapatkan URI saat ini dan bersihkan ---
                                $requestUri = $_SERVER['REQUEST_URI'];
                                $requestPath = strtok($requestUri, '?'); // Hapus query string
                                
                                // Hapus '/index.php' jika ada (common in CI, old PHP setups)
                                $requestPath = str_replace('/index.php', '', $requestPath);
                                
                                // Hapus base directory/folder jika aplikasi tidak di root domain
                                // Contoh: Jika aplikasi Anda di 'http://localhost/si_surat/',
                                // maka $requestPath awal mungkin '/si_surat/admin/dashboard'
                                // Anda perlu menghapus '/si_surat'
                                // Untuk mengetahui base directory secara dinamis:
                                $scriptName = $_SERVER['SCRIPT_NAME']; // e.g., /si_surat/index.php
                                $baseDir = dirname($scriptName); // e.g., /si_surat
                                // Hapus base directory dari requestPath, kecuali jika baseDir adalah '/'
                                if ($baseDir !== '/' && strpos($requestPath, $baseDir) === 0) {
                                    $requestPath = substr($requestPath, strlen($baseDir));
                                }
                                // Pastikan path dimulai dengan '/' jika tidak kosong
                                if ($requestPath === '') {
                                    $requestPath = '/';
                                } elseif (substr($requestPath, 0, 1) !== '/') {
                                    $requestPath = '/' . $requestPath;
                                }


                                // Hapus trailing slash kecuali untuk root (/)
                                if ($requestPath !== '/' && substr($requestPath, -1) === '/') {
                                    $requestPath = substr($requestPath, 0, -1);
                                }
                                
                                // Debugging: Ini akan sangat membantu! Lihat di console browser Anda (F12)
                                // echo "<script>console.log('PHP Current Path: " . $requestPath . "');</script>";
                                
                                // --- Fungsi untuk menentukan kelas 'active' ---
                                function getActiveClass($expectedPath, $currentPath) {
                                    // Bersihkan expectedPath dari base_url() dan index.php jika ada
                                    $expectedPathClean = str_replace('/index.php', '', parse_url($expectedPath, PHP_URL_PATH));
                                    
                                    // Pastikan expectedPathClean juga dimulai dengan '/' dan tanpa trailing slash
                                    if ($expectedPathClean === '') {
                                        $expectedPathClean = '/';
                                    } elseif (substr($expectedPathClean, 0, 1) !== '/') {
                                        $expectedPathClean = '/' . $expectedPathClean;
                                    }
                                    if ($expectedPathClean !== '/' && substr($expectedPathClean, -1) === '/') {
                                        $expectedPathClean = substr($expectedPathClean, 0, -1);
                                    }
                                    
                                    // echo "<script>console.log('PHP Expected Path: " . $expectedPathClean . "');</script>"; // Debugging
                                    
                                    // Lakukan perbandingan
                                    if ($currentPath === $expectedPathClean) {
                                        return 'active current-file'; // Tambahkan 'current-file' juga jika template menggunakannya
                                    }
                                    
                                    // Khusus untuk dashboard, mungkin bisa juga aktif jika root path (/)
                                    // Ini opsional, tergantung apakah dashboard diakses juga via '/'
                                    if ($expectedPathClean === '/admin/dashboard' && $currentPath === '/') {
                                        return 'active current-file';
                                    }

                                    // Jika Anda memiliki sub-route (misal: /admin/pengajuan-surat/tambah atau /admin/pengajuan-surat/edit/1)
                                    // Anda bisa menggunakan str_starts_with untuk mengaktifkan parent menu
                                    // Pastikan expectedPathClean bukan root path '/' itu sendiri saat str_starts_with
                                    if ($expectedPathClean !== '/' && str_starts_with($currentPath, $expectedPathClean)) {
                                        return 'active current-file';
                                    }

                                    return ''; // Kosong jika tidak aktif
                                }
                                ?>

                                <li class="<?= getActiveClass(base_url('admin/dashboard'), $requestPath) ?>">
                                    <a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-home"></i> Dashboard </a>
                                </li>

                                <li class="<?= getActiveClass(base_url('admin/pengajuan-surat'), $requestPath) ?>">
                                    <a href="<?= base_url('admin/pengajuan-surat') ?>"><i class="fa fa-envelope"></i> Pengajuan Surat </a>
                                </li>

                                <li class="<?= getActiveClass(base_url('admin/surat-masuk'), $requestPath) ?>">
                                    <a href="<?= base_url('admin/surat-masuk') ?>"><i class="fa fa-inbox"></i> Surat Masuk </a>
                                </li>

                                <li class="<?= getActiveClass(base_url('admin/arsip-surat'), $requestPath) ?>">
                                    <a href="<?= base_url('admin/arsip-surat') ?>"><i class="fa fa-archive"></i> Arsip Surat </a>
                                </li>

                                <li class="<?= getActiveClass(base_url('admin/pengguna'), $requestPath) ?>">
                                    <a href="<?= base_url('admin/pengguna') ?>"><i class="fa fa-users"></i> Data Pengguna </a>
                                </li>

                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                        <i class="fa fa-power-off"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>
            </div>


            <div class="right_col" role="main">
                <?= $this->renderSection('content') ?>
            </div>
            </div>

        <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin logout?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="/template-admin/vendors/jquery/dist/jquery.min.js"></script>
        <script src="/template-admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/template-admin/vendors/fastclick/lib/fastclick.js"></script>
        <script src="/template-admin/vendors/nprogress/nprogress.js"></script>
        <script src="/template-admin/vendors/Chart.js/dist/Chart.min.js"></script>
        <script src="/template-admin/vendors/gauge.js/dist/gauge.min.js"></script>
        <script src="/template-admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <script src="/template-admin/vendors/iCheck/icheck.min.js"></script>
        <script src="/template-admin/vendors/skycons/skycons.js"></script>
        <script src="/template-admin/vendors/Flot/jquery.flot.js"></script>
        <script src="/template-admin/vendors/Flot/jquery.flot.pie.js"></script>
        <script src="/template-admin/vendors/Flot/jquery.flot.time.js"></script>
        <script src="/template-admin/vendors/Flot/jquery.flot.stack.js"></script>
        <script src="/template-admin/vendors/Flot/jquery.flot.resize.js"></script>
        <script src="/template-admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="/template-admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="/template-admin/vendors/flot.curvedlines/curvedLines.js"></script>
        <script src="/template-admin/vendors/DateJS/build/date.js"></script>
        <script src="/template-admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="/template-admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="/template-admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <script src="/template-admin/vendors/moment/min/moment.min.js"></script>
        <script src="/template-admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <script src="/template-admin/build/js/custom.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
        </body>

</html>