<!-- app/Views/admin/disposisi/index.php -->

<?= $this->extend('komponen/template-kepala-desa') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Halaman Disposisi Surat Masuk</h2>
    <p class="lead">Daftar surat masuk yang memerlukan tindakan disposisi dari Bapak/Ibu Kepala Desa.</p>

    <!-- Area untuk menampilkan pesan flashdata (success, error, info) -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('info')): ?>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('info') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (empty($surat_masuk_untuk_disposisi)): ?>
        <!-- Pesan jika tidak ada surat yang perlu didisposisikan -->
        <div class="alert alert-success" role="alert">
            Tidak ada surat masuk yang menunggu untuk didisposisikan saat ini. Semua sudah tertangani!
        </div>
    <?php else: ?>
        <!-- Tabel untuk menampilkan daftar surat masuk yang perlu didisposisikan -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Jenis Surat</th>
                        <th>File Surat</th>
                        <th>Tanggal Surat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($surat_masuk_untuk_disposisi as $i => $surat): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($surat['jenis_surat']) ?></td>
                            <td>
                                <?php if (!empty($surat['file_surat'])): ?>
                                    <a href="<?= base_url('uploads/surat_masuk/' . $surat['file_surat']) ?>" target="_blank" class="btn btn-sm btn-info">Lihat File</a>
                                <?php else: ?>
                                    Tidak ada file
                                <?php endif; ?>
                            </td>
                            <td><?= date('d-m-Y', strtotime($surat['tanggal_surat'])) ?></td>
                            <td>
                                <!-- Tombol untuk mengarahkan ke formulir disposisi surat ini -->
                                <a href="<?= site_url('kepala-desa/disposisi/form/' . $surat['id_surat_masuk']) ?>" class="btn btn-warning btn-sm">Disposisi</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
