<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kehilangan</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form id="formKehilangan" action="<?= site_url('masyarakat/surat/kehilangan/ajukan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.jenis_kelamin') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.ttl') ? 'is-invalid' : '' ?>" id="ttl" name="ttl" placeholder="Contoh: Bandung, 1 Januari 2000" value="<?= old('ttl') ?>" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.ttl') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nik') ? 'is-invalid' : '' ?>" id="nik" name="nik"
                value="<?= old('nik') ?>" required minlength="16" maxlength="16"
                pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')">
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.nik') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select class="form-control <?= session('errors.agama') ? 'is-invalid' : '' ?>" id="agama" name="agama" required>
                <option value="">-- Pilih --</option>
                <?php $list_agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']; ?>
                <?php foreach ($list_agama as $agama) : ?>
                    <option value="<?= $agama ?>" <?= old('agama') == $agama ? 'selected' : '' ?>><?= $agama ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.agama') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" rows="3" required><?= old('alamat') ?></textarea>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="barang_hilang">Barang yang Hilang <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.barang_hilang') ? 'is-invalid' : '' ?>" id="barang_hilang" name="barang_hilang" value="<?= old('barang_hilang') ?>" required>
            <small class="form-text text-muted">Contoh: Dompet, KTP, SIM, STNK, dll.</small>
            <div class="invalid-feedback"><?= session('errors.barang_hilang') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="keperluan">Keperluan Barang Hilang <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.keperluan') ? 'is-invalid' : '' ?>" id="keperluan" name="keperluan" rows="3" required><?= old('keperluan') ?></textarea>
            <small class="form-text text-muted">Tuliskan untuk keperluan apa surat kehilangan ini diperlukan.</small>
            <div class="invalid-feedback"><?= session('errors.keperluan') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="deskripsi_barang">Deskripsi Barang <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.deskripsi_barang') ? 'is-invalid' : '' ?>" id="deskripsi_barang" name="deskripsi_barang" rows="3" required><?= old('deskripsi_barang') ?></textarea>
            <small class="form-text text-muted">Tuliskan deskripsi barang yang hilang.</small>
            <div class="invalid-feedback"><?= session('errors.deskripsi_barang') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="ktp">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file <?= session('errors.ktp') ? 'is-invalid' : '' ?>" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback d-block"><?= session('errors.ktp') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK<span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file <?= session('errors.kk') ? 'is-invalid' : '' ?>" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback d-block"><?= session('errors.kk') ?></div>
        </div>


        <a href="/masyarakat/surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="button" class="btn btn-primary mt-3" onclick="showConfirmationModal()">
            Ajukan Surat
        </button>
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
                <p><strong>Jenis Kelamin:</strong> <span id="preview_jenis_kelamin"></span></p>
                <p><strong>Tempat / Tanggal Lahir:</strong> <span id="preview_ttl"></span></p>
                <p><strong>NIK:</strong> <span id="preview_nik"></span></p>
                <p><strong>Agama:</strong> <span id="preview_agama"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>
                <p><strong>Barang yang Hilang:</strong> <span id="preview_barang_hilang"></span></p>
                <p><strong>Keperluan:</strong> <span id="preview_keperluan"></span></p>
                <p><strong>Kartu Keluarga (KK):</strong> <span id="preview_kk_file"></span></p>
                <p><strong>Kartu Tanda Penduduk (KTP):</strong> <span id="preview_ktp_file"></span></p>
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
        document.getElementById('preview_jenis_kelamin').textContent = document.getElementById('jenis_kelamin').value;
        document.getElementById('preview_ttl').textContent = document.getElementById('ttl').value;
        document.getElementById('preview_nik').textContent = document.getElementById('nik').value;
        document.getElementById('preview_agama').textContent = document.getElementById('agama').value;
        document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
        document.getElementById('preview_barang_hilang').textContent = document.getElementById('barang_hilang').value;
        document.getElementById('preview_keperluan').textContent = document.getElementById('keperluan').value;

        const kkFile = document.getElementById('kk').files[0];
        const ktpFile = document.getElementById('ktp').files[0];
        document.getElementById('preview_kk_file').textContent = kkFile ? kkFile.name : 'Belum ada file dipilih';
        document.getElementById('preview_ktp_file').textContent = ktpFile ? ktpFile.name : 'Belum ada file dipilih';

        // Show the modal
        const confirmModal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
        confirmModal.show();
    }

    function submitForm() {
        // Submit the form
        document.getElementById('formKehilangan').submit();
    }
</script>

<?= $this->endSection() ?>