<!-- app/Views/admin/surat_masuk/index.php -->

<?= $this->extend('komponen/template-real-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Data Surat Masuk</h2>
    <a href="<?= site_url('admin/surat-masuk/tambah') ?>" class="btn btn-success mb-3">+ Tambah Surat Masuk</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Surat</th>
                <th>File</th>
                <th>Waktu Upload</th>
                <th>Aksi</th> <!-- Tambah ini -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surat_masuk as $i => $surat): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($surat['jenis_surat']) ?></td>
                    <td><a href="<?= base_url('uploads/surat_masuk/' . $surat['file_surat']) ?>" target="_blank">Lihat</a></td>
                    <td><?= $surat['created_at'] ?></td>
                    <td>
                        <form action="<?= site_url('admin/surat-masuk/hapus/' . $surat['id_surat_masuk']) ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>

    </table>
</div>

<?= $this->endSection() ?>