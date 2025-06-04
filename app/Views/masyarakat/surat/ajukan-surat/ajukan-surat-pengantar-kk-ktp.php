<!-- app/Views/ajukan_surat_pengantar_kkktp.php -->

<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Pengantar KK dan KTP</h2>

    <form action="<?= site_url('masyarakat/surat/pengantar-kk-ktp/ajukan') ?>"  method="POST">
        <?= csrf_field() ?>

        <div id="form-container">
            <div class="form-person mb-4 border p-3 rounded">
                <h5>Data Orang 1</h5>

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="data[0][nama]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>No Kartu Keluarga</label>
                    <input type="text" name="data[0][no_kk]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" required maxlength="16" minlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit NIK">
                    <small class="form-text text-muted">NIK harus 16 digit angka.</small>
                </div>


                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="data[0][keterangan]" class="form-control" rows="2" required></textarea>
                </div>

                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" name="data[0][jumlah]" class="form-control" required>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-success mb-3" onclick="addPerson()">+ Tambah Orang</button>
        <button type="submit" class="btn btn-primary">Ajukan Surat</button>
    </form>
</div>

<script>
    let count = 1;

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