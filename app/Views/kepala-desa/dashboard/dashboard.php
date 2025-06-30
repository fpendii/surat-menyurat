<!-- app/Views/kepala_desa/dashboard/index.php -->

<?= $this->extend('komponen/template-kepala-desa') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4">Selamat Datang di Dashboard Kepala Desa!</h1>
    <p class="lead">Ini adalah portal informasi utama Anda untuk memantau aktivitas surat di lingkungan desa.</p>
    
    <hr class="my-4">

    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card bg-primary text-white shadow-sm rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-inbox fa-3x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Total Surat Masuk</h5>
                            <p class="card-text fs-4"><?php echo $total_surat_masuk; ?></p>
                        </div>
                    </div>
                    <!-- Link ini mungkin akan mengarah ke daftar surat masuk yang perlu didisposisi oleh kepala desa -->
                    <a href="#" class="stretched-link text-white text-decoration-none">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card bg-success text-white shadow-sm rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-paper-plane fa-3x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Total Surat Keluar</h5>
                            <p class="card-text fs-4"><?php echo $total_surat_keluar; ?></p>
                        </div>
                    </div>
                    <!-- Link ini mungkin akan mengarah ke daftar surat keluar yang telah dibuat -->
                    <a href="<?= site_url('kepala-desa/arsip-surat') ?>" class="stretched-link text-white text-decoration-none">Lihat Detail</a>
                </div>
            </div>
        </div>
       
    </div>

   

</div>

<!-- Font Awesome untuk ikon, pastikan sudah di-load di template utama atau di sini -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<?= $this->endSection() ?>
