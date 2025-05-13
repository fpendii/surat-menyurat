<!-- app/Views/ajukan_surat_kehilangan.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kehilangan</h2>

    <form action="<?= site_url('masyarakat/surat/kehilangan/preview') ?>" target="_blank" method="POST">

        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir</label>
            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Contoh: Jakarta, 01 Januari 2000" required>
        </div>

        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" required>
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
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="barang_hilang">Barang yang Hilang</label>
            <input type="text" class="form-control" id="barang_hilang" name="barang_hilang" required>
        </div>

        <div class="form-group">
            <label for="keperluan">Keperluan Barang Hilang</label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat Kehilangan</button>
    </form>
</div>

<?= $this->endSection() ?>
