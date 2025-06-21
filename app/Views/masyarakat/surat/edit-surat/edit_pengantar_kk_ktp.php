<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Pengantar KK dan KTP</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form id="formPengantarKKKTP" action="<?= site_url('masyarakat/surat/pengantar-kk-ktp/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <h5 class="mt-3">Data Orang yang Diajukan</h5>
        <div id="data-orang-wrapper">
            <?php if (!empty($dataOrang)): ?>
                <?php foreach ($dataOrang as $index => $person): ?>
                    <div class="person-group border p-3 rounded mb-3">
                        <div class="form-group mb-2">
                            <label for="nama_<?= $index ?>">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_<?= $index ?>" name="data[<?= $index ?>][nama]" value="<?= old('data.' . $index . '.nama', $person['nama']) ?>" required>
                            <input type="hidden" name="data[<?= $index ?>][id_detail]" value="<?= esc($person['id_pengantar_kk_ktp']) ?>"> </div>

                        <div class="form-group mb-2">
                            <label for="no_kk_<?= $index ?>">Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="no_kk_<?= $index ?>" name="data[<?= $index ?>][no_kk]" value="<?= old('data.' . $index . '.no_kk', $person['no_kk']) ?>" required minlength="16" maxlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit Nomor KK">
                        </div>

                        <div class="form-group mb-2">
                            <label for="nik_<?= $index ?>">NIK <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nik_<?= $index ?>" name="data[<?= $index ?>][nik]" value="<?= old('data.' . $index . '.nik', $person['nik']) ?>" required minlength="16" maxlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit NIK">
                        </div>

                        <div class="form-group mb-2">
                            <label for="keterangan_<?= $index ?>">Keterangan/Hubungan (misal: Ayah, Ibu, Anak) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="keterangan_<?= $index ?>" name="data[<?= $index ?>][keterangan]" value="<?= old('data.' . $index . '.keterangan', $person['keterangan']) ?>" placeholder="Contoh: Pemohon Utama / Suami / Istri / Anak" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="jumlah_<?= $index ?>">Jumlah Dokumen yang Diajukan (per orang) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah_<?= $index ?>" name="data[<?= $index ?>][jumlah]" value="<?= old('data.' . $index . '.jumlah', $person['jumlah']) ?>" min="1" required>
                        </div>

                        <button type="button" class="btn btn-danger btn-sm mt-3 remove-person-group">Hapus Orang Ini</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="person-group border p-3 rounded mb-3">
                    <div class="form-group mb-2">
                        <label for="nama_0">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_0" name="data[0][nama]" value="<?= old('data.0.nama') ?>" required>
                        <input type="hidden" name="data[0][id_detail]" value="0"> </div>
                    <div class="form-group mb-2">
                        <label for="no_kk_0">Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="no_kk_0" name="data[0][no_kk]" value="<?= old('data.0.no_kk') ?>" required minlength="16" maxlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit Nomor KK">
                    </div>
                    <div class="form-group mb-2">
                        <label for="nik_0">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nik_0" name="data[0][nik]" value="<?= old('data.0.nik') ?>" required minlength="16" maxlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit NIK">
                    </div>
                    <div class="form-group mb-2">
                        <label for="keterangan_0">Keterangan/Hubungan (misal: Ayah, Ibu, Anak) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="keterangan_0" name="data[0][keterangan]" value="<?= old('data.0.keterangan') ?>" placeholder="Contoh: Pemohon Utama / Suami / Istri / Anak" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="jumlah_0">Jumlah Dokumen yang Diajukan (per orang) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="jumlah_0" name="data[0][jumlah]" value="<?= old('data.0.jumlah') ?? 1 ?>" min="1" required>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm mt-3 remove-person-group">Hapus Orang Ini</button>
                </div>
            <?php endif; ?>
        </div>

        <button type="button" class="btn btn-secondary my-2" id="add-person-btn">+ Tambah Orang</button>

        <h5 class="mt-4">Upload Berkas Pendukung</h5>
        <div class="form-group mb-2">
            <label for="ktp">Upload KTP <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control-file <?= (session('errors.ktp')) ? 'is-invalid' : '' ?>" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
            <div class="invalid-feedback"><?= session('errors.ktp') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control-file <?= (session('errors.kk')) ? 'is-invalid' : '' ?>" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/kk/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
            <div class="invalid-feedback"><?= session('errors.kk') ?></div>
        </div>

        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<script>
    let personIndex = <?= !empty($dataOrang) ? count($dataOrang) - 1 : 0 ?>; // Initialize index based on existing data

    document.getElementById('add-person-btn').addEventListener('click', function() {
        personIndex++;
        const wrapper = document.getElementById('data-orang-wrapper');
        const newGroup = document.createElement('div');
        newGroup.classList.add('person-group', 'border', 'p-3', 'rounded', 'mb-3');
        newGroup.innerHTML = `
            <div class="form-group mb-2">
                <label for="nama_${personIndex}">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_${personIndex}" name="data[${personIndex}][nama]" value="" required>
                <input type="hidden" name="data[${personIndex}][id_detail]" value="0"> </div>
            <div class="form-group mb-2">
                <label for="no_kk_${personIndex}">Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="no_kk_${personIndex}" name="data[${personIndex}][no_kk]" value="" required minlength="16" maxlength="16" pattern="\\d{16}" oninput="this.value = this.value.replace(/\\D/g, '')" placeholder="Masukkan 16 digit Nomor KK">
            </div>
            <div class="form-group mb-2">
                <label for="nik_${personIndex}">NIK <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nik_${personIndex}" name="data[${personIndex}][nik]" value="" required minlength="16" maxlength="16" pattern="\\d{16}" oninput="this.value = this.value.replace(/\\D/g, '')" placeholder="Masukkan 16 digit NIK">
            </div>
            <div class="form-group mb-2">
                <label for="keterangan_${personIndex}">Keterangan/Hubungan (misal: Ayah, Ibu, Anak) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="keterangan_${personIndex}" name="data[${personIndex}][keterangan]" value="" placeholder="Contoh: Suami / Istri / Anak" required>
            </div>
            <div class="form-group mb-2">
                <label for="jumlah_${personIndex}">Jumlah Dokumen yang Diajukan (per orang) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="jumlah_${personIndex}" name="data[${personIndex}][jumlah]" value="1" min="1" required>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-3 remove-person-group">Hapus Orang Ini</button>
        `;
        wrapper.appendChild(newGroup);
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-person-group')) {
            const groups = document.querySelectorAll('.person-group');
            if (groups.length > 1) { // Ensure at least one group remains
                e.target.closest('.person-group').remove();
            } else {
                alert("Minimal harus ada satu orang yang diajukan.");
            }
        }
    });

    // No confirmation modal needed for edit, directly submit
    // Removed showConfirmationModal and its related elements from HTML
    // The submit button is now type="submit" directly.
</script>

<?= $this->endSection() ?>