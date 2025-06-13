<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kawin</h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif ?>

    <form action="<?= site_url('masyarakat/surat/status-perkawinan/ajukan') ?>"  method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (isset($validation) && $validation->hasError('nama')) ? 'is-invalid' : '' ?>"
                id="nama"
                name="nama"
                value="<?= old('nama') ?>"
                required>
            <?php if (isset($validation) && $validation->hasError('nama')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('nama') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (isset($validation) && $validation->hasError('nik')) ? 'is-invalid' : '' ?>"
                id="nik"
                name="nik"
                value="<?= old('nik') ?>"
                required>
            <?php if (isset($validation) && $validation->hasError('nik')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('nik') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (isset($validation) && $validation->hasError('ttl')) ? 'is-invalid' : '' ?>"
                id="ttl"
                name="ttl"
                placeholder="Contoh: Surabaya, 14 Februari 1995"
                value="<?= old('ttl') ?>"
                required>
            <?php if (isset($validation) && $validation->hasError('ttl')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('ttl') ?>
                </div>
            <?php endif ?>
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
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea
                class="form-control <?= (isset($validation) && $validation->hasError('alamat')) ? 'is-invalid' : '' ?>"
                id="alamat"
                name="alamat"
                rows="3"
                required><?= old('alamat') ?></textarea>
            <?php if (isset($validation) && $validation->hasError('alamat')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('alamat') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (isset($validation) && $validation->hasError('status')) ? 'is-invalid' : '' ?>"
                id="status"
                name="status"
                required>
                <option value="" <?= old('status') == '' ? 'selected' : '' ?>>-- Pilih --</option>
                <option value="Belum Kawin" <?= old('status') == 'Belum Kawin' ? 'selected' : '' ?>>Janda</option>
                <option value="Sudah Kawin" <?= old('status') == 'Sudah Kawin' ? 'selected' : '' ?>>Duda</option>
                <option value="Cerai Hidup" <?= old('status') == 'Cerai Hidup' ? 'selected' : '' ?>>Perjaka</option>
                <option value="Cerai Mati" <?= old('status') == 'Cerai Mati' ? 'selected' : '' ?>>Cerai Mati</option>
            </select>
            <?php if (isset($validation) && $validation->hasError('status')) : ?>
                <div class="invalid-feedback">
                    <?= $validation->getError('status') ?>
                </div>
            <?php endif ?>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>