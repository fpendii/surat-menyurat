<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Keterangan Kawin</h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
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

    <form id="formSuratKawin" action="<?= site_url('masyarakat/surat/status-perkawinan/update/' . $surat['id_surat']) ?>" enctype="multipart/form-data" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session()->has('errors.nama')) ? 'is-invalid' : '' ?>"
                id="nama"
                name="nama"
                value="<?= old('nama', $detail['nama'] ?? '') ?>"
                required>
            <?php if (session()->has('errors.nama')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.nama') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session()->has('errors.nik')) ? 'is-invalid' : '' ?>"
                id="nik"
                name="nik"
                value="<?= old('nik', $detail['nik'] ?? '') ?>"
                required maxlength="16" minlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="">
            <?php if (session()->has('errors.nik')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.nik') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session()->has('errors.ttl')) ? 'is-invalid' : '' ?>"
                id="ttl"
                name="ttl"
                placeholder="Contoh: Surabaya, 14 Februari 1995"
                value="<?= old('ttl', $detail['ttl'] ?? '') ?>"
                required>
            <?php if (session()->has('errors.ttl')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.ttl') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (session()->has('errors.agama')) ? 'is-invalid' : '' ?>"
                id="agama"
                name="agama"
                required>
                <option value="" <?= (old('agama', $detail['agama'] ?? '') == '') ? 'selected' : '' ?>>-- Pilih --</option>
                <option value="Islam" <?= (old('agama', $detail['agama'] ?? '') == 'Islam') ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= (old('agama', $detail['agama'] ?? '') == 'Kristen') ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= (old('agama', $detail['agama'] ?? '') == 'Katolik') ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= (old('agama', $detail['agama'] ?? '') == 'Hindu') ? 'selected' : '' ?>>Hindu</option>
                <option value="Budha" <?= (old('agama', $detail['agama'] ?? '') == 'Budha') ? 'selected' : '' ?>>Budha</option>
                <option value="Konghucu" <?= (old('agama', $detail['agama'] ?? '') == 'Konghucu') ? 'selected' : '' ?>>Konghucu</option>
            </select>
            <?php if (session()->has('errors.agama')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.agama') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea
                class="form-control <?= (session()->has('errors.alamat')) ? 'is-invalid' : '' ?>"
                id="alamat"
                name="alamat"
                rows="3"
                required><?= old('alamat', $detail['alamat'] ?? '') ?></textarea>
            <?php if (session()->has('errors.alamat')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.alamat') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group mb-2">
            <label for="status">Status Perkawinan <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (session()->has('errors.status')) ? 'is-invalid' : '' ?>"
                id="status"
                name="status"
                required>
                <option value="" <?= (old('status', $detail['status'] ?? '') == '') ? 'selected' : '' ?>>-- Pilih --</option>
                <option value="Janda" <?= (old('status', $detail['status'] ?? '') == 'Janda') ? 'selected' : '' ?>>Janda</option>
                <option value="Duda" <?= (old('status', $detail['status'] ?? '') == 'Duda') ? 'selected' : '' ?>>Duda</option>
                <option value="Perjaka" <?= (old('status', $detail['status'] ?? '') == 'Perjaka') ? 'selected' : '' ?>>Perjaka</option>
                <option value="Lajang" <?= (old('status', $detail['status'] ?? '') == 'Lajang') ? 'selected' : '' ?>>Lajang</option>
                <option value="Menikah" <?= (old('status', $detail['status'] ?? '') == 'Menikah') ? 'selected' : '' ?>>Menikah</option>
                <option value="Cerai Hidup" <?= (old('status', $detail['status'] ?? '') == 'Cerai Hidup') ? 'selected' : '' ?>>Cerai Hidup</option>
                <option value="Cerai Mati" <?= (old('status', $detail['status'] ?? '') == 'Cerai Mati') ? 'selected' : '' ?>>Cerai Mati</option>
            </select>
            <?php if (session()->has('errors.status')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.status') ?>
                </div>
            <?php endif ?>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="ktp_file">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="ktp_file" name="ktp" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="kk_file">Upload KK <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="kk_file" name="kk" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf">
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