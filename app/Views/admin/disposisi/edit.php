<?= $this->extend('komponen/template-real-admin') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Edit Disposisi</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/disposisi/update/' . $disposisi['id_disposisi']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">Surat Dari</label>
            <input type="text" name="surat_dari" class="form-control" value="<?= esc($disposisi['surat_dari']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No Surat</label>
            <input type="text" name="nomor_surat" class="form-control" value="<?= esc($disposisi['nomor_surat']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Surat</label>
            <input type="date" name="tanggal_surat" class="form-control" value="<?= esc($disposisi['tanggal_surat']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Diterima</label>
            <input type="date" name="tanggal_diterima" class="form-control" value="<?= esc($disposisi['tanggal_diterima']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No Agenda</label>
            <input type="text" name="nomor_agenda" class="form-control" value="<?= esc($disposisi['nomor_agenda']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sifat</label>
            <select name="sifat" class="form-select" required>
                <option value="Biasa" <?= $disposisi['sifat'] == 'Biasa' ? 'selected' : '' ?>>Biasa</option>
                <option value="Segera" <?= $disposisi['sifat'] == 'Segera' ? 'selected' : '' ?>>Segera</option>
                <option value="Rahasia" <?= $disposisi['sifat'] == 'Rahasia' ? 'selected' : '' ?>>Rahasia</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Perihal</label>
            <input type="text" name="perihal" class="form-control" value="<?= esc($disposisi['perihal']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Diteruskan Kepada</label>
            <select name="diteruskan_kepada" class="form-select" required>
                <option value="">-- Pilih Pegawai --</option>
                <?php foreach ($pegawaiList as $p): ?>
                    <option value="<?= $p['id_user'] ?>" <?= $p['id_user'] == $disposisi['diteruskan_kepada'] ? 'selected' : '' ?>>
                        <?= esc($p['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <textarea name="catatan" class="form-control" rows="3"><?= esc($disposisi['catatan']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('admin/disposisi') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection() ?>
