<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Keterangan Usaha</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
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

    <form id="formSuratUsaha" action="<?= site_url('masyarakat/surat/usaha/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                id="nama" name="nama"
                value="<?= old('nama', $detail['nama'] ?? '') ?>" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.nik') ? 'is-invalid' : '' ?>"
                id="nik" name="nik"
                value="<?= old('nik', $detail['nik'] ?? '') ?>"
                required minlength="16" maxlength="16"
                pattern="\d{16}"
                oninput="this.value=this.value.replace(/\D/g,'')">
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.nik') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>"
                id="alamat" name="alamat" rows="2" required><?= old('alamat', $detail['alamat'] ?? '') ?></textarea>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="rt_rw">RT/RW <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.rt_rw') ? 'is-invalid' : '' ?>"
                id="rt_rw" name="rt_rw"
                placeholder="Contoh: 02/03"
                value="<?= old('rt_rw', $detail['rt_rw'] ?? '') ?>" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.rt_rw') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="desa">Desa <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.desa') ? 'is-invalid' : '' ?>"
                id="desa" name="desa"
                value="<?= old('desa', $detail['desa'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.desa') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.kecamatan') ? 'is-invalid' : '' ?>"
                id="kecamatan" name="kecamatan"
                value="<?= old('kecamatan', $detail['kecamatan'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.kecamatan') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.kabupaten') ? 'is-invalid' : '' ?>"
                id="kabupaten" name="kabupaten"
                value="<?= old('kabupaten', $detail['kabupaten'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.kabupaten') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.provinsi') ? 'is-invalid' : '' ?>"
                id="provinsi" name="provinsi"
                value="<?= old('provinsi', $detail['provinsi'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.provinsi') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nama_usaha">Nama Usaha <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.nama_usaha') ? 'is-invalid' : '' ?>"
                id="nama_usaha" name="nama_usaha"
                value="<?= old('nama_usaha', $detail['nama_usaha'] ?? '') ?>" required>
            <small class="form-text text-muted">Masukkan nama usaha yang dijalankan.</small>
            <div class="invalid-feedback"><?= session('errors.nama_usaha') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat_usaha">Alamat Usaha <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat_usaha') ? 'is-invalid' : '' ?>"
                id="alamat_usaha" name="alamat_usaha" rows="2" required><?= old('alamat_usaha', $detail['alamat_usaha'] ?? '') ?></textarea>
            <small class="form-text text-muted">Masukkan alamat lengkap lokasi usaha.</small>
            <div class="invalid-feedback"><?= session('errors.alamat_usaha') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="sejak_tahun">Sejak Tahun <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.sejak_tahun') ? 'is-invalid' : '' ?>"
                id="sejak_tahun" name="sejak_tahun"
                placeholder="Contoh: 2018"
                value="<?= old('sejak_tahun', $detail['sejak_tahun'] ?? '') ?>" required>
            <small class="form-text text-muted">Tahun mulai usaha dijalankan.</small>
            <div class="invalid-feedback"><?= session('errors.sejak_tahun') ?></div>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="ktp_file">Upload KTP<span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file"
                class="form-control-file <?= session('errors.ktp') ? 'is-invalid' : '' ?>"
                id="ktp_file" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
            <div class="invalid-feedback d-block"><?= session('errors.ktp') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kk_file">Upload KK <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file"
                class="form-control-file <?= session('errors.kk') ? 'is-invalid' : '' ?>"
                id="kk_file" name="kk" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/kk/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
            <div class="invalid-feedback d-block"><?= session('errors.kk') ?></div>
        </div>
        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>