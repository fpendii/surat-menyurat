<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kelahiran</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form action="<?= site_url('masyarakat/surat/kelahiran/ajukan') ?>" enctype="multipart/form-data" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.ttl') ? 'is-invalid' : '' ?>" id="ttl" name="ttl" placeholder="Contoh: Bandung, 12 Mei 2023" value="<?= old('ttl') ?>" required>
            <div class="invalid-feedback"><?= session('errors.ttl') ?></div>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <div class="invalid-feedback"><?= session('errors.jenis_kelamin') ?></div>
        </div>

        <div class="form-group">
            <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.pekerjaan') ? 'is-invalid' : '' ?>" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan') ?>" required>
            <div class="invalid-feedback"><?= session('errors.pekerjaan') ?></div>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" rows="2" required><?= old('alamat') ?></textarea>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group">
            <label for="nama_ayah">Nama Ayah Kandung <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama_ayah') ? 'is-invalid' : '' ?>" id="nama_ayah" name="nama_ayah" value="<?= old('nama_ayah') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama_ayah') ?></div>
        </div>

        <div class="form-group">
            <label for="nama_ibu">Nama Ibu Kandung <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama_ibu') ? 'is-invalid' : '' ?>" id="nama_ibu" name="nama_ibu" value="<?= old('nama_ibu') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama_ibu') ?></div>
        </div>

        <div class="form-group">
            <label for="anak_ke">Anak Ke- <span class="text-danger">*</span></label>
            <input type="number" class="form-control <?= session('errors.anak_ke') ? 'is-invalid' : '' ?>" id="anak_ke" name="anak_ke" min="1" value="<?= old('anak_ke') ?>" required>
            <div class="invalid-feedback"><?= session('errors.anak_ke') ?></div>
        </div>

        <!-- Input file hanya satu kali di bawah form -->
        <div class="form-group">
            <label>Upload KTP <span class="text-danger">*</span></label>
            <input type="file" name="ktp" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="form-group">
            <label>Upload KK <span class="text-danger">*</span></label>
            <input type="file" name="kk" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>
