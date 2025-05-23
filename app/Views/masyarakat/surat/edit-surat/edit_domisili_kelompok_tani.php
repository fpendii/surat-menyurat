<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Domisili Kelompok Tani</h2>

    <!-- Form Pengajuan Surat -->
    <form action="<?= site_url('masyarakat/surat/domisili_kelompok_tani/update/' . $detail['id_surat']) ?>" method="POST">
        <?= csrf_field() ?>
        <input type="text" name="no_surat" value="<?= $surat['no_surat'] ?>" hidden>
        <div class="form-group mb-2">
        <label for="nama_gapoktan">Nama Gapoktan</label>
            <input type="text" value="<?= $detail['nama_gapoktan'] ?>" class="form-control" id="nama_gapoktan" name="nama_gapoktan" required>
        </div>

        <div class="form-group mb-2">
            <label for="tgl_pembentukan">Tanggal Pembentukan</label>
            <input type="date" value="<?= $detail['tgl_pembentukan'] ?>" class="form-control" id="tgl_pembentukan" name="tgl_pembentukan" required>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat Lengkap</label>
            <input type="text" value="<?= $detail['alamat'] ?>" class="form-control" id="alamat" name="alamat" required>
        </div>

        <div class="form-group mb-2">
            <label for="ketua">Nama Ketua</label>
            <input type="text" value="<?= $detail['ketua'] ?>" class="form-control" id="ketua" name="ketua" required>
        </div>

        <div class="form-group mb-2">
            <label for="sekretaris">Nama Sekretaris</label>
            <input type="text" value="<?= $detail['sekretaris'] ?>" class="form-control" id="sekretaris" name="sekretaris" required>
        </div>

        <div class="form-group mb-2">
            <label for="bendahara">Nama Bendahara</label>
            <input type="text" value="<?= $detail['bendahara'] ?>" class="form-control" id="bendahara" name="bendahara" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>




<?= $this->endSection() ?>
