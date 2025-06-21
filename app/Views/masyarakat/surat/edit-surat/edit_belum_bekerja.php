<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Keterangan Belum Bekerja</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
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

    <form action="<?= site_url('masyarakat/surat/belum-bekerja/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">

        <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama', $detail['nama']) ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control"
                id="nik"
                name="nik"
                value="<?= old('nik', $detail['nik']) ?>"
                required
                maxlength="16"
                minlength="16"
                pattern="\d{16}"
                title="NIK harus 16 digit angka"
                oninput="this.value = this.value.replace(/\D/g, '')"
                placeholder="Masukkan 16 digit NIK">
            <small class="form-text text-muted">NIK harus 16 digit angka.</small>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl" name="ttl" value="<?= old('ttl', $detail['ttl']) ?>" placeholder="Contoh: Bandung, 10 Oktober 2001" required>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" <?= old('jenis_kelamin', $detail['jenis_kelamin']) == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= old('jenis_kelamin', $detail['jenis_kelamin']) == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select class="form-control" id="agama" name="agama" required>
                <option value="">-- Pilih --</option>
                <?php
                $agamas = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                foreach ($agamas as $agama) :
                ?>
                    <option value="<?= $agama ?>" <?= old('agama', $detail['agama']) == $agama ? 'selected' : '' ?>><?= $agama ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="status_pekerjaan">Status Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="status_pekerjaan" name="status_pekerjaan" value="<?= old('status_pekerjaan', $detail['status_pekerjaan']) ?>" placeholder="Contoh: Belum bekerja" required>
        </div>

        <div class="form-group mb-2">
            <label for="warga_negara">Warga Negara <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="warga_negara" name="warga_negara" value="<?= old('warga_negara', $detail['warga_negara']) ?>" placeholder="Contoh: Indonesia" required>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat', $detail['alamat']) ?></textarea>
        </div>

        <div class="form-group mb-2">
            <label for="ktp">Upload KTP <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control-file" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($detail['file_ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/belum_bekerja/' . $detail['file_ktp']) ?>" target="_blank"><?= esc($detail['file_ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control-file" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($detail['file_kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/belum_bekerja/' . $detail['file_kk']) ?>" target="_blank"><?= esc($detail['file_kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
        </div>

        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>