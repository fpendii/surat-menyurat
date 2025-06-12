<?= $this->extend('komponen/template-real-admin') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Tambah Pengguna</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/pengguna/simpan') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="masyarakat" selected>Masyarakat</option>
                <option value="admin">Admin</option>
                <option value="kepala_desa">Kepala Desa</option>
                <option value="pegawai">Pegawai</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">No. Telepon</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea name="address" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Status Akun</label>
            <select name="is_active" class="form-select">
                <option value="1">Aktif</option>
                <option value="0" selected>Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('admin/pengguna') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>
