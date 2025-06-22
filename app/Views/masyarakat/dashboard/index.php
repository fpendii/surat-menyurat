<!-- app/Views/masyarakat/dashboard/index.php -->

<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h1 class="mb-4">Selamat Datang di Portal Layanan Masyarakat Desa!</h1>
    <p class="lead">Di sini Anda dapat menemukan informasi dan status terkini terkait pengajuan surat Anda.</p>

    <hr class="my-4">

    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card bg-primary text-white shadow-sm rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-file-invoice fa-3x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Total Surat Diajukan</h5>
                            <p class="card-text fs-4"><?php echo $totalSuratDiajukanHariIni; ?></p> <!-- Placeholder, isi dari controller -->
                        </div>
                    </div>
                    <a href="#" class="stretched-link text-white text-decoration-none">Lihat Semua Surat</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card bg-danger text-white shadow-sm rounded-lg">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit fa-3x me-3"></i>
                        <div>
                            <h5 class="card-title mb-0">Surat Perlu Revisi</h5>
                            <p class="card-text fs-4"><?php echo $totalSuratDirevisi; ?></p> <!-- Placeholder, isi dari controller -->
                        </div>
                    </div>
                    <a href="#" class="stretched-link text-white text-decoration-none">Lihat Surat Revisi</a>
                </div>
            </div>
        </div>
        <!-- Anda bisa menambahkan kartu lain di sini sesuai kebutuhan -->
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm rounded-lg">
                <div class="card-body">
                    <h5 class="card-title">Informasi dan Bantuan</h5>
                    <ul>
                        <li>Gunakan menu navigasi di atas untuk menjelajahi portal.</li>
                        <li>Untuk bantuan atau pertanyaan terkait pengajuan surat Anda, silakan hubungi petugas desa.</li>
                        <li>Pastikan data pribadi Anda aman saat menggunakan layanan.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Font Awesome untuk ikon, pastikan sudah di-load di template utama atau di sini -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<?= $this->endSection() ?>