<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Ajukan Surat Pindah</h2>

    <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form id="formSuratPindah" action="<?= site_url('masyarakat/surat/pindah/ajukan') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <h5 class="mt-3">Data Pemohon</h5>
        <div class="form-group mb-2">
            <label for="nama">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="" disabled <?= old('jenis_kelamin') ? '' : 'selected' ?>>-- Pilih --</option>
                <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>


        <div class="form-group mb-2">
            <label for="ttl">Tempat / Tanggal Lahir <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="ttl" name="ttl" placeholder="Contoh: Bandung, 01 Januari 1990" value="<?= old('ttl') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="kewarganegaraan">Kewarganegaraan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" value="<?= old('kewarganegaraan') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="agama">Agama <span class="text-danger">*</span></label>
            <select
                class="form-control <?= (session()->has('errors.agama')) ? 'is-invalid' : '' ?>"
                id="agama"
                name="agama"
                required>
                <option value="" <?= old('agama') == '' ? 'selected' : '' ?>>-- Pilih --</option>
                <option value="Islam" <?= old('agama') == 'Islam' ? 'selected' : '' ?>>Islam</option>
                <option value="Kristen" <?= old('agama') == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                <option value="Katolik" <?= old('agama') == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                <option value="Hindu" <?= old('agama') == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                <option value="Budha" <?= old('agama') == 'Budha' ? 'selected' : '' ?>>Budha</option>
                <option value="Konghucu" <?= old('agama') == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
            </select>
            <?php if (session()->has('errors.agama')) : ?>
                <div class="invalid-feedback">
                    <?= session('errors.agama') ?>
                </div>
            <?php endif ?>
        </div>

        <div class="form-group mb-2">
            <label for="status_perkawinan">Status Perkawinan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan" value="<?= old('status_perkawinan') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="pekerjaan">Pekerjaan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= old('pekerjaan') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="pendidikan">Pendidikan <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="<?= old('pendidikan') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="alamat_asal">Alamat Asal <span class="text-danger">*</span></label>
            <textarea class="form-control" id="alamat_asal" name="alamat_asal" rows="2" required><?= old('alamat_asal') ?></textarea>
        </div>

        <div class="form-group mb-2">
            <label for="nik">NIK <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nik" name="nik" required maxlength="16" minlength="16" pattern="\d{16}" oninput="this.value = this.value.replace(/\D/g, '')" placeholder="" value="<?= old('nik') ?>">
            <small class="form-text text-muted"></small>
        </div>

        <div class="form-group mb-2">
            <label for="tujuan_pindah">Tujuan Pindah <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tujuan_pindah" name="tujuan_pindah" value="<?= old('tujuan_pindah') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="alasan_pindah">Alasan Pindah <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="alasan_pindah" name="alasan_pindah" value="<?= old('alasan_pindah') ?>" required>
        </div>

        <div class="form-group mb-2">
            <label for="jumlah_pengikut">Jumlah Pengikut <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="jumlah_pengikut" name="jumlah_pengikut" min="0" value="<?= old('jumlah_pengikut', 0) ?>" required>
            <small class="form-text text-muted">Isi 0 jika tidak ada pengikut.</small>
        </div>


        <h5 class="mt-4">Data Pengikut <small>(Opsional, isi jika jumlah pengikut > 0)</small></h5>
        <div id="pengikut-wrapper">
            <?php if (old('nama_pengikut') && is_array(old('nama_pengikut'))) : ?>
                <?php foreach (old('nama_pengikut') as $idx => $nama_pengikut) : ?>
                    <div class="pengikut-group border p-3 rounded mb-3">
                        <h5>Data Pengikut <?= $idx + 1 ?></h5>
                        <div class="form-group mb-2">
                            <label for="nama_pengikut_<?= $idx ?>">Nama Pengikut <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama_pengikut[]" id="nama_pengikut_<?= $idx ?>" value="<?= esc($nama_pengikut) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="jenis_kelamin_pengikut_<?= $idx ?>">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_kelamin_pengikut[]" id="jenis_kelamin_pengikut_<?= $idx ?>" required>
                                <option value="L" <?= old("jenis_kelamin_pengikut.$idx") == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= old("jenis_kelamin_pengikut.$idx") == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="umur_pengikut_<?= $idx ?>">Umur <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="umur_pengikut[]" id="umur_pengikut_<?= $idx ?>" value="<?= esc(old("umur_pengikut.$idx")) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status_perkawinan_pengikut_<?= $idx ?>">Status Perkawinan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="status_perkawinan_pengikut[]" id="status_perkawinan_pengikut_<?= $idx ?>" value="<?= esc(old("status_perkawinan_pengikut.$idx")) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="pendidikan_pengikut_<?= $idx ?>">Pendidikan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pendidikan_pengikut[]" id="pendidikan_pengikut_<?= $idx ?>" value="<?= esc(old("pendidikan_pengikut.$idx")) ?>" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="no_ktp_pengikut_<?= $idx ?>">No. KTP <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control"
                                name="no_ktp_pengikut[]"
                                id="no_ktp_pengikut_<?= $idx ?>"
                                value="<?= esc(old("no_ktp_pengikut.$idx")) ?>"
                                required
                                minlength="16"
                                maxlength="16"
                                pattern="\d{16}"
                                oninput="this.value = this.value.replace(/\D/g, '')">
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="tambah-pengikut">+ Tambah Pengikut</button>
        <button type="button" class="btn btn-danger mb-3 ms-2" id="hapus-pengikut">- Hapus Pengikut Terakhir</button>
        <br>

        <h5 class="mt-4">Upload Berkas</h5>
        <div class="form-group mb-2">
            <label for="file_ktp">Upload KTP <span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="file_ktp" name="file_ktp" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>

        <div class="form-group mb-2">
            <label for="file_kk">Upload KK<span class="text-danger">*</span>(jpg, jpeg, png, pdf)</label>
            <input type="file" class="form-control-file" id="file_kk" name="file_kk" accept=".jpg,.jpeg,.png,.pdf" required>
        </div>


        <button type="button" class="btn btn-primary mt-3" onclick="showConfirmationModal()">Ajukan Surat</button>
    </form>
