<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Suami Istri</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="formSuamiIstri" action="<?= site_url('masyarakat/surat/suami-istri/ajukan') ?>" enctype="multipart/form-data" method="POST">
        <?= csrf_field() ?>

        <h5 class="mt-4">Data Suami</h5>
        <div class="form-group mb-2">
            <label for="nama_suami">Nama Suami <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.nama_suami')) ? 'is-invalid' : '' ?>"
                id="nama_suami"
                name="nama_suami"
                value="<?= old('nama_suami') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.nama_suami') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="ttl_suami">Tempat / Tanggal Lahir Suami <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.ttl_suami')) ? 'is-invalid' : '' ?>"
                id="ttl_suami"
                name="ttl_suami"
                value="<?= old('ttl_suami') ?>"
                placeholder="Contoh: Surabaya, 14 Februari 1990"
                required>
            <div class="invalid-feedback">
                <?= session('errors.ttl_suami') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="agama_suami">Agama Suami <span class="text-danger">*</span></label>
            <select class="form-control <?= (session('errors.agama_suami')) ? 'is-invalid' : '' ?>"
                id="agama_suami"
                name="agama_suami"
                required>
                <option value="">-- Pilih --</option>
                <?php
                $agama_options = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                foreach ($agama_options as $opt) : ?>
                    <option value="<?= $opt ?>" <?= old('agama_suami') === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
                <?= session('errors.agama_suami') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="status_sebelum_nikah_suami">Status Sebelum Nikah (Suami) <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.status_sebelum_nikah_suami')) ? 'is-invalid' : '' ?>"
                id="status_sebelum_nikah_suami"
                name="status_sebelum_nikah_suami"
                value="<?= old('status_sebelum_nikah_suami') ?>"
                placeholder="Contoh: Jejaka, Duda"
                required>
            <div class="invalid-feedback">
                <?= session('errors.status_sebelum_nikah_suami') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat_suami">Alamat Suami <span class="text-danger">*</span></label>
            <textarea class="form-control <?= (session('errors.alamat_suami')) ? 'is-invalid' : '' ?>"
                id="alamat_suami"
                name="alamat_suami"
                rows="3"
                required><?= old('alamat_suami') ?></textarea>
            <div class="invalid-feedback">
                <?= session('errors.alamat_suami') ?>
            </div>
        </div>

        <hr>

        <h5 class="mt-4">Data Istri</h5>
        <div class="form-group mb-2">
            <label for="nama_istri">Nama Istri <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.nama_istri')) ? 'is-invalid' : '' ?>"
                id="nama_istri"
                name="nama_istri"
                value="<?= old('nama_istri') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.nama_istri') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="ttl_istri">Tempat / Tanggal Lahir Istri <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.ttl_istri')) ? 'is-invalid' : '' ?>"
                id="ttl_istri"
                name="ttl_istri"
                value="<?= old('ttl_istri') ?>"
                placeholder="Contoh: Bandung, 5 Mei 1992"
                required>
            <div class="invalid-feedback">
                <?= session('errors.ttl_istri') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="agama_istri">Agama Istri <span class="text-danger">*</span></label>
            <select class="form-control <?= (session('errors.agama_istri')) ? 'is-invalid' : '' ?>"
                id="agama_istri"
                name="agama_istri"
                required>
                <option value="">-- Pilih --</option>
                <?php foreach ($agama_options as $opt) : ?>
                    <option value="<?= $opt ?>" <?= old('agama_istri') === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
                <?= session('errors.agama_istri') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="status_sebelum_nikah_istri">Status Sebelum Nikah (Istri) <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.status_sebelum_nikah_istri')) ? 'is-invalid' : '' ?>"
                id="status_sebelum_nikah_istri"
                name="status_sebelum_nikah_istri"
                value="<?= old('status_sebelum_nikah_istri') ?>"
                placeholder="Contoh: Perawan, Janda"
                required>
            <div class="invalid-feedback">
                <?= session('errors.status_sebelum_nikah_istri') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat_istri">Alamat Istri <span class="text-danger">*</span></label>
            <textarea class="form-control <?= (session('errors.alamat_istri')) ? 'is-invalid' : '' ?>"
                id="alamat_istri"
                name="alamat_istri"
                rows="3"
                required><?= old('alamat_istri') ?></textarea>
            <div class="invalid-feedback">
                <?= session('errors.alamat_istri') ?>
            </div>
        </div>

        <hr>

        <h5 class="mt-4">Data Pernikahan</h5>
        <div class="form-group mb-2">
            <label for="hari_nikah">Hari Nikah <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.hari_nikah')) ? 'is-invalid' : '' ?>"
                id="hari_nikah"
                name="hari_nikah"
                value="<?= old('hari_nikah') ?>"
                placeholder="Contoh: Minggu"
                required>
            <div class="invalid-feedback">
                <?= session('errors.hari_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="tbt_nikah">Tanggal / Bulan / Tahun Nikah <span class="text-danger">*</span></label>
            <input type="date"
                class="form-control <?= (session('errors.tbt_nikah')) ? 'is-invalid' : '' ?>"
                id="tbt_nikah"
                name="tbt_nikah"
                value="<?= old('tbt_nikah') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.tbt_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="tempat_akat_nikah">Tempat Akta Nikah <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.tempat_akat_nikah')) ? 'is-invalid' : '' ?>"
                id="tempat_akat_nikah"
                name="tempat_akat_nikah"
                value="<?= old('tempat_akat_nikah') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.tempat_akat_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="wali_nikah">Wali Nikah <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.wali_nikah')) ? 'is-invalid' : '' ?>"
                id="wali_nikah"
                name="wali_nikah"
                value="<?= old('wali_nikah') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.wali_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="mahar">Mahar <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.mahar')) ? 'is-invalid' : '' ?>"
                id="mahar"
                name="mahar"
                value="<?= old('mahar') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.mahar') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="saksi_nikah">Saksi Nikah <span class="text-danger">*</span></label>
            <textarea class="form-control <?= (session('errors.saksi_nikah')) ? 'is-invalid' : '' ?>"
                id="saksi_nikah"
                name="saksi_nikah"
                rows="2"
                placeholder="Contoh: Nama Saksi 1, Nama Saksi 2"
                required><?= old('saksi_nikah') ?></textarea>
            <div class="invalid-feedback">
                <?= session('errors.saksi_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="jumlah_anak">Jumlah Anak <span class="text-danger">*</span></label>
            <input type="number"
                class="form-control <?= (session('errors.jumlah_anak')) ? 'is-invalid' : '' ?>"
                id="jumlah_anak"
                name="jumlah_anak"
                value="<?= old('jumlah_anak') ?>"
                min="0"
                required>
            <div class="invalid-feedback">
                <?= session('errors.jumlah_anak') ?>
            </div>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="ktp_file">Upload KTP Suami & Istri (digabungkan) <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file"
                id="ktp_file"
                name="ktp"
                class="form-control-file <?= (session('errors.ktp')) ? 'is-invalid' : '' ?>"
                accept=".jpg,.jpeg,.png,.pdf"
                required>
            <div class="invalid-feedback">
                <?= session('errors.ktp') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="kk_file">Upload KK Suami & Istri (digabungkan) <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file"
                id="kk_file"
                name="kk"
                class="form-control-file <?= (session('errors.kk')) ? 'is-invalid' : '' ?>"
                accept=".jpg,.jpeg,.png,.pdf"
                required>
            <div class="invalid-feedback">
                <?= session('errors.kk') ?>
            </div>
        </div>
        <a href="/masyarakat/surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="button" class="btn btn-primary mt-3" onclick="showConfirmationModal()">Ajukan Surat</button>
    </form>
</div>

<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Data Pengajuan Surat Keterangan Suami Istri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Data Suami</strong></h6>
                <p><strong>Nama:</strong> <span id="preview_nama_suami"></span></p>
                <p><strong>Tempat / Tanggal Lahir:</strong> <span id="preview_ttl_suami"></span></p>
                <p><strong>Agama:</strong> <span id="preview_agama_suami"></span></p>
                <p><strong>Status Sebelum Nikah:</strong> <span id="preview_status_sebelum_nikah_suami"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat_suami"></span></p>
                <hr>
                <h6><strong>Data Istri</strong></h6>
                <p><strong>Nama:</strong> <span id="preview_nama_istri"></span></p>
                <p><strong>Tempat / Tanggal Lahir:</strong> <span id="preview_ttl_istri"></span></p>
                <p><strong>Agama:</strong> <span id="preview_agama_istri"></span></p>
                <p><strong>Status Sebelum Nikah:</strong> <span id="preview_status_sebelum_nikah_istri"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat_istri"></span></p>
                <hr>
                <h6><strong>Data Pernikahan</strong></h6>
                <p><strong>Hari Nikah:</strong> <span id="preview_hari_nikah"></span></p>
                <p><strong>Tanggal / Bulan / Tahun Nikah:</strong> <span id="preview_tbt_nikah"></span></p>
                <p><strong>Tempat Akta Nikah:</strong> <span id="preview_tempat_akat_nikah"></span></p>
                <p><strong>Wali Nikah:</strong> <span id="preview_wali_nikah"></span></p>
                <p><strong>Mahar:</strong> <span id="preview_mahar"></span></p>
                <p><strong>Saksi Nikah:</strong> <span id="preview_saksi_nikah"></span></p>
                <p><strong>Jumlah Anak:</strong> <span id="preview_jumlah_anak"></span></p>

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
        // Populate the modal with form data for Husband
        document.getElementById('preview_nama_suami').textContent = document.getElementById('nama_suami').value;
        document.getElementById('preview_ttl_suami').textContent = document.getElementById('ttl_suami').value;
        document.getElementById('preview_agama_suami').textContent = document.getElementById('agama_suami').value;
        document.getElementById('preview_status_sebelum_nikah_suami').textContent = document.getElementById('status_sebelum_nikah_suami').value;
        document.getElementById('preview_alamat_suami').textContent = document.getElementById('alamat_suami').value;

        // Populate the modal with form data for Wife
        document.getElementById('preview_nama_istri').textContent = document.getElementById('nama_istri').value;
        document.getElementById('preview_ttl_istri').textContent = document.getElementById('ttl_istri').value;
        document.getElementById('preview_agama_istri').textContent = document.getElementById('agama_istri').value;
        document.getElementById('preview_status_sebelum_nikah_istri').textContent = document.getElementById('status_sebelum_nikah_istri').value;
        document.getElementById('preview_alamat_istri').textContent = document.getElementById('alamat_istri').value;

        // Populate the modal with form data for Marriage Details
        document.getElementById('preview_hari_nikah').textContent = document.getElementById('hari_nikah').value;
        document.getElementById('preview_tbt_nikah').textContent = document.getElementById('tbt_nikah').value; // date input might need formatting for display
        document.getElementById('preview_tempat_akat_nikah').textContent = document.getElementById('tempat_akat_nikah').value;
        document.getElementById('preview_wali_nikah').textContent = document.getElementById('wali_nikah').value;
        document.getElementById('preview_mahar').textContent = document.getElementById('mahar').value;
        document.getElementById('preview_saksi_nikah').textContent = document.getElementById('saksi_nikah').value;
        document.getElementById('preview_jumlah_anak').textContent = document.getElementById('jumlah_anak').value;


        // Populate the modal with file names
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
        document.getElementById('formSuamiIstri').submit();
    }
</script>

<?= $this->endSection() ?>