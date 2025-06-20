<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Domisili Bangunan</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="bangunanForm" action="<?= site_url('masyarakat/surat/domisili-bangunan/ajukan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <h5 class="mt-3">Data Pejabat</h5>
        <div class="form-group mb-2">
            <label for="nama_kepala_desa">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" value="<?= old('nama_kepala_desa') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= old('jabatan') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan">kecamatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?= old('kecamatan') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?= old('kabupaten') ?>" required>
        </div>

        <h5 class="mt-3">Data Bangunan</h5>
        <div class="form-group mb-2">
            <label for="kantor"> Kantor <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kantor" name="kantor" value="<?= old('kantor') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= old('alamat') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="desa">Desa <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="desa" name="desa" value="<?= old('desa') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan_desa">Kecamatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kecamatan_desa" name="kecamatan_desa" value="<?= old('kecamatan_desa') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten_desa">Kabupaten <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kabupaten_desa" name="kabupaten_desa" value="<?= old('kabupaten_desa') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?= old('provinsi') ?>" required>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="ktp">Upload KTP Penanggung Jawab <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK Penanggung Jawab <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <a href="/masyarakat/surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="button" class="btn btn-primary mt-3" onclick="showConfirmationModal()">Ajukan Surat</button>
    </form>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Data Kepala Desa</strong></h6>
                <p><strong>Nama:</strong> <span id="preview_nama_kepala_desa"></span></p>
                <p><strong>Jabatan:</strong> <span id="preview_jabatan"></span></p>
                <p><strong>kecamatan_desa:</strong> <span id="preview_kecamatan"></span></p>
                <p><strong>Kabupaten_desa:</strong> <span id="preview_kabupaten"></span></p>

                <h6 class="mt-4"><strong>Data Bangunan</strong></h6>
                <p><strong>Kantor:</strong> <span id="preview_kantor"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>
                <p><strong>Desa:</strong> <span id="preview_desa"></span></p>
                <p><strong>kecamatan_desa:</strong> <span id="preview_kecamatan_desa"></span></p>
                <p><strong>Kabupaten_desa:</strong> <span id="preview_kabupaten_desa"></span></p>
                <p><strong>Provinsi:</strong> <span id="preview_provinsi"></span></p>
                <p><strong>KTP:</strong> <span id="preview_ktp"></span></p>
                <p><strong>KK:</strong> <span id="preview_kk"></span></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button class="btn btn-success" onclick="submitForm()">Ya, Ajukan</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirmationModal() {
        // Data Kepala Desa
        document.getElementById('preview_nama_kepala_desa').textContent = document.getElementById('nama_kepala_desa').value;
        document.getElementById('preview_jabatan').textContent = document.getElementById('jabatan').value;
        document.getElementById('preview_kecamatan').textContent = document.getElementById('kecamatan').value;
        document.getElementById('preview_kabupaten').textContent = document.getElementById('kabupaten').value;

        // Data Bangunan
        document.getElementById('preview_kantor').textContent = document.getElementById('kantor').value;
        document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
        document.getElementById('preview_desa').textContent = document.getElementById('desa').value;
        document.getElementById('preview_kecamatan_desa').textContent = document.getElementById('kecamatan_desa').value;
        document.getElementById('preview_kabupaten_desa').textContent = document.getElementById('kabupaten_desa').value;
        document.getElementById('preview_provinsi').textContent = document.getElementById('provinsi').value;

        // File
        const ktp = document.getElementById('ktp').files[0];
        const kk = document.getElementById('kk').files[0];
        document.getElementById('preview_ktp').textContent = ktp ? ktp.name : 'Belum dipilih';
        document.getElementById('preview_kk').textContent = kk ? kk.name : 'Belum dipilih';

        // Tampilkan modal
        const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
        modal.show();
    }

    function submitForm() {
        document.getElementById('bangunanForm').submit();
    }
</script>

<?= $this->endSection() ?>