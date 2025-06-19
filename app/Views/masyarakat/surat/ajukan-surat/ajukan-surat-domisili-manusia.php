<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Ajukan Surat Domisili Warga</h2>

  <?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
          <li><?= esc($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form id="domisiliForm" action="<?= site_url('masyarakat/surat/domisili-bangunan/ajukan') ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <h5 class="mt-3">Data Kepala Desa</h5>
    <div class="form-group mb-2">
      <label for="nama_pejabat">Nama<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="nama_pejabat" name="nama_pejabat" value="<?= old('nama_pejabat') ?>" required>
    </div>

    <div class="form-group mb-2">
      <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= old('jabatan') ?>" required>
    </div>

    <div class="form-group mb-2">
      <label for="kecamatan_pejabat">Kecamatan <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="kecamatan_pejabat" name="kecamatan_pejabat" value="<?= old('kecamatan_pejabat') ?>" required>
    </div>

    <div class="form-group mb-2">
      <label for="kabupaten_pejabat">Kabupaten <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="kabupaten_pejabat" name="kabupaten_pejabat" value="<?= old('kabupaten_pejabat') ?>" required>
    </div>

    <h5 class="mt-3">Data Warga</h5>
    <div class="form-group mb-2">
      <label for="nama_warga">Nama<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="nama_warga" name="nama_warga" value="<?= old('nama_warga') ?>" required>
    </div>

    <div class="form-group mb-2">
      <label for="nik">NIK <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="nik" name="nik" value="<?= old('nik') ?>" required
        pattern="\d{16}" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
      <small class="text-muted"></small>
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
      <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?= old('kecamatan') ?>" required>
    </div>

    <div class="form-group mb-2">
      <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?= old('kabupaten') ?>" required>
    </div>

    <div class="form-group mb-2">
      <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?= old('provinsi') ?>" required>
    </div>

    <div class="form-group mb-2">
      <label for="ktp">Upload KTP <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
      <input type="file" class="form-control" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
    </div>

    <div class="form-group mb-2">
      <label for="kk">Upload KK <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
      <input type="file" class="form-control" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
    </div>

    <button type="button" class="btn btn-primary mt-3" onclick="showConfirmationModal()">Ajukan Surat</button>
  </form>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Data Pengajuan Surat Domisili</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <h6><strong>Data Kepala Desa</strong></h6>
        <p><strong>Nama:</strong> <span id="preview_nama_pejabat"></span></p>
        <p><strong>Jabatan:</strong> <span id="preview_jabatan"></span></p>
        <p><strong>Kecamatan:</strong> <span id="preview_kecamatan_pejabat"></span></p>
        <p><strong>Kabupaten:</strong> <span id="preview_kabupaten_pejabat"></span></p>

        <h6 class="mt-4"><strong>Data Warga</strong></h6>
        <p><strong>Nama:</strong> <span id="preview_nama_warga"></span></p>
        <p><strong>NIK:</strong> <span id="preview_nik"></span></p>
        <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>
        <p><strong>Desa:</strong> <span id="preview_desa"></span></p>
        <p><strong>Kecamatan:</strong> <span id="preview_kecamatan"></span></p>
        <p><strong>Kabupaten:</strong> <span id="preview_kabupaten"></span></p>
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
    document.getElementById('preview_nama_pejabat').textContent = document.getElementById('nama_pejabat').value;
    document.getElementById('preview_jabatan').textContent = document.getElementById('jabatan').value;
    document.getElementById('preview_kecamatan_pejabat').textContent = document.getElementById('kecamatan_pejabat').value;
    document.getElementById('preview_kabupaten_pejabat').textContent = document.getElementById('kabupaten_pejabat').value;

    // Data Warga
    document.getElementById('preview_nama_warga').textContent = document.getElementById('nama_warga').value;
    document.getElementById('preview_nik').textContent = document.getElementById('nik').value;
    document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
    document.getElementById('preview_desa').textContent = document.getElementById('desa').value;
    document.getElementById('preview_kecamatan').textContent = document.getElementById('kecamatan').value;
    document.getElementById('preview_kabupaten').textContent = document.getElementById('kabupaten').value;
    document.getElementById('preview_provinsi').textContent = document.getElementById('provinsi').value;

    const ktp = document.getElementById('ktp').files[0];
    const kk = document.getElementById('kk').files[0];
    document.getElementById('preview_ktp').textContent = ktp ? ktp.name : 'Belum dipilih';
    document.getElementById('preview_kk').textContent = kk ? kk.name : 'Belum dipilih';

    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    modal.show();
  }

  function submitForm() {
    document.getElementById('domisiliForm').submit();
  }
</script>

<?= $this->endSection() ?>