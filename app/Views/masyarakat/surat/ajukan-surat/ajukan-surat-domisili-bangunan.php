<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Ajukan Surat Domisili Bangunan</h2>

  <form id="domisiliForm" action="<?= site_url('masyarakat/surat/domisili-bangunan/ajukan') ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="nama_gapoktan">Nama Gapoktan <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="nama_gapoktan" name="nama_gapoktan" required>
    </div>

    <div class="form-group">
      <label for="tgl_pembentukan">Tanggal Pembentukan <span class="text-danger">*</span></label>
      <input type="date" class="form-control" id="tgl_pembentukan" name="tgl_pembentukan" required>
    </div>

    <div class="form-group">
      <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="alamat" name="alamat" required>
    </div>

    <div class="form-group">
      <label for="ketua">Nama Ketua <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="ketua" name="ketua" required>
    </div>

    <div class="form-group">
      <label for="sekretaris">Nama Sekretaris <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="sekretaris" name="sekretaris" required>
    </div>

    <div class="form-group">
      <label for="bendahara">Nama Bendahara <span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="bendahara" name="bendahara" required>
    </div>

    <div class="form-group">
      <label for="ktp">Upload KTP <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
      <input type="file" class="form-control" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
    </div>

    <div class="form-group">
      <label for="kk">Upload KK <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
      <input type="file" class="form-control" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
    </div>

    <button type="button" class="btn btn-primary mt-3" onclick="showConfirmationModal()">Ajukan Surat Domisili</button>
  </form>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nama Gapoktan:</strong> <span id="preview_nama_gapoktan"></span></p>
        <p><strong>Tanggal Pembentukan:</strong> <span id="preview_tgl_pembentukan"></span></p>
        <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>
        <p><strong>Nama Ketua:</strong> <span id="preview_ketua"></span></p>
        <p><strong>Nama Sekretaris:</strong> <span id="preview_sekretaris"></span></p>
        <p><strong>Nama Bendahara:</strong> <span id="preview_bendahara"></span></p>
        <p><strong>File KTP:</strong> <span id="preview_ktp"></span></p>
        <p><strong>File KK:</strong> <span id="preview_kk"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-success" onclick="submitForm()">Ya, Ajukan</button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript Konfirmasi -->
<script>
  function showConfirmationModal() {
    document.getElementById('preview_nama_gapoktan').textContent = document.getElementById('nama_gapoktan').value;
    document.getElementById('preview_tgl_pembentukan').textContent = document.getElementById('tgl_pembentukan').value;
    document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
    document.getElementById('preview_ketua').textContent = document.getElementById('ketua').value;
    document.getElementById('preview_sekretaris').textContent = document.getElementById('sekretaris').value;
    document.getElementById('preview_bendahara').textContent = document.getElementById('bendahara').value;

    const ktpFile = document.getElementById('ktp').files[0];
    const kkFile = document.getElementById('kk').files[0];
    document.getElementById('preview_ktp').textContent = ktpFile ? ktpFile.name : 'Belum dipilih';
    document.getElementById('preview_kk').textContent = kkFile ? kkFile.name : 'Belum dipilih';

    const myModal = new bootstrap.Modal(document.getElementById('confirmModal'), {
      backdrop: 'static',
      keyboard: false
    });
    myModal.show();
  }

  function submitForm() {
    document.getElementById('domisiliForm').submit();
  }
</script>

<?= $this->endSection() ?>
