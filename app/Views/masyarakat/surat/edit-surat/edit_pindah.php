<!-- app/Views/edit_surat_domisili_bangunan.php -->

<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Domisili Bangunan</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="domisiliForm" action="<?= site_url('masyarakat/data-surat/domisili_bangunan/update/' . $detail['id_surat']) ?>" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="no_surat" value="<?= esc($surat['no_surat']) ?>">

        <div class="form-group mb-2">
            <label for="nama_gapoktan">Nama Bangunan <span class="text-danger">*</span></label>
            <input type="text" value="<?= esc($detail['nama_gapoktan']) ?>" class="form-control" id="nama_gapoktan" name="nama_gapoktan" required>
        </div>

        <div class="form-group mb-2">
            <label for="tgl_pembentukan">Tanggal Berdiri <span class="text-danger">*</span></label>
            <input type="date" value="<?= esc($detail['tgl_pembentukan']) ?>" class="form-control" id="tgl_pembentukan" name="tgl_pembentukan" required>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
            <input type="text" value="<?= esc($detail['alamat']) ?>" class="form-control" id="alamat" name="alamat" required>
        </div>

        <div class="form-group mb-2">
            <label for="ketua">Penanggung Jawab <span class="text-danger">*</span></label>
            <input type="text" value="<?= esc($detail['ketua']) ?>" class="form-control" id="ketua" name="ketua" required>
        </div>

        <div class="form-group mb-2">
            <label for="sekretaris">Sekretaris <span class="text-danger">*</span></label>
            <input type="text" value="<?= esc($detail['sekretaris']) ?>" class="form-control" id="sekretaris" name="sekretaris" required>
        </div>

        <div class="form-group mb-2">
            <label for="bendahara">Bendahara <span class="text-danger">*</span></label>
            <input type="text" value="<?= esc($detail['bendahara']) ?>" class="form-control" id="bendahara" name="bendahara" required>
        </div>
        <a href="/masyarakat/data-surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="button" class="btn btn-primary mt-3" onclick="showConfirmationModal()">Simpan</button>
    </form>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Data Domisili Bangunan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Bangunan:</strong> <span id="preview_nama_gapoktan"></span></p>
                <p><strong>Tanggal Berdiri:</strong> <span id="preview_tgl_pembentukan"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>
                <p><strong>Penanggung Jawab:</strong> <span id="preview_ketua"></span></p>
                <p><strong>Sekretaris:</strong> <span id="preview_sekretaris"></span></p>
                <p><strong>Bendahara:</strong> <span id="preview_bendahara"></span></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button class="btn btn-success" onclick="submitForm()">Ya, Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk Preview Modal -->
<script>
    function showConfirmationModal() {
        document.getElementById('preview_nama_gapoktan').textContent = document.getElementById('nama_gapoktan').value;
        document.getElementById('preview_tgl_pembentukan').textContent = document.getElementById('tgl_pembentukan').value;
        document.getElementById('preview_alamat').textContent = document.getElementById('alamat').value;
        document.getElementById('preview_ketua').textContent = document.getElementById('ketua').value;
        document.getElementById('preview_sekretaris').textContent = document.getElementById('sekretaris').value;
        document.getElementById('preview_bendahara').textContent = document.getElementById('bendahara').value;

        const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
        modal.show();
    }

    function submitForm() {
        document.getElementById('domisiliForm').submit();
    }
</script>

<?= $this->endSection() ?>