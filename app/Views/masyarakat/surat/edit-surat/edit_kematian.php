<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kematian</h2>

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

    <form action="<?= site_url('masyarakat/surat/kematian/update/' . $surat['id_surat']) ?>" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input
                type="text"
                class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>"
                id="nama"
                name="nama"
                value="<?= old('nama', $detail['nama']) ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.nama') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select
                class="form-control <?= (session('errors.jenis_kelamin')) ? 'is-invalid' : '' ?>"
                id="jenis_kelamin"
                name="jenis_kelamin"
                required>
                <option value="">-- Pilih --</option>
                <option value="L" <?= (old('jenis_kelamin', $detail['jenis_kelamin']) == 'laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= (old('jenis_kelamin', $detail['jenis_kelamin']) == 'perempuan') ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <div class="invalid-feedback">
                <?= session('errors.jenis_kelamin') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir</label>
            <input
                type="text"
                class="form-control <?= (session('errors.ttl')) ? 'is-invalid' : '' ?>"
                id="ttl"
                name="ttl"
                placeholder="Contoh: Bandung, 10 Januari 1960"
                value="<?= old('ttl', $detail['ttl']) ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.ttl') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="agama">Agama</label>
            <input
                type="text"
                class="form-control <?= (session('errors.agama')) ? 'is-invalid' : '' ?>"
                id="agama"
                name="agama"
                value="<?= old('agama', $detail['agama']) ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.agama') ?>
            </div>
        </div>

        

        <div class="form-group">
            <label for="hari_tanggal">Hari / Tanggal Meninggal</label>
            <input
                type="text"
                class="form-control <?= (session('errors.hari_tanggal')) ? 'is-invalid' : '' ?>"
                id="hari_tanggal"
                name="hari_tanggal"
                placeholder="Contoh: Senin, 1 Januari 2024"
                value="<?= old('hari_tanggal', $detail['hari_tanggal']) ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.hari_tanggal') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="jam">Jam Meninggal</label>
            <input
                type="time"
                class="form-control <?= (session('errors.jam')) ? 'is-invalid' : '' ?>"
                id="jam"
                name="jam"
                value="<?= old('jam', $detail['jam']) ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.jam') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="tempat">Tempat Meninggal</label>
            <input
                type="text"
                class="form-control <?= (session('errors.tempat')) ? 'is-invalid' : '' ?>"
                id="tempat"
                name="tempat"
                value="<?= old('tempat', $detail['tempat']) ?>"
                required>
            <div class="invalid-feedback">
                <?= session('errors.tempat') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="penyebab">Penyebab Kematian</label>
            <textarea
                class="form-control <?= (session('errors.penyebab')) ? 'is-invalid' : '' ?>"
                id="penyebab"
                name="penyebab"
                rows="2"
                required><?= old('penyebab', $detail['penyebab']) ?></textarea>
            <div class="invalid-feedback">
                <?= session('errors.penyebab') ?>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>
