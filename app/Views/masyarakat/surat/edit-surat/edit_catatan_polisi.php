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
                <option value="Belum Kawin" <?= (old('status_perkawinan', $catatanPolisi['status_perkawinan'] ?? '') == 'Belum Kawin') ? 'selected' : '' ?>>Belum Kawin</option>
                <option value="Kawin" <?= (old('status_perkawinan', $catatanPolisi['status_perkawinan'] ?? '') == 'Kawin') ? 'selected' : '' ?>>Kawin</option>
                <option value="Cerai Hidup" <?= (old('status_perkawinan', $catatanPolisi['status_perkawinan'] ?? '') == 'Cerai Hidup') ? 'selected' : '' ?>>Cerai Hidup</option>
                <option value="Cerai Mati" <?= (old('status_perkawinan', $catatanPolisi['status_perkawinan'] ?? '') == 'Cerai Mati') ? 'selected' : '' ?>>Cerai Mati</option>
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
                <option value="Islam" <?= (old('agama', $catatanPolisi['agama'] ?? '') == 'Islam') ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= (old('agama', $catatanPolisi['agama'] ?? '') == 'Kristen') ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= (old('agama', $catatanPolisi['agama'] ?? '') == 'Katolik') ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= (old('agama', $catatanPolisi['agama'] ?? '') == 'Hindu') ? 'selected' : '' ?>>Hindu</option>
                <option value="Budha" <?= (old('agama', $catatanPolisi['agama'] ?? '') == 'Budha') ? 'selected' : '' ?>>Budha</option>
                <option value="Konghucu" <?= (old('agama', $catatanPolisi['agama'] ?? '') == 'Konghucu') ? 'selected' : '' ?>>Konghucu</option>
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

        ---
        <h5 class="mt-4">Upload Berkas</h5>
        <?php
        $files = [
            'kk'            => 'KK',
            'ktp'           => 'KTP',
            'akta_lahir'    => 'Akta Lahir',
            'ijazah'        => 'Ijazah Terakhir',
        ];
        foreach ($files as $id => $label):
            // Determine the file path based on the file type (assuming a folder structure like uploads/surat_catatan_polisi/)
            $currentFileName = $catatanPolisi['file_' . $id] ?? null;
            $filePath = !empty($currentFileName) ? base_url('uploads/surat_catatan_polisi/' . $currentFileName) : null;
        ?>
            <div class="form-group mb-2">
                <label for="<?= $id ?>">Upload <?= $label ?> <span class="text-danger">*</span> <small class="text-muted">(Format: PDF/JPG/PNG)</small></label>
                <input
                    type="file"
                    class="form-control-file <?= (session("errors.$id")) ? 'is-invalid' : '' ?>"
                    id="<?= $id ?>" name="<?= $id ?>"
                    accept=".pdf,.jpg,.jpeg,.png"> <?php if (!empty($currentFileName)): ?>
                    <small class="form-text text-muted">File saat ini: <a href="<?= esc($filePath) ?>" target="_blank"><?= esc($currentFileName) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
                <?php else: ?>
                    <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
                <?php endif; ?>
                <div class="invalid-feedback"><?= session("errors.$id") ?></div>
            </div>
        <?php endforeach; ?>

        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>