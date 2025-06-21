<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Pindah</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
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

    <form id="formSuratPindah" action="<?= site_url('masyarakat/surat/pindah/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <h5 class="mt-3">Data Pemohon</h5>
        <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $detail['nama'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="" disabled <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == '') ? 'selected' : '' ?>>-- Pilih --</option>
                <option value="L" <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == 'P') ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Contoh: Bandung, 01 Januari 1990" value="<?= old('ttl', $detail['ttl'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kewarganegaraan">Kewarganegaraan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" value="<?= old('kewarganegaraan', $detail['kewarganegaraan'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (session()->has('errors.agama')) ? 'is-invalid' : '' ?>"
                id="agama"
                name="agama"
                required>
                <option value="" <?= (old('agama', $detail['agama'] ?? '') == '') ? 'selected' : '' ?>>-- Pilih --</option>
                <option value="Islam" <?= (old('agama', $detail['agama'] ?? '') == 'Islam') ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= (old('agama', $detail['agama'] ?? '') == 'Kristen') ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= (old('agama', $detail['agama'] ?? '') == 'Katolik') ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= (old('agama', $detail['agama'] ?? '') == 'Hindu') ? 'selected' : '' ?>>Hindu</option>
                <option value="Budha" <?= (old('agama', $detail['agama'] ?? '') == 'Budha') ? 'selected' : '' ?>>Budha</option>
                <option value="Konghucu" <?= (old('agama', $detail['agama'] ?? '') == 'Konghucu') ? 'selected' : '' ?>>Konghucu</option>
            </select>
            <?php if (session()->has('errors.agama')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.agama') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group mb-2">
            <label for="status_perkawinan">Status Perkawinan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan" value="<?= old('status_perkawinan', $detail['status_perkawinan'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan', $detail['pekerjaan'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="pendidikan">Pendidikan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="<?= old('pendidikan', $detail['pendidikan'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="alamat_asal">Alamat Asal <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat_asal" name="alamat_asal" rows="2" required><?= old('alamat_asal', $detail['alamat_asal'] ?? '') ?></textarea>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nik" name="nik" required maxlength="16" minlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="" value="<?= old('nik', $detail['nik'] ?? '') ?>">
            <small class="form-text text-muted"></small>
        </div>

        <div class="form-group mb-2">
            <label for="tujuan_pindah">Tujuan Pindah <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tujuan_pindah" name="tujuan_pindah" value="<?= old('tujuan_pindah', $detail['tujuan_pindah'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="alasan_pindah">Alasan Pindah <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="alasan_pindah" name="alasan_pindah" value="<?= old('alasan_pindah', $detail['alasan_pindah'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="jumlah_pengikut">Jumlah Pengikut <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="jumlah_pengikut" name="jumlah_pengikut" min="0" value="<?= old('jumlah_pengikut', $detail['jumlah_pengikut'] ?? 0) ?>" required>
            <small class="form-text text-muted">Isi 0 jika tidak ada pengikut.</small>
        </div>

        <h5 class="mt-4">Data Pengikut <small>(Opsional, isi jika jumlah pengikut > 0)</small></h5>
        <div id="pengikut-wrapper">
            <?php
            $initialPengikutCount = 0;
            if (!empty($dataPengikut) && is_array($dataPengikut)) :
                $initialPengikutCount = count($dataPengikut);
                foreach ($dataPengikut as $idx => $pengikut) :
            ?>
                    <div class="pengikut-group border p-3 rounded mb-3">
                        <h5>Data Pengikut <?= $idx + 1 ?></h5>
                        <div class="form-group mb-2">
                            <label for="nama_pengikut_<?= $idx ?>">Nama Pengikut <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_pengikut[]" id="nama_pengikut_<?= $idx ?>" value="<?= old("nama_pengikut.{$idx}", $pengikut['nama_pengikut'] ?? '') ?>" required>
                            <input type="hidden" name="id_pengikut[]" value="<?= esc($pengikut['id_pengikut'] ?? 0) ?>"> </div>
                        <div class="form-group mb-2">
                            <label for="jenis_kelamin_pengikut_<?= $idx ?>">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_kelamin_pengikut[]" id="jenis_kelamin_pengikut_<?= $idx ?>" required>
                                <option value="L" <?= (old("jenis_kelamin_pengikut.{$idx}", $pengikut['jenis_kelamin_pengikut'] ?? '') == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= (old("jenis_kelamin_pengikut.{$idx}", $pengikut['jenis_kelamin_pengikut'] ?? '') == 'P') ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="umur_pengikut_<?= $idx ?>">Umur <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="umur_pengikut[]" id="umur_pengikut_<?= $idx ?>" value="<?= old("umur_pengikut.{$idx}", $pengikut['umur_pengikut'] ?? '') ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status_perkawinan_pengikut_<?= $idx ?>">Status Perkawinan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="status_perkawinan_pengikut[]" id="status_perkawinan_pengikut_<?= $idx ?>" value="<?= old("status_perkawinan_pengikut.{$idx}", $pengikut['status_perkawinan_pengikut'] ?? '') ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="pendidikan_pengikut_<?= $idx ?>">Pendidikan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pendidikan_pengikut[]" id="pendidikan_pengikut_<?= $idx ?>" value="<?= old("pendidikan_pengikut.{$idx}", $pengikut['pendidikan_pengikut'] ?? '') ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="no_ktp_pengikut_<?= $idx ?>">No. KTP <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control"
                                name="no_ktp_pengikut[]"
                                id="no_ktp_pengikut_<?= $idx ?>"
                                value="<?= old("no_ktp_pengikut.{$idx}", $pengikut['no_ktp_pengikut'] ?? '') ?>"
                                required
                                minlength="16"
                                maxlength="16"
                                pattern="\d{16}"
                                oninput="this.value = this.value.replace(/\D/g, '')">
                        </div>
                        <button type="button" class="btn btn-danger btn-sm mt-3 remove-pengikut">Hapus Pengikut Ini</button>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="pengikut-group border p-3 rounded mb-3" style="display: none;">
                    <h5>Data Pengikut 1</h5>
                    <div class="form-group mb-2">
                        <label for="nama_pengikut_0">Nama Pengikut <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_pengikut[]" id="nama_pengikut_0" value="" required>
                        <input type="hidden" name="id_pengikut[]" value="0">
                    </div>
                    <div class="form-group mb-2">
                        <label for="jenis_kelamin_pengikut_0">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-control" name="jenis_kelamin_pengikut[]" id="jenis_kelamin_pengikut_0" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="umur_pengikut_0">Umur <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="umur_pengikut[]" id="umur_pengikut_0" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="status_perkawinan_pengikut_0">Status Perkawinan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="status_perkawinan_pengikut[]" id="status_perkawinan_pengikut_0" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="pendidikan_pengikut_0">Pendidikan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="pendidikan_pengikut[]" id="pendidikan_pengikut_0" required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="no_ktp_pengikut_0">No. KTP <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control"
                            name="no_ktp_pengikut[]"
                            id="no_ktp_pengikut_0"
                            required
                            minlength="16"
                            maxlength="16"
                            pattern="\d{16}"
                            oninput="this.value = this.value.replace(/\D/g, '')">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm mt-3 remove-pengikut">Hapus Pengikut Ini</button>
                </div>
            <?php endif; ?>
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="tambah-pengikut">+ Tambah Pengikut</button>
        <button type="button" class="btn btn-danger mb-3 ms-2" id="hapus-pengikut-last">- Hapus Pengikut Terakhir</button>
        <br>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="file_ktp">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="file_ktp" name="file_ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="file_kk">Upload KK<span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="file_kk" name="file_kk" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/kk/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="file_f1">Upload F1 (Opsional)(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="file_f1" name="file_f1" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['f1'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/f1/' . $surat['f1']) ?>" target="_blank"><?= esc($surat['f1']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Tidak ada file F1 yang diunggah.</small>
            <?php endif; ?>
        </div>

        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<script>
    // Initialize pengikutCount based on existing data
    let pengikutCount = <?= $initialPengikutCount ?? 0 ?>;
    let initialRenderedCount = pengikutCount; // To manage original elements

    document.addEventListener('DOMContentLoaded', () => {
        // Ensure "Jumlah Pengikut" input reflects the number of initially loaded pengikut
        document.getElementById('jumlah_pengikut').value = initialRenderedCount;

        // Hide "Data Pengikut" section if initially 0
        const pengikutWrapper = document.getElementById('pengikut-wrapper');
        if (initialRenderedCount === 0) {
             // If there's a hidden empty group, remove it or ensure it stays hidden
            const emptyGroup = pengikutWrapper.querySelector('.pengikut-group[style*="display: none;"]');
            if (emptyGroup) {
                emptyGroup.remove(); // Remove the single empty hidden group
            }
        }
    });

    document.getElementById('tambah-pengikut').addEventListener('click', function() {
        pengikutCount++; // Increment the counter for new elements
        document.getElementById('jumlah_pengikut').value = pengikutCount;
        addPengikutForm(pengikutCount - 1); // Pass the correct index for array naming (0-based)
    });

    document.getElementById('hapus-pengikut-last').addEventListener('click', function() {
        const wrapper = document.getElementById('pengikut-wrapper');
        const pengikutGroups = wrapper.querySelectorAll('.pengikut-group');
        
        if (pengikutGroups.length > 0) {
            // Check if the last group is one of the *newly added* ones (index > initialRenderedCount - 1)
            // Or if it's the only remaining group, and we are forced to remove it.
            if (pengikutGroups.length > initialRenderedCount || (pengikutGroups.length === 1 && initialRenderedCount === 0)) {
                wrapper.removeChild(pengikutGroups[pengikutGroups.length - 1]);
                pengikutCount--; // Decrement global counter
                document.getElementById('jumlah_pengikut').value = pengikutCount; // Update input field
            } else {
                alert("Anda tidak dapat menghapus pengikut yang sudah ada dari daftar awal. Anda hanya bisa menambah atau menghapus yang baru ditambahkan.");
            }
        }
    });

    // Delegated event listener for "Hapus Pengikut Ini" buttons on dynamically added elements
    document.getElementById('pengikut-wrapper').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-pengikut')) {
            const groupToRemove = e.target.closest('.pengikut-group');
            const groups = document.querySelectorAll('#pengikut-wrapper .pengikut-group');
            
            if (groups.length > 1) { // Ensure at least one group remains (or allow removal if it's the only one left from initial load)
                const idPengikutInput = groupToRemove.querySelector('input[name="id_pengikut[]"]');
                if (idPengikutInput && idPengikutInput.value !== '0') {
                    // This is an existing record from the database, maybe mark for deletion instead of direct removal?
                    // For now, let's just remove it from DOM and your controller will handle missing IDs
                    // If you need to explicitly send IDs to be deleted, you'd add a hidden field here
                    if (!confirm("Menghapus pengikut ini akan menghapusnya dari database saat Anda menyimpan perubahan. Lanjutkan?")) {
                        return; // Stop if user cancels
                    }
                }
                groupToRemove.remove();
                pengikutCount--; // Decrement global counter
                document.getElementById('jumlah_pengikut').value = pengikutCount; // Update input field
            } else {
                alert("Minimal harus ada satu pengikut (atau pemohon jika tidak ada pengikut).");
            }
        }
    });


    function addPengikutForm(index) {
        const wrapper = document.getElementById('pengikut-wrapper');
        const newGroup = document.createElement('div');
        newGroup.classList.add('pengikut-group', 'border', 'p-3', 'rounded', 'mb-3');
        newGroup.innerHTML = `
            <h5>Data Pengikut ${index + 1}</h5>
            <div class="form-group mb-2">
                <label for="nama_pengikut_${index}">Nama Pengikut <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_pengikut[]" id="nama_pengikut_${index}" required>
                <input type="hidden" name="id_pengikut[]" value="0"> </div>
            <div class="form-group mb-2">
                <label for="jenis_kelamin_pengikut_${index}">Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-control" name="jenis_kelamin_pengikut[]" id="jenis_kelamin_pengikut_${index}" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="umur_pengikut_${index}">Umur <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="umur_pengikut[]" id="umur_pengikut_${index}" required>
            </div>
            <div class="form-group mb-2">
                <label for="status_perkawinan_pengikut_${index}">Status Perkawinan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="status_perkawinan_pengikut[]" id="status_perkawinan_pengikut_${index}" required>
            </div>
            <div class="form-group mb-2">
                <label for="pendidikan_pengikut_${index}">Pendidikan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="pendidikan_pengikut[]" id="pendidikan_pengikut_${index}" required>
            </div>
            <div class="form-group mb-2">
                <label for="no_ktp_pengikut_${index}">No. KTP <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control"
                    name="no_ktp_pengikut[]"
                    id="no_ktp_pengikut_${index}"
                    required
                    minlength="16"
                    maxlength="16"
                    pattern="\\d{16}"
                    oninput="this.value = this.value.replace(/\\D/g, '')">
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-3 remove-pengikut">Hapus Pengikut Ini</button>
        `;
        wrapper.appendChild(newGroup);
    }
</script>

<?= $this->endSection() ?>