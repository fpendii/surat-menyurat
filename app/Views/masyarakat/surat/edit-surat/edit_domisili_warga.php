<!-- app/Views/ajukan_surat_domisili_warga.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Domisili Warga</h2>

    <!-- Catatan dari Kepala Desa -->
    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/domisili-warga/update/' . $surat['id_surat']) ?>" method="POST">
        <?= csrf_field() ?>

        <h5 class="mt-3">Data Kepala Desa</h5>
        <input type="hidden" value="<?= $surat['no_surat'] ?>" class="form-control" id="no_surat" name="no_surat">

        <div class="form-group mb-2">
            <label for="nama_pejabat">Nama <span class="text-danger">*</span></label>
            <input type="text" value="<?= $detail['nama_pejabat'] ?>" class="form-control" id="nama_pejabat" name="nama_pejabat" required>
        </div>

        <div class="form-group mb-2">
            <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
            <input type="text" value="<?= $detail['jabatan'] ?>" class="form-control" id="jabatan" name="jabatan" required>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan_pejabat">Kecamatan <span class="text-danger">*</span></label>
            <input type="text" value="<?= $detail['kecamatan_pejabat'] ?>" class="form-control" id="kecamatan_pejabat" name="kecamatan_pejabat" required>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten_pejabat">Kabupaten <span class="text-danger">*</span></label>
            <input type="text" value="<?= $detail['kabupaten_pejabat'] ?>" class="form-control" id="kabupaten_pejabat" name="kabupaten_pejabat" required>
        </div>

        <h5 class="mt-4">Data Warga</h5>

        <div class="form-group mb-2">
            <label for="nama_warga">Nama <span class="text-danger">*</span></label>
            <input type="text" value="<?= $detail['nama_warga'] ?>" class="form-control" id="nama_warga" name="nama_warga" required>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input
                type="text"
                value="<?= $detail['nik'] ?>"
                class="form-control"
                id="nik"
                name="nik"
                required
                maxlength="16"
                pattern="\d{16}"
                title="NIK harus terdiri dari 16 digit angka"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16);">
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= $detail['alamat'] ?></textarea>
        </div>

        <div class="form-group mb-2">
            <label for="desa">Desa <span class="text-danger">*</span></label>
            <input type="text" value="<?= $detail['desa'] ?>" class="form-control" id="desa" name="desa" required>
        </div>

        <div class="form-group mb-2">
            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
            <input type="text" value="<?= $detail['kecamatan'] ?>" class="form-control" id="kecamatan" name="kecamatan" required>
        </div>

        <div class="form-group mb-2">
            <label for="kabupaten">Kabupaten <span class="text-danger">*</span></label>
            <input type="text" value="<?= $detail['kabupaten'] ?>" class="form-control" id="kabupaten" name="kabupaten" required>
        </div>

        <div class="form-group mb-2">
            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
            <input type="text" value="<?= $detail['provinsi'] ?>" class="form-control" id="provinsi" name="provinsi" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan</button>
    </form>
</div>

<?= $this->endSection() ?>