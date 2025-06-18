<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Ahli Waris</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <form id="formAhliWaris" enctype="multipart/form-data" method="POST" action="<?= site_url('masyarakat/surat/ahli-waris/ajukan') ?>">
        <?= csrf_field() ?>

        <!-- Data Pemilik Harta -->
        <div class="form-group mb-2">
            <label>Nama Pemilik Harta (Almarhum/ah) <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="pemilik_harta" id="pemilik_harta" required>
        </div>

        <div class="form-group mb-3">
            <label>Upload Surat Nikah Pemilik Harta <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="surat_nikah" id="surat_nikah" accept=".pdf,.jpg,.jpeg,.png" required>
        </div>

        <!-- Ahli Waris -->
        <hr>
        <h5>Data Ahli Waris</h5>
        <div id="ahli-waris-wrapper">
            <div class="ahli-waris-group border p-3 rounded mb-3">
                <div class="form-group">
                    <label>Nama Ahli Waris <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_ahli_waris[]" required>
                </div>
                <div class="form-group">
                    <label>NIK <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nik_ahli_waris[]" required minlength="16" maxlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')">
                </div>
                <div class="form-group">
                    <label>Tempat/Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ttl_ahli_waris[]" placeholder="Contoh: Bandung, 01 Januari 1990" required>
                </div>
                <div class="form-group">
                    <label>Hubungan dengan Almarhum <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="hubungan_ahli_waris[]" required>
                </div>
                <div class="form-group">
                    <label>Upload KTP <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="ktp_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <div class="form-group">
                    <label>Upload KK <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="kk_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <div class="form-group">
                    <label>Upload Akta Lahir <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="akta_lahir_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <button type="button" class="btn btn-danger btn-sm mt-2 remove-ahli-waris">Hapus</button>
            </div>
        </div>

        <button type="button" class="btn btn-secondary my-2" id="tambah-ahli-waris">+ Tambah Ahli Waris</button>
        <br>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Ajukan Surat</button>
    </form>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Pengajuan Surat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nama Pemilik Harta:</strong> <span id="preview_pemilik_harta"></span></p>
        <div id="preview_ahli_waris"></div>
        <p class="text-danger mt-3">Apakah Anda yakin semua data sudah benar?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Periksa Kembali</button>
        <button type="button" class="btn btn-success" id="konfirmasiSubmit">Ya, Ajukan!</button>
      </div>
    </div>
  </div>
</div>

<!-- Script Dynamic Input dan Modal Preview -->
<script>
    document.getElementById('tambah-ahli-waris').addEventListener('click', function () {
        const wrapper = document.getElementById('ahli-waris-wrapper');
        const clone = wrapper.firstElementChild.cloneNode(true);
        clone.querySelectorAll('input').forEach(input => input.value = '');
        wrapper.appendChild(clone);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-ahli-waris')) {
            const groups = document.querySelectorAll('.ahli-waris-group');
            if (groups.length > 1) {
                e.target.closest('.ahli-waris-group').remove();
            } else {
                alert("Minimal harus ada satu ahli waris.");
            }
        }
    });

    document.querySelector('[data-bs-target="#konfirmasiModal"]').addEventListener('click', function () {
        document.getElementById('preview_pemilik_harta').innerText = document.getElementById('pemilik_harta').value;

        const container = document.getElementById('preview_ahli_waris');
        container.innerHTML = '';

        const ahliWarisGroups = document.querySelectorAll('.ahli-waris-group');
        ahliWarisGroups.forEach((group, index) => {
            const nama = group.querySelector('input[name="nama_ahli_waris[]"]').value;
            const nik = group.querySelector('input[name="nik_ahli_waris[]"]').value;
            const ttl = group.querySelector('input[name="ttl_ahli_waris[]"]').value;
            const hubungan = group.querySelector('input[name="hubungan_ahli_waris[]"]').value;

            const div = document.createElement('div');
            div.innerHTML = `
                <hr>
                <p><strong>Ahli Waris ${index + 1}</strong></p>
                <p>Nama: ${nama}</p>
                <p>NIK: ${nik}</p>
                <p>TTL: ${ttl}</p>
                <p>Hubungan: ${hubungan}</p>
            `;
            container.appendChild(div);
        });
    });

    document.getElementById('konfirmasiSubmit').addEventListener('click', function () {
        document.getElementById('formAhliWaris').submit();
    });
</script>

<?= $this->endSection() ?>
