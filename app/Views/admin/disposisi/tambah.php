<?= $this->extend('komponen/template-real-admin') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Tambah Disposisi</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/disposisi/simpan') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label">Surat Dari</label>
            <input type="text" name="surat_dari" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No Surat</label>
            <input type="text" name="nomor_surat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Surat</label>
            <input type="date" name="tanggal_surat" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Diterima</label>
            <input type="date" name="tanggal_diterima" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No Agenda</label>
            <input type="text" name="nomor_agenda" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sifat</label>
            <select name="sifat" class="form-select" required>
                <option value="Biasa">Biasa</option>
                <option value="Segera">Segera</option>
                <option value="Rahasia">Rahasia</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Perihal</label>
            <input type="text" name="perihal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Diteruskan Kepada</label>
            <select name="diteruskan_kepada" class="form-select" required>
                <option value="">-- Pilih Pegawai --</option>
                <?php foreach ($pegawaiList as $p): ?>
                    <option value="<?= $p['id_user'] ?>"><?= esc($p['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/disposisi') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>
