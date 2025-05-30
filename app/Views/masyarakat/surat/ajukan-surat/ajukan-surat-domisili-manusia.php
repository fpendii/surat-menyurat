<!-- app/Views/ajukan_surat_domisili_warga.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Domisili Warga</h2>

    <form action="<?= site_url('masyarakat/surat/domisili-warga/ajukan') ?>" method="POST">
        <?= csrf_field() ?>

        <h5 class="mt-3">Data Pejabat (Yang Bertanda Tangan)</h5>
        <div class="form-group">
            <label for="nama_pejabat">Nama</label>
            <input type="text" class="form-control" id="nama_pejabat" name="nama_pejabat" required>
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
        </div>

        <div class="form-group">
            <label for="kecamatan_pejabat">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan_pejabat" name="kecamatan_pejabat" required>
        </div>

        <div class="form-group">
            <label for="kabupaten_pejabat">Kabupaten</label>
            <input type="text" class="form-control" id="kabupaten_pejabat" name="kabupaten_pejabat" required>
        </div>

        <h5 class="mt-4">Data Warga</h5>
        <div class="form-group">
            <label for="nama_warga">Nama</label>
            <input type="text" class="form-control" id="nama_warga" name="nama_warga" required>
        </div>

        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" required maxlength="16" minlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit NIK">
            <small class="form-text text-muted">NIK harus 16 digit angka.</small>
        </div>


        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
        </div>

        <div class="form-group">
            <label for="desa">Desa</label>
            <input type="text" class="form-control" id="desa" name="desa" required>
        </div>

        <div class="form-group">
            <label for="kecamatan">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
        </div>

        <div class="form-group">
            <label for="kabupaten">Kabupaten</label>
            <input type="text" class="form-control" id="kabupaten" name="kabupaten" required>
        </div>

        <div class="form-group">
            <label for="provinsi">Provinsi</label>
            <input type="text" class="form-control" id="provinsi" name="provinsi" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>