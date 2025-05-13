<!-- app/Views/ajukan_surat_domisili.php -->

<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Domisili Bangunan</h2>

    <form action="<?= site_url('masyarakat/surat/domisili-bangunan/preview') ?>" target="_blank"  method="POST">

        <?= csrf_field() ?>


        <div class="form-group">
            <label for="nama_gapoktan">Nama Gapoktan</label>
            <input type="text" class="form-control" id="nama_gapoktan" name="nama_gapoktan" required>
        </div>

        <div class="form-group">
            <label for="tgl_pembentukan">Tanggal Pembentukan</label>
            <input type="date" class="form-control" id="tgl_pembentukan" name="tgl_pembentukan" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat Lengkap</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>

        <div class="form-group">
            <label for="ketua">Nama Ketua</label>
            <input type="text" class="form-control" id="ketua" name="ketua" required>
        </div>

        <div class="form-group">
            <label for="sekretaris">Nama Sekretaris</label>
            <input type="text" class="form-control" id="sekretaris" name="sekretaris" required>
        </div>

        <div class="form-group">
            <label for="bendahara">Nama Bendahara</label>
            <input type="text" class="form-control" id="bendahara" name="bendahara" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat Domisili</button>
    </form>
</div>

<?= $this->endSection() ?>