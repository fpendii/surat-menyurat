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

    <!-- Catatan dari Kepala Desa -->
    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/usaha/update/' . $usaha['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="no_surat" value="<?= esc($surat['no_surat']) ?>">

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                id="nama" name="nama" value="<?= old('nama', $usaha['nama']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group">
            <label for="nik">NIK</label>
            <input
                type="text"
                class="form-control <?= session('errors.nik') ? 'is-invalid' : '' ?>"
                id="nik"
                name="nik"
                value="<?= old('nik', $usaha['nik']) ?>"
                required
                maxlength="16"
                pattern="\d{16}"
                title="NIK harus terdiri dari 16 digit angka"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16);">
            <div class="invalid-feedback"><?= session('errors.nik') ?></div>
        </div>


        <div class="form-group">
            <label for="alamat">Alamat Tempat Tinggal</label>
            <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>"
                id="alamat" name="alamat" rows="2" required><?= old('alamat', $usaha['alamat']) ?></textarea>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group">
            <label for="rt_rw">RT/RW</label>
            <input type="text" class="form-control <?= session('errors.rt_rw') ? 'is-invalid' : '' ?>"
                id="rt_rw" name="rt_rw" value="<?= old('rt_rw', $usaha['rt_rw']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.rt_rw') ?></div>
        </div>

        <div class="form-group">
            <label for="desa">Desa</label>
            <input type="text" class="form-control <?= session('errors.desa') ? 'is-invalid' : '' ?>"
                id="desa" name="desa" value="<?= old('desa', $usaha['desa']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.desa') ?></div>
        </div>

        <div class="form-group">
            <label for="kecamatan">Kecamatan</label>
            <input type="text" class="form-control <?= session('errors.kecamatan') ? 'is-invalid' : '' ?>"
                id="kecamatan" name="kecamatan" value="<?= old('kecamatan', $usaha['kecamatan']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.kecamatan') ?></div>
        </div>

        <div class="form-group">
            <label for="kabupaten">Kabupaten</label>
            <input type="text" class="form-control <?= session('errors.kabupaten') ? 'is-invalid' : '' ?>"
                id="kabupaten" name="kabupaten" value="<?= old('kabupaten', $usaha['kabupaten']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.kabupaten') ?></div>
        </div>

        <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <input type="text" class="form-control <?= session('errors.provinsi') ? 'is-invalid' : '' ?>"
                id="provinsi" name="provinsi" value="<?= old('provinsi', $usaha['provinsi']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.provinsi') ?></div>
        </div>

        <div class="form-group">
            <label for="nama_usaha">Nama Usaha</label>
            <input type="text" class="form-control <?= session('errors.nama_usaha') ? 'is-invalid' : '' ?>"
                id="nama_usaha" name="nama_usaha" value="<?= old('nama_usaha', $usaha['nama_usaha']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama_usaha') ?></div>
        </div>

        <div class="form-group">
            <label for="alamat_usaha">Alamat Usaha</label>
            <textarea class="form-control <?= session('errors.alamat_usaha') ? 'is-invalid' : '' ?>"
                id="alamat_usaha" name="alamat_usaha" rows="2" required><?= old('alamat_usaha', $usaha['alamat_usaha']) ?></textarea>
            <div class="invalid-feedback"><?= session('errors.alamat_usaha') ?></div>
        </div>

        <div class="form-group">
            <label for="sejak_tahun">Sejak Tahun</label>
            <input type="text" class="form-control <?= session('errors.sejak_tahun') ? 'is-invalid' : '' ?>"
                id="sejak_tahun" name="sejak_tahun" value="<?= old('sejak_tahun', $usaha['sejak_tahun']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.sejak_tahun') ?></div>
        </div>

        <div class="form-group">
            <label for="kk">Upload Kartu Keluarga (KK)</label>
            <input type="file" class="form-control-file <?= session('errors.kk') ? 'is-invalid' : '' ?>"
                id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf">
            <div class="invalid-feedback d-block"><?= session('errors.kk') ?></div>
            <?php if (!empty($usaha['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <?= esc($usaha['kk']) ?></small>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label for="ktp">Upload KTP</label>
            <input type="file" class="form-control-file <?= session('errors.ktp') ? 'is-invalid' : '' ?>"
                id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <div class="invalid-feedback d-block"><?= session('errors.ktp') ?></div>
            <?php if (!empty($usaha['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <?= esc($usaha['ktp']) ?></small>
            <?php endif ?>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>