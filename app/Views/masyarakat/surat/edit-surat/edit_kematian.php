<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Kematian</h2>

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

    <form id="kematianForm" action="<?= site_url('masyarakat/surat/kematian/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <h5 class="mt-3">Data Almarhum/Almarhumah</h5>
        <div class="form-group mb-2">
            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $detail['nama'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl" name="ttl" value="<?= old('ttl', $detail['ttl'] ?? '') ?>" placeholder="Contoh: Banjarmasin, 17 Agustus 1945" required>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="agama" name="agama" value="<?= old('agama', $detail['agama'] ?? '') ?>" required>
        </div>

        <h5 class="mt-3">Detail Kematian</h5>
        <div class="form-group mb-2">
            <label for="hari_tanggal">Hari, Tanggal Kematian <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="hari_tanggal" name="hari_tanggal" value="<?= old('hari_tanggal', $detail['hari_tanggal'] ?? '') ?>" placeholder="Contoh: Jumat, 10 Juni 2025" required>
        </div>

        <div class="form-group mb-2">
            <label for="jam">Jam Kematian <span class="text-danger">*</span></label>
            <input type="time" class="form-control" id="jam" name="jam" value="<?= old('jam', $detail['jam'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="tempat">Tempat Kematian <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tempat" name="tempat" value="<?= old('tempat', $detail['tempat'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="penyebab">Penyebab Kematian <span class="text-danger">*</span></label>
            <textarea class="form-control" id="penyebab" name="penyebab" rows="3" required><?= old('penyebab', $detail['penyebab'] ?? '') ?></textarea>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="ktp">Upload KTP Penanggung Jawab <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK Penanggung Jawab <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/kk/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>