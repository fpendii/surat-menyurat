<?= $this->extend('komponen/template-kepala-desa') ?>

<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Revisi Surat</h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('kepala-desa/pengajuan-surat/kirim-revisi/' . $dataSurat['id_surat']) ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label for="catatan_revisi">Catatan Revisi</label>
                <textarea name="catatan_revisi" id="catatan_revisi" class="form-control" rows="5" placeholder="Tulis catatan atau alasan revisi..." required><?= old('catatan_revisi') ?></textarea>
            </div>

            <button type="submit" class="btn btn-warning"><i class="fa fa-edit"></i> Kirim Revisi</button>
            <a href="<?= base_url('kepala-desa/pengajuan-surat') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
