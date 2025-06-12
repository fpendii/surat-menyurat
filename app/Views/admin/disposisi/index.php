<?= $this->extend('komponen/template-real-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Daftar Disposisi</h2>

    <a href="<?= base_url('admin/disposisi/tambah') ?>" class="btn btn-primary mb-3">Tambah Disposisi</a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Surat Dari</th>
                <th>No Surat</th>
                <th>Tgl Surat</th>
                <th>Diterima Tgl</th>
                <th>No Agenda</th>
                <th>Sifat</th>
                <th>Perihal</th>
                <th>Diteruskan Kepada</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($disposisis as $key => $row): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= esc($row['surat_dari']) ?></td>
                    <td><?= esc($row['nomor_surat']) ?></td>
                    <td><?= esc($row['tanggal_surat']) ?></td>
                    <td><?= esc($row['tanggal_diterima']) ?></td>
                    <td><?= esc($row['nomor_agenda']) ?></td>
                    <td><?= esc($row['sifat']) ?></td>
                    <td><?= esc($row['perihal']) ?></td>
                    <td>
                        <?php
                            // Ambil nama pegawai jika sudah join, atau tampilkan ID saja
                            echo isset($row['name']) ? esc($row['name']) : 'ID: ' . esc($row['diteruskan_kepada']);
                        ?>
                    </td>
                    <td><?= esc($row['catatan']) ?></td>
                    <td>
                        <a href="<?= base_url('admin/disposisi/edit/' . $row['id_disposisi']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form action="<?= base_url('admin/disposisi/hapus/' . $row['id_disposisi']) ?>" method="post" style="display:inline;">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
