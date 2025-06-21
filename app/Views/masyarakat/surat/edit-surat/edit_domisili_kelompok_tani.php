<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Domisili Kelompok Tani</h2>

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

    <form id="domisiliForm" action="<?= site_url('masyarakat/surat/domisili-kelompok-tani/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <div class="form-group mb-2">
            <label for="nama_gapoktan">Nama Kelompok Tani <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= (session('errors.nama_gapoktan')) ? 'is-invalid' : '' ?>" id="nama_gapoktan" name="nama_gapoktan" value="<?= old('nama_gapoktan', $detail['nama_gapoktan'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama_gapoktan') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="tgl_pembentukan">Tanggal Pembentukan Kelompok Tani <span class="text-danger">*</span></label>
            <input type="date" class="form-control <?= (session('errors.tgl_pembentukan')) ? 'is-invalid' : '' ?>" id="tgl_pembentukan" name="tgl_pembentukan" value="<?= old('tgl_pembentukan', $detail['tgl_pembentukan'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.tgl_pembentukan') ?></div>
        </div>

        <script>
            // Set max date for tgl_pembentukan to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById("tgl_pembentukan").setAttribute("max", today);
        </script>

        <div class="form-group mb-2">
            <label for="alamat">Alamat Sekretariat <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= (session('errors.alamat')) ? 'is-invalid' : '' ?>" id="alamat" name="alamat" value="<?= old('alamat', $detail['alamat'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="ketua">Nama Ketua <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= (session('errors.ketua')) ? 'is-invalid' : '' ?>" id="ketua" name="ketua" value="<?= old('ketua', $detail['ketua'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.ketua') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="sekretaris">Nama Sekretaris <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= (session('errors.sekretaris')) ? 'is-invalid' : '' ?>" id="sekretaris" name="sekretaris" value="<?= old('sekretaris', $detail['sekretaris'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.sekretaris') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="bendahara">Nama Bendahara <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= (session('errors.bendahara')) ? 'is-invalid' : '' ?>" id="bendahara" name="bendahara" value="<?= old('bendahara', $detail['bendahara'] ?? '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.bendahara') ?></div>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="ktp">Upload KTP Ketua <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control <?= (session('errors.ktp')) ? 'is-invalid' : '' ?>" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/surat_domisili_kelompok_tani/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
            <div class="invalid-feedback"><?= session('errors.ktp') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK Ketua <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control <?= (session('errors.kk')) ? 'is-invalid' : '' ?>" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/surat_domisili_kelompok_tani/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
            <div class="invalid-feedback"><?= session('errors.kk') ?></div>
        </div>

        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>