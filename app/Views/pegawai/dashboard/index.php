<!-- app/Views/pegawai/dashboard/index.php -->

<?= $this->extend('komponen/template-pegawai') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4">Selamat Datang di Dashboard Pegawai!</h1>
    <p class="lead">Di sini Anda dapat melihat ringkasan aktivitas surat-menyurat dan disposisi yang relevan dengan tugas Anda.</p>

    <hr class="my-4">

    <div class="row">
        
        
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card bg-warning text-white shadow-sm rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tasks fa-3x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Disposisi Menunggu Tindak Lanjut</h5>
                            <p class="card-text fs-4">ZZ</p> <!-- Placeholder, isi dari controller -->
                        </div>
                    </div>
                    <a href="<?= site_url('pegawai/disposisi') ?>" class="stretched-link text-white text-decoration-none">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm rounded-lg">
                <div class="card-body">
                    <h5 class="card-title">Informasi Penting</h5>
                    <ul>
                        <li>Gunakan menu navigasi untuk mengakses arsip surat dan disposisi.</li>
                        <li>Pastikan untuk menindaklanjuti disposisi yang ditujukan kepada Anda.</li>
                        <li>Laporkan jika ada masalah atau butuh bantuan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Font Awesome untuk ikon, pastikan sudah di-load di template utama atau di sini -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<?= $this->endSection() ?>
