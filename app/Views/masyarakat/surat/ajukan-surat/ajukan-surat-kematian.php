<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kematian</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form id="formKematian" action="<?= site_url('masyarakat/surat/kematian/ajukan') ?>" enctype="multipart/form-data" method="POST">
        <?= csrf_field() ?>

        <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>"
                id="nama"
                name="nama"
                value="<?= old('nama') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.nama') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (session('errors.jenis_kelamin')) ? 'is-invalid' : '' ?>"
                id="jenis_kelamin"
                name="jenis_kelamin"
                required>
                <option value="">-- Pilih --</option>
                <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <div class="invalid-feedback">
                <?= session('errors.jenis_kelamin') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session('errors.ttl')) ? 'is-invalid' : '' ?>"
                id="ttl"
                name="ttl"
                placeholder="Contoh: Bandung, 10 Januari 2000"
                value="<?= old('ttl') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.ttl') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (session('errors.agama')) ? 'is-invalid' : '' ?>"
                id="agama"
                name="agama"
                required>
                <option value="">-- Pilih --</option>
                <option value="Islam" <?= old('agama') == 'Islam' ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= old('agama') == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= old('agama') == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= old('agama') == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                <option value="Budha" <?= old('agama') == 'Budha' ? 'selected' : '' ?>>Budha</option>
                <option value="Konghucu" <?= old('agama') == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
            </select>
            <div class="invalid-feedback">
                <?= session('errors.agama') ?>
            </div>
        </div>


        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea
                class="form-control <?= (session('errors.alamat')) ? 'is-invalid' : '' ?>"
                id="alamat"
                name="alamat"
                rows="2"
                required><?= old('alamat') ?></textarea>
            <div class="invalid-feedback">
                <?= session('errors.alamat') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="hari_tanggal">Hari / Tanggal Meninggal <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session('errors.hari_tanggal')) ? 'is-invalid' : '' ?>"
                id="hari_tanggal"
                name="hari_tanggal"
                placeholder="Contoh: Senin, 1 Januari 2024"
                value="<?= old('hari_tanggal') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.hari_tanggal') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="jam">Jam Meninggal <span class="text-danger">*</span></label>
            <input
                type="time"
                class="form-control <?= (session('errors.jam')) ? 'is-invalid' : '' ?>"
                id="jam"
                name="jam"
                value="<?= old('jam') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.jam') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="tempat">Tempat Meninggal <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session('errors.tempat')) ? 'is-invalid' : '' ?>"
                id="tempat"
                name="tempat"
                value="<?= old('tempat') ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.tempat') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="penyebab">Penyebab Kematian <span class="text-danger">*</span></label>
            <textarea
                class="form-control <?= (session('errors.penyebab')) ? 'is-invalid' : '' ?>"
                id="penyebab"
                name="penyebab"
                rows="2"
                required><?= old('penyebab') ?></textarea>
            <div class="invalid-feedback">
                <?= session('errors.penyebab') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="ktp">Upload KTP yang Meninggal <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="ktp" name="ktp" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK yang Meninggal<span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="kk" name="kk" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
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
                <h6><strong>Detail Data Almarhum/Almarhumah</strong></h6>
                <p><strong>Nama Lengkap:</strong> <span id="preview_nama"></span></p>
                <p><strong>Jenis Kelamin:</strong> <span id="preview_jenis_kelamin"></span></p>
                <p><strong>Tempat / Tanggal Lahir:</strong> <span id="preview_ttl"></span></p>
                <p><strong>Agama:</strong> <span id="preview_agama"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>
                <p><strong>Hari / Tanggal Meninggal:</strong> <span id="preview_hari_tanggal"></span></p>
                <p><strong>Jam Meninggal:</strong> <span id="preview_jam"></span></p>
                <p><strong>Tempat Meninggal:</strong> <span id="preview_tempat"></span></p>
                <p><strong>Penyebab Kematian:</strong> <span id="preview_penyebab"></span></p>

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
        // Populate the modal with form data
        document.getElementById('preview_nama').textContent = document.getElementById('nama').value;

        const jenisKelaminValue = document.getElementById('jenis_kelamin').value;
        document.getElementById('preview_jenis_kelamin').textContent = jenisKelaminValue === 'L' ? 'Laki-laki' : (jenisKelaminValue === 'P' ? 'Perempuan' : 'Belum dipilih');

        document.getElementById('preview_ttl').textContent = document.getElementById('ttl').value;
        document.getElementById('preview_agama').textContent = document.getElementById('agama').value;
        document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
        document.getElementById('preview_hari_tanggal').textContent = document.getElementById('hari_tanggal').value;
        document.getElementById('preview_jam').textContent = document.getElementById('jam').value;
        document.getElementById('preview_tempat').textContent = document.getElementById('tempat').value;
        document.getElementById('preview_penyebab').textContent = document.getElementById('penyebab').value;

        const ktpFile = document.getElementById('ktp').files[0];
        const kkFile = document.getElementById('kk').files[0];
        document.getElementById('preview_ktp_file').textContent = ktpFile ? ktpFile.name : 'Belum ada file dipilih';
        document.getElementById('preview_kk_file').textContent = kkFile ? kkFile.name : 'Belum ada file dipilih';

        // Show the modal
        const confirmModal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
        confirmModal.show();
    }

    function submitForm() {
        // Submit the form
        document.getElementById('formKematian').submit();
    }
</script>

<?= $this->endSection() ?>