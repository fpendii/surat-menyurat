<?= $this->extend('komponen/template-pegawai') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <!-- File Surat -->
<?php if (!empty($disposisi['file_surat'])): ?>
    <div class="mb-4">
        <label class="form-label"><strong>📎 File Surat:</strong></label><br>
        <?php
        $file = $disposisi['file_surat'];
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
    <div class="alert alert-warning">📁 File surat tidak tersedia.</div>
<?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">📄 Detail Disposisi</h4>
                    <span class="badge bg-light text-dark"><?= esc($disposisi['sifat']) ?></span>
                </div>

                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">
                        <i class="bi bi-envelope-paper-fill me-2"></i><?= esc($disposisi['perihal']) ?>
                    </h5>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong><i class="bi bi-hash me-1"></i>Nomor Surat:</strong> <?= esc($disposisi['nomor_surat']) ?>
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-person-fill me-1"></i>Surat Dari:</strong> <?= esc($disposisi['surat_dari']) ?>
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-calendar-event me-1"></i>Tanggal Surat:</strong> <?= esc($disposisi['tanggal_surat']) ?>
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-calendar-check me-1"></i>Tanggal Diterima:</strong> <?= esc($disposisi['tanggal_diterima']) ?>
                        </li>
                        <li class="list-group-item">
                            <strong><i class="bi bi-arrow-right-circle me-1"></i>Diteruskan Kepada:</strong> <?= esc($disposisi['diteruskan_kepada']) ?>
                        </li>
                    </ul>

                    <?php if (!empty($disposisi['catatan'])) : ?>
                        <div class="alert alert-warning mt-4" role="alert">
                            <i class="bi bi-pencil-square me-1"></i><strong>Catatan:</strong><br>
                            <em><?= esc($disposisi['catatan']) ?></em>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="card-footer text-end bg-light">
                    <a href="<?= base_url('pegawai/disposisi') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