</div>

<div class="modal fade" id="konfirmasiModal" tabindex="-1" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body" id="modal-body-content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Ya, Ajukan</button>
            </div>
        </div>
    </div>
</div>

<script>
    let pengikutCount = <?= old('nama_pengikut') ? count(old('nama_pengikut')) : 0 ?>;

    // Adjust initial display based on old data
    document.addEventListener('DOMContentLoaded', () => {
        if (pengikutCount > 0) {
            document.getElementById('jumlah_pengikut').value = pengikutCount;
        }
    });

    document.getElementById('tambah-pengikut').addEventListener('click', function() {
        const jumlahPengikutInput = document.getElementById('jumlah_pengikut');
        const currentJumlahPengikut = parseInt(jumlahPengikutInput.value);

        // Increment the number of followers displayed in the input field
        jumlahPengikutInput.value = currentJumlahPengikut + 1;
        pengikutCount = currentJumlahPengikut + 1; // Update global counter

        addPengikutForm(pengikutCount);
    });

    document.getElementById('hapus-pengikut').addEventListener('click', function() {
        const wrapper = document.getElementById('pengikut-wrapper');
        if (wrapper.children.length > 0) {
            wrapper.removeChild(wrapper.lastElementChild);
            pengikutCount--; // Decrement global counter
            document.getElementById('jumlah_pengikut').value = pengikutCount;
        }
    });

    function addPengikutForm(index) {
        const wrapper = document.getElementById('pengikut-wrapper');
        const newGroup = document.createElement('div');
        newGroup.classList.add('pengikut-group', 'border', 'p-3', 'rounded', 'mb-3');
        newGroup.innerHTML = `
            <h5>Data Pengikut ${index}</h5>
            <div class="form-group mb-2">
                <label for="nama_pengikut_${index}">Nama Pengikut <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_pengikut[]" id="nama_pengikut_${index}" required>
            </div>
            <div class="form-group mb-2">
                <label for="jenis_kelamin_pengikut_${index}">Jenis Kelamin <span class="text-danger">*</span></label>
                <select class="form-control" name="jenis_kelamin_pengikut[]" id="jenis_kelamin_pengikut_${index}" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="form-group mb-2">
                <label for="umur_pengikut_${index}">Umur <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="umur_pengikut[]" id="umur_pengikut_${index}" required>
            </div>
            <div class="form-group mb-2">
                <label for="status_perkawinan_pengikut_${index}">Status Perkawinan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="status_perkawinan_pengikut[]" id="status_perkawinan_pengikut_${index}" required>
            </div>
            <div class="form-group mb-2">
                <label for="pendidikan_pengikut_${index}">Pendidikan <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="pendidikan_pengikut[]" id="pendidikan_pengikut_${index}" required>
            </div>
            <div class="form-group mb-2">
                <label for="no_ktp_pengikut_${index}">No. KTP <span class="text-danger">*</span></label>
                <input type="text"
                    class="form-control"
                    name="no_ktp_pengikut[]"
                    id="no_ktp_pengikut_${index}"
                    required
                    minlength="16"
                    maxlength="16"
                    pattern="\\d{16}"
                    oninput="this.value = this.value.replace(/\\D/g, '')">
            </div>
        `;
        wrapper.appendChild(newGroup);
    }

    function showConfirmationModal() {
        const modalBody = document.getElementById('modal-body-content');
        modalBody.innerHTML = ''; // Clear previous content

        // Add applicant data
        modalBody.innerHTML += `
            <h6><strong>Data Pemohon</strong></h6>
            <p><strong>Nama:</strong> ${document.getElementById('nama').value}</p>
            <p><strong>Jenis Kelamin:</strong> ${document.getElementById('jenis_kelamin').options[document.getElementById('jenis_kelamin').selectedIndex].text}</p>
            <p><strong>Tempat / Tanggal Lahir:</strong> ${document.getElementById('ttl').value}</p>
            <p><strong>Kewarganegaraan:</strong> ${document.getElementById('kewarganegaraan').value}</p>
            <p><strong>Agama:</strong> ${document.getElementById('agama').value}</p>
            <p><strong>Status Perkawinan:</strong> ${document.getElementById('status_perkawinan').value}</p>
            <p><strong>Pekerjaan:</strong> ${document.getElementById('pekerjaan').value}</p>
            <p><strong>Pendidikan:</strong> ${document.getElementById('pendidikan').value}</p>
            <p><strong>Alamat Asal:</strong> ${document.getElementById('alamat_asal').value}</p>
            <p><strong>NIK:</strong> ${document.getElementById('nik').value}</p>
            <p><strong>Tujuan Pindah:</strong> ${document.getElementById('tujuan_pindah').value}</p>
            <p><strong>Alasan Pindah:</strong> ${document.getElementById('alasan_pindah').value}</p>
            <p><strong>Jumlah Pengikut:</strong> ${document.getElementById('jumlah_pengikut').value}</p>
            <hr>
        `;

        // Add followers data if any
        const pengikutForms = document.querySelectorAll('#pengikut-wrapper .pengikut-group');
        if (pengikutForms.length > 0) {
            modalBody.innerHTML += `<h6><strong>Data Pengikut</strong></h6>`;
            pengikutForms.forEach((form, index) => {
                const nama_pengikut = form.querySelector('[name="nama_pengikut[]"]').value;
                const jenis_kelamin_pengikut = form.querySelector('[name="jenis_kelamin_pengikut[]"]').options[form.querySelector('[name="jenis_kelamin_pengikut[]"]').selectedIndex].text;
                const umur_pengikut = form.querySelector('[name="umur_pengikut[]"]').value;
                const status_perkawinan_pengikut = form.querySelector('[name="status_perkawinan_pengikut[]"]').value;
                const pendidikan_pengikut = form.querySelector('[name="pendidikan_pengikut[]"]').value;
                const no_ktp_pengikut = form.querySelector('[name="no_ktp_pengikut[]"]').value;

                modalBody.innerHTML += `
                    <p><strong>Pengikut ${index + 1}:</strong></p>
                    <ul>
                        <li>Nama: ${nama_pengikut}</li>
                        <li>Jenis Kelamin: ${jenis_kelamin_pengikut}</li>
                        <li>Umur: ${umur_pengikut}</li>
                        <li>Status Perkawinan: ${status_perkawinan_pengikut}</li>
                        <li>Pendidikan: ${pendidikan_pengikut}</li>
                        <li>No. KTP: ${no_ktp_pengikut}</li>
                    </ul>
                `;
            });
            modalBody.innerHTML += `<hr>`;
        }


        // Add uploaded files
        const fileKk = document.getElementById('file_kk').files[0];
        const fileKtp = document.getElementById('file_ktp').files[0];
        const fileF1 = document.getElementById('file_f1').files[0];

        modalBody.innerHTML += `
            <h6 class="mt-4"><strong>Dokumen Pendukung</strong></h6>
            <p><strong>Kartu Keluarga (KK):</strong> ${fileKk ? fileKk.name : 'Belum ada file dipilih'}</p>
            <p><strong>KTP:</strong> ${fileKtp ? fileKtp.name : 'Belum ada file dipilih'}</p>
        `;

        // Show the modal
        const confirmModal = new bootstrap.Modal(document.getElementById('konfirmasiModal'));
        confirmModal.show();
    }

    function submitForm() {
        // Submit the form
        document.getElementById('formSuratPindah').submit();
    }
</script>

<?= $this->endSection() ?>