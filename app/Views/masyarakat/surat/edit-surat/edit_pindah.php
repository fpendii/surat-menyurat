<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Edit Surat Pindah</h2>

    <form action="<?= site_url('masyarakat/surat/pindah/update/' . $surat['id_surat']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="no_surat" value="<?= esc($surat['no_surat']) ?>">
        <!-- Data Pemohon -->
        <h5>Data Pemohon</h5>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" class="form-control" name="nama" value="<?= esc($suratPindah['nama']) ?>" required>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select class="form-control" name="jenis_kelamin" required>
                <option value="L" <?= $suratPindah['jenis_kelamin'] === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= $suratPindah['jenis_kelamin'] === 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="form-group">
            <label>Tempat / Tanggal Lahir</label>
            <input type="text" class="form-control" name="ttl" value="<?= esc($suratPindah['ttl']) ?>" required>
        </div>

        <div class="form-group">
            <label>Kewarganegaraan</label>
            <input type="text" class="form-control" name="kewarganegaraan" value="<?= esc($suratPindah['kewarganegaraan']) ?>" required>
        </div>

        <div class="form-group">
            <label>Agama</label>
            <input type="text" class="form-control" name="agama" value="<?= esc($suratPindah['agama']) ?>" required>
        </div>

        <div class="form-group">
            <label>Status Perkawinan</label>
            <input type="text" class="form-control" name="status_perkawinan" value="<?= esc($suratPindah['status_perkawinan']) ?>" required>
        </div>

        <div class="form-group">
            <label>Pekerjaan</label>
            <input type="text" class="form-control" name="pekerjaan" value="<?= esc($suratPindah['pekerjaan']) ?>" required>
        </div>

        <div class="form-group">
            <label>Pendidikan</label>
            <input type="text" class="form-control" name="pendidikan" value="<?= esc($suratPindah['pendidikan']) ?>" required>
        </div>

        <div class="form-group">
            <label>Alamat Asal</label>
            <textarea class="form-control" name="alamat_asal" required><?= esc($suratPindah['alamat_asal']) ?></textarea>
        </div>

        <div class="form-group">
            <label>NIK</label>
            <input type="text" class="form-control" name="nik" value="<?= esc($suratPindah['nik']) ?>" required>
        </div>

        <div class="form-group">
            <label>Tujuan Pindah</label>
            <input type="text" class="form-control" name="tujuan_pindah" value="<?= esc($suratPindah['tujuan_pindah']) ?>" required>
        </div>

        <div class="form-group">
            <label>Alasan Pindah</label>
            <input type="text" class="form-control" name="alasan_pindah" value="<?= esc($suratPindah['alasan_pindah']) ?>" required>
        </div>

        <div class="form-group">
            <label>Jumlah Pengikut</label>
            <input type="number" class="form-control" id="jumlah_pengikut" name="jumlah_pengikut" min="1" value="<?= count($pengikutList) ?>" required>
        </div>

        <h5>Data Pengikut</h5>
        <div id="pengikut-wrapper">
            <?php foreach ($pengikutList as $i => $pengikut): ?>
                <div class="pengikut-group border p-3 rounded mb-3">
                    <h5>Data Pengikut <?= $i + 1 ?></h5>
                    <div class="form-group">
                        <label>Nama Pengikut</label>
                        <input type="text" class="form-control" name="nama_pengikut[]" value="<?= esc($pengikut['nama']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin_pengikut[]" required>
                            <option value="L" <?= $pengikut['jenis_kelamin'] === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= $pengikut['jenis_kelamin'] === 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Umur</label>
                        <input type="number" class="form-control" name="umur_pengikut[]" value="<?= esc($pengikut['umur']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Status Perkawinan</label>
                        <input type="text" class="form-control" name="status_perkawinan_pengikut[]" value="<?= esc($pengikut['status_perkawinan']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Pendidikan</label>
                        <input type="text" class="form-control" name="pendidikan_pengikut[]" value="<?= esc($pengikut['pendidikan']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>No. KTP</label>
                        <input type="text" class="form-control" name="no_ktp_pengikut[]" value="<?= esc($pengikut['no_ktp']) ?>" required>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <h5>Upload Berkas Baru (Opsional)</h5>
        <div class="form-group">
            <label>Kartu Keluarga (KK)</label>
            <input type="file" class="form-control-file" name="file_kk" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="form-group">
            <label>KTP</label>
            <input type="file" class="form-control-file" name="file_ktp" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="form-group">
            <label>Form F1</label>
            <input type="file" class="form-control-file" name="file_f1" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>

<?= $this->endSection() ?>
