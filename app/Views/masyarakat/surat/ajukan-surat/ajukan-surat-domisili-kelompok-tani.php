<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Ajukan Surat Domisili Kelompok Tani</h2>

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

    <div class="form-group mb-2">
      <label for="nama_gapoktan">Nama Kelompok Tani <span class="text-danger">*</span></label>
      <input type="text" class="form-control <?= (session('errors.nama_gapoktan')) ? 'is-invalid' : '' ?>" id="nama_gapoktan" name="nama_gapoktan" value="<?= old('nama_gapoktan') ?>" required>
      <div class="invalid-feedback"><?= session('errors.nama_gapoktan') ?></div>
    </div>

    <div class="form-group mb-2">
      <label for="tgl_pembentukan">Tanggal Pembentukan Kelompok Tani <span class="text-danger">*</span></label>
      <input type="date" class="form-control <?= (session('errors.tgl_pembentukan')) ? 'is-invalid' : '' ?>" id="tgl_pembentukan" name="tgl_pembentukan" value="<?= old('tgl_pembentukan') ?>" required>
      <div class="invalid-feedback"><?= session('errors.tgl_pembentukan') ?></div>
    </div>

    <script>
      const today = new Date().toISOString().split('T')[0];
      document.getElementById("tgl_pembentukan").setAttribute("max", today);
    </script>

    <div class="form-group mb-2">
      <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
      <input type="text" class="form-control <?= (session('errors.alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" value="<?= old('alamat') ?>" required>
      <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
    </div>

    <div class="form-group mb-2">
      <label for="ketua">Nama Ketua <span class="text-danger">*</span></label>
      <input type="text" class="form-control <?= (session('errors.ketua')) ? 'is-invalid' : '' ?>" id="ketua" name="ketua" value="<?= old('ketua') ?>" required>
      <div class="invalid-feedback"><?= session('errors.ketua') ?></div>
    </div>

    <div class="form-group mb-2">
      <label for="sekretaris">Nama Sekretaris <span class="text-danger">*</span></label>
      <input type="text" class="form-control <?= (session('errors.sekretaris')) ? 'is-invalid' : '' ?>" id="sekretaris" name="sekretaris" value="<?= old('sekretaris') ?>" required>
      <div class="invalid-feedback"><?= session('errors.sekretaris') ?></div>
    </div>

    <div class="form-group mb-2">
      <label for="bendahara">Nama Bendahara <span class="text-danger">*</span></label>
      <input type="text" class="form-control <?= (session('errors.bendahara')) ? 'is-invalid' : '' ?>" id="bendahara" name="bendahara" value="<?= old('bendahara') ?>" required>
      <div class="invalid-feedback"><?= session('errors.bendahara') ?></div>
    </div>

    <div class="form-group mb-2">
      <label for="ktp">Upload KTP Ketua <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
      <input type="file" class="form-control <?= (session('errors.ktp')) ? 'is-invalid' : '' ?>" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
      <div class="invalid-feedback"><?= session('errors.ktp') ?></div>
    </div>

    <div class="form-group mb-2">
      <label for="kk">Upload KK Ketua <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
      <input type="file" class="form-control <?= (session('errors.kk')) ? 'is-invalid' : '' ?>" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
      <div class="invalid-feedback"><?= session('errors.kk') ?></div>
    </div>

    <button type="button" class="btn btn-primary mt-3" onclick="showConfirmationModal()">Ajukan Surat</button>
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
        <p><strong>Nama Kelompok Tani:</strong> <span id="preview_nama_gapoktan"></span></p>
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