<!-- app/Views/ajukan_surat_domisili.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Catatan Polisi</h2>

    <form action="<?= site_url('masyarakat/surat/catatan-polisi/preview') ?>" target="_blank" method="POST">

        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="Rina" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Perempuan">Perempuan</option>
                <option value="Laki-laki">Laki-laki</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tempat_tanggal_lahir">Tempat, Tanggal Lahir</label>
            <input type="text" class="form-control" id="tempat_tanggal_lahir" name="tempat_tanggal_lahir" placeholder="Contoh: Bandung, 10 Januari 2000" required>
        </div>

        <div class="form-group">
            <label for="status_perkawinan">Status Perkawinan</label>
            <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                <option value="">-- Pilih --</option>
                <option value="Belum Kawin">Belum Kawin</option>
                <option value="Kawin">Kawin</option>
                <option value="Cerai Hidup">Cerai Hidup</option>
                <option value="Cerai Mati">Cerai Mati</option>
            </select>
        </div>

        <div class="form-group">
            <label for="kewarganegaraan">Kewarganegaraan</label>
            <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" value="Indonesia" required>
        </div>

        <div class="form-group">
            <label for="agama">Agama</label>
            <select class="form-control" id="agama" name="agama" required>
                <option value="">-- Pilih --</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
        </div>

        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat Domisili</button>
    </form>
</div>

<?= $this->endSection() ?>
