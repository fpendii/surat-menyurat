<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Keterangan Belum Bekerja</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="formBelumBekerja" action="<?= site_url('masyarakat/surat/belum-bekerja/ajukan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="form-group mb-2">
            <label for="nama">Nama<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nik" name="nik" value="<?= old('nik') ?>" required maxlength="16" minlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit NIK">
            <small class="form-text text-muted">NIK harus 16 digit angka.</small>
        </div>

        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl" name="ttl" value="<?= old('ttl') ?>" placeholder="Contoh: Bandung, 10 Oktober 2001" required>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select class="form-control" id="agama" name="agama" required>
                <option value="">-- Pilih --</option>
                <?php
                $agamas = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];
                foreach ($agamas as $agama) :
                ?>
                    <option value="<?= $agama ?>" <?= old('agama') == $agama ? 'selected' : '' ?>><?= $agama ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group mb-2">
            <label for="status_pekerjaan">Status Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="status_pekerjaan" name="status_pekerjaan" value="<?= old('status_pekerjaan') ?>" placeholder="Contoh: Belum bekerja" required>
        </div>

        <div class="form-group mb-2">
            <label for="warga_negara">Warga Negara <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="warga_negara" name="warga_negara" value="<?= old('warga_negara') ?>" placeholder="Contoh: Indonesia" required>
        </div>

        <div class="form-group mb-2">
            <label for="alamat">Alamat <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= old('alamat') ?></textarea>
        </div>

        <div class="form-group mb-2">
            <label for="ktp">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="d-flex justify-content-start align-items-center mt-3">
            <a href="/masyarakat/surat" class="btn btn-secondary me-2 text-white">Batal</a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Ajukan Surat</button>
        </div>
    </form>
</div>

<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body" id="modal-body-content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Periksa Kembali</button>
                <button type="button" class="btn btn-success" id="submitForm">Ya, Ajukan!</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('submitForm').addEventListener('click', function() {
        document.getElementById('formBelumBekerja').submit();
    });

    // Event listener for when the modal is about to be shown
    document.getElementById('konfirmasiModal').addEventListener('show.bs.modal', function() {
        const modalBody = document.getElementById('modal-body-content');
        modalBody.innerHTML = ''; // Clear previous content

        // Get form input values
        const nama = document.getElementById('nama').value;
        const nik = document.getElementById('nik').value;
        const ttl = document.getElementById('ttl').value;
        const jenisKelamin = document.getElementById('jenis_kelamin').value;
        const agama = document.getElementById('agama').value;
        const statusPekerjaan = document.getElementById('status_pekerjaan').value;
        const wargaNegara = document.getElementById('warga_negara').value;
        const alamat = document.getElementById('alamat').value;

        // Get file names (if selected)
        const ktpFileName = document.getElementById('ktp').files[0] ? document.getElementById('ktp').files[0].name : 'Belum ada file dipilih';
        const kkFileName = document.getElementById('kk').files[0] ? document.getElementById('kk').files[0].name : 'Belum ada file dipilih';

        // Populate modal body
        modalBody.innerHTML = `
           
            <p><strong>Nama:</strong> ${nama}</p>
            <p><strong>NIK:</strong> ${nik}</p>
            <p><strong>Tempat / Tanggal Lahir:</strong> ${ttl}</p>
            <p><strong>Jenis Kelamin:</strong> ${jenisKelamin}</p>
            <p><strong>Agama:</strong> ${agama}</p>
            <p><strong>Status Pekerjaan:</strong> ${statusPekerjaan}</p>
            <p><strong>Warga Negara:</strong> ${wargaNegara}</p>
            <p><strong>Alamat:</strong> ${alamat}</p>
            <hr>
            <h6><strong>Dokumen Pendukung:</strong></h6>
            <p><strong>KTP:</strong> ${ktpFileName}</p>
            <p><strong>KK:</strong> ${kkFileName}</p>
        `;
    });
</script>

<?= $this->endSection() ?>