<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Ahli Waris</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/ahli-waris/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <h5 class="mt-3">Data Almarhum/ah</h5>
        <div class="form-group mb-2">
            <label for="pemilik_harta">Nama Pemilik Harta (Almarhum/ah) <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pemilik_harta" name="pemilik_harta" value="<?= esc($suratAhliWaris['pemilik_harta']) ?? '' ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="surat_nikah">Upload Surat Nikah Pemilik Harta <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
            <input type="file" class="form-control" id="surat_nikah" name="surat_nikah" accept=".pdf,.jpg,.jpeg,.png">
            <?php if (!empty($suratAhliWaris['file_surat_nikah'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/surat_ahli_waris/' . $suratAhliWaris['file_surat_nikah']) ?>" target="_blank"><?= esc($suratAhliWaris['file_surat_nikah']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-3">
            <label for="surat_kematian">Upload Surat Kematian <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
            <input type="file" class="form-control" id="surat_kematian" name="surat_kematian" accept=".pdf,.jpg,.jpeg,.png">
            <?php if (!empty($suratAhliWaris['file_surat_kematian'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/surat_ahli_waris/' . $suratAhliWaris['file_surat_kematian']) ?>" target="_blank"><?= esc($suratAhliWaris['file_surat_kematian']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah.</small>
            <?php endif; ?>
        </div>

        <hr>

        <h5>Data Ahli Waris</h5>
        <div id="ahli-waris-wrapper">
            <?php if (!empty($dataAhliWaris)): ?>
                <?php foreach ($dataAhliWaris as $index => $aw) : ?>
                    <div class="ahli-waris-group border p-3 rounded mb-3">
                        <div class="form-group mb-2">
                            <label>Nama Ahli Waris <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_ahli_waris[]" value="<?= esc($aw['nama']) ?>" required>
                            <input type="hidden" name="id_ahli_waris[]" value="<?= esc($aw['id_ahli_waris']) ?>"> </div>
                        <div class="form-group mb-2">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                name="nik_ahli_waris[]"
                                value="<?= esc($aw['nik']) ?>"
                                required
                                minlength="16"
                                maxlength="16"
                                pattern="\d{16}"
                                title="NIK harus terdiri dari 16 digit angka"
                                oninput="this.value = this.value.replace(/\D/g, '')"
                            >
                        </div>
                        <div class="form-group mb-2">
                            <label>Tempat/Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="ttl_ahli_waris[]" value="<?= esc($aw['ttl']) ?>" placeholder="Contoh: Bandung, 01 Januari 1990" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="alamat[]" value="<?= esc($aw['alamat']) ?>" placeholder="Contoh: Jl. Contoh No. 123, RT 01/RW 02" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Hubungan dengan Almarhum <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="hubungan_ahli_waris[]" value="<?= esc($aw['hubungan']) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Upload KTP <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                            <input type="file" class="form-control" name="ktp_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png">
                            <?php if (!empty($aw['file_ktp'])): ?>
                                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ahli_waris/' . $aw['file_ktp']) ?>" target="_blank"><?= esc($aw['file_ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
                            <?php else: ?>
                                <small class="form-text text-muted">Belum ada file diunggah.</small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-2">
                            <label>Upload KK <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                            <input type="file" class="form-control" name="kk_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png">
                            <?php if (!empty($aw['file_kk'])): ?>
                                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ahli_waris/' . $aw['file_kk']) ?>" target="_blank"><?= esc($aw['file_kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
                            <?php else: ?>
                                <small class="form-text text-muted">Belum ada file diunggah.</small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-2">
                            <label>Upload Akta Lahir <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                            <input type="file" class="form-control" name="akta_lahir_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png">
                            <?php if (!empty($aw['file_akta_lahir'])): ?>
                                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ahli_waris/' . $aw['file_akta_lahir']) ?>" target="_blank"><?= esc($aw['file_akta_lahir']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
                            <?php else: ?>
                                <small class="form-text text-muted">Belum ada file diunggah.</small>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="btn btn-danger btn-sm mt-3 remove-ahli-waris">Hapus Ahli Waris Ini</button>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <div class="ahli-waris-group border p-3 rounded mb-3">
                    <div class="form-group mb-2">
                        <label>Nama Ahli Waris <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_ahli_waris[]" value="" required>
                        <input type="hidden" name="id_ahli_waris[]" value="0"> </div>
                    <div class="form-group mb-2">
                        <label>NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nik_ahli_waris[]" value="" required minlength="16" maxlength="16" pattern="\d{16}" title="NIK harus terdiri dari 16 digit angka" oninput="this.value = this.value.replace(/\D/g, '')">
                    </div>
                    <div class="form-group mb-2">
                        <label>Tempat/Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="ttl_ahli_waris[]" value="" placeholder="Contoh: Bandung, 01 Januari 1990" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Alamat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="alamat[]" value="" placeholder="Contoh: Jl. Contoh No. 123, RT 01/RW 02" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Hubungan dengan Almarhum <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="hubungan_ahli_waris[]" value="" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Upload KTP <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                        <input type="file" class="form-control" name="ktp_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div class="form-group mb-2">
                        <label>Upload KK <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                        <input type="file" class="form-control" name="kk_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <div class="form-group mb-2">
                        <label>Upload Akta Lahir <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                        <input type="file" class="form-control" name="akta_lahir_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm mt-3 remove-ahli-waris">Hapus Ahli Waris Ini</button>
                </div>
            <?php endif; ?>
        </div>

        <button type="button" class="btn btn-secondary my-2" id="tambah-ahli-waris">+ Tambah Ahli Waris</button>
        <br>
        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<script>
    document.getElementById('tambah-ahli-waris').addEventListener('click', function() {
        const wrapper = document.getElementById('ahli-waris-wrapper');
        // Create a new div element for the new ahli waris group
        const newGroup = document.createElement('div');
        newGroup.classList.add('ahli-waris-group', 'border', 'p-3', 'rounded', 'mb-3');
        newGroup.innerHTML = `
            <div class="form-group mb-2">
                <label>Nama Ahli Waris <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_ahli_waris[]" value="" required>
                <input type="hidden" name="id_ahli_waris[]" value="0"> </div>
            <div class="form-group mb-2">
                <label>NIK <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nik_ahli_waris[]" value="" required minlength="16" maxlength="16" pattern="\\d{16}" title="NIK harus terdiri dari 16 digit angka" oninput="this.value = this.value.replace(/\\D/g, '')">
            </div>
            <div class="form-group mb-2">
                <label>Tempat/Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="ttl_ahli_waris[]" value="" placeholder="Contoh: Bandung, 01 Januari 1990" required>
            </div>
            <div class="form-group mb-2">
                <label>Alamat <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="alamat[]" value="" placeholder="Contoh: Jl. Contoh No. 123, RT 01/RW 02" required>
            </div>
            <div class="form-group mb-2">
                <label>Hubungan dengan Almarhum <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="hubungan_ahli_waris[]" value="" required>
            </div>
            <div class="form-group mb-2">
                <label>Upload KTP <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                <input type="file" class="form-control" name="ktp_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
            <div class="form-group mb-2">
                <label>Upload KK <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                <input type="file" class="form-control" name="kk_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
            <div class="form-group mb-2">
                <label>Upload Akta Lahir <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                <input type="file" class="form-control" name="akta_lahir_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-3 remove-ahli-waris">Hapus Ahli Waris Ini</button>
        `;
        wrapper.appendChild(newGroup);
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