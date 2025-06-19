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

    <form id="formSuratUsaha" action="<?= site_url('masyarakat/surat/usaha/ajukan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>"
                id="nama" name="nama"
                value="<?= old('nama') ?>" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.nik') ? 'is-invalid' : '' ?>"
                id="nik" name="nik"
                value="<?= old('nik') ?>"
                required minlength="16" maxlength="16"
                pattern="\d{16}"
                oninput="this.value=this.value.replace(/\D/g,'')">
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.nik') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>"
                id="alamat" name="alamat" rows="2" required><?= old('alamat') ?></textarea>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="rt_rw">RT/RW <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.rt_rw') ? 'is-invalid' : '' ?>"
                id="rt_rw" name="rt_rw"
                placeholder="Contoh: 02/03"
                value="<?= old('rt_rw') ?>" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.rt_rw') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="desa">Desa <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.desa') ? 'is-invalid' : '' ?>"
                id="desa" name="desa"
                value="<?= old('desa') ?>" required>
            <div class="invalid-feedback"><?= session('errors.desa') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.kecamatan') ? 'is-invalid' : '' ?>"
                id="kecamatan" name="kecamatan"
                value="<?= old('kecamatan') ?>" required>
            <div class="invalid-feedback"><?= session('errors.kecamatan') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.kabupaten') ? 'is-invalid' : '' ?>"
                id="kabupaten" name="kabupaten"
                value="<?= old('kabupaten') ?>" required>
            <div class="invalid-feedback"><?= session('errors.kabupaten') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.provinsi') ? 'is-invalid' : '' ?>"
                id="provinsi" name="provinsi"
                value="<?= old('provinsi') ?>" required>
            <div class="invalid-feedback"><?= session('errors.provinsi') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nama_usaha">Nama Usaha <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.nama_usaha') ? 'is-invalid' : '' ?>"
                id="nama_usaha" name="nama_usaha"
                value="<?= old('nama_usaha') ?>" required>
            <small class="form-text text-muted">Masukkan nama usaha yang dijalankan.</small>
            <div class="invalid-feedback"><?= session('errors.nama_usaha') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat_usaha">Alamat Usaha <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat_usaha') ? 'is-invalid' : '' ?>"
                id="alamat_usaha" name="alamat_usaha" rows="2" required><?= old('alamat_usaha') ?></textarea>
            <small class="form-text text-muted">Masukkan alamat lengkap lokasi usaha.</small>
            <div class="invalid-feedback"><?= session('errors.alamat_usaha') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="sejak_tahun">Sejak Tahun <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= session('errors.sejak_tahun') ? 'is-invalid' : '' ?>"
                id="sejak_tahun" name="sejak_tahun"
                placeholder="Contoh: 2018"
                value="<?= old('sejak_tahun') ?>" required>
            <small class="form-text text-muted">Tahun mulai usaha dijalankan.</small>
            <div class="invalid-feedback"><?= session('errors.sejak_tahun') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="ktp_file">Upload KTP<span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file"
                class="form-control-file <?= session('errors.ktp') ? 'is-invalid' : '' ?>"
                id="ktp_file" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback d-block"><?= session('errors.ktp') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kk_file">Upload KK <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file"
                class="form-control-file <?= session('errors.kk') ? 'is-invalid' : '' ?>"
                id="kk_file" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback d-block"><?= session('errors.kk') ?></div>
        </div>

        <button type="button" class="btn btn-primary mt-3" onclick="showConfirmationModal()">Ajukan Surat</button>
    </form>
</div>

<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Data Pemohon</strong></h6>
                <p><strong>Nama:</strong> <span id="preview_nama"></span></p>
                <p><strong>NIK:</strong> <span id="preview_nik"></span></p>
                <p><strong>Alamat Tempat Tinggal:</strong> <span id="preview_alamat"></span></p>
                <p><strong>RT/RW:</strong> <span id="preview_rt_rw"></span></p>
                <p><strong>Desa:</strong> <span id="preview_desa"></span></p>
                <p><strong>Kecamatan:</strong> <span id="preview_kecamatan"></span></p>
                <p><strong>Kabupaten:</strong> <span id="preview_kabupaten"></span></p>
                <p><strong>Provinsi:</strong> <span id="preview_provinsi"></span></p>

                <h6 class="mt-4"><strong>Data Usaha</strong></h6>
                <p><strong>Nama Usaha:</strong> <span id="preview_nama_usaha"></span></p>
                <p><strong>Alamat Usaha:</strong> <span id="preview_alamat_usaha"></span></p>
                <p><strong>Sejak Tahun:</strong> <span id="preview_sejak_tahun"></span></p>

                <h6 class="mt-4"><strong>Dokumen Pendukung</strong></h6>
                <p><strong>Kartu Tanda Penduduk:</strong> <span id="preview_ktp_file"></span></p>
                <p><strong>Kartu Keluarga:</strong> <span id="preview_kk_file"></span></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Ya, Ajukan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirmationModal() {
        // Populate applicant data
        document.getElementById('preview_nama').textContent = document.getElementById('nama').value;
        document.getElementById('preview_nik').textContent = document.getElementById('nik').value;
        document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
        document.getElementById('preview_rt_rw').textContent = document.getElementById('rt_rw').value;
        document.getElementById('preview_desa').textContent = document.getElementById('desa').value;
        document.getElementById('preview_kecamatan').textContent = document.getElementById('kecamatan').value;
        document.getElementById('preview_kabupaten').textContent = document.getElementById('kabupaten').value;
        document.getElementById('preview_provinsi').textContent = document.getElementById('provinsi').value;

        // Populate business data
        document.getElementById('preview_nama_usaha').textContent = document.getElementById('nama_usaha').value;
        document.getElementById('preview_alamat_usaha').textContent = document.getElementById('alamat_usaha').value;
        document.getElementById('preview_sejak_tahun').textContent = document.getElementById('sejak_tahun').value;

        // Populate file names
        const kkFile = document.getElementById('kk_file').files[0];
        const ktpFile = document.getElementById('ktp_file').files[0];
        document.getElementById('preview_kk_file').textContent = kkFile ? kkFile.name : 'Belum ada file dipilih';
        document.getElementById('preview_ktp_file').textContent = ktpFile ? ktpFile.name : 'Belum ada file dipilih';

        // Show the modal
        const confirmModal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
        confirmModal.show();
    }

    function submitForm() {
        // Submit the form
        document.getElementById('formSuratUsaha').submit();
    }
</script>

<?= $this->endSection() ?>