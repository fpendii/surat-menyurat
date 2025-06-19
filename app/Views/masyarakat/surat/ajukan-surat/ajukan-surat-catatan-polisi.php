<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Catatan Kepolisian</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="formCatatanPolisi" action="<?= site_url('masyarakat/surat/catatan-polisi/ajukan') ?>"
        method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <!-- ===== Data Diri ===== -->
        <div class="form-group">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>"
                id="nama" name="nama" value="<?= old('nama') ?>" required>
            <div class="invalid-feedback"><?= session('errors.nama') ?></div>
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control <?= (session('errors.jenis_kelamin')) ? 'is-invalid' : '' ?>"
                id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki‑laki</option>
            </select>
            <div class="invalid-feedback"><?= session('errors.jenis_kelamin') ?></div>
        </div>

        <div class="form-group">
            <label for="tempat_tanggal_lahir">Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.tempat_tanggal_lahir')) ? 'is-invalid' : '' ?>"
                id="tempat_tanggal_lahir" name="tempat_tanggal_lahir"
                placeholder="Contoh: Bandung, 10 Januari 2000"
                value="<?= old('tempat_tanggal_lahir') ?>" required>
            <div class="invalid-feedback"><?= session('errors.tempat_tanggal_lahir') ?></div>
        </div>

        <div class="form-group">
            <label for="status_perkawinan">Status Perkawinan <span class="text-danger">*</span></label>
            <select class="form-control <?= (session('errors.status_perkawinan')) ? 'is-invalid' : '' ?>"
                id="status_perkawinan" name="status_perkawinan" required>
                <option value="">-- Pilih --</option>
                <?php
                $statuses = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
                foreach ($statuses as $s):
                ?>
                    <option value="<?= $s ?>" <?= old('status_perkawinan') == $s ? 'selected' : '' ?>><?= $s ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback"><?= session('errors.status_perkawinan') ?></div>
        </div>

        <div class="form-group">
            <label for="kewarganegaraan">Kewarganegaraan <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.kewarganegaraan')) ? 'is-invalid' : '' ?>"
                id="kewarganegaraan" name="kewarganegaraan"
                value="<?= old('kewarganegaraan', '') ?>" required>
            <div class="invalid-feedback"><?= session('errors.kewarganegaraan') ?></div>
        </div>

        <div class="form-group">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select class="form-control <?= (session('errors.agama')) ? 'is-invalid' : '' ?>"
                id="agama" name="agama" required>
                <option value="">-- Pilih --</option>
                <?php
                $agamas = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                foreach ($agamas as $a):
                ?>
                    <option value="<?= $a ?>" <?= old('agama') == $a ? 'selected' : '' ?>><?= $a ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback"><?= session('errors.agama') ?></div>
        </div>

        <div class="form-group">
            <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.pekerjaan')) ? 'is-invalid' : '' ?>"
                id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan') ?>" required>
            <div class="invalid-feedback"><?= session('errors.pekerjaan') ?></div>
        </div>

        <div class="form-group">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text"
                class="form-control <?= (session('errors.nik')) ? 'is-invalid' : '' ?>"
                id="nik" name="nik" value="<?= old('nik') ?>" required
                minlength="16" maxlength="16" pattern="\d{16}"
                oninput="this.value=this.value.replace(/\D/g,'')">
            <div class="invalid-feedback"><?= session('errors.nik') ?></div>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control <?= (session('errors.alamat')) ? 'is-invalid' : '' ?>"
                id="alamat" name="alamat" rows="3" required><?= old('alamat') ?></textarea>
            <div class="invalid-feedback"><?= session('errors.alamat') ?></div>
        </div>

        <!-- ===== Upload Berkas ===== -->
        <?php
        $files = [
            'kk'                  => 'KK ',
            'ktp'                 => 'KTP',
            'akta_lahir'          => 'Akta Lahir',
            'ijazah'              => 'Ijazah Terakhir',

        ];
        foreach ($files as $id => $label):
        ?>
            <div class="form-group">
                <label for="<?= $id ?>">Upload <?= $label ?> <span class="text-danger">*</span>
                    <small class="text-muted">(JPG, JPEG, PNG, PDF<?= $id == 'foto_latar_belakang' ? '/ZIP' : '' ?>)</small>
                </label>
                <input type="file"
                    class="form-control-file <?= (session("errors.$id")) ? 'is-invalid' : '' ?>"
                    id="<?= $id ?>" name="<?= $id ?>"
                    accept=".pdf,.jpg,.jpeg,.png<?= $id == 'foto_latar_belakang' ? ',.zip' : '' ?>" required>
                <div class="invalid-feedback"><?= session("errors.$id") ?></div>
            </div>
        <?php endforeach; ?>

        <!-- Tombol buka modal -->
        <button type="button" class="btn btn-primary mt-3"
            data-bs-toggle="modal" data-bs-target="#konfirmasiModal">
            Ajukan Surat
        </button>
    </form>
</div>

<!-- ===== Modal Konfirmasi ===== -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama:</strong> <span id="preview_nama"></span></p>
                <p><strong>Jenis Kelamin:</strong> <span id="preview_jk"></span></p>
                <p><strong>TTL:</strong> <span id="preview_ttl"></span></p>
                <p><strong>Status Perkawinan:</strong> <span id="preview_status"></span></p>
                <p><strong>Kewarganegaraan:</strong> <span id="preview_wn"></span></p>
                <p><strong>Agama:</strong> <span id="preview_agama"></span></p>
                <p><strong>Pekerjaan:</strong> <span id="preview_pekerjaan"></span></p>
                <p><strong>NIK:</strong> <span id="preview_nik"></span></p>
                <p><strong>Alamat:</strong> <span id="preview_alamat"></span></p>
                <hr>
                <h6 class="mb-2">Nama Berkas Ter‑upload</h6>
                <ul class="mb-0" style="list-style:disc;padding-left:20px;">
                    <?php foreach ($files as $id => $label): ?>
                        <li><?= $label ?>: <span id="file_<?= $id ?>"></span></li>
                    <?php endforeach; ?>
                </ul>
                <p class="text-danger mt-3">Pastikan semua data sudah benar sebelum dikirim!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Periksa Kembali</button>
                <button type="button" class="btn btn-success" id="submitModal">Ya, Ajukan!</button>
            </div>
        </div>
    </div>
</div>

<!-- ===== Script Preview dan Submit ===== -->
<script>
    /* Kirim form setelah konfirmasi */
    document.getElementById('submitModal').addEventListener('click', () => {
        document.getElementById('formCatatanPolisi').submit();
    });

    /* Isi preview ketika tombol Ajukan diklik */
    document.querySelector('[data-bs-target="#konfirmasiModal"]').addEventListener('click', () => {
        const g = id => document.getElementById(id);

        g('preview_nama').textContent = g('nama').value;
        g('preview_jk').textContent = g('jenis_kelamin').value;
        g('preview_ttl').textContent = g('tempat_tanggal_lahir').value;
        g('preview_status').textContent = g('status_perkawinan').value;
        g('preview_wn').textContent = g('kewarganegaraan').value;
        g('preview_agama').textContent = g('agama').value;
        g('preview_pekerjaan').textContent = g('pekerjaan').value;
        g('preview_nik').textContent = g('nik').value;
        g('preview_alamat').textContent = g('alamat').value;

        /* Tampilkan nama file (atau “‑”) */
        const fileIds = ['kk', 'ktp', 'akta_lahir', 'ijazah'];
        fileIds.forEach(id => {
            const fileInput = g(id);
            g('file_' + id).textContent = fileInput.files.length ? fileInput.files[0].name : '‑';
        });
    });
</script>

<?= $this->endSection() ?>