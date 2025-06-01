<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
  <h2>Ajukan Surat Domisili Kelompok Tani</h2>

  <!-- Form Pengajuan Surat -->
  <form id="ajukanForm">
    <?= csrf_field() ?>

    <div class="form-group mb-2">
      <label for="nama_gapoktan">Nama Kelompok Tani</label>
      <input type="text" class="form-control" id="nama_gapoktan" name="nama_gapoktan" required>
    </div>


    <div class="form-group mb-2">
      <label for="tgl_pembentukan">Tanggal Pembentukan Kelompok Tani</label>
      <input type="date" class="form-control" id="tgl_pembentukan" name="tgl_pembentukan" required>
    </div>

    <script>
      // Ambil tanggal hari ini dalam format YYYY-MM-DD
      const today = new Date().toISOString().split('T')[0];

      // Set atribut max agar tanggal tidak bisa melebihi hari ini
      document.getElementById("tgl_pembentukan").setAttribute("max", today);
    </script>


    <div class="form-group mb-2">
      <label for="alamat">Alamat Lengkap</label>
      <input type="text" class="form-control" id="alamat" name="alamat" required>
    </div>

    <div class="form-group mb-2">
      <label for="ketua">Nama Ketua</label>
      <input type="text" class="form-control" id="ketua" name="ketua" required>
    </div>

    <div class="form-group mb-2">
      <label for="sekretaris">Nama Sekretaris</label>
      <input type="text" class="form-control" id="sekretaris" name="sekretaris" required>
    </div>

    <div class="form-group mb-2">
      <label for="bendahara">Nama Bendahara</label>
      <input type="text" class="form-control" id="bendahara" name="bendahara" required>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
  </form>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <!-- Modal di tengah -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nama Kelompok Tani:</strong> <span id="preview_nama_gapoktan"></span></p>
        <p><strong>Tanggal Pembentukan Kelompok Tani:</strong> <span id="preview_tgl_pembentukan"></span></p>
        <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>
        <p><strong>Ketua:</strong> <span id="preview_ketua"></span></p>
        <p><strong>Sekretaris:</strong> <span id="preview_sekretaris"></span></p>
        <p><strong>Bendahara:</strong> <span id="preview_bendahara"></span></p>
        <p class="text-danger">Apakah Anda yakin data di atas sudah benar dan ingin mengajukan surat?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Periksa Lagi</button>
        <button type="button" class="btn btn-success" id="konfirmasiSubmit">Ya, Ajukan!</button>
      </div>
    </div>
  </div>
</div>

<!-- Script Konfirmasi dan Submit -->
<script>
  document.getElementById('ajukanForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Cegah form langsung submit

    // Ambil data input
    const nama = document.getElementById('nama_gapoktan').value;
    const tgl = document.getElementById('tgl_pembentukan').value;
    const alamat = document.getElementById('alamat').value;
    const ketua = document.getElementById('ketua').value;
    const sekretaris = document.getElementById('sekretaris').value;
    const bendahara = document.getElementById('bendahara').value;

    // Isi modal dengan data
    document.getElementById('preview_nama_gapoktan').innerText = nama;
    document.getElementById('preview_tgl_pembentukan').innerText = tgl;
    document.getElementById('preview_alamat').innerText = alamat;
    document.getElementById('preview_ketua').innerText = ketua;
    document.getElementById('preview_sekretaris').innerText = sekretaris;
    document.getElementById('preview_bendahara').innerText = bendahara;

    // Tampilkan modal
    const modal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
    modal.show();
  });

  document.getElementById('konfirmasiSubmit').addEventListener('click', function () {
    // Buat form baru untuk submit ke target preview
    const form = document.getElementById('ajukanForm');
    form.setAttribute('action', "<?= site_url('masyarakat/surat/domisili-kelompok-tani/ajukan') ?>");
    form.setAttribute('method', "POST");
    form.submit();
    // Tutup modal
    bootstrap.Modal.getInstance(document.getElementById('konfirmasiModal')).hide();
  });
</script>

<?= $this->endSection() ?>