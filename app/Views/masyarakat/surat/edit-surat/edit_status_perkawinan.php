<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Keterangan Kawin</h2>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif ?>

    <!-- Catatan dari Kepala Desa -->
    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/status-perkawinan/update/' . $detail['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (isset($validation) && $validation->hasError('nama')) ? 'is-invalid' : '' ?>"
                id="nama"
                name="nama"
                value="<?= old('nama', $detail['nama']) ?>"
                required>
            <?php if (isset($validation) && $validation->hasError('nama')) : ?>
                <div class="invalid-feedback"><?= $validation->getError('nama') ?></div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (isset($validation) && $validation->hasError('nik')) ? 'is-invalid' : '' ?>"
                id="nik"
                name="nik"
                value="<?= old('nik', $detail['nik']) ?>"
                required
                maxlength="16"
                pattern="\d{16}"
                title="NIK harus terdiri dari 16 digit angka"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,16);">
            <?php if (isset($validation) && $validation->hasError('nik')) : ?>
                <div class="invalid-feedback"><?= $validation->getError('nik') ?></div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input
                type="text"
                class="form-control <?= (isset($validation) && $validation->hasError('ttl')) ? 'is-invalid' : '' ?>"
                id="ttl"
                name="ttl"
                placeholder="Contoh: Surabaya, 14 Februari 1995"
                value="<?= old('ttl', $detail['ttl']) ?>"
                required>
            <?php if (isset($validation) && $validation->hasError('ttl')) : ?>
                <div class="invalid-feedback"><?= $validation->getError('ttl') ?></div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (isset($validation) && $validation->hasError('agama')) ? 'is-invalid' : '' ?>"
                id="agama"
                name="agama"
                required>
                <?php
                $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                $selectedAgama = old('agama', $detail['agama']);
                ?>
                <option value="">-- Pilih --</option>
                <?php foreach ($agamaList as $agama): ?>
                    <option value="<?= $agama ?>" <?= $selectedAgama == $agama ? 'selected' : '' ?>><?= $agama ?></option>
                <?php endforeach ?>
            </select>
            <?php if (isset($validation) && $validation->hasError('agama')) : ?>
                <div class="invalid-feedback"><?= $validation->getError('agama') ?></div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea
                class="form-control <?= (isset($validation) && $validation->hasError('alamat')) ? 'is-invalid' : '' ?>"
                id="alamat"
                name="alamat"
                rows="3"
                required><?= old('alamat', $detail['alamat']) ?></textarea>
            <?php if (isset($validation) && $validation->hasError('alamat')) : ?>
                <div class="invalid-feedback"><?= $validation->getError('alamat') ?></div>
            <?php endif ?>
        </div>

        <div class="form-group">
            <label for="status">Status <span class="text-danger">*</span></label>
            <?php
            $statusList = ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati'];
            $selectedStatus = old('status', $detail['status']);
            ?>
            <select
                class="form-control <?= (isset($validation) && $validation->hasError('status')) ? 'is-invalid' : '' ?>"
                id="status"
                name="status"
                required>
                <option value="">-- Pilih --</option>
                <?php foreach ($statusList as $status): ?>
                    <option value="<?= $status ?>" <?= $selectedStatus == $status ? 'selected' : '' ?>><?= $status ?></option>
                <?php endforeach ?>
            </select>
            <?php if (isset($validation) && $validation->hasError('status')) : ?>
                <div class="invalid-feedback"><?= $validation->getError('status') ?></div>
            <?php endif ?>
        </div>


        <div class="form-group">
            <label for="ktp">Upload KTP <small class="text-muted"></small> <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf">
        </div>

        <div class="form-group">
            <label for="kk">Upload KK <small class="text-muted"></small> <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf">
        </div>
        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

<?= $this->endSection() ?>