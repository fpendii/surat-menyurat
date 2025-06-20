<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Domisili Bangunan</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/domisili-bangunan/update/' . $surat['id']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <h5 class="mt-3">Data Kepala Desa</h5>
        <input type="hidden" value="<?= $surat['no_surat'] ?? '' ?>" class="form-control" id="no_surat" name="no_surat">

        <div class="form-group mb-2">
            <label for="nama_kepala_desa">Nama Kepala Desa <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.nama_kepala_desa')) ? 'is-invalid' : '' ?>"
                   id="nama_kepala_desa"
                   name="nama_kepala_desa"
                   value="<?= old('nama_kepala_desa', $detail['nama_kepala_desa'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.nama_kepala_desa') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.jabatan')) ? 'is-invalid' : '' ?>"
                   id="jabatan"
                   name="jabatan"
                   value="<?= old('jabatan', $detail['jabatan'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.jabatan') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan">Kecamatan Kepala Desa <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.kecamatan')) ? 'is-invalid' : '' ?>"
                   id="kecamatan"
                   name="kecamatan"
                   value="<?= old('kecamatan', $detail['kecamatan'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.kecamatan') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten">Kabupaten Kepala Desa <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.kabupaten')) ? 'is-invalid' : '' ?>"
                   id="kabupaten"
                   name="kabupaten"
                   value="<?= old('kabupaten', $detail['kabupaten'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.kabupaten') ?>
            </div>
        </div>

        <h5 class="mt-4">Data Bangunan</h5>

        <div class="form-group mb-2">
            <label for="kantor">Nama Kantor/Bangunan <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.kantor')) ? 'is-invalid' : '' ?>"
                   id="kantor"
                   name="kantor"
                   value="<?= old('kantor', $detail['kantor'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.kantor') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat Bangunan <span class="text-danger">*</span></label>
            <textarea class="form-control <?= (session('errors.alamat')) ? 'is-invalid' : '' ?>"
                      id="alamat"
                      name="alamat"
                      rows="2"
                      required><?= old('alamat', $detail['alamat'] ?? '') ?></textarea>
            <div class="invalid-feedback">
                <?= session('errors.alamat') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="desa">Desa Bangunan <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.desa')) ? 'is-invalid' : '' ?>"
                   id="desa"
                   name="desa"
                   value="<?= old('desa', $detail['desa'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.desa') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan_desa">Kecamatan Bangunan <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.kecamatan_desa')) ? 'is-invalid' : '' ?>"
                   id="kecamatan_desa"
                   name="kecamatan_desa"
                   value="<?= old('kecamatan_desa', $detail['kecamatan_desa'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.kecamatan_desa') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten_desa">Kabupaten Bangunan <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.kabupaten_desa')) ? 'is-invalid' : '' ?>"
                   id="kabupaten_desa"
                   name="kabupaten_desa"
                   value="<?= old('kabupaten_desa', $detail['kabupaten_desa'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.kabupaten_desa') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="provinsi">Provinsi Bangunan <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.provinsi')) ? 'is-invalid' : '' ?>"
                   id="provinsi"
                   name="provinsi"
                   value="<?= old('provinsi', $detail['provinsi'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.provinsi') ?>
            </div>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <p class="text-muted">Isi hanya jika ingin mengganti file.</p>

        <div class="form-group mb-2">
            <label for="ktp">Upload KTP Penanggung Jawab <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a></small>
            <?php endif; ?>
            <?php if (session('errors.ktp')): ?>
                <div class="text-danger small mt-1"><?= session('errors.ktp') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK Penanggung Jawab <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/kk/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a></small>
            <?php endif; ?>
            <?php if (session('errors.kk')): ?>
                <div class="text-danger small mt-1"><?= session('errors.kk') ?></div>
            <?php endif; ?>
        </div>

        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>