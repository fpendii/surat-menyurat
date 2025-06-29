<!-- app/Views/admin/arsip_surat/index.php -->

<?= $this->extend('komponen/template-real-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Arsip Surat</h2>

    <!-- Navigasi Tabs -->
    <ul class="nav nav-tabs" id="arsipSuratTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="surat-masuk-tab" data-bs-toggle="tab" data-bs-target="#surat-masuk" type="button" role="tab" aria-controls="surat-masuk" aria-selected="true">Surat Masuk</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="surat-keluar-tab" data-bs-toggle="tab" data-bs-target="#surat-keluar" type="button" role="tab" aria-controls="surat-keluar" aria-selected="false">Surat Keluar</button>
        </li>
    </ul>

    <!-- Konten Tabs -->
    <div class="tab-content" id="arsipSuratTabContent">
        <!-- Tab Pane untuk Surat Masuk -->
        <div class="tab-pane fade show active" id="surat-masuk" role="tabpanel" aria-labelledby="surat-masuk-tab">
            <div class="mt-3">
                <h4>Data Surat Masuk</h4>
                <?php if (empty($surat_masuk)): ?>
                    <div class="alert alert-info" role="alert">
                        Belum ada data surat masuk.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Surat</th>
                                    <th>File</th>
                                    <th>Tanggal Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($surat_masuk as $i => $surat): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= esc($surat['jenis_surat']) ?></td>
                                        <td>
                                            <?php if (!empty($surat['file_surat'])): ?>
                                                <a href="<?= base_url('uploads/surat_masuk/' . $surat['file_surat']) ?>" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                            <?php else: ?>
                                                Tidak ada file
                                            <?php endif; ?>
                                        </td>
                                         <td><?= date('d-m-Y', strtotime($surat['tanggal_surat'])) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tab Pane untuk Surat Keluar -->
        <div class="tab-pane fade" id="surat-keluar" role="tabpanel" aria-labelledby="surat-keluar-tab">
            <div class="mt-3">
                <h4>Data Surat Keluar</h4>
                <?php if (empty($surat_keluar)): ?>
                    <div class="alert alert-info" role="alert">
                        Belum ada data surat keluar.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-success">
                                <tr>
                                    <th>No</th>
                                    <th>Jenis Surat</th>
                                    <th>File</th>
                                    <th>Waktu Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($surat_keluar as $i => $surat): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= esc($surat['jenis_surat']) ?></td>
                                        <td>
                                            <?php if (!empty($surat['file_surat'])): ?>
                                                <!-- Asumsi path untuk surat keluar sama dengan surat masuk, sesuaikan jika berbeda -->
                                                <a href="<?= base_url('lihat-file-surat-keluar/' . $surat['file_surat']) ?>" target="_blank" class="btn btn-sm btn-info">Lihat</a>
                                            <?php else: ?>
                                                Tidak ada file
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d-m-Y', strtotime($surat['created_at'])) ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>