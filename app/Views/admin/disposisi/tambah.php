    <?= $this->extend('komponen/template-real-admin') ?>

    <?= $this->section('content') ?>
    <div class="container mt-4">
        <h2>Tambah Disposisi</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <!-- File Surat -->
        <?php if (!empty($suratMasuk['file_surat'])): ?>
            <div class="mb-4">
                <label class="form-label"><strong>File Surat:</strong></label><br>
                <?php
                $file = $suratMasuk['file_surat'];
                $ext = pathinfo($file, PATHINFO_EXTENSION);
                ?>
                <?php if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                    <img src="<?= base_url('uploads/surat_masuk/' . $file) ?>" alt="File Surat" class="img-fluid" style="max-height: 400px;">
                <?php elseif (strtolower($ext) == 'pdf'): ?>
                    <embed src="<?= base_url('uploads/surat_masuk/' . $file) ?>" type="application/pdf" width="100%" height="500px" />
                <?php else: ?>
                    <a href="<?= base_url('uploads/surat_masuk/' . $file) ?>" target="_blank" class="btn btn-primary">Download File Surat</a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">File surat tidak tersedia.</div>
        <?php endif; ?>
        <form action="<?= base_url('admin/disposisi/simpan') ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id_surat_masuk" value="<?= $suratMasuk['id_surat_masuk'] ?>">
            <div class="mb-3">
                <label class="form-label">Surat</label>
                <input type="text" name="surat_dari" value="<?= $suratMasuk['jenis_surat'] ?>" class="form-control" required readonly>
            </div>
            <div class="mb-3">
                <label class="form-label">Surat Dari</label>
                <input type="text" name="surat_dari" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">No Surat</label>
                <input type="text" name="nomor_surat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Surat</label>
                <input type="date" name="tanggal_surat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Diterima</label>
                <input type="date" name="tanggal_diterima" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">No Agenda</label>
                <input type="text" name="nomor_agenda" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Sifat</label>
                <select name="sifat" class="form-select" required>
                    <option value="Biasa">Biasa</option>
                    <option value="Segera">Segera</option>
                    <option value="Rahasia">Rahasia</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Perihal</label>
                <input type="text" name="perihal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Diteruskan Kepada</label>
                <select name="diteruskan_kepada" class="form-select" required>
                    <option value="">-- Pilih Pegawai --</option>
                    <?php foreach ($pegawaiList as $p): ?>
                        <option value="<?= $p['id_user'] ?>"><?= esc($p['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="catatan" class="form-control" rows="3"></textarea>
            </div>



            <button type="submit" class="btn btn-success mt-3">Simpan</button>
            <a href="<?= base_url('admin/disposisi') ?>" class="btn btn-secondary mt-3">Batal</a>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Inisialisasi Select2 -->
    <script>
        $(document).ready(function() {
            $('#id_surat_masuk').select2({
                placeholder: "-- Pilih Surat Masuk --",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    <?= $this->endSection() ?>