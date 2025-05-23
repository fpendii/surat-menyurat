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

    <!-- Catatan dari Kepala Desa -->
    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/kelahiran/update/' . $id_surat) ?>" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" 
                value="<?= old('nama', isset($nama) ? $nama : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir</label>
            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Contoh: Bandung, 12 Mei 2023" 
                value="<?= old('ttl', isset($ttl) ? $ttl : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" <?= old('jenis_kelamin', isset($jenis_kelamin) ? $jenis_kelamin : '') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= old('jenis_kelamin', isset($jenis_kelamin) ? $jenis_kelamin : '') == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" 
                value="<?= old('pekerjaan', isset($pekerjaan) ? $pekerjaan : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= old('alamat', isset($alamat) ? $alamat : '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="nama_ayah">Nama Ayah Kandung</label>
            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" 
                value="<?= old('nama_ayah', isset($nama_ayah) ? $nama_ayah : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="nama_ibu">Nama Ibu Kandung</label>
            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" 
                value="<?= old('nama_ibu', isset($nama_ibu) ? $nama_ibu : '') ?>" required>
        </div>

        <div class="form-group">
            <label for="anak_ke">Anak Ke-</label>
            <input type="number" class="form-control" id="anak_ke" name="anak_ke" min="1" 
                value="<?= old('anak_ke', isset($anak_ke) ? $anak_ke : '') ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>
