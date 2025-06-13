<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Usaha</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form action="<?= site_url('masyarakat/surat/usaha/ajukan') ?>"  method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                id="nama" name="nama"
                value="<?= old('nama') ?>" required>
            <small class="form-text text-muted">Masukkan nama lengkap sesuai KTP.</small>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.nik') ? 'is-invalid' : '' ?>"
                id="nik" name="nik"
                value="<?= old('nik') ?>"
                required minlength="16" maxlength="16"
                pattern="\d{16}"
                oninput="this.value=this.value.replace(/\D/g,'')">
            <small class="form-text text-muted">Masukkan 16 digit angka.</small>
            <div class="invalid-feedback"><?= session('errors.nik') ?></div>
        </div>


        <div class="form-group">
            <label for="alamat">Alamat Tempat Tinggal <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>"
                id="alamat" name="alamat" rows="2" required><?= old('alamat') ?></textarea>
            <small class="form-text text-muted">Tulis alamat sesuai KTP.</small>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group">
            <label for="rt_rw">RT/RW <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.rt_rw') ? 'is-invalid' : '' ?>"
                id="rt_rw" name="rt_rw"
                placeholder="Contoh: 02/03"
                value="<?= old('rt_rw') ?>" required>
            <small class="form-text text-muted">Masukkan format RT/RW dengan benar.</small>
            <div class="invalid-feedback"><?= session('errors.rt_rw') ?></div>
        </div>

        <div class="form-group">
            <label for="desa">Desa <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.desa') ? 'is-invalid' : '' ?>"
                id="desa" name="desa"
                value="<?= old('desa') ?>" required>
            <div class="invalid-feedback"><?= session('errors.desa') ?></div>
        </div>

        <div class="form-group">
            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.kecamatan') ? 'is-invalid' : '' ?>"
                id="kecamatan" name="kecamatan"
                value="<?= old('kecamatan') ?>" required>
            <div class="invalid-feedback"><?= session('errors.kecamatan') ?></div>
        </div>

        <div class="form-group">
            <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.kabupaten') ? 'is-invalid' : '' ?>"
                id="kabupaten" name="kabupaten"
                value="<?= old('kabupaten') ?>" required>
            <div class="invalid-feedback"><?= session('errors.kabupaten') ?></div>
        </div>

        <div class="form-group">
            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.provinsi') ? 'is-invalid' : '' ?>"
                id="provinsi" name="provinsi"
                value="<?= old('provinsi') ?>" required>
            <div class="invalid-feedback"><?= session('errors.provinsi') ?></div>
        </div>

        <div class="form-group">
            <label for="nama_usaha">Nama Usaha <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.nama_usaha') ? 'is-invalid' : '' ?>"
                id="nama_usaha" name="nama_usaha"
                value="<?= old('nama_usaha') ?>" required>
            <small class="form-text text-muted">Masukkan nama usaha yang dijalankan.</small>
            <div class="invalid-feedback"><?= session('errors.nama_usaha') ?></div>
        </div>

        <div class="form-group">
            <label for="alamat_usaha">Alamat Usaha <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat_usaha') ? 'is-invalid' : '' ?>"
                id="alamat_usaha" name="alamat_usaha" rows="2" required><?= old('alamat_usaha') ?></textarea>
            <small class="form-text text-muted">Masukkan alamat lengkap lokasi usaha.</small>
            <div class="invalid-feedback"><?= session('errors.alamat_usaha') ?></div>
        </div>

        <div class="form-group">
            <label for="sejak_tahun">Sejak Tahun <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.sejak_tahun') ? 'is-invalid' : '' ?>"
                id="sejak_tahun" name="sejak_tahun"
                placeholder="Contoh: 2018"
                value="<?= old('sejak_tahun') ?>" required>
            <small class="form-text text-muted">Tahun mulai usaha dijalankan.</small>
            <div class="invalid-feedback"><?= session('errors.sejak_tahun') ?></div>
        </div>

        <div class="form-group">
            <label for="kk">Upload Kartu Keluarga (KK) <span class="text-danger">*</span></label>
            <input type="file"
                class="form-control-file <?= session('errors.kk') ? 'is-invalid' : '' ?>"
                id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
            <small class="form-text text-muted">Unggah file KK dalam format JPG, JPEG, PNG, atau PDF (maksimal 2MB).</small>
            <div class="invalid-feedback d-block"><?= session('errors.kk') ?></div>
        </div>

        <div class="form-group">
            <label for="ktp">Upload Kartu Tanda Penduduk (KTP) <span class="text-danger">*</span></label>
            <input type="file"
                class="form-control-file <?= session('errors.ktp') ? 'is-invalid' : '' ?>"
                id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
            <small class="form-text text-muted">Unggah file KTP dalam format JPG, JPEG, PNG, atau PDF (maksimal 2MB).</small>
            <div class="invalid-feedback d-block"><?= session('errors.ktp') ?></div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>