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

    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form id="formKelahiran" action="<?= site_url('masyarakat/surat/kelahiran/update/' . $surat['id_surat']) ?>" enctype="multipart/form-data" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <div class="form-group mb-2">
            <label for="nama">Nama<span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama', $detail['nama'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.ttl') ? 'is-invalid' : '' ?>" id="ttl" name="ttl" placeholder="Contoh: Banjarbaru, 12 Mei 2023" value="<?= old('ttl', $detail['ttl'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.ttl') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki" <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <div class="invalid-feedback"><?= session('errors.jenis_kelamin') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.pekerjaan') ? 'is-invalid' : '' ?>" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan', $detail['pekerjaan'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.pekerjaan') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" rows="2" required><?= old('alamat', $detail['alamat'] ?? '') ?></textarea>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nama_ayah">Nama Ayah Kandung <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama_ayah') ? 'is-invalid' : '' ?>" id="nama_ayah" name="nama_ayah" value="<?= old('nama_ayah', $detail['nama_ayah'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama_ayah') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nama_ibu">Nama Ibu Kandung <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama_ibu') ? 'is-invalid' : '' ?>" id="nama_ibu" name="nama_ibu" value="<?= old('nama_ibu', $detail['nama_ibu'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama_ibu') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="anak_ke">Anak Ke- <span class="text-danger">*</span></label>
            <input type="number" class="form-control <?= session('errors.anak_ke') ? 'is-invalid' : '' ?>" id="anak_ke" name="anak_ke" min="1" value="<?= old('anak_ke', $detail['anak_ke'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.anak_ke') ?></div>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="ktp">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="ktp" name="ktp" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="kk" name="kk" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/kk/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>
        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>