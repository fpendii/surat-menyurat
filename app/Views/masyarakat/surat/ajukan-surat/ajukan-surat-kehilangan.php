<!-- app/Views/ajukan_surat_kehilangan.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kehilangan</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form action="<?= site_url('masyarakat/surat/kehilangan/ajukan') ?>"  method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" required>
            <small class="form-text text-muted">Masukkan nama lengkap sesuai KTP.</small>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <small class="form-text text-muted">Pilih jenis kelamin Anda.</small>
            <div class="invalid-feedback"><?= session('errors.jenis_kelamin') ?></div>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir</label>
            <input type="text" class="form-control <?= session('errors.ttl') ? 'is-invalid' : '' ?>" id="ttl" name="ttl" value="<?= old('ttl') ?>" required>
            <small class="form-text text-muted">Tulis tempat dan tanggal lahir sesuai dokumen resmi.</small>
            <div class="invalid-feedback"><?= session('errors.ttl') ?></div>
        </div>

        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text"
                class="form-control <?= session('errors.nik') ? 'is-invalid' : '' ?>"
                id="nik" name="nik"
                value="<?= old('nik') ?>"
                required minlength="16" maxlength="16"
                pattern="\d{16}"
                oninput="this.value = this.value.replace(/\D/g, '')">
            <small class="form-text text-muted">Masukkan Nomor Induk Kependudukan (16 digit angka).</small>
            <div class="invalid-feedback"><?= session('errors.nik') ?></div>
        </div>


        <div class="form-group">
            <label for="agama">Agama</label>
            <select class="form-control <?= session('errors.agama') ? 'is-invalid' : '' ?>" id="agama" name="agama" required>
                <option value="">-- Pilih --</option>
                <?php $list_agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']; ?>
                <?php foreach ($list_agama as $agama) : ?>
                    <option value="<?= $agama ?>" <?= old('agama') == $agama ? 'selected' : '' ?>><?= $agama ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted">Pilih agama yang sesuai dengan identitas Anda.</small>
            <div class="invalid-feedback"><?= session('errors.agama') ?></div>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" rows="3" required><?= old('alamat') ?></textarea>
            <small class="form-text text-muted">Tulis alamat tempat tinggal lengkap Anda.</small>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group">
            <label for="barang_hilang">Barang yang Hilang</label>
            <input type="text" class="form-control <?= session('errors.barang_hilang') ? 'is-invalid' : '' ?>" id="barang_hilang" name="barang_hilang" value="<?= old('barang_hilang') ?>" required>
            <small class="form-text text-muted">Contoh: Dompet, KTP, SIM, STNK, dll.</small>
            <div class="invalid-feedback"><?= session('errors.barang_hilang') ?></div>
        </div>

        <div class="form-group">
            <label for="keperluan">Keperluan Barang Hilang</label>
            <textarea class="form-control <?= session('errors.keperluan') ? 'is-invalid' : '' ?>" id="keperluan" name="keperluan" rows="3" required><?= old('keperluan') ?></textarea>
            <small class="form-text text-muted">Tuliskan untuk keperluan apa surat kehilangan ini diperlukan.</small>
            <div class="invalid-feedback"><?= session('errors.keperluan') ?></div>
        </div>

        <div class="form-group">
            <label for="kk">Unggah Kartu Keluarga (KK)</label>
            <input type="file" class="form-control-file <?= session('errors.kk') ? 'is-invalid' : '' ?>" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
            <small class="form-text text-muted">Unggah scan atau foto KK (format: JPG, PNG, atau PDF).</small>
            <div class="invalid-feedback d-block"><?= session('errors.kk') ?></div>
        </div>

        <div class="form-group">
            <label for="ktp">Unggah KTP</label>
            <input type="file" class="form-control-file <?= session('errors.ktp') ? 'is-invalid' : '' ?>" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
            <small class="form-text text-muted">Unggah scan atau foto KTP (format: JPG, PNG, atau PDF).</small>
            <div class="invalid-feedback d-block"><?= session('errors.ktp') ?></div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat Kehilangan</button>
    </form>
</div>

<?= $this->endSection() ?>