<!-- app/Views/admin/dashboard/index.php -->

<?= $this->extend('komponen/template-real-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4">Selamat Datang di Dashboard Admin!</h1>
    <p class="lead">Ini adalah sistem manajemen surat berbasis web untuk membantu Anda mengelola surat masuk dan surat keluar dengan lebih efisien.</p>

    <hr class="my-4">

    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card bg-primary text-white shadow-sm rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-inbox fa-3x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Total Surat Masuk</h5>
                            <p class="card-text fs-4">XX</p> <!-- Placeholder, nanti bisa diisi dari controller -->
                        </div>
                    </div>
                    <a href="<?= site_url('admin/surat-masuk') ?>" class="stretched-link text-white text-decoration-none">Lihat Detail</a>
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
                            <p class="card-text fs-4">YY</p> <!-- Placeholder, nanti bisa diisi dari controller -->
                        </div>
                    </div>
                    <a href="<?= site_url('admin/surat-keluar') ?>" class="stretched-link text-white text-decoration-none">Lihat Detail</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card bg-info text-white shadow-sm rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-alt fa-3x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Total Disposisi</h5>
                            <p class="card-text fs-4">ZZ</p> <!-- Placeholder, nanti bisa diisi dari controller -->
                        </div>
                    </div>
                    <a href="<?= site_url('admin/disposisi') ?>" class="stretched-link text-white text-decoration-none">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm rounded-lg">
                <div class="card-body">
                    <h5 class="card-title">Informasi Cepat</h5>
                    <ul>
                        <li>Gunakan menu navigasi di samping untuk mengakses fitur-fitur lainnya.</li>
                        <li>Pastikan data arsip selalu diperbarui.</li>
                        <li>Hubungi dukungan jika ada kendala.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Font Awesome untuk ikon, pastikan sudah di-load di template utama atau di sini -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<?= $this->endSection() ?>