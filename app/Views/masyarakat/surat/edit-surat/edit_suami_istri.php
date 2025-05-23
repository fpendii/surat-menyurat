<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Suami Istri</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <!-- Catatan dari Kepala Desa -->
    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/suami-istri/update/' . $detail['id_surat']) ?>" method="POST">
        <?= csrf_field() ?>

        <h5 class="mt-4">Data Suami</h5>
        <div class="form-group">
            <label for="nama_suami">Nama Suami</label>
            <input type="text" class="form-control" id="nama_suami" name="nama_suami" value="<?= old('nama_suami', $detail['nama_suami']) ?>" required>
        </div>

        <div class="form-group">
            <label for="nik_suami">NIK Suami</label>
            <input type="text" class="form-control" id="nik_suami" name="nik_suami" value="<?= old('nik_suami', $detail['nik_suami']) ?>" required>
        </div>

        <div class="form-group">
            <label for="ttl_suami">Tempat / Tanggal Lahir Suami</label>
            <input type="text" class="form-control" id="ttl_suami" name="ttl_suami" value="<?= old('ttl_suami', $detail['ttl_suami']) ?>" required>
        </div>

        <div class="form-group">
            <label for="agama_suami">Agama Suami</label>
            <select class="form-control" id="agama_suami" name="agama_suami" required>
                <option value="">-- Pilih --</option>
                <?php
                $agama_suami = old('agama_suami', $detail['agama_suami']);
                $options = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                foreach ($options as $opt) : ?>
                    <option value="<?= $opt ?>" <?= $agama_suami === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat_suami">Alamat Suami</label>
            <textarea class="form-control" id="alamat_suami" name="alamat_suami" rows="3" required><?= old('alamat_suami', $detail['alamat_suami']) ?></textarea>
        </div>

        <hr>

        <h5 class="mt-4">Data Istri</h5>
        <div class="form-group">
            <label for="nama_istri">Nama Istri</label>
            <input type="text" class="form-control" id="nama_istri" name="nama_istri" value="<?= old('nama_istri', $detail['nama_istri']) ?>" required>
        </div>

        <div class="form-group">
            <label for="nik_istri">NIK Istri</label>
            <input type="text" class="form-control" id="nik_istri" name="nik_istri" value="<?= old('nik_istri', $detail['nik_istri']) ?>" required>
        </div>

        <div class="form-group">
            <label for="ttl_istri">Tempat / Tanggal Lahir Istri</label>
            <input type="text" class="form-control" id="ttl_istri" name="ttl_istri" value="<?= old('ttl_istri', $detail['ttl_istri']) ?>" required>
        </div>

        <div class="form-group">
            <label for="agama_istri">Agama Istri</label>
            <select class="form-control" id="agama_istri" name="agama_istri" required>
                <option value="">-- Pilih --</option>
                <?php
                $agama_istri = old('agama_istri', $detail['agama_istri']);
                foreach ($options as $opt) : ?>
                    <option value="<?= $opt ?>" <?= $agama_istri === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat_istri">Alamat Istri</label>
            <textarea class="form-control" id="alamat_istri" name="alamat_istri" rows="3" required><?= old('alamat_istri', $detail['alamat_istri']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Ajukan Surat</button>
    </form>
</div>

<?= $this->endSection() ?>
