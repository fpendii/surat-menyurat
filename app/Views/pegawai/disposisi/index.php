<!-- app/Views/pegawai/disposisi/index.php -->

<?= $this->extend('komponen/template-pegawai') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Disposisi Saya</h2>

    <?php if (empty($disposisiList)) : ?>
        <p class="text-muted">Belum ada disposisi untuk Anda.</p>
    <?php else : ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($disposisiList as $d) : ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-1"><?= esc($d['perihal']) ?></h5>
                            <span class="badge bg-secondary"><?= esc($d['sifat']) ?></span>

                            <ul class="list-unstyled mt-3 mb-0">
                                <li><strong>Nomor Surat:</strong> <?= esc($d['nomor_surat']) ?></li>
                                <li><strong>Surat Dari:</strong> <?= esc($d['surat_dari']) ?></li>
                                <li><strong>Tgl. Surat:</strong> <?= esc($d['tanggal_surat']) ?></li>
                                <li><strong>Tgl. Diterima:</strong> <?= esc($d['tanggal_diterima']) ?></li>
                            </ul>

                            <?php if (!empty($d['catatan'])) : ?>
                                <p class="small text-muted mt-3 mb-0"><em>Catatan: <?= esc($d['catatan']) ?></em></p>
                            <?php endif; ?>
                        </div>

                        <div class="card-footer bg-transparent border-0">
                            <a href="<?= base_url('pegawai/disposisi/' . $d['id_disposisi']) ?>" class="btn btn-primary btn-sm w-100">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
