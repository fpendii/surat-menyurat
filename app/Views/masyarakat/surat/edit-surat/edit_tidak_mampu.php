<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Keterangan Tidak Mampu</h2>

    <?php if (session('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/tidak-mampu/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $detail['nama']) ?>" required>
        </div>

        <div class="form-group">
            <label for="bin_binti">Bin/Binti</label>
            <input type="text" class="form-control" id="bin_binti" name="bin_binti" value="<?= old('bin_binti', $detail['bin_binti']) ?>" required>
        </div>

        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" class="form-control" id="nik" name="nik" value="<?= old('nik', $detail['nik']) ?>" required>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir</label>
            <input type="text" class="form-control" id="ttl" name="ttl" value="<?= old('ttl', $detail['ttl']) ?>" required>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="L" <?= old('jenis_kelamin', $detail['jenis_kelamin']) == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= old('jenis_kelamin', $detail['jenis_kelamin']) == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label for="agama">Agama</label>
            <input type="text" class="form-control" id="agama" name="agama" value="<?= old('agama', $detail['agama']) ?>" required>
        </div>

        <div class="form-group">
            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan', $detail['pekerjaan']) ?>" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= old('alamat', $detail['alamat']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="keperluan">Keperluan Pembuatan Surat</label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="2" required><?= old('keperluan', $detail['keperluan']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="ktp">Upload KTP (abaikan jika tidak diubah)</label>
            <input type="file" class="form-control-file" id="ktp" name="ktp">
        </div>

        <div class="form-group">
            <label for="kk">Upload KK (abaikan jika tidak diubah)</label>
            <input type="file" class="form-control-file" id="kk" name="kk">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>
