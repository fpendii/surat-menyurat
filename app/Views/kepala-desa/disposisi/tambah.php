<!-- app/Views/kepala-desa/disposisi/form.php -->

<?= $this->extend('komponen/template-kepala-desa') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2 class="mb-4">Formulir Disposisi Surat</h2>
    <!-- Tampilkan detail singkat surat yang akan didisposisikan -->
    <p class="lead">Surat yang akan didisposisikan: <strong><?= esc($surat['jenis_surat']) ?></strong> (Nomor Surat: <?= esc($surat['no_surat'] ?? 'Tidak Tersedia') ?>)</p>
    <a href="<?= base_url('uploads/surat_masuk/' . $surat['file_surat']) ?>" target="_blank" class="btn btn-info btn-sm mb-3">Lihat File Surat</a>

    <!-- Area untuk menampilkan pesan flashdata (error validasi, dll.) -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Formulir Pengisian Disposisi -->
    <form action="<?= site_url('kepala-desa/disposisi/simpan') ?>" method="post">
        <?= csrf_field() ?>
        <!-- Hidden input untuk mengirim ID surat masuk -->
        <input type="hidden" name="id_surat_masuk" value="<?= esc($surat['id_surat_masuk']) ?>">

        <div class="mb-3">
            <label for="surat_dari" class="form-label">Surat Dari</label>
            <input type="text" class="form-control" id="surat_dari" name="surat_dari" value="<?= old('surat_dari') ?>" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?= esc($surat['tanggal_surat']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">

                <label for="tanggal_diterima" class="form-label">Tanggal Pelaksanaan</label>
                <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="<?= old('tanggal_diterima', date('Y-m-d')) ?>" required>

                <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
                <input type="date" class="form-control" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="<?= old('tanggal_diterima', date('Y-m-d')) ?>" required>

            </div>
        </div>

        <div class="mb-3">
            <label for="nomor_agenda" class="form-label">Nomor Agenda (Opsional)</label>
            <input type="text" class="form-control" id="nomor_agenda" name="nomor_agenda" value="<?= old('nomor_agenda') ?>">
        </div>

        <div class="mb-3">
            <label for="sifat" class="form-label">Sifat Surat</label>
            <select class="form-select" id="sifat" name="sifat" required>
                <option value="">Pilih Sifat</option>
                <option value="Biasa" <?= old('sifat') == 'Biasa' ? 'selected' : '' ?>>Biasa</option>
                <option value="Penting" <?= old('sifat') == 'Penting' ? 'selected' : '' ?>>Penting</option>
                <option value="Rahasia" <?= old('sifat') == 'Rahasia' ? 'selected' : '' ?>>Rahasia</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="perihal" class="form-label">Perihal</label>
            <textarea class="form-control" id="perihal" name="perihal" rows="3" required><?= old('perihal') ?></textarea>
        </div>

        <!-- Input untuk memilih pegawai yang akan didisposisikan (multi-select) -->
        <div class="mb-3">
            <label for="diteruskan_kepada" class="form-label">Diteruskan Kepada Pegawai</label>
            <select class="form-select" id="diteruskan_kepada" name="diteruskan_kepada" required>
                <option value="">Pilih Pegawai</option>
                <?php if (!empty($daftar_pegawai)): ?>
                    <?php $selected_pegawai = old('diteruskan_kepada') ?? ''; ?>
                    <?php foreach ($daftar_pegawai as $pegawai): ?>
                        <option value="<?= esc($pegawai['id_user']) ?>"
                            <?= $pegawai['name'] == $selected_pegawai ? 'selected' : '' ?>>
                            <?= esc($pegawai['name']) ?> (<?= esc($pegawai['role']) ?>)
                        </option>
                    <?php endforeach ?>
                <?php else: ?>
                    <option value="" disabled>Tidak ada data pegawai tersedia</option>
                <?php endif; ?>
            </select>
        </div>


        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan (Opsional)</label>
            <textarea class="form-control" id="catatan" name="catatan" rows="3"><?= old('catatan') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary me-2">Simpan Disposisi</button>
        <a href="<?= site_url('kepala-desa/disposisi') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?= $this->endSection() ?>