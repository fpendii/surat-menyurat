<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Pengantar KK dan KTP</h2>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="formPengantarKKKTP" action="<?= site_url('masyarakat/surat/pengantar-kk-ktp/ajukan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <h5 class="mt-3">Data Orang yang Diajukan</h5>
        <div id="data-orang-wrapper">
            <div class="person-group border p-3 rounded mb-3">
                <div class="form-group mb-2">
                    <label for="nama_0">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama_0" name="data[0][nama]" value="<?= old('data.0.nama') ?>" required>
                </div>

                <div class="form-group mb-2">
                    <label for="no_kk_0">Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="no_kk_0" name="data[0][no_kk]" value="<?= old('data.0.no_kk') ?>" required minlength="16" maxlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit Nomor KK">
                </div>

                <div class="form-group mb-2">
                    <label for="nik_0">NIK <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nik_0" name="data[0][nik]" value="<?= old('data.0.nik') ?>" required minlength="16" maxlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="Masukkan 16 digit NIK">
                </div>

                <div class="form-group mb-2">
                    <label for="keterangan_0">Keterangan/Hubungan (misal: Ayah, Ibu, Anak) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="keterangan_0" name="data[0][keterangan]" value="<?= old('data.0.keterangan') ?>" placeholder="Contoh: Pemohon Utama / Suami / Istri / Anak" required>
                </div>

                <div class="form-group mb-2">
                    <label for="jumlah_0">Jumlah Dokumen yang Diajukan (per orang) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="jumlah_0" name="data[0][jumlah]" value="<?= old('data.0.jumlah') ?? 1 ?>" min="1" required>
                </div>

                <button type="button" class="btn btn-danger btn-sm mt-3 remove-person-group">Hapus Orang Ini</button>
            </div>
        </div>

        <button type="button" class="btn btn-secondary my-2" id="add-person-btn">+ Tambah Orang</button>

        <h5 class="mt-4">Upload Berkas Pendukung</h5>
        <div class="form-group mb-2">
            <label for="ktp">Upload KTP <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control-file <?= (session('errors.ktp')) ? 'is-invalid' : '' ?>" id="ktp" name="ktp" accept=".jpg,.jpeg,.png,.pdf" required>
            <div class="invalid-feedback"><?= session('errors.ktp') ?></div>
        </div>

        <div class="form-group mb-2">
            <label for="kk">Upload KK <span class="text-danger">*</span> <small>(jpg, jpeg, png, pdf)</small></label>
            <input type="file" class="form-control-file <?= (session('errors.kk')) ? 'is-invalid' : '' ?>" id="kk" name="kk" accept=".jpg,.jpeg,.png,.pdf" required>
            <div class="invalid-feedback"><?= session('errors.kk') ?></div>
        </div>

        <a href="/masyarakat/surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="button" class="btn btn-primary mt-3" onclick="showConfirmationModal()">Ajukan Surat</button>
    </form>
</div>

<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Data Pengajuan Surat Pengantar KK & KTP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Data Orang yang Diajukan</strong></h6>
                <div id="preview_data_orang">
                </div>

                <h6 class="mt-4"><strong>Dokumen Pendukung</strong></h6>
                <p><strong>KTP:</strong> <span id="preview_ktp_file"></span></p>
                <p><strong>KK:</strong> <span id="preview_kk_file"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Periksa Kembali</button>
                <button type="button" class="btn btn-success" onclick="submitForm()">Ya, Ajukan</button>
            </div>
        </div>
    </div>
</div>

<script>
    let personIndex = 0; // Initialize index for new persons

    document.getElementById('add-person-btn').addEventListener('click', function() {
        personIndex++;
        const wrapper = document.getElementById('data-orang-wrapper');
        const newGroup = document.createElement('div');
        newGroup.classList.add('person-group', 'border', 'p-3', 'rounded', 'mb-3');
        newGroup.innerHTML = `
            <div class="form-group mb-2">
                <label for="nama_${personIndex}">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nama_${personIndex}" name="data[${personIndex}][nama]" value="" required>
            </div>
            <div class="form-group mb-2">
                <label for="no_kk_${personIndex}">Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="no_kk_${personIndex}" name="data[${personIndex}][no_kk]" value="" required minlength="16" maxlength="16" pattern="\\d{16}" oninput="this.value = this.value.replace(/\\D/g, '')" placeholder="Masukkan 16 digit Nomor KK">
            </div>
            <div class="form-group mb-2">
                <label for="nik_${personIndex}">NIK <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nik_${personIndex}" name="data[${personIndex}][nik]" value="" required minlength="16" maxlength="16" pattern="\\d{16}" oninput="this.value = this.value.replace(/\\D/g, '')" placeholder="Masukkan 16 digit NIK">
            </div>
            <div class="form-group mb-2">
                <label for="keterangan_${personIndex}">Keterangan/Hubungan (misal: Ayah, Ibu, Anak) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="keterangan_${personIndex}" name="data[${personIndex}][keterangan]" value="" placeholder="Contoh: Suami / Istri / Anak" required>
            </div>
            <div class="form-group mb-2">
                <label for="jumlah_${personIndex}">Jumlah Dokumen yang Diajukan (per orang) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="jumlah_${personIndex}" name="data[${personIndex}][jumlah]" value="1" min="1" required>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-3 remove-person-group">Hapus Orang Ini</button>
        `;
        wrapper.appendChild(newGroup);
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-person-group')) {
            const groups = document.querySelectorAll('.person-group');
            if (groups.length > 1) { // Ensure at least one group remains
                e.target.closest('.person-group').remove();
            } else {
                alert("Minimal harus ada satu orang yang diajukan.");
            }
        }
    });

    function showConfirmationModal() {
        const previewContainer = document.getElementById('preview_data_orang');
        previewContainer.innerHTML = ''; // Clear previous preview content

        const personGroups = document.querySelectorAll('.person-group');
        personGroups.forEach((group, index) => {
            const nama = group.querySelector(`input[name="data[${index}][nama]"]`).value;
            const no_kk = group.querySelector(`input[name="data[${index}][no_kk]"]`).value;
            const nik = group.querySelector(`input[name="data[${index}][nik]"]`).value;
            const keterangan = group.querySelector(`input[name="data[${index}][keterangan]"]`).value;
            const jumlah = group.querySelector(`input[name="data[${index}][jumlah]"]`).value;

            const div = document.createElement('div');
            div.innerHTML = `
                <hr>
                <p><strong>Orang #${index + 1}</strong></p>
                <p><strong>Nama Lengkap:</strong> ${nama || '-'}</p>
                <p><strong>Nomor KK:</strong> ${no_kk || '-'}</p>
                <p><strong>NIK:</strong> ${nik || '-'}</p>
                <p><strong>Keterangan/Hubungan:</strong> ${keterangan || '-'}</p>
                <p><strong>Jumlah Dokumen:</strong> ${jumlah || '-'}</p>
            `;
            previewContainer.appendChild(div);
        });

        // Populate file names
        const ktpFile = document.getElementById('ktp').files[0];
        const kkFile = document.getElementById('kk').files[0];
        document.getElementById('preview_ktp_file').textContent = ktpFile ? ktpFile.name : 'Belum ada file dipilih';
        document.getElementById('preview_kk_file').textContent = kkFile ? kkFile.name : 'Belum ada file dipilih';

        // Show the modal
        new bootstrap.Modal(document.getElementById('konfirmasiModal')).show();
    }

    function submitForm() {
        document.getElementById('formPengantarKKKTP').submit();
    }
</script>

<?= $this->endSection() ?>