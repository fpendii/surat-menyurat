<!-- app/Views/ajukan_surat_ahli_waris.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Ahli Waris</h2>

    <form action="<?= site_url('masyarakat/surat/ahli-waris/ajukan') ?>"   method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Data Pemilik Harta -->
        <div class="form-group">
            <label for="pemilik_harta">Nama Pemilik Harta (Almarhum/ah)</label>
            <input type="text" class="form-control" id="pemilik_harta" name="pemilik_harta" required>
            <small class="form-text text-muted">Isikan nama lengkap orang yang telah meninggal dan meninggalkan warisan.</small>
        </div>

        <div class="form-group mt-2">
            <label for="surat_nikah">Upload Surat Nikah Pemilik Harta</label>
            <input type="file" class="form-control" id="surat_nikah" name="surat_nikah" accept=".pdf,.jpg,.jpeg,.png" required>
            <small class="form-text text-muted">Unggah salinan surat nikah untuk membuktikan status pernikahan.</small>
        </div>

        <hr>

        <!-- Data Ahli Waris -->
        <h5>Data Ahli Waris</h5>
        <div id="ahli-waris-wrapper">
            <div class="ahli-waris-group border p-3 rounded mb-3">
                <div class="form-group">
                    <label>Nama Ahli Waris</label>
                    <input type="text" class="form-control" name="nama_ahli_waris[]" required>
                </div>
                <div class="form-group">
                    <label>NIK</label>
                    <input type="text"
                        class="form-control"
                        name="nik_ahli_waris[]"
                        required
                        minlength="16"
                        maxlength="16"
                        pattern="\d{16}"
                        oninput="this.value = this.value.replace(/\D/g, '')">
                </div>

                <div class="form-group">
                    <label>Tempat/Tanggal Lahir</label>
                    <input type="text" class="form-control" name="ttl_ahli_waris[]" placeholder="Contoh: Bandung, 01 Januari 1990" required>
                    <small class="form-text text-muted">Tulis dalam format: Tempat, dd bulan yyyy. Contoh: Bandung, 01 Januari 1990.</small>
                </div>
                <div class="form-group">
                    <label>Hubungan dengan Almarhum</label>
                    <input type="text" class="form-control" name="hubungan_ahli_waris[]" required>
                    <small class="form-text text-muted">Contoh: Anak, Istri, Suami, Saudara kandung, dll.</small>
                </div>
                <div class="form-group">
                    <label>Upload KTP</label>
                    <input type="file" class="form-control" name="ktp_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
                    <small class="form-text text-muted">Unggah foto atau scan KTP ahli waris.</small>
                </div>
                <div class="form-group">
                    <label>Upload KK</label>
                    <input type="file" class="form-control" name="kk_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
                    <small class="form-text text-muted">Unggah salinan Kartu Keluarga tempat ahli waris terdaftar.</small>
                </div>
                <div class="form-group">
                    <label>Upload Akta Lahir</label>
                    <input type="file" class="form-control" name="akta_lahir_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
                    <small class="form-text text-muted">Akta lahir digunakan untuk membuktikan hubungan keluarga.</small>
                </div>
                <button type="button" class="btn btn-danger btn-sm mt-2 remove-ahli-waris">Hapus</button>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="tambah-ahli-waris">+ Tambah Ahli Waris</button>
        <br>
        <button type="submit" class="btn btn-primary">Ajukan Surat</button>
    </form>
</div>

<script>
    document.getElementById('tambah-ahli-waris').addEventListener('click', function() {
        const wrapper = document.getElementById('ahli-waris-wrapper');
        const clone = wrapper.firstElementChild.cloneNode(true);

        // Kosongkan input
        clone.querySelectorAll('input').forEach(input => {
            if (input.type === 'file') {
                input.value = '';
            } else {
                input.value = '';
            }
        });

        wrapper.appendChild(clone);
    });

    // Hapus salah satu form ahli waris
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-ahli-waris')) {
            const groups = document.querySelectorAll('.ahli-waris-group');
            if (groups.length > 1) {
                e.target.closest('.ahli-waris-group').remove();
            } else {
                alert("Minimal harus ada satu ahli waris.");
            }
        }
    });
</script>

<?= $this->endSection() ?>