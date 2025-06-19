<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Keterangan Kelahiran</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <!-- Catatan dari Kepala Desa -->
    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/kelahiran/update/' . $id_surat) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama"
                value="<?= old('nama', isset($nama) ? $nama : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Contoh: Bandung, 12 Mei 2023"
                value="<?= old('ttl', isset($ttl) ? $ttl : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" <?= old('jenis_kelamin', isset($jenis_kelamin) ? $jenis_kelamin : '') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= old('jenis_kelamin', isset($jenis_kelamin) ? $jenis_kelamin : '') == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                value="<?= old('pekerjaan', isset($pekerjaan) ? $pekerjaan : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= old('alamat', isset($alamat) ? $alamat : '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="nama_ayah">Nama Ayah Kandung <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                value="<?= old('nama_ayah', isset($nama_ayah) ? $nama_ayah : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="nama_ibu">Nama Ibu Kandung <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                value="<?= old('nama_ibu', isset($nama_ibu) ? $nama_ibu : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="anak_ke">Anak Ke- <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="anak_ke" name="anak_ke" min="1"
                value="<?= old('anak_ke', isset($anak_ke) ? $anak_ke : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="ktp">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file <?= (session('errors.ktp')) ? 'is-invalid' : '' ?>" id="ktp" name="ktp" accept=".pdf,.jpg,.jpeg,.png" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.ktp') ?></div>
        </div>

        <div class="form-group">
            <label for="kk">Upload KK <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file <?= (session('errors.kk')) ? 'is-invalid' : '' ?>" id="kk" name="kk" accept=".pdf,.jpg,.jpeg,.png" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.kk') ?></div>
        </div>
        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>