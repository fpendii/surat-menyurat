<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Domisili Bangunan</h2>

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

    <form id="bangunanForm" action="<?= site_url('masyarakat/surat/domisili-bangunan/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <h5 class="mt-3">Data Pejabat</h5>
        <div class="form-group mb-2">
            <label for="nama_kepala_desa">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama_kepala_desa" name="nama_kepala_desa" value="<?= old('nama_kepala_desa', $detail['nama_kepala_desa'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= old('jabatan', $detail['jabatan'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?= old('kecamatan', $detail['kecamatan'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?= old('kabupaten', $detail['kabupaten'] ?? '') ?>" required>
        </div>

        <h5 class="mt-3">Data Bangunan</h5>
        <div class="form-group mb-2">
            <label for="kantor">Kantor <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kantor" name="kantor" value="<?= old('kantor', $detail['kantor'] ?? '') ?>" required>
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
            <label for="kecamatan_desa">Kecamatan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kecamatan_desa" name="kecamatan_desa" value="<?= old('kecamatan_desa', $detail['kecamatan_desa'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten_desa">Kabupaten <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kabupaten_desa" name="kabupaten_desa" value="<?= old('kabupaten_desa', $detail['kabupaten_desa'] ?? '') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?= old('provinsi', $detail['provinsi'] ?? '') ?>" required>
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