<!-- app/Views/ajukan_surat_tidak_mampu.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Tidak Mampu</h2>

    <?php if (session('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/tidak-mampu/ajukan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required>
            <small class="form-text text-muted">Masukkan nama lengkap sesuai KTP.</small>
        </div>

        <div class="form-group">
            <label for="bin_binti">Bin/Binti</label>
            <input type="text" class="form-control" id="bin_binti" name="bin_binti" value="<?= old('bin_binti') ?>" required>
            <small class="form-text text-muted">Tulis nama ayah kandung.</small>
        </div>

        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" required maxlength="16" minlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit NIK">
            <small class="form-text text-muted">NIK harus 16 digit angka.</small>
        </div>


        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir</label>
            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Contoh: Bandung, 1 Januari 2000" value="<?= old('ttl') ?>" required>
            <small class="form-text text-muted">Isi dengan format Tempat, Tanggal Lahir.</small>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <small class="form-text text-muted">Pilih jenis kelamin Anda.</small>
        </div>

        <div class="form-group">
            <label for="agama">Agama</label>
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
            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan') ?>" required>
            <small class="form-text text-muted">Tuliskan pekerjaan Anda saat ini.</small>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= old('alamat') ?></textarea>
            <small class="form-text text-muted">Masukkan alamat tempat tinggal lengkap.</small>
        </div>

        <div class="form-group">
            <label for="keperluan">Keperluan Pembuatan Surat</label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="2" required><?= old('keperluan') ?></textarea>
            <small class="form-text text-muted">Tuliskan alasan atau keperluan pengajuan surat.</small>
        </div>

        <div class="form-group">
            <label for="ktp">Upload KTP</label>
            <input type="file" class="form-control-file" id="ktp" name="ktp" required>
            <small class="form-text text-muted">Unggah salinan KTP dalam format JPG atau PDF.</small>
        </div>

        <div class="form-group">
            <label for="kk">Upload Kartu Keluarga (KK)</label>
            <input type="file" class="form-control-file" id="kk" name="kk" required>
            <small class="form-text text-muted">Unggah salinan KK dalam format JPG atau PDF.</small>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>