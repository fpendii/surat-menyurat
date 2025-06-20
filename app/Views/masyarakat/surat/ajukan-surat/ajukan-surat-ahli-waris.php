<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Ahli Waris</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="formAhliWaris" enctype="multipart/form-data" method="POST" action="<?= site_url('masyarakat/surat/ahli-waris/ajukan') ?>">
        <?= csrf_field() ?>

        <h5 class="mt-3">Data Almarhum/ah</h5>
        <div class="form-group mb-2">
            <label>Nama Pemilik Harta (Almarhum/ah) <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?= (session('errors.pemilik_harta')) ? 'is-invalid' : '' ?>"
                   name="pemilik_harta" id="pemilik_harta" value="<?= old('pemilik_harta') ?>" required>
            <div class="invalid-feedback">
                <?= session('errors.pemilik_harta') ?>
            </div>
        </div>

        <div class="form-group mb-3">
            <label>Upload Surat Nikah Pemilik Harta <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
            <input type="file" class="form-control <?= (session('errors.surat_nikah')) ? 'is-invalid' : '' ?>"
                   name="surat_nikah" id="surat_nikah" accept=".pdf,.jpg,.jpeg,.png" required>
            <div class="invalid-feedback">
                <?= session('errors.surat_nikah') ?>
            </div>
        </div>

        <div class="form-group mb-3">
            <label>Upload Surat Kematian <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
            <input type="file" class="form-control <?= (session('errors.surat_kematian')) ? 'is-invalid' : '' ?>"
                   name="surat_kematian" id="surat_kematian" accept=".pdf,.jpg,.jpeg,.png" required>
            <div class="invalid-feedback">
                <?= session('errors.surat_kematian') ?>
            </div>
        </div>

        <hr>
        <h5>Data Ahli Waris</h5>
        <div id="ahli-waris-wrapper">
            <div class="ahli-waris-group border p-3 rounded mb-3">
                <div class="form-group mb-2">
                    <label>Nama Ahli Waris <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_ahli_waris[]" value="<?= old('nama_ahli_waris.0') ?>" required>
                    </div>
                <div class="form-group mb-2">
                    <label>NIK <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nik_ahli_waris[]" value="<?= old('nik_ahli_waris.0') ?>" required minlength="16" maxlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')">
                    </div>
                <div class="form-group mb-2">
                    <label>Tempat/Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="ttl_ahli_waris[]" value="<?= old('ttl_ahli_waris.0') ?>" placeholder="Contoh: Bandung, 01 Januari 1990" required>
                    </div>
                <div class="form-group mb-2">
                    <label>Alamat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="alamat[]" value="<?= old('alamat.0') ?>" placeholder="Contoh: Bandung, 01 Januari 1990" required>
                    </div>
                <div class="form-group mb-2">
                    <label>Hubungan dengan Almarhum <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="hubungan_ahli_waris[]" value="<?= old('hubungan_ahli_waris.0') ?>" required>
                    </div>
                <div class="form-group mb-2">
                    <label>Upload KTP <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                    <input type="file" class="form-control" name="ktp_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                <div class="form-group mb-2">
                    <label>Upload KK <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                    <input type="file" class="form-control" name="kk_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                <div class="form-group mb-2">
                    <label>Upload Akta Lahir <span class="text-danger">*</span> <small>(pdf, jpg, jpeg, png)</small></label>
                    <input type="file" class="form-control" name="akta_lahir_ahli_waris[]" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                <button type="button" class="btn btn-danger btn-sm mt-3 remove-ahli-waris">Hapus Ahli Waris Ini</button>
            </div>
        </div>

        <button type="button" class="btn btn-secondary my-2" id="tambah-ahli-waris">+ Tambah Ahli Waris</button>
        <br>
        <a href="/masyarakat/surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#konfirmasiModal">Ajukan Surat</button>
    </form>
</div>

<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Data Pengajuan Surat Ahli Waris</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <h6><strong>Data Almarhum/ah</strong></h6>
                <p><strong>Nama Pemilik Harta:</strong> <span id="preview_pemilik_harta"></span></p>
                <p><strong>Surat Nikah Pemilik Harta:</strong> <span id="preview_surat_nikah"></span></p>
                <p><strong>Surat Kematian:</strong> <span id="preview_surat_kematian"></span></p>

                <h6 class="mt-4"><strong>Data Ahli Waris</strong></h6>
                <div id="preview_ahli_waris">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Periksa Kembali</button>
                <button type="button" class="btn btn-success" id="konfirmasiSubmit">Ya, Ajukan!</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Clone logic for adding new ahli waris
    document.getElementById('tambah-ahli-waris').addEventListener('click', function() {
        const wrapper = document.getElementById('ahli-waris-wrapper');
        const originalGroup = wrapper.firstElementChild; // Get the first group to clone

        // Create a new clone
        const clone = originalGroup.cloneNode(true);

        // Clear values of cloned inputs
        clone.querySelectorAll('input').forEach(input => {
            input.value = '';
            // Reset validation states if any
            input.classList.remove('is-invalid');
            if (input.nextElementSibling && input.nextElementSibling.classList.contains('invalid-feedback')) {
                input.nextElementSibling.innerText = '';
            }
        });

        // Append the cloned group to the wrapper
        wrapper.appendChild(clone);
    });

    // Logic for removing ahli waris group
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-ahli-waris')) {
            const groups = document.querySelectorAll('.ahli-waris-group');
            if (groups.length > 1) { // Ensure at least one group remains
                e.target.closest('.ahli-waris-group').remove();
            } else {
                alert("Minimal harus ada satu ahli waris.");
            }
        }
    });

    // Event listener for showing the confirmation modal
    document.querySelector('[data-bs-target="#konfirmasiModal"]').addEventListener('click', function() {
        // --- Preview Data Pemilik Harta ---
        document.getElementById('preview_pemilik_harta').innerText = document.getElementById('pemilik_harta').value;

        // Preview Surat Nikah
        const suratNikahFile = document.getElementById('surat_nikah').files[0];
        document.getElementById('preview_surat_nikah').innerText = suratNikahFile ? suratNikahFile.name : 'Belum ada file dipilih';

        // Preview Surat Kematian
        const suratKematianFile = document.getElementById('surat_kematian').files[0];
        document.getElementById('preview_surat_kematian').innerText = suratKematianFile ? suratKematianFile.name : 'Belum ada file dipilih';

        // --- Preview Data Ahli Waris ---
        const ahliWarisContainer = document.getElementById('preview_ahli_waris');
        ahliWarisContainer.innerHTML = ''; // Clear previous preview content

        const ahliWarisGroups = document.querySelectorAll('.ahli-waris-group');
        ahliWarisGroups.forEach((group, index) => {
            const nama = group.querySelector('input[name="nama_ahli_waris[]"]').value;
            const nik = group.querySelector('input[name="nik_ahli_waris[]"]').value;
            const ttl = group.querySelector('input[name="ttl_ahli_waris[]"]').value;
            const hubungan = group.querySelector('input[name="hubungan_ahli_waris[]"]').value;

            // Get file names for each ahli waris
            const ktpAhliWarisFile = group.querySelector('input[name="ktp_ahli_waris[]"]').files[0];
            const kkAhliWarisFile = group.querySelector('input[name="kk_ahli_waris[]"]').files[0];
            const aktaLahirAhliWarisFile = group.querySelector('input[name="akta_lahir_ahli_waris[]"]').files[0];

            const div = document.createElement('div');
            div.innerHTML = `
                <hr>
                <p><strong>Ahli Waris ${index + 1}</strong></p>
                <p><strong>Nama:</strong> ${nama || '-'}</p>
                <p><strong>NIK:</strong> ${nik || '-'}</p>
                <p><strong>Tempat/Tanggal Lahir:</strong> ${ttl || '-'}</p>
                <p><strong>Hubungan:</strong> ${hubungan || '-'}</p>
                <p><strong>KTP:</strong> ${ktpAhliWarisFile ? ktpAhliWarisFile.name : 'Belum ada file dipilih'}</p>
                <p><strong>KK:</strong> ${kkAhliWarisFile ? kkAhliWarisFile.name : 'Belum ada file dipilih'}</p>
                <p><strong>Akta Lahir:</strong> ${aktaLahirAhliWarisFile ? aktaLahirAhliWarisFile.name : 'Belum ada file dipilih'}</p>
            `;
            ahliWarisContainer.appendChild(div);
        });
    });

    // Event listener for submitting the form from the modal
    document.getElementById('konfirmasiSubmit').addEventListener('click', function() {
        document.getElementById('formAhliWaris').submit();
    });
</script>

<?= $this->endSection() ?>