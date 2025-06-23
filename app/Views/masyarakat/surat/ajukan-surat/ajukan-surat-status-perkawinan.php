<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kawin</h2>

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


    <form id="formSuratKawin" action="<?= site_url('masyarakat/surat/status-perkawinan/ajukan') ?>" enctype="multipart/form-data" method="POST">
        <?= csrf_field() ?>

        <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session()->has('errors.nama')) ? 'is-invalid' : '' ?>"
                id="nama"
                name="nama"
                value="<?= old('nama') ?>"
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
                value="<?= old('nik') ?>"
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
                value="<?= old('ttl') ?>"
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
                <option value="" <?= old('agama') == '' ? 'selected' : '' ?>>-- Pilih --</option>
                <option value="Islam" <?= old('agama') == 'Islam' ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= old('agama') == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= old('agama') == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= old('agama') == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                <option value="Budha" <?= old('agama') == 'Budha' ? 'selected' : '' ?>>Budha</option>
                <option value="Konghucu" <?= old('agama') == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
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
                required><?= old('alamat') ?></textarea>
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
                <option value="" <?= old('status') == '' ? 'selected' : '' ?>>-- Pilih --</option>
                <option value="Janda" <?= old('status') == 'Janda' ? 'selected' : '' ?>>Janda</option>
                <option value="Duda" <?= old('status') == 'Duda' ? 'selected' : '' ?>>Duda</option>
                <option value="Perjaka" <?= old('status') == 'Perjaka' ? 'selected' : '' ?>>Perjaka</option>
                <option value="Lajang" <?= old('status') == 'Lajang' ? 'selected' : '' ?>>Lajang</option>
                <option value="Menikah" <?= old('status') == 'Menikah' ? 'selected' : '' ?>>Menikah</option>
                <option value="Cerai Hidup" <?= old('status') == 'Cerai Hidup' ? 'selected' : '' ?>>Cerai Hidup</option>
                <option value="Cerai Mati" <?= old('status') == 'Cerai Mati' ? 'selected' : '' ?>>Cerai Mati</option>
            </select>
            <?php if (session()->has('errors.status')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.status') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group mb-2">
            <label for="ktp_file">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="ktp_file" name="ktp" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="form-group mb-2">
            <label for="kk_file">Upload KK <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="kk_file" name="kk" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>
        <a href="/masyarakat/surat" class="btn btn-secondary mt-3 text-white">Batal</a>
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
                <h6><strong>Detail Data Pemohon</strong></h6>
                <p><strong>Nama:</strong> <span id="preview_nama"></span></p>
                <p><strong>NIK:</strong> <span id="preview_nik"></span></p>
                <p><strong>Tempat / Tanggal Lahir:</strong> <span id="preview_ttl"></span></p>
                <p><strong>Agama:</strong> <span id="preview_agama"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>
                <p><strong>Status Perkawinan:</strong> <span id="preview_status"></span></p>

                <h6 class="mt-4"><strong>Dokumen Pendukung</strong></h6>
                <p><strong>KTP:</strong> <span id="preview_ktp_file"></span></p>
                <p><strong>KK:</strong> <span id="preview_kk_file"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Periksa Kembali</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Ya, Ajukan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirmationModal() {
        // Populate the modal with form data
        document.getElementById('preview_nama').textContent = document.getElementById('nama').value;
        document.getElementById('preview_nik').textContent = document.getElementById('nik').value;
        document.getElementById('preview_ttl').textContent = document.getElementById('ttl').value;
        document.getElementById('preview_agama').textContent = document.getElementById('agama').value;
        document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
        document.getElementById('preview_status').textContent = document.getElementById('status').value;

        const ktpFile = document.getElementById('ktp_file').files[0];
        const kkFile = document.getElementById('kk_file').files[0];
        document.getElementById('preview_ktp_file').textContent = ktpFile ? ktpFile.name : 'Belum ada file dipilih';
        document.getElementById('preview_kk_file').textContent = kkFile ? kkFile.name : 'Belum ada file dipilih';

        // Show the modal
        const confirmModal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
        confirmModal.show();
    }

    function submitForm() {
        // Submit the form
        document.getElementById('formSuratKawin').submit();
    }
</script>

<?= $this->endSection() ?>