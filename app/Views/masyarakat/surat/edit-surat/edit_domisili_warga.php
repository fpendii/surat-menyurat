<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Domisili Warga</h2>

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

    <form id="domisiliForm" action="<?= site_url('masyarakat/surat/domisili-warga/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <h5 class="mt-3">Data Pejabat</h5>
        <div class="form-group mb-2">
            <label for="nama_pejabat">Nama<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_pejabat" name="nama_pejabat" value="<?= old('nama_pejabat', $detail['nama_pejabat'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= old('jabatan', $detail['jabatan'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan_pejabat">Kecamatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kecamatan_pejabat" name="kecamatan_pejabat" value="<?= old('kecamatan_pejabat', $detail['kecamatan_pejabat'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten_pejabat">Kabupaten <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kabupaten_pejabat" name="kabupaten_pejabat" value="<?= old('kabupaten_pejabat', $detail['kabupaten_pejabat'] ?? '') ?>" required>
        </div>

        <h5 class="mt-3">Data Warga</h5>
        <div class="form-group mb-2">
            <label for="nama_warga">Nama<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_warga" name="nama_warga" value="<?= old('nama_warga', $detail['nama_warga'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nik" name="nik" value="<?= old('nik', $detail['nik'] ?? '') ?>" required
                pattern="\d{16}" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            <small class="text-muted">NIK harus 16 digit angka.</small>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= old('alamat', $detail['alamat'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="desa">Desa <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="desa" name="desa" value="<?= old('desa', $detail['desa'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?= old('kecamatan', $detail['kecamatan'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?= old('kabupaten', $detail['kabupaten'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?= old('provinsi', $detail['provinsi'] ?? '') ?>" required>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="ktp">Upload KTP <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
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