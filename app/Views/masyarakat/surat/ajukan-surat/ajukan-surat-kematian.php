<!-- app/Views/ajukan_surat_kematian.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Kematian</h2>

    <form action="<?= site_url('masyarakat/surat/kematian/preview') ?>" target="_blank" method="POST">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir</label>
            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Contoh: Bandung, 10 Januari 1960" required>
        </div>

        <div class="form-group">
            <label for="agama">Agama</label>
            <input type="text" class="form-control" id="agama" name="agama" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required></textarea>
        </div>

        <div class="form-group">
            <label for="hari_tanggal">Hari / Tanggal Meninggal</label>
            <input type="text" class="form-control" id="hari_tanggal" name="hari_tanggal" placeholder="Contoh: Senin, 1 Januari 2024" required>
        </div>

        <div class="form-group">
            <label for="jam">Jam Meninggal</label>
            <input type="time" class="form-control" id="jam" name="jam" required>
        </div>

        <div class="form-group">
            <label for="tempat">Tempat Meninggal</label>
            <input type="text" class="form-control" id="tempat" name="tempat" required>
        </div>

        <div class="form-group">
            <label for="penyebab">Penyebab Kematian</label>
            <textarea class="form-control" id="penyebab" name="penyebab" rows="2" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>
