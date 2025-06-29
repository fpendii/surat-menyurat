<?= $this->extend('komponen/template-real-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Masuk</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('admin/surat-masuk/update/' . $surat['id_surat_masuk']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT"> 

        <div class="form-group">
            <label for="jenis_surat">Jenis Surat</label>
            <input type="text" name="jenis_surat" class="form-control" value="<?= esc(old('jenis_surat', $surat['jenis_surat'])) ?>">
        </div>
        <div class="form-group mt-2" id="nomer_surat_group">
            <label for="no_surat">Nomer Surat</label>
            <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="Nomer Surat" value="<?= esc(old('no_surat', $surat['no_surat'])) ?>">
        </div>
        <div class="form-group mt-2" id="nama_instansi_group">
            <label for="nama_instansi">Nama Instansi</label>
            <input type="text" name="nama_instansi" id="nama_instansi" class="form-control" placeholder="Nama Instansi" value="<?= esc(old('nama_instansi', $surat['nama_instansi'])) ?>" required>
        </div>

        <div class="form-group mt-3">
            <label for="file_surat">File Surat (Kosongkan jika tidak ingin mengubah)</label>
            <input type="file" name="file_surat" class="form-control" accept=".pdf,.jpg,.png">
            <?php if (!empty($surat['file_surat'])): ?>
                <small class="form-text text-muted">File saat ini: <a href="<?= base_url('uploads/surat_masuk/' . $surat['file_surat']) ?>" target="_blank"><?= esc($surat['file_surat']) ?></a></small>
            <?php endif; ?>
        </div>
        <div class="form-group mt-3">
            <label for="tanggal_surat">Tanggal Surat</label>
            <input type="date" name="tanggal_surat" class="form-control" value="<?= esc(old('tanggal_surat', $surat['tanggal_surat'])) ?>" required>
        </div>
        
        <a href="/admin/surat-masuk" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
    </form>
</div>

<script>
    // Perhatikan: Script ini tidak memiliki elemen 'jenis_surat_lainnya' atau 'jenis_surat' select
    // di dalam kode yang Anda berikan untuk "tambah". Jika itu adalah fungsionalitas yang Anda inginkan
    // di sini juga, Anda perlu menambahkan elemen select dan input yang sesuai.
    // Saat ini, saya menghapus script yang tidak relevan dengan form ini,
    // atau Anda bisa menambahkan kembali jika diperlukan dengan elemen HTML yang ada.
    // const jenisSuratSelect = document.getElementById('jenis_surat');
    // const lainnyaGroup = document.getElementById('jenis_surat_lainnya_group');

    // if (jenisSuratSelect) { // Pastikan elemen ada sebelum menambahkan event listener
    //     jenisSuratSelect.addEventListener('change', function() {
    //         if (this.value === 'Lainnya') {
    //             lainnyaGroup.classList.remove('d-none');
    //             document.getElementById('jenis_surat_lainnya').setAttribute('required', true);
    //         } else {
    //             lainnyaGroup.classList.add('d-none');
    //             document.getElementById('jenis_surat_lainnya').removeAttribute('required');
    //         }
    //     });
    //     // Initial check if 'Lainnya' is selected on page load for existing data
    //     if (jenisSuratSelect.value === 'Lainnya') {
    //         lainnyaGroup.classList.remove('d-none');
    //         document.getElementById('jenis_surat_lainnya').setAttribute('required', true);
    //     }
    // }
</script>

<?= $this->endSection() ?>