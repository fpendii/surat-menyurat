<!-- app/Views/ajukan_surat_domisili.php -->

<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Catatan Polisi</h2>

    <?php if(session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Catatan dari Kepala Desa -->
    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/catatan-polisi/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- Form input dasar -->
        <div class="form-group">
            <label for="nama">Nama</label>
            <input 
                type="text" 
                class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>" 
                id="nama" name="nama" 
                value="<?= old('nama', $catatanPolisi['nama'] ?? '') ?>" 
                required>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
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

        <div class="form-group">
            <label for="tempat_tanggal_lahir">Tempat, Tanggal Lahir</label>
            <input 
                type="text" 
                class="form-control <?= (session('errors.tempat_tanggal_lahir')) ? 'is-invalid' : '' ?>" 
                id="tempat_tanggal_lahir" name="tempat_tanggal_lahir" 
                placeholder="Contoh: Bandung, 10 Januari 2000" 
                value="<?= old('tempat_tanggal_lahir', $catatanPolisi['tempat_tanggal_lahir'] ?? '') ?>" 
                required>
            <div class="invalid-feedback"><?= session('errors.tempat_tanggal_lahir') ?></div>
        </div>

        <div class="form-group">
            <label for="status_perkawinan">Status Perkawinan</label>
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

        <div class="form-group">
            <label for="kewarganegaraan">Kewarganegaraan</label>
            <input 
                type="text" 
                class="form-control <?= (session('errors.kewarganegaraan')) ? 'is-invalid' : '' ?>" 
                id="kewarganegaraan" name="kewarganegaraan" 
                value="<?= old('kewarganegaraan', $catatanPolisi['kewarganegaraan'] ?? 'Indonesia') ?>" 
                required>
            <div class="invalid-feedback"><?= session('errors.kewarganegaraan') ?></div>
        </div>

        <div class="form-group">
            <label for="agama">Agama</label>
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

        <div class="form-group">
            <label for="pekerjaan">Pekerjaan</label>
            <input 
                type="text" 
                class="form-control <?= (session('errors.pekerjaan')) ? 'is-invalid' : '' ?>" 
                id="pekerjaan" name="pekerjaan" 
                value="<?= old('pekerjaan', $catatanPolisi['pekerjaan'] ?? '') ?>" 
                required>
            <div class="invalid-feedback"><?= session('errors.pekerjaan') ?></div>
        </div>

        <div class="form-group">
            <label for="nik">NIK</label>
            <input 
                type="text" 
                class="form-control <?= (session('errors.nik')) ? 'is-invalid' : '' ?>" 
                id="nik" name="nik" 
                value="<?= old('nik', $catatanPolisi['nik'] ?? '') ?>" 
                required>
            <div class="invalid-feedback"><?= session('errors.nik') ?></div>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea 
                class="form-control <?= (session('errors.alamat')) ? 'is-invalid' : '' ?>" 
                id="alamat" name="alamat" rows="3" 
                required><?= old('alamat', $catatanPolisi['alamat'] ?? '') ?></textarea>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <!-- File Uploads -->
        <div class="form-group mt-4">
            <label for="kk">Upload Kartu Keluarga (KK) <small class="text-muted">(Format: PDF/JPG/PNG)</small></label>
            <input 
                type="file" 
                class="form-control-file <?= (session('errors.kk')) ? 'is-invalid' : '' ?>" 
                id="kk" name="kk" 
                accept=".pdf,.jpg,.jpeg,.png" >
            <div class="invalid-feedback"><?= session('errors.kk') ?></div>
        </div>

        <div class="form-group">
            <label for="ktp">Upload KTP <small class="text-muted">(Format: PDF/JPG/PNG)</small></label>
            <input 
                type="file" 
                class="form-control-file <?= (session('errors.ktp')) ? 'is-invalid' : '' ?>" 
                id="ktp" name="ktp" 
                accept=".pdf,.jpg,.jpeg,.png" >
            <div class="invalid-feedback"><?= session('errors.ktp') ?></div>
        </div>

        <div class="form-group">
            <label for="akta_lahir">Upload Akta Lahir <small class="text-muted">(Format: PDF/JPG/PNG)</small></label>
            <input 
                type="file" 
                class="form-control-file <?= (session('errors.akta_lahir')) ? 'is-invalid' : '' ?>" 
                id="akta_lahir" name="akta_lahir" 
                accept=".pdf,.jpg,.jpeg,.png" >
            <div class="invalid-feedback"><?= session('errors.akta_lahir') ?></div>
        </div>

        <div class="form-group">
            <label for="ijazah">Upload Ijazah <small class="text-muted">(Format: PDF/JPG/PNG)</small></label>
            <input 
                type="file" 
                class="form-control-file <?= (session('errors.ijazah')) ? 'is-invalid' : '' ?>" 
                id="ijazah" name="ijazah" 
                accept=".pdf,.jpg,.jpeg,.png" >
            <div class="invalid-feedback"><?= session('errors.ijazah') ?></div>
        </div>

        <div class="form-group">
            <label for="foto_latar_belakang">Upload Foto Latar Belakang Merah</label>
            <input 
                type="file" 
                class="form-control-file <?= (session('errors.foto_latar_belakang')) ? 'is-invalid' : '' ?>" 
                id="foto_latar_belakang" name="foto_latar_belakang" 
                accept=".pdf,.jpg,.jpeg,.png,.zip" >
            <div class="invalid-feedback"><?= session('errors.foto_latar_belakang') ?></div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>
