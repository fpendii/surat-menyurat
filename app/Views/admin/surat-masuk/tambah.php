<?= $this->extend('komponen/template-real-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Upload Surat Masuk</h2>

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

    <form action="<?= site_url('admin/surat-masuk/simpan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="jenis_surat">Jenis Surat</label>
            <input type="text" name="jenis_surat" class="form-control">

        </div>
        <div class="form-group mt-2 " id="nomer_surat">
            <label for="no_surat">Nomer Surat</label>
            <input type="text" name="no_surat" id="no_surat" class="form-control" placeholder="Nomer Surat">
        </div>
        <div class="form-group mt-2 " id="nama_instansi">
            <label for="nama_instansi">Nama Instansi</label>
            <input type="text" name="nama_instansi" id="nama_instansi" class="form-control" placeholder="Nama Instansi" required>
        </div>

        <div class="form-group mt-3">
            <label for="file_surat">File Surat</label>
            <input type="file" name="file_surat" class="form-control" accept=".pdf,.jpg,.png" required>
        </div>
        <a href="/admin/surat-masuk" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="submit" class="btn btn-primary mt-3">Upload</button>
    </form>
</div>

<script>
    const jenisSuratSelect = document.getElementById('jenis_surat');
    const lainnyaGroup = document.getElementById('jenis_surat_lainnya_group');

    jenisSuratSelect.addEventListener('change', function() {
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