<?= $this->extend('komponen/template-real-admin') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Edit Pengguna</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/pengguna/update/' . $user['id_user']) ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" value="<?= esc($user['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= esc($user['email']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi (Kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="masyarakat" <?= $user['role'] === 'masyarakat' ? 'selected' : '' ?>>Masyarakat</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="kepala_desa" <?= $user['role'] === 'kepala_desa' ? 'selected' : '' ?>>Kepala Desa</option>
                <option value="pegawai" <?= $user['role'] === 'pegawai' ? 'selected' : '' ?>>Pegawai</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">No. Telepon</label>
            <input type="text" name="phone" class="form-control" value="<?= esc($user['phone']) ?>">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <textarea name="address" class="form-control" rows="3"><?= esc($user['address']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="is_active" class="form-label">Status Akun</label>
            <select name="is_active" class="form-select">
                <option value="1" <?= $user['is_active'] == 1 ? 'selected' : '' ?>>Aktif</option>
                <option value="0" <?= $user['is_active'] == 0 ? 'selected' : '' ?>>Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('admin/pengguna') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<?= $this->endSection() ?>
