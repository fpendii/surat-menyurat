<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Kematian</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="kematianForm" action="<?= site_url('masyarakat/surat/kematian/ajukan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <h5 class="mt-3">Data Almarhum/Almarhumah</h5>
        <div class="form-group mb-2">
            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl" name="ttl" value="<?= old('ttl') ?>" placeholder="Contoh: Banjarmasin, 17 Agustus 1945" required>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="agama" name="agama" value="<?= old('agama') ?>" required>
        </div>

        <h5 class="mt-3">Detail Kematian</h5>
        <div class="form-group mb-2">
            <label for="hari_tanggal">Hari, Tanggal Kematian <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="hari_tanggal" name="hari_tanggal" value="<?= old('hari_tanggal') ?>" placeholder="Contoh: Jumat, 10 Juni 2025" required>
        </div>

        <div class="form-group mb-2">
            <label for="jam">Jam Kematian <span class="text-danger">*</span></label>
            <input type="time" class="form-control" id="jam" name="jam" value="<?= old('jam') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="tempat">Tempat Kematian <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tempat" name="tempat" value="<?= old('tempat') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="penyebab">Penyebab Kematian <span class="text-danger">*</span></label>
            <textarea class="form-control" id="penyebab" name="penyebab" rows="3" required><?= old('penyebab') ?></textarea>
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
                <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Data Pengajuan Surat Kematian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Data Almarhum/Almarhumah</strong></h6>
                <p><strong>Nama Lengkap:</strong> <span id="preview_nama"></span></p>
                <p><strong>Jenis Kelamin:</strong> <span id="preview_jenis_kelamin"></span></p>
                <p><strong>Tempat, Tanggal Lahir:</strong> <span id="preview_ttl"></span></p>
                <p><strong>Agama:</strong> <span id="preview_agama"></span></p>

                <h6 class="mt-4"><strong>Detail Kematian</strong></h6>
                <p><strong>Hari, Tanggal Kematian:</strong> <span id="preview_hari_tanggal"></span></p>
                <p><strong>Jam Kematian:</strong> <span id="preview_jam"></span></p>
                <p><strong>Tempat Kematian:</strong> <span id="preview_tempat"></span></p>
                <p><strong>Penyebab Kematian:</strong> <span id="preview_penyebab"></span></p>

                <h6 class="mt-4"><strong>Dokumen Pendukung</strong></h6>
                <p><strong>KTP</strong> <span id="preview_ktp_file"></span></p>
                <p><strong>KK</strong> <span id="preview_kk_file"></span></p>
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
        // Data Almarhum/Almarhumah
        document.getElementById('preview_nama').textContent = document.getElementById('nama').value;
        document.getElementById('preview_jenis_kelamin').textContent = document.getElementById('jenis_kelamin').value;
        document.getElementById('preview_ttl').textContent = document.getElementById('ttl').value;
        document.getElementById('preview_agama').textContent = document.getElementById('agama').value;

        // Detail Kematian
        document.getElementById('preview_hari_tanggal').textContent = document.getElementById('hari_tanggal').value;
        document.getElementById('preview_jam').textContent = document.getElementById('jam').value;
        document.getElementById('preview_tempat').textContent = document.getElementById('tempat').value;
        document.getElementById('preview_penyebab').textContent = document.getElementById('penyebab').value;


        // File preview
        const ktpFile = document.getElementById('ktp').files[0];
        const kkFile = document.getElementById('kk').files[0];
        document.getElementById('preview_ktp_file').textContent = ktpFile ? ktpFile.name : 'Belum ada file dipilih';
        document.getElementById('preview_kk_file').textContent = kkFile ? kkFile.name : 'Belum ada file dipilih';

        // Tampilkan modal
        new bootstrap.Modal(document.getElementById('confirmModal')).show();
    }

    function submitForm() {
        document.getElementById('kematianForm').submit();
    }
</script>

<?= $this->endSection() ?>