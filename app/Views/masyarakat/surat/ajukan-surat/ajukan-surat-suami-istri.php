<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Suami Istri</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form id="formSuamiIstri" action="<?= site_url('masyarakat/surat/suami-istri/ajukan') ?>" enctype="multipart/form-data" method="POST">
        <?= csrf_field() ?>

        <h5 class="mt-4">Data Suami</h5>
        <div class="form-group mb-2">
            <label for="nama_suami">Nama Suami <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_suami" name="nama_suami" value="<?= old('nama_suami') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="nik_suami">NIK Suami <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control"
                id="nik_suami"
                name="nik_suami"
                value="<?= old('nik_suami') ?>"
                required
                minlength="16"
                maxlength="16"
                pattern="\d{16}"
                oninput="this.value = this.value.replace(/\D/g, '')">
        </div>

        <div class="form-group mb-2">
            <label for="ttl_suami">Tempat / Tanggal Lahir Suami <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl_suami" name="ttl_suami" value="<?= old('ttl_suami') ?>" placeholder="Contoh: Surabaya, 14 Februari 1990" required>
        </div>

        <div class="form-group mb-2">
            <label for="agama_suami">Agama Suami <span class="text-danger">*</span></label>
            <select class="form-control" id="agama_suami" name="agama_suami" required>
                <option value="">-- Pilih --</option>
                <?php
                $agama_options = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                foreach ($agama_options as $opt) : ?>
                    <option value="<?= $opt ?>" <?= old('agama_suami') === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="alamat_suami">Alamat Suami <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat_suami" name="alamat_suami" rows="3" required><?= old('alamat_suami') ?></textarea>
        </div>

        <hr>

        <h5 class="mt-4">Data Istri</h5>
        <div class="form-group mb-2">
            <label for="nama_istri">Nama Istri <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_istri" name="nama_istri" value="<?= old('nama_istri') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="nik_istri">NIK Istri <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control"
                id="nik_istri"
                name="nik_istri"
                value="<?= old('nik_istri') ?>"
                required
                minlength="16"
                maxlength="16"
                pattern="\d{16}"
                oninput="this.value = this.value.replace(/\D/g, '')">
        </div>

        <div class="form-group mb-2">
            <label for="ttl_istri">Tempat / Tanggal Lahir Istri <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl_istri" name="ttl_istri" value="<?= old('ttl_istri') ?>" placeholder="Contoh: Bandung, 5 Mei 1992" required>
        </div>

        <div class="form-group mb-2">
            <label for="agama_istri">Agama Istri <span class="text-danger">*</span></label>
            <select class="form-control" id="agama_istri" name="agama_istri" required>
                <option value="">-- Pilih --</option>
                <?php
                foreach ($agama_options as $opt) : // Re-using the $agama_options array from above
                ?>
                    <option value="<?= $opt ?>" <?= old('agama_istri') === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="alamat_istri">Alamat Istri <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat_istri" name="alamat_istri" rows="3" required><?= old('alamat_istri') ?></textarea>
        </div>

        <div class="form-group mb-2">
            <label for="ktp_file">Upload KTP <span class="text-danger">*</span></label>
            <input type="file" id="ktp_file" name="ktp" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="form-group mb-2">
            <label for="kk_file">Upload KK <span class="text-danger">*</span></label>
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
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Data Pengajuan Surat Keterangan Suami Istri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Data Suami</strong></h6>
                <p><strong>Nama:</strong> <span id="preview_nama_suami"></span></p>
                <p><strong>NIK:</strong> <span id="preview_nik_suami"></span></p>
                <p><strong>Tempat / Tanggal Lahir:</strong> <span id="preview_ttl_suami"></span></p>
                <p><strong>Agama:</strong> <span id="preview_agama_suami"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat_suami"></span></p>
                <hr>
                <h6><strong>Data Istri</strong></h6>
                <p><strong>Nama:</strong> <span id="preview_nama_istri"></span></p>
                <p><strong>NIK:</strong> <span id="preview_nik_istri"></span></p>
                <p><strong>Tempat / Tanggal Lahir:</strong> <span id="preview_ttl_istri"></span></p>
                <p><strong>Agama:</strong> <span id="preview_agama_istri"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat_istri"></span></p>

                <h6 class="mt-4"><strong>Dokumen Pendukung</strong></h6>
                <p><strong>KTP:</strong> <span id="preview_ktp_file"></span></p>
                <p><strong>KK:</strong> <span id="preview_kk_file"></span></p>
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
        // Populate the modal with form data for Husband
        document.getElementById('preview_nama_suami').textContent = document.getElementById('nama_suami').value;
        document.getElementById('preview_nik_suami').textContent = document.getElementById('nik_suami').value;
        document.getElementById('preview_ttl_suami').textContent = document.getElementById('ttl_suami').value;
        document.getElementById('preview_agama_suami').textContent = document.getElementById('agama_suami').value;
        document.getElementById('preview_alamat_suami').textContent = document.getElementById('alamat_suami').value;

        // Populate the modal with form data for Wife
        document.getElementById('preview_nama_istri').textContent = document.getElementById('nama_istri').value;
        document.getElementById('preview_nik_istri').textContent = document.getElementById('nik_istri').value;
        document.getElementById('preview_ttl_istri').textContent = document.getElementById('ttl_istri').value;
        document.getElementById('preview_agama_istri').textContent = document.getElementById('agama_istri').value;
        document.getElementById('preview_alamat_istri').textContent = document.getElementById('alamat_istri').value;

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