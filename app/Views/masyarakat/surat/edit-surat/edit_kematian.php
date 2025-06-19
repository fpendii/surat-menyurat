<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Keterangan Kematian</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <!-- Catatan dari Kepala Desa -->
    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/kematian/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama"
                value="<?= old('nama', $detail['nama']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control <?= (session('errors.jenis_kelamin')) ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="L" <?= (old('jenis_kelamin', $detail['jenis_kelamin']) == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= (old('jenis_kelamin', $detail['jenis_kelamin']) == 'P') ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <div class="invalid-feedback"><?= session('errors.jenis_kelamin') ?></div>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= (session('errors.ttl')) ? 'is-invalid' : '' ?>" id="ttl" name="ttl"
                placeholder="Contoh: Bandung, 10 Januari 1960"
                value="<?= old('ttl', $detail['ttl']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.ttl') ?></div>
        </div>

        <div class="form-group">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select class="form-control <?= (session('errors.agama')) ? 'is-invalid' : '' ?>" id="agama" name="agama" required>
                <option value="">-- Pilih Agama --</option>
                <option value="Islam" <?= old('agama', $detail['agama']) == 'Islam' ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= old('agama', $detail['agama']) == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= old('agama', $detail['agama']) == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= old('agama', $detail['agama']) == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                <option value="Budha" <?= old('agama', $detail['agama']) == 'Budha' ? 'selected' : '' ?>>Budha</option>
                <option value="Konghucu" <?= old('agama', $detail['agama']) == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
            </select>
            <div class="invalid-feedback"><?= session('errors.agama') ?></div>
        </div>

        <div class="form-group">
            <label for="hari_tanggal">Hari / Tanggal Meninggal <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= (session('errors.hari_tanggal')) ? 'is-invalid' : '' ?>" id="hari_tanggal" name="hari_tanggal"
                placeholder="Contoh: Senin, 1 Januari 2024"
                value="<?= old('hari_tanggal', $detail['hari_tanggal']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.hari_tanggal') ?></div>
        </div>

        <div class="form-group">
            <label for="jam">Jam Meninggal <span class="text-danger">*</span></label>
            <input type="time" class="form-control <?= (session('errors.jam')) ? 'is-invalid' : '' ?>" id="jam" name="jam"
                value="<?= old('jam', $detail['jam']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.jam') ?></div>
        </div>

        <div class="form-group">
            <label for="tempat">Tempat Meninggal <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= (session('errors.tempat')) ? 'is-invalid' : '' ?>" id="tempat" name="tempat"
                value="<?= old('tempat', $detail['tempat']) ?>" required>
            <div class="invalid-feedback"><?= session('errors.tempat') ?></div>
        </div>

        <div class="form-group">
            <label for="penyebab">Penyebab Kematian <span class="text-danger">*</span></label>
            <textarea class="form-control <?= (session('errors.penyebab')) ? 'is-invalid' : '' ?>" id="penyebab" name="penyebab" rows="2" required><?= old('penyebab', $detail['penyebab']) ?></textarea>
            <div class="invalid-feedback"><?= session('errors.penyebab') ?></div>
        </div>

        <!-- Upload KK -->
        <div class="form-group mt-4">
            <label for="kk">Upload KK yang Meninggal<small class="text-muted"></small> <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file <?= (session('errors.kk')) ? 'is-invalid' : '' ?>" id="kk" name="kk" accept=".pdf,.jpg,.jpeg,.png">
            <div class="invalid-feedback"><?= session('errors.kk') ?></div>
        </div>

        <!-- Upload KTP -->
        <div class="form-group">
            <label for="ktp">Upload KTP yang Meninggal <small class="text-muted"></small> <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file <?= (session('errors.ktp')) ? 'is-invalid' : '' ?>" id="ktp" name="ktp" accept=".pdf,.jpg,.jpeg,.png">
            <div class="invalid-feedback"><?= session('errors.ktp') ?></div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan</button>
    </form>
</div>

<?= $this->endSection() ?>