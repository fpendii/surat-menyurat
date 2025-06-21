<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Keterangan Kehilangan</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form id="formKehilangan" action="<?= site_url('masyarakat/surat/kehilangan/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama', $detail['nama'] ?? '') ?>" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control <?= session('errors.jenis_kelamin') ? 'is-invalid' : '' ?>" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= (old('jenis_kelamin', $detail['jenis_kelamin'] ?? '') == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
            </select>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.jenis_kelamin') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.ttl') ? 'is-invalid' : '' ?>" id="ttl" name="ttl" placeholder="Contoh: Bandung, 1 Januari 2000" value="<?= old('ttl', $detail['ttl'] ?? '') ?>" required>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.ttl') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.nik') ? 'is-invalid' : '' ?>" id="nik" name="nik"
                value="<?= old('nik', $detail['nik'] ?? '') ?>" required minlength="16" maxlength="16"
                pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')">
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.nik') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select class="form-control <?= session('errors.agama') ? 'is-invalid' : '' ?>" id="agama" name="agama" required>
                <option value="">-- Pilih --</option>
                <?php $list_agama = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']; ?>
                <?php foreach ($list_agama as $agama) : ?>
                    <option value="<?= $agama ?>" <?= (old('agama', $detail['agama'] ?? '') == $agama) ? 'selected' : '' ?>><?= $agama ?></option>
                <?php endforeach ?>
            </select>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.agama') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.alamat') ? 'is-invalid' : '' ?>" id="alamat" name="alamat" rows="3" required><?= old('alamat', $detail['alamat'] ?? '') ?></textarea>
            <small class="form-text text-muted"></small>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="barang_hilang">Barang yang Hilang <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= session('errors.barang_hilang') ? 'is-invalid' : '' ?>" id="barang_hilang" name="barang_hilang" value="<?= old('barang_hilang', $detail['barang_hilang'] ?? '') ?>" required>
            <small class="form-text text-muted">Contoh: Dompet, KTP, SIM, STNK, dll.</small>
            <div class="invalid-feedback"><?= session('errors.barang_hilang') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="keperluan">Keperluan Barang Hilang <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.keperluan') ? 'is-invalid' : '' ?>" id="keperluan" name="keperluan" rows="3" required><?= old('keperluan', $detail['keperluan'] ?? '') ?></textarea>
            <small class="form-text text-muted">Tuliskan untuk keperluan apa surat kehilangan ini diperlukan.</small>
            <div class="invalid-feedback"><?= session('errors.keperluan') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="deskripsi_barang">Deskripsi Barang <span class="text-danger">*</span></label>
            <textarea class="form-control <?= session('errors.deskripsi_barang') ? 'is-invalid' : '' ?>" id="deskripsi_barang" name="deskripsi_barang" rows="3" required><?= old('deskripsi_barang', $detail['deskripsi_barang'] ?? '') ?></textarea>
            <small class="form-text text-muted">Tuliskan deskripsi barang yang hilang.</small>
            <div class="invalid-feedback"><?= session('errors.deskripsi_barang') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="ktp">Upload KTP <span class="text-danger">*</span> (jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file <?= session('errors.ktp') ? 'is-invalid' : '' ?>" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/ktp/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
            <div class="invalid-feedback d-block"><?= session('errors.ktp') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK <span class="text-danger">*</span> (jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file <?= session('errors.kk') ? 'is-invalid' : '' ?>" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/kk/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
            <div class="invalid-feedback d-block"><?= session('errors.kk') ?></div>
        </div>

        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>