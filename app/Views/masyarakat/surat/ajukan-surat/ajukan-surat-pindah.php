<!-- app/Views/ajukan_surat_pindah.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Pindah</h2>

    <form action="<?= site_url('masyarakat/surat/pindah/ajukan') ?>"  method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Data Pemohon -->
        <h5>Data Pemohon</h5>
        <div class="form-group">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Contoh: Bandung, 01 Januari 1990" required>
        </div>

        <div class="form-group">
            <label for="kewarganegaraan">Kewarganegaraan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" required>
        </div>

        <div class="form-group">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (isset($validation) && $validation->hasError('agama')) ? 'is-invalid' : '' ?>"
                id="agama"
                name="agama"
                required>
                <option value="" <?= old('agama') == '' ? 'selected' : '' ?>>-- Pilih --</option>
                <option value="Islam" <?= old('agama') == 'Islam' ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= old('agama') == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= old('agama') == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= old('agama') == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                <option value="Budha" <?= old('agama') == 'Budha' ? 'selected' : '' ?>>Budha</option>
                <option value="Konghucu" <?= old('agama') == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
            </select>
            <?php if (isset($validation) && $validation->hasError('agama')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('agama') ?>
                </div>
            <?php endif ?>
        </div>


        <div class="form-group">
            <label for="status_perkawinan">Status Perkawinan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan" required>
        </div>

        <div class="form-group">
            <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
        </div>

        <div class="form-group">
            <label for="pendidikan">Pendidikan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pendidikan" name="pendidikan" required>
        </div>

        <div class="form-group">
            <label for="alamat_asal">Alamat Asal <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat_asal" name="alamat_asal" rows="2" required></textarea>
        </div>

        <div class="form-group">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nik" name="nik" required maxlength="16" minlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit NIK">
            <small class="form-text text-muted">NIK harus 16 digit angka.</small>
        </div>


        <div class="form-group">
            <label for="tujuan_pindah">Tujuan Pindah <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tujuan_pindah" name="tujuan_pindah" required>
        </div>

        <div class="form-group">
            <label for="alasan_pindah">Alasan Pindah <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="alasan_pindah" name="alasan_pindah" required>
        </div>

        <div class="form-group">
            <label for="jumlah_pengikut">Jumlah Pengikut <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="jumlah_pengikut" name="jumlah_pengikut" min="1" value="1" required>
        </div>


        <!-- Data Pengikut (Dapat Ditambahkan Berdasarkan Jumlah Pengikut) -->
        <div id="pengikut-wrapper">
            <div class="pengikut-group border p-3 rounded mb-3">
                <h5>Data Pengikut 1</h5>
                <div class="form-group">
                    <label for="nama_pengikut">Nama Pengikut <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_pengikut[]" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin_pengikut">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-control" name="jenis_kelamin_pengikut[]" required>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="umur_pengikut">Umur <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="umur_pengikut[]" required>
                </div>
                <div class="form-group">
                    <label for="status_perkawinan_pengikut">Status Perkawinan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="status_perkawinan_pengikut[]" required>
                </div>
                <div class="form-group">
                    <label for="pendidikan_pengikut">Pendidikan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="pendidikan_pengikut[]" required>
                </div>
                <div class="form-group">
                    <label for="no_ktp_pengikut">No. KTP <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control"
                        name="no_ktp_pengikut[]"
                        required
                        minlength="16"
                        maxlength="16"
                        pattern="\d{16}"
                        oninput="this.value = this.value.replace(/\D/g, '')">
                </div>

            </div>
        </div>

        <!-- Upload Berkas Pendukung -->
        <h5>Upload Berkas</h5>

        <div class="form-group">
            <label for="file_kk">Kartu Keluarga (KK) <span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" id="file_kk" name="file_kk" accept=".pdf,.jpg,.jpeg,.png" required>
        </div>

        <div class="form-group">
            <label for="file_ktp">KTP <span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" id="file_ktp" name="file_ktp" accept=".pdf,.jpg,.jpeg,.png" required>
        </div>

        <div class="form-group">
            <label for="file_f1">Form F1 <span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" id="file_f1" name="file_f1" accept=".pdf,.jpg,.jpeg,.png" required>
        </div>

        <button type="button" class="btn btn-secondary mb-3" id="tambah-pengikut">+ Tambah Pengikut</button>
        <br>
        <button type="submit" class="btn btn-primary">Ajukan Surat</button>
    </form>
</div>

<script>
    // Fungsi untuk menambah input data pengikut
    document.getElementById('tambah-pengikut').addEventListener('click', function() {
        const jumlahPengikut = document.getElementById('jumlah_pengikut').value;
        const wrapper = document.getElementById('pengikut-wrapper');
        const index = wrapper.childElementCount + 1;

        // Periksa apakah jumlah pengikut sudah sesuai
        if (index <= jumlahPengikut) {
            const newGroup = wrapper.firstElementChild.cloneNode(true);

            // Update data pengikut yang baru
            newGroup.querySelectorAll('input').forEach(input => input.value = '');
            newGroup.querySelector('h5').textContent = `Data Pengikut ${index}`;

            wrapper.appendChild(newGroup);
        } else {
            alert("Jumlah pengikut telah mencapai batas.");
        }
    });
</script>

<?= $this->endSection() ?>