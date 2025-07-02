<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Keterangan Catatan Kepolisian</h2>

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

    <form action="<?= site_url('masyarakat/surat/catatan-polisi/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <h5 class="mt-3">Data Diri Pemohon</h5>
        <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>"
                id="nama" name="nama"
                value="<?= old('nama', $catatanPolisi['nama'] ?? '') ?>"
                required>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (session('errors.jenis_kelamin')) ? 'is-invalid' : '' ?>"
                id="jenis_kelamin" name="jenis_kelamin"
                required>
                <option value="">-- Pilih --</option>
                <option value="Perempuan" <?= (old('jenis_kelamin', $catatanPolisi['jenis_kelamin'] ?? '') == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                <option value="Laki-laki" <?= (old('jenis_kelamin', $catatanPolisi['jenis_kelamin'] ?? '') == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
            </select>
            <div class="invalid-feedback"><?= session('errors.jenis_kelamin') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="tempat_tanggal_lahir">Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session('errors.tempat_tanggal_lahir')) ? 'is-invalid' : '' ?>"
                id="tempat_tanggal_lahir" name="tempat_tanggal_lahir"
                placeholder="Contoh: Banjarbaru, 21 Juni 2000"
                value="<?= old('tempat_tanggal_lahir', $catatanPolisi['tempat_tanggal_lahir'] ?? '') ?>"
                required>
            <div class="invalid-feedback"><?= session('errors.tempat_tanggal_lahir') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="status_perkawinan">Status Perkawinan <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (session('errors.status_perkawinan')) ? 'is-invalid' : '' ?>"
                id="status_perkawinan" name="status_perkawinan"
                required>
                <option value="">-- Pilih --</option>
                <?php
                $statuses = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
                foreach ($statuses as $s):
                ?>
                    <option value="<?= $s ?>" <?= (old('status_perkawinan', $catatanPolisi['status_perkawinan'] ?? '') == $s) ? 'selected' : '' ?>><?= $s ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback"><?= session('errors.status_perkawinan') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kewarganegaraan">Kewarganegaraan <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session('errors.kewarganegaraan')) ? 'is-invalid' : '' ?>"
                id="kewarganegaraan" name="kewarganegaraan"
                value="<?= old('kewarganegaraan', $catatanPolisi['kewarganegaraan'] ?? 'Indonesia') ?>"
                required>
            <div class="invalid-feedback"><?= session('errors.kewarganegaraan') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (session('errors.agama')) ? 'is-invalid' : '' ?>"
                id="agama" name="agama"
                required>
                <option value="">-- Pilih --</option>
                <?php
                $agamas = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                foreach ($agamas as $a):
                ?>
                    <option value="<?= $a ?>" <?= (old('agama', $catatanPolisi['agama'] ?? '') == $a) ? 'selected' : '' ?>><?= $a ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback"><?= session('errors.agama') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session('errors.pekerjaan')) ? 'is-invalid' : '' ?>"
                id="pekerjaan" name="pekerjaan"
                value="<?= old('pekerjaan', $catatanPolisi['pekerjaan'] ?? '') ?>"
                required>
            <div class="invalid-feedback"><?= session('errors.pekerjaan') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (session('errors.nik')) ? 'is-invalid' : '' ?>"
                id="nik" name="nik"
                value="<?= old('nik', $catatanPolisi['nik'] ?? '') ?>"
                required
                minlength="16" maxlength="16" pattern="\d{16}"
                title="NIK harus 16 digit angka"
                oninput="this.value = this.value.replace(/\D/g, '')">
            <div class="invalid-feedback"><?= session('errors.nik') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea
                class="form-control <?= (session('errors.alamat')) ? 'is-invalid' : '' ?>"
                id="alamat" name="alamat" rows="3"
                required><?= old('alamat', $catatanPolisi['alamat'] ?? '') ?></textarea>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="kk">Upload KK <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/kk/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="ktp">Upload KTP <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="akta_lahir">Upload Akta Lahir <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="akta_lahir" name="akta_lahir" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($catatanPolisi['akta_lahir'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/akta_lahir/' . $catatanPolisi['akta_lahir']) ?>" target="_blank"><?= esc($catatanPolisi['akta_lahir']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="ijazah">Upload Ijazah <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="ijazah" name="ijazah" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($catatanPolisi['ijazah'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ijazah/' . $catatanPolisi['ijazah']) ?>" target="_blank"><?= esc($catatanPolisi['ijazah']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>

        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>