<?= $this->extend('komponen/template-real-admin') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <h2>Data Pengguna</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <a href="<?= base_url('admin/pengguna/tambah') ?>" class="btn btn-primary mb-3">Tambah Pengguna</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                    <th>Status Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Urutkan user berdasarkan role: admin, kepala_desa, pegawai, masyarakat
                $rolePriority = [
                    'admin' => 1,
                    'kepala_desa' => 2,
                    'pegawai' => 3,
                    'masyarakat' => 4
                ];
                usort($users, function ($a, $b) use ($rolePriority) {
                    $aPriority = $rolePriority[$a['role']] ?? 99;
                    $bPriority = $rolePriority[$b['role']] ?? 99;
                    return $aPriority <=> $bPriority;
                });
                ?>

                <?php if (!empty($users) && is_array($users)) : ?>
                    <?php $no = 1; foreach ($users as $user): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($user['name']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td>
                                <?php
                                switch ($user['role']) {
                                    case 'admin':
                                        $badge = 'danger';
                                        break;
                                    case 'kepala_desa':
                                        $badge = 'primary';
                                        break;
                                    case 'pegawai':
                                        $badge = 'info';
                                        break;
                                    case 'masyarakat':
                                        $badge = 'success';
                                        break;
                                    default:
                                        $badge = 'secondary';
                                }
                                ?>
                                <span class="badge bg-<?= $badge ?>">
                                    <?= ucfirst(str_replace('_', ' ', $user['role'])) ?>
                                </span>
                            </td>
                            <td><?= esc($user['phone']) ?></td>
                            <td><?= esc($user['address']) ?></td>
                            <td>
                                <?php if ($user['is_active']) : ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/pengguna/edit/' . $user['id_user']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <form action="<?= base_url('admin/pengguna/hapus/' . $user['id_user']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data pengguna.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
