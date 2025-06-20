<?= $this->extend('komponen/template-kepala-desa') ?>


<?= $this->section('content') ?>
    <div class="container mt-4">
        <h1>Selamat Datang, Kepala Desa!</h1>
        <p>Ini adalah ringkasan performa sistem manajemen surat Anda.</p>

        <div class="row mt-4">
            <div class="col-md-6 mb-4">
                <div class="card border-primary shadow-sm h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Surat Diajukan Hari Ini
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $totalSuratDiajukanHariIni ?? 0 ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Surat Disetujui
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $totalSuratDiAcc ?? 0 ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
<?= $this->endSection() ?>