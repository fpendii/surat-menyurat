<!-- app/Views/ajukan_surat_keterangan_usaha.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Usaha</h2>

    <form action="<?= site_url('masyarakat/surat/usaha/preview') ?>" target="_blank" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat Tempat Tinggal</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
        </div>

        <div class="form-group">
            <label for="rt_rw">RT/RW</label>
            <input type="text" class="form-control" id="rt_rw" name="rt_rw" placeholder="Contoh: 02/03" required>
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

        <div class="form-group">
            <label for="nama_usaha">Nama Usaha</label>
            <input type="text" class="form-control" id="nama_usaha" name="nama_usaha" required>
        </div>

        <div class="form-group">
            <label for="alamat_usaha">Alamat Usaha</label>
            <textarea class="form-control" id="alamat_usaha" name="alamat_usaha" rows="2" required></textarea>
        </div>

        <div class="form-group">
            <label for="sejak_tahun">Sejak Tahun</label>
            <input type="text" class="form-control" id="sejak_tahun" name="sejak_tahun" placeholder="Contoh: 2018" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>
