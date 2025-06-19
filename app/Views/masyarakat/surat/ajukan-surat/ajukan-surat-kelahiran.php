<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kelahiran</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form id="formKelahiran" action="<?= site_url('masyarakat/surat/kelahiran/ajukan') ?>" enctype="multipart/form-data" method="POST">
        <?= csrf_field() ?>

        <div class="form-group mb-2">
            <label for="nama">Nama<span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.ttl') ? 'is-invalid' : '' ?>" id="ttl" name="ttl" placeholder="Contoh: Bandung, 12 Mei 2023" value="<?= old('ttl') ?>" required>
            <div class="invalid-feedback"><?= session('errors.ttl') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <div class="invalid-feedback"><?= session('errors.jenis_kelamin') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.pekerjaan') ? 'is-invalid' : '' ?>" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan') ?>" required>
            <div class="invalid-feedback"><?= session('errors.pekerjaan') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" rows="2" required><?= old('alamat') ?></textarea>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nama_ayah">Nama Ayah Kandung <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama_ayah') ? 'is-invalid' : '' ?>" id="nama_ayah" name="nama_ayah" value="<?= old('nama_ayah') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama_ayah') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nama_ibu">Nama Ibu Kandung <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama_ibu') ? 'is-invalid' : '' ?>" id="nama_ibu" name="nama_ibu" value="<?= old('nama_ibu') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama_ibu') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="anak_ke">Anak Ke- <span class="text-danger">*</span></label>
            <input type="number" class="form-control <?= session('errors.anak_ke') ? 'is-invalid' : '' ?>" id="anak_ke" name="anak_ke" min="1" value="<?= old('anak_ke') ?>" required>
            <div class="invalid-feedback"><?= session('errors.anak_ke') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="ktp">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="ktp" name="ktp" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
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
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Data Pengajuan Surat Kelahiran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Detail Data Anak</strong></h6>
                <p><strong>Nama Lengkap:</strong> <span id="preview_nama"></span></p>
                <p><strong>Tempat / Tanggal Lahir:</strong> <span id="preview_ttl"></span></p>
                <p><strong>Jenis Kelamin:</strong> <span id="preview_jenis_kelamin"></span></p>
                <p><strong>Anak Ke-:</strong> <span id="preview_anak_ke"></span></p>

                <h6 class="mt-4"><strong>Detail Data Orang Tua</strong></h6>
                <p><strong>Nama Ayah Kandung:</strong> <span id="preview_nama_ayah"></span></p>
                <p><strong>Nama Ibu Kandung:</strong> <span id="preview_nama_ibu"></span></p>
                <p><strong>Pekerjaan:</strong> <span id="preview_pekerjaan"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>

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
        document.getElementById('preview_ttl').textContent = document.getElementById('ttl').value;

        // Convert gender code to full text for preview
        const jenisKelaminValue = document.getElementById('jenis_kelamin').value;
        document.getElementById('preview_jenis_kelamin').textContent = jenisKelaminValue === 'L' ? 'Laki-laki' : (jenisKelaminValue === 'P' ? 'Perempuan' : 'Belum dipilih');

        document.getElementById('preview_pekerjaan').textContent = document.getElementById('pekerjaan').value;
        document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
        document.getElementById('preview_nama_ayah').textContent = document.getElementById('nama_ayah').value;
        document.getElementById('preview_nama_ibu').textContent = document.getElementById('nama_ibu').value;
        document.getElementById('preview_anak_ke').textContent = document.getElementById('anak_ke').value;

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
        document.getElementById('formKelahiran').submit();
    }
</script>

<?= $this->endSection() ?>