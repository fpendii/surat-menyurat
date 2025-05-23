<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Pengantar KK dan KTP</h2>

    <!-- Catatan dari Kepala Desa -->
    <?php if (!empty($surat['catatan'])): ?>
        <div class="alert alert-warning">
            <strong>Catatan dari Kepala Desa:</strong><br>
            <?= nl2br(esc($surat['catatan'])) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('masyarakat/surat/pengantar-kk-ktp/update/' . $surat['id_surat']) ?>" method="POST">
        <?= csrf_field() ?>

        <div id="form-container">
            <?php foreach ($dataOrang as $index => $orang): ?>
            <div class="form-person mb-4 border p-3 rounded">
                <h5>Data Orang <?= $index + 1 ?></h5>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="data[<?= $index ?>][nama]" class="form-control" value="<?= esc($orang['nama']) ?>" required>
                </div>

                <div class="form-group">
                    <label>No Kartu Keluarga</label>
                    <input type="text" name="data[<?= $index ?>][no_kk]" class="form-control" value="<?= esc($orang['no_kk']) ?>" required>
                </div>

                <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="data[<?= $index ?>][nik]" class="form-control" value="<?= esc($orang['nik']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="data[<?= $index ?>][keterangan]" class="form-control" rows="2" required><?= esc($orang['keterangan']) ?></textarea>
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="data[<?= $index ?>][jumlah]" class="form-control" value="<?= esc($orang['jumlah']) ?>" required>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <button type="button" class="btn btn-success mb-3" onclick="addPerson()">+ Tambah Orang</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<script>
    let count = <?= count($dataOrang) ?>;

    function addPerson() {
        const container = document.getElementById('form-container');

        const formHTML = `
        <div class="form-person mb-4 border p-3 rounded">
            <h5>Data Orang ${count + 1}</h5>

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="data[${count}][nama]" class="form-control" required>
            </div>

            <div class="form-group">
                <label>No Kartu Keluarga</label>
                <input type="text" name="data[${count}][no_kk]" class="form-control" required>
            </div>

            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="data[${count}][nik]" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="data[${count}][keterangan]" class="form-control" rows="2" required></textarea>
            </div>

            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" name="data[${count}][jumlah]" class="form-control" required>
            </div>
        </div>
        `;

        container.insertAdjacentHTML('beforeend', formHTML);
        count++;
    }
</script>

<?= $this->endSection() ?>
