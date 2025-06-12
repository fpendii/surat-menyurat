<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Upload Surat Masuk</h2>
    <form action="<?= site_url('admin/surat-masuk/simpan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="jenis_surat">Jenis Surat</label>
            <select name="jenis_surat" id="jenis_surat" class="form-control" required>
                <option value="">-- Pilih Jenis Surat --</option>
                <option value="Surat Domisili Kelompok Tani">Surat Domisili Kelompok Tani</option>
                <option value="Surat Domisili Bangunan">Surat Domisili Bangunan</option>
                <option value="Surat Domisili Warga">Surat Domisili Warga</option>
                <option value="Surat Pindah">Surat Pindah</option>
                <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
                <option value="Surat Pengantar KK dan KTP">Surat Pengantar KK dan KTP</option>
                <option value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu</option>
                <option value="Surat Keterangan Belum Bekerja">Surat Keterangan Belum Bekerja</option>
                <option value="Surat Keterangan Kehilangan">Surat Keterangan Kehilangan</option>
                <option value="Surat Keterangan Catatan Polisi">Surat Keterangan Catatan Polisi</option>
                <option value="Surat Keterangan Kelahiran">Surat Keterangan Kelahiran</option>
                <option value="Surat Keterangan Kematian">Surat Keterangan Kematian</option>
                <option value="Surat Keterangan Ahli Waris">Surat Keterangan Ahli Waris</option>
                <option value="Surat Suami Istri">Surat Suami Istri</option>
                <option value="Surat Keterangan Status Perkawinan">Surat Keterangan Status Perkawinan</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>

        <div class="form-group mt-2 d-none" id="jenis_surat_lainnya_group">
            <label for="jenis_surat_lainnya">Jenis Surat Lainnya</label>
            <input type="text" name="jenis_surat_lainnya" id="jenis_surat_lainnya" class="form-control" placeholder="Masukkan jenis surat lainnya">
        </div>

        <div class="form-group mt-3">
            <label for="file_surat">File Surat</label>
            <input type="file" name="file_surat" class="form-control" accept=".pdf,.jpg,.png" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Upload</button>
    </form>
</div>

<script>
    const jenisSuratSelect = document.getElementById('jenis_surat');
    const lainnyaGroup = document.getElementById('jenis_surat_lainnya_group');

    jenisSuratSelect.addEventListener('change', function () {
        if (this.value === 'Lainnya') {
            lainnyaGroup.classList.remove('d-none');
            document.getElementById('jenis_surat_lainnya').setAttribute('required', true);
        } else {
            lainnyaGroup.classList.add('d-none');
            document.getElementById('jenis_surat_lainnya').removeAttribute('required');
        }
    });
</script>

<?= $this->endSection() ?>
