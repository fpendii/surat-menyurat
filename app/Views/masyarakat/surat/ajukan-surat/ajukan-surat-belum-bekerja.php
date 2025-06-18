<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Belum Bekerja</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="formBelumBekerja" action="<?= site_url('masyarakat/surat/belum-bekerja/ajukan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required>
        </div>

        <div class="form-group">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nik" name="nik" required maxlength="16" minlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit NIK">
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl" name="ttl" value="<?= old('ttl') ?>" placeholder="Contoh: Bandung, 10 Oktober 2001" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select class="form-control" id="agama" name="agama" required>
                <option value="">-- Pilih --</option>
                <?php
                $agamas = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                foreach ($agamas as $agama) :
                ?>
                    <option value="<?= $agama ?>" <?= old('agama') == $agama ? 'selected' : '' ?>><?= $agama ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group">
            <label for="status_pekerjaan">Status Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="status_pekerjaan" name="status_pekerjaan" value="<?= old('status_pekerjaan') ?>" placeholder="Contoh: Belum bekerja" required>
        </div>

        <div class="form-group">
            <label for="warga_negara">Warga Negara <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="warga_negara" name="warga_negara" value="<?= old('warga_negara') ?>" placeholder="Contoh: Indonesia" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat') ?></textarea>
        </div>

        <div class="form-group">
            <label for="ktp">Upload KTP <span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="form-group">
            <label for="kk">Upload Kartu Keluarga (KK) <span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Ajukan Surat</button>
    </form>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Pengajuan Surat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nama:</strong> <span id="preview_nama"></span></p>
        <p><strong>NIK:</strong> <span id="preview_nik"></span></p>
        <p><strong>TTL:</strong> <span id="preview_ttl"></span></p>
        <p><strong>Jenis Kelamin:</strong> <span id="preview_jk"></span></p>
        <p><strong>Agama:</strong> <span id="preview_agama"></span></p>
        <p><strong>Status Pekerjaan:</strong> <span id="preview_pekerjaan"></span></p>
        <p><strong>Warga Negara:</strong> <span id="preview_wni"></span></p>
        <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>
        <p class="text-danger">Pastikan semua data sudah benar sebelum dikirim!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Periksa Kembali</button>
        <button type="button" class="btn btn-success" id="submitForm">Ya, Ajukan!</button>
      </div>
    </div>
  </div>
</div>

<!-- Script Preview dan Submit Modal -->
<script>
document.getElementById('submitForm').addEventListener('click', function () {
    document.getElementById('formBelumBekerja').submit();
});

document.querySelector('[data-bs-target="#konfirmasiModal"]').addEventListener('click', function () {
    document.getElementById('preview_nama').innerText = document.getElementById('nama').value;
    document.getElementById('preview_nik').innerText = document.getElementById('nik').value;
    document.getElementById('preview_ttl').innerText = document.getElementById('ttl').value;
    document.getElementById('preview_jk').innerText = document.getElementById('jenis_kelamin').value;
    document.getElementById('preview_agama').innerText = document.getElementById('agama').value;
    document.getElementById('preview_pekerjaan').innerText = document.getElementById('status_pekerjaan').value;
    document.getElementById('preview_wni').innerText = document.getElementById('warga_negara').value;
    document.getElementById('preview_alamat').innerText = document.getElementById('alamat').value;
});
</script>

<?= $this->endSection() ?>
