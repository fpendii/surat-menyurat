<!-- app/Views/ajukan_surat_kelahiran.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kelahiran</h2>

    <form action="<?= site_url('masyarakat/surat/kelahiran/preview') ?>" target="_blank" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir</label>
            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Contoh: Bandung, 12 Mei 2023" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
        </div>

        <div class="form-group">
            <label for="nama_ayah">Nama Ayah Kandung</label>
            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" required>
        </div>

        <div class="form-group">
            <label for="nama_ibu">Nama Ibu Kandung</label>
            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" required>
        </div>

        <div class="form-group">
            <label for="anak_ke">Anak Ke-</label>
            <input type="number" class="form-control" id="anak_ke" name="anak_ke" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>
