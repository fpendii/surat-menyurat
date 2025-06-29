<?= $this->extend('komponen/template-real-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Data Surat Masuk</h2>
    <a href="<?= base_url('admin/surat-masuk/tambah') ?>" class="btn btn-success mb-3">Tambah Surat Masuk</a>
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php elseif (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Surat</th>
                <th>Nomer Surat</th>
                <th>Nama Instansi</th>
                <th>File</th>
                <th>Waktu Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surat_masuk as $i => $surat): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= esc($surat['jenis_surat']) ?></td>
                    <td><?= esc($surat['no_surat']) ?></td>
                    <td><?= esc($surat['nama_instansi']) ?></td>
                    <td><a href="<?= base_url('uploads/surat_masuk/' . $surat['file_surat']) ?>" target="_blank">Lihat</a></td>
                    <td><?= date('d-m-Y', strtotime($surat['tanggal_surat'])) ?></td>
                    <td>
                        <a href="<?= base_url('admin/surat-masuk/edit/' . $surat['id_surat_masuk']) ?>" class="btn btn-primary btn-sm mr-2">Edit</a>
                        <form action="<?= base_url('admin/surat-masuk/hapus/' . $surat['id_surat_masuk']) ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus surat ini?')" class="d-inline">
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