<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Ajukan Surat Domisili Bangunan</h2>

  <form id="domisiliForm" action="<?= site_url('masyarakat/surat/domisili-bangunan/ajukan') ?>" method="POST">
    <?= csrf_field() ?>

    <div class="form-group">
      <label for="nama">Nama Kepala Desa</label>
      <input type="text" class="form-control" id="nama" name="nama" required>
    </div>

    <div class="form-group">
      <label for="jabatan">Jabatan Kepala Desa</label>
      <input type="text" class="form-control" id="jabatan" name="jabatan" required>
    </div>

    <div class="form-group">
      <label for="kecamatan_domisili">Kecamatan</label>
      <input type="text" class="form-control" id="kecamatan_domisili" name="kecamatan_domisili" required>
    </div>

    <div class="form-group">
      <label for="kabupaten_domisili">Kabupaten</label>
      <input type="text" class="form-control" id="kabupaten_domisili" name="kabupaten_domisili" required>
    </div>

    <div class="form-group">
      <label for="kantor">Nama Bangunan</label>
      <input type="text" class="form-control" id="kantor" name="kantor" required>
    </div>

    <div class="form-group">
      <label for="alamat">Alamat Bangunan</label>
      <input type="text" class="form-control" id="alamat" name="alamat" required>
    </div>

    <div class="form-group">
      <label for="desa">Desa</label>
      <input type="text" class="form-control" id="desa" name="desa" required>
    </div>

    <div class="form-group">
      <label for="kecamatan_kantor">Kecamatan</label>
      <input type="text" class="form-control" id="kecamatan_kantor" name="kecamatan_kantor" required>
    </div>

    <div class="form-group">
      <label for="kabupaten_kantor">Kabupaten</label>
      <input type="text" class="form-control" id="kabupaten_kantor" name="kabupaten_kantor" required>
    </div>

    <div class="form-group">
      <label for="provinsi">Provinsi</label>
      <input type="text" class="form-control" id="provinsi" name="provinsi" required>
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
        <p><strong>Nama Kepala Desa:</strong> <span id="preview_nama"></span></p>
        <p><strong>Jabatan Kepala Desa:</strong> <span id="preview_jabatan"></span></p>
        <p><strong>Kecamatan:</strong> <span id="preview_kecamatan_domisili"></span></p>
        <p><strong>Kabupaten:</strong> <span id="preview_kabupaten_domisili"></span></p>
        <p><strong>Nama Bangunan:</strong> <span id="preview_kantor"></span></p>
        <p><strong>Alamat Bangunan:</strong> <span id="preview_alamat"></span></p>
        <p><strong>Desa:</strong> <span id="preview_desa"></span></p>
        <p><strong>Kecamatan:</strong> <span id="preview_kecamatan_kantor"></span></p>
        <p><strong>Kabupaten:</strong> <span id="preview_kabupaten_kantor"></span></p>
        <p><strong>Provinsi:</strong> <span id="preview_provinsi"></span></p>
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
    document.getElementById('preview_nama').textContent = document.getElementById('nama').value;
    document.getElementById('preview_jabatan').textContent = document.getElementById('jabatan').value;
    document.getElementById('preview_kecamatan_domisili').textContent = document.getElementById('kecamatan_domisili').value;
    document.getElementById('preview_kabupaten_domisili').textContent = document.getElementById('kabupaten_domisili').value;
    document.getElementById('preview_kantor').textContent = document.getElementById('kantor').value;
    document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
    document.getElementById('preview_desa').textContent = document.getElementById('desa').value;
    document.getElementById('preview_kecamatan_kantor').textContent = document.getElementById('kecamatan_kantor').value;
    document.getElementById('preview_kabupaten_kantor').textContent = document.getElementById('kabupaten_kantor').value;
    document.getElementById('preview_provinsi').textContent = document.getElementById('provinsi').value;

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