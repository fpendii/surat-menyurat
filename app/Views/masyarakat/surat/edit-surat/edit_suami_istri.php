<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Keterangan Suami Istri</h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif ?>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
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

    <form id="formSuamiIstri" action="<?= site_url('masyarakat/surat/suami-istri/update/' . $surat['id_surat']) ?>" enctype="multipart/form-data" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> <h5 class="mt-4">Data Suami</h5>
        <div class="form-group mb-2">
            <label for="nama_suami">Nama Suami <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.nama_suami')) ? 'is-invalid' : '' ?>"
                   id="nama_suami"
                   name="nama_suami"
                   value="<?= old('nama_suami', $detail['nama_suami'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.nama_suami') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="ttl_suami">Tempat / Tanggal Lahir Suami <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.ttl_suami')) ? 'is-invalid' : '' ?>"
                   id="ttl_suami"
                   name="ttl_suami"
                   value="<?= old('ttl_suami', $detail['ttl_suami'] ?? '') ?>"
                   placeholder="Contoh: Surabaya, 14 Februari 1990"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.ttl_suami') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="agama_suami">Agama Suami <span class="text-danger">*</span></label>
            <select class="form-control <?= (session('errors.agama_suami')) ? 'is-invalid' : '' ?>"
                    id="agama_suami"
                    name="agama_suami"
                    required>
                <option value="">-- Pilih --</option>
                <?php
                $agama_options = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                foreach ($agama_options as $opt) : ?>
                    <option value="<?= $opt ?>" <?= (old('agama_suami', $detail['agama_suami'] ?? '') === $opt) ? 'selected' : '' ?>><?= $opt ?></option>
                <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
                <?= session('errors.agama_suami') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="status_sebelum_nikah_suami">Status Sebelum Nikah (Suami) <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.status_sebelum_nikah_suami')) ? 'is-invalid' : '' ?>"
                   id="status_sebelum_nikah_suami"
                   name="status_sebelum_nikah_suami"
                   value="<?= old('status_sebelum_nikah_suami', $detail['status_sebelum_nikah_suami'] ?? '') ?>"
                   placeholder="Contoh: Jejaka, Duda"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.status_sebelum_nikah_suami') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat_suami">Alamat Suami <span class="text-danger">*</span></label>
            <textarea class="form-control <?= (session('errors.alamat_suami')) ? 'is-invalid' : '' ?>"
                      id="alamat_suami"
                      name="alamat_suami"
                      rows="3"
                      required><?= old('alamat_suami', $detail['alamat_suami'] ?? '') ?></textarea>
            <div class="invalid-feedback">
                <?= session('errors.alamat_suami') ?>
            </div>
        </div>

        <hr>

        <h5 class="mt-4">Data Istri</h5>
        <div class="form-group mb-2">
            <label for="nama_istri">Nama Istri <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.nama_istri')) ? 'is-invalid' : '' ?>"
                   id="nama_istri"
                   name="nama_istri"
                   value="<?= old('nama_istri', $detail['nama_istri'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.nama_istri') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="ttl_istri">Tempat / Tanggal Lahir Istri <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.ttl_istri')) ? 'is-invalid' : '' ?>"
                   id="ttl_istri"
                   name="ttl_istri"
                   value="<?= old('ttl_istri', $detail['ttl_istri'] ?? '') ?>"
                   placeholder="Contoh: Bandung, 5 Mei 1992"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.ttl_istri') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="agama_istri">Agama Istri <span class="text-danger">*</span></label>
            <select class="form-control <?= (session('errors.agama_istri')) ? 'is-invalid' : '' ?>"
                    id="agama_istri"
                    name="agama_istri"
                    required>
                <option value="">-- Pilih --</option>
                <?php foreach ($agama_options as $opt) : ?>
                    <option value="<?= $opt ?>" <?= (old('agama_istri', $detail['agama_istri'] ?? '') === $opt) ? 'selected' : '' ?>><?= $opt ?></option>
                <?php endforeach ?>
            </select>
            <div class="invalid-feedback">
                <?= session('errors.agama_istri') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="status_sebelum_nikah_istri">Status Sebelum Nikah (Istri) <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.status_sebelum_nikah_istri')) ? 'is-invalid' : '' ?>"
                   id="status_sebelum_nikah_istri"
                   name="status_sebelum_nikah_istri"
                   value="<?= old('status_sebelum_nikah_istri', $detail['status_sebelum_nikah_istri'] ?? '') ?>"
                   placeholder="Contoh: Perawan, Janda"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.status_sebelum_nikah_istri') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="alamat_istri">Alamat Istri <span class="text-danger">*</span></label>
            <textarea class="form-control <?= (session('errors.alamat_istri')) ? 'is-invalid' : '' ?>"
                      id="alamat_istri"
                      name="alamat_istri"
                      rows="3"
                      required><?= old('alamat_istri', $detail['alamat_istri'] ?? '') ?></textarea>
            <div class="invalid-feedback">
                <?= session('errors.alamat_istri') ?>
            </div>
        </div>

        <hr>

        <h5 class="mt-4">Data Pernikahan</h5>
        <div class="form-group mb-2">
            <label for="hari_nikah">Hari Nikah <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.hari_nikah')) ? 'is-invalid' : '' ?>"
                   id="hari_nikah"
                   name="hari_nikah"
                   value="<?= old('hari_nikah', $detail['hari_nikah'] ?? '') ?>"
                   placeholder="Contoh: Minggu"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.hari_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="tbt_nikah">Tanggal / Bulan / Tahun Nikah <span class="text-danger">*</span></label>
            <input type="date"
                   class="form-control <?= (session('errors.tbt_nikah')) ? 'is-invalid' : '' ?>"
                   id="tbt_nikah"
                   name="tbt_nikah"
                   value="<?= old('tbt_nikah', $detail['tbt_nikah'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.tbt_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="tempat_akat_nikah">Tempat Akta Nikah <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.tempat_akat_nikah')) ? 'is-invalid' : '' ?>"
                   id="tempat_akat_nikah"
                   name="tempat_akat_nikah"
                   value="<?= old('tempat_akat_nikah', $detail['tempat_akat_nikah'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.tempat_akat_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="wali_nikah">Wali Nikah <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.wali_nikah')) ? 'is-invalid' : '' ?>"
                   id="wali_nikah"
                   name="wali_nikah"
                   value="<?= old('wali_nikah', $detail['wali_nikah'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.wali_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="mahar">Mahar <span class="text-danger">*</span></label>
            <input type="text"
                   class="form-control <?= (session('errors.mahar')) ? 'is-invalid' : '' ?>"
                   id="mahar"
                   name="mahar"
                   value="<?= old('mahar', $detail['mahar'] ?? '') ?>"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.mahar') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="saksi_nikah">Saksi Nikah <span class="text-danger">*</span></label>
            <textarea class="form-control <?= (session('errors.saksi_nikah')) ? 'is-invalid' : '' ?>"
                      id="saksi_nikah"
                      name="saksi_nikah"
                      rows="2"
                      placeholder="Contoh: Nama Saksi 1, Nama Saksi 2"
                      required><?= old('saksi_nikah', $detail['saksi_nikah'] ?? '') ?></textarea>
            <div class="invalid-feedback">
                <?= session('errors.saksi_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="jumlah_anak">Jumlah Anak <span class="text-danger">*</span></label>
            <input type="number"
                   class="form-control <?= (session('errors.jumlah_anak')) ? 'is-invalid' : '' ?>"
                   id="jumlah_anak"
                   name="jumlah_anak"
                   value="<?= old('jumlah_anak', $detail['jumlah_anak'] ?? '') ?>"
                   min="0"
                   required>
            <div class="invalid-feedback">
                <?= session('errors.jumlah_anak') ?>
            </div>
        </div>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="ktp_file">Upload KTP Suami & Istri (digabungkan) <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file"
                   id="ktp_file"
                   name="ktp_file"
                   class="form-control-file <?= (session('errors.ktp_file')) ? 'is-invalid' : '' ?>"
                   accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['ktp'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/surat_suami_istri/' . $surat['ktp']) ?>" target="_blank"><?= esc($surat['ktp']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
            <div class="invalid-feedback">
                <?= session('errors.ktp_file') ?>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="kk_file">Upload KK Suami & Istri (digabungkan) <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file"
                   id="kk_file"
                   name="kk_file"
                   class="form-control-file <?= (session('errors.kk_file')) ? 'is-invalid' : '' ?>"
                   accept=".jpg,.jpeg,.png,.pdf">
            <?php if (!empty($surat['kk'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/surat_suami_istri/' . $surat['kk']) ?>" target="_blank"><?= esc($surat['kk']) ?></a> (Kosongkan jika tidak ingin mengubah)</small>
            <?php else: ?>
                <small class="form-text text-muted">Belum ada file diunggah. Harap unggah file baru.</small>
            <?php endif; ?>
            <div class="invalid-feedback">
                <?= session('errors.kk_file') ?>
            </div>
        </div>
        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>