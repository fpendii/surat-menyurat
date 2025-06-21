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

    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form id="formSuratTidakMampu" action="<?= site_url('masyarakat/surat/tidak-mampu/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <div class="form-group mb-2">
            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $detail['nama'] ?? '') ?>" required>
            <small class="form-text text-muted"></small>
        </div>

        <div class="form-group mb-2">
            <label for="bin_binti">Bin/Binti <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="bin_binti" name="bin_binti" value="<?= old('bin_binti', $detail['bin_binti'] ?? '') ?>" required>
            <small class="form-text text-muted"></small>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nik" name="nik" required maxlength="16" minlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="" value="<?= old('nik', $detail['nik'] ?? '') ?>">
            <small class="form-text text-muted"></small>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Contoh: Bandung, 1 Januari 2000" value="<?= old('ttl', $detail['ttl'] ?? '') ?>" required>
            <small class="form-text text-muted"></small>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="L" <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == 'P') ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <small class="form-text text-muted"></small>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (session()->has('errors.agama')) ? 'is-invalid' : '' ?>"
                id="agama"
                name="agama"
                required>
                <option value="" <?= (old('agama', $detail['agama'] ?? '') == '') ? 'selected' : '' ?>>-- Pilih --</option>
                <option value="Islam" <?= (old('agama', $detail['agama'] ?? '') == 'Islam') ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= (old('agama', $detail['agama'] ?? '') == 'Kristen') ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= (old('agama', $detail['agama'] ?? '') == 'Katolik') ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= (old('agama', $detail['agama'] ?? '') == 'Hindu') ? 'selected' : '' ?>>Hindu</option>
                <option value="Budha" <?= (old('agama', $detail['agama'] ?? '') == 'Budha') ? 'selected' : '' ?>>Budha</option>
                <option value="Konghucu" <?= (old('agama', $detail['agama'] ?? '') == 'Konghucu') ? 'selected' : '' ?>>Konghucu</option>
            </select>
            <?php if (session()->has('errors.agama')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.agama') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group mb-2">
            <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan', $detail['pekerjaan'] ?? '') ?>" required>
            <small class="form-text text-muted">Tuliskan pekerjaan Anda saat ini.</small>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat" name="alamat" rows="2" required><?= old('alamat', $detail['alamat'] ?? '') ?></textarea>
            <small class="form-text text-muted">Masukkan alamat tempat tinggal lengkap.</small>
        </div>

        <div class="form-group mb-2">
            <label for="keperluan">Keperluan Pembuatan Surat <span class="text-danger">*</span></label>
            <textarea class="form-control" id="keperluan" name="keperluan" rows="2" required><?= old('keperluan', $detail['keperluan'] ?? '') ?></textarea>
            <small class="form-text text-muted">Tuliskan alasan atau keperluan pengajuan surat.</small>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="ktp_file">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="ktp_file" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="kk_file">Upload KK<span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="kk_file" name="kk" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/kk/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>
        
        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>