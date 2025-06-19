<?= $this->extend('komponen/template-admin') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Pengantar KK dan KTP</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form id="formKKKTP" action="<?= site_url('masyarakat/surat/pengantar-kk-ktp/ajukan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div id="form-container">
            <div class="form-person mb-4 border p-3 rounded">
                <h5>Data Orang 1</h5>

                <div class="form-group mb-2">
                    <label>Nama <span class="text-danger">*</span></label>
                    <input type="text" name="data[0][nama]" class="form-control" required>
                </div>

                <div class="form-group mb-2">
                    <label>No Kartu Keluarga <span class="text-danger">*</span></label>
                    <input type="text" name="data[0][no_kk]" class="form-control" required
                        maxlength="16" minlength="16" pattern="\d{16}"
                        oninput="this.value = this.value.replace(/\D/g, '')"
                        placeholder="Masukkan 16 digit KK">
                    <small class="form-text text-muted"></small>
                </div>

                <div class="form-group mb-2">
                    <label for="nik_0">NIK <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nik_0" name="data[0][nik]" required
                        maxlength="16" minlength="16" pattern="\d{16}"
                        oninput="this.value = this.value.replace(/\D/g, '')"
                        placeholder="Masukkan 16 digit NIK">
                    <small class="form-text text-muted"></small>
                </div>

                <div class="form-group mb-2">
                    <label>Keterangan <span class="text-danger">*</span></label>
                    <textarea name="data[0][keterangan]" class="form-control" rows="2" required></textarea>
                </div>

                <div class="form-group mb-2">
                    <label>Jumlah <span class="text-danger">*</span></label>
                    <input type="number" name="data[0][jumlah]" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="form-group mb-2">
            <label for="ktp_file">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="ktp_file" name="ktp" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="form-group mb-2">
            <label for="kk_file">Upload KK <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" id="kk_file" name="kk" class="form-control-file" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <button type="button" class="btn btn-success mb-3" onclick="addPerson()">+ Tambah Orang</button>
        <a href="/masyarakat/surat" class="btn btn-secondary mt-3 text-white">Batal</a>
        <button type="button" class="btn btn-primary" onclick="showConfirmationModal()">Ajukan Surat</button>
    </form>
</div>

<!-- Modal Konfirmasi -->
<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body" id="modal-body-content"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Ya, Ajukan</button>
            </div>
        </div>
    </div>
</div>

<script>
    let count = 1;

    function addPerson() {
        const container = document.getElementById('form-container');

        const formHTML = `
        <div class="form-person mb-4 border p-3 rounded">
            <h5>Data Orang ${count + 1}</h5>

            <div class="form-group mb-2">
                <label>Nama <span class="text-danger">*</span></label>
                <input type="text" name="data[${count}][nama]" class="form-control" required>
            </div>

            <div class="form-group mb-2">
                <label>No Kartu Keluarga <span class="text-danger">*</span></label>
                <input type="text" name="data[${count}][no_kk]" class="form-control" required
                       maxlength="16" minlength="16" pattern="\\d{16}"
                       oninput="this.value = this.value.replace(/\\D/g, '')"
                       placeholder="Masukkan 16 digit KK">
                <small class="form-text text-muted">Nomor KK harus 16 digit angka.</small>
            </div>

            <div class="form-group mb-2">
                <label>NIK <span class="text-danger">*</span></label>
                <input type="text" name="data[${count}][nik]" class="form-control" required
                       maxlength="16" minlength="16" pattern="\\d{16}"
                       oninput="this.value = this.value.replace(/\\D/g, '')"
                       placeholder="Masukkan 16 digit NIK">
                <small class="form-text text-muted">NIK harus 16 digit angka.</small>
            </div>

            <div class="form-group mb-2">
                <label>Keterangan <span class="text-danger">*</span></label>
                <textarea name="data[${count}][keterangan]" class="form-control" rows="2" required></textarea>
            </div>

            <div class="form-group mb-2">
                <label>Jumlah <span class="text-danger">*</span></label>
                <input type="number" name="data[${count}][jumlah]" class="form-control" required>
            </div>
        </div>
        `;

        container.insertAdjacentHTML('beforeend', formHTML);
        count++;
    }

    function showConfirmationModal() {
        const modalBody = document.getElementById('modal-body-content');
        modalBody.innerHTML = '';

        const personForms = document.querySelectorAll('.form-person');
        personForms.forEach((form, index) => {
            const nama = form.querySelector(`[name="data[${index}][nama]"]`).value;
            const no_kk = form.querySelector(`[name="data[${index}][no_kk]"]`).value;
            const nik = form.querySelector(`[name="data[${index}][nik]"]`).value;
            const keterangan = form.querySelector(`[name="data[${index}][keterangan]"]`).value;
            const jumlah = form.querySelector(`[name="data[${index}][jumlah]"]`).value;

            modalBody.innerHTML += `
                <h6><strong>Data Orang ${index + 1}</strong></h6>
                <p><strong>Nama:</strong> ${nama}</p>
                <p><strong>No KK:</strong> ${no_kk}</p>
                <p><strong>NIK:</strong> ${nik}</p>
                <p><strong>Keterangan:</strong> ${keterangan}</p>
                <p><strong>Jumlah:</strong> ${jumlah}</p>
                <hr>
            `;
        });

        const ktpFile = document.getElementById('ktp_file').files[0];
        const kkFile = document.getElementById('kk_file').files[0];

        modalBody.innerHTML += `
            <h6 class="mt-4"><strong>Dokumen Pendukung</strong></h6>
            <p><strong>KTP:</strong> ${ktpFile ? ktpFile.name : 'Belum ada file dipilih'}</p>
            <p><strong>KK:</strong> ${kkFile ? kkFile.name : 'Belum ada file dipilih'}</p>
        `;

        const confirmModal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
        confirmModal.show();
    }

    function submitForm() {
        document.getElementById('formKKKTP').submit();
    }
</script>

<?= $this->endSection() ?>