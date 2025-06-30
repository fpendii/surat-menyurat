<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pindah</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .surat {
            padding: 30px;
            margin: 30px auto;
            max-width: 800px;
        }

        .kop-border {
            border-top: 4px solid black;
            border-bottom: 1px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 90px;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h5,
        .kop-text h4 {
            margin: 0;
            line-height: 1.3;
        }

        .text-isi {
            text-align: justify;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
        }

        .no-border td {
            border: none;
        }

        .bordered {
            border: 1px solid black;
        }

        /* Agar titik dua sejajar */
        .sejajar td:first-child {
            width: 20%;
        }

        .sejajar td:nth-child(2) {
            text-align: right;
            padding-right: 10px;
        }

        /* Styling untuk bagian tanda tangan */
        .ttd {
            text-align: right; /* Rata kanan untuk seluruh blok tanda tangan */
            margin-top: 50px;
        }

        .ttd p {
            margin: 0; /* Menghilangkan margin default pada paragraf di dalam ttd */
        }

        /* Menyesuaikan jarak antara "Kepala Desa Handil Suruk" dan nama */
        .ttd p:nth-of-type(2) { /* Menargetkan paragraf kedua di dalam .ttd ("Kepala Desa Handil Suruk") */
            margin-bottom: 80px; /* Atur jarak ini sesuai keinginan Anda, contoh: 80px */
        }

        /* Memberikan jarak dari elemen setelah float */
        .requirements {
            clear: both;
            margin-top: 50px; /* Jarak antara bagian ttd dan persyaratan */
        }
    </style>
</head>

<body>

    <div class="surat">
        <table style="width: 100%;">
            <tr>
                <td style="width: 90px; text-align: center;">
                    <img src="<?= $logo ?? '' ?>" alt="Logo" style="width: 70px;">
                </td>
                <td class="kop-text">
                    <h5><strong>PEMERINTAH KABUPATEN TANAH LAUT</strong></h5>
                    <h5><strong>KECAMATAN BUMI MAKMUR</strong></h5>
                    <h4><strong>DESA HANDIL SURUK</strong></h4>
                    <p style="font-size: 13px; margin: 0;">
                        Alamat: Jl. Suka Damai Rt 04 Rw 02 Desa Handil Suruk Kec. Bumi Makmur Kode Pos 70853<br>
                        Email : desahandilsuruk@gmail.com
                    </p>
                </td>
            </tr>
        </table>

        <div class="kop-border"></div>

        <div style="text-align: center; margin-bottom: 20px;">
            <h5><u><strong>SURAT KETERANGAN DOMISILI</strong></u></h5>
            <p>Nomor : <?= $no_surat ?? '...' ?></p>
        </div>

        <div class="text-isi">
            <p>Yang Bertanda Tangan di bawah ini Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, Menerangkan dengan sebenarnya bahwa:</p>
            <table style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td style="width: 10px;">Nama</td>
                    <td style="width: 10px;">:</td>
                    <td><strong><?php echo $nama ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><strong><?php echo $jenis_kelamin ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td><strong><?php echo $ttl ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Kewarganegaraan</td>
                    <td>:</td>
                    <td><strong><?php echo $kewarganegaraan ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><strong><?php echo $agama ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Status Perkawinan</td>
                    <td>:</td>
                    <td><strong><?php echo $status_perkawinan ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><strong><?php echo $pekerjaan ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Pendidikan</td>
                    <td>:</td>
                    <td><strong><?php echo $pendidikan ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Alamat Asal</td>
                    <td>:</td>
                    <td><strong><?php echo $alamat_asal ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><strong><?php echo $nik ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Tujuan Pindah</td>
                    <td>:</td>
                    <td><strong><?php echo $tujuan_pindah ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Alasan Pindah</td>
                    <td>:</td>
                    <td><strong><?php echo $alasan_pindah ?? '...'; ?></strong></td>
                </tr>
                <tr>
                    <td>Jumlah Pengikut</td>
                    <td>:</td>
                    <td><strong><?php echo $jumlah_pengikut ?? '...'; ?></strong></td>
                </tr>
            </table>

            <?php if (!empty($nama_pengikut)): ?>
                <p>Data Pengikut:</p>
                <table class="bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Status Perkawinan</th>
                            <th>Pendidikan</th>
                            <th>No. KTP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nama_pengikut as $key => $pengikut): ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $pengikut ?></td>
                                <td><?= $jenis_kelamin_pengikut[$key] ?? '' ?></td>
                                <td><?= $umur_pengikut[$key] ?? '' ?></td>
                                <td><?= $status_perkawinan_pengikut[$key] ?? '' ?></td>
                                <td><?= $pendidikan_pengikut[$key] ?? '' ?></td>
                                <td><?= $no_ktp_pengikut[$key] ?? '' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <p>
                Demikian Surat Pindah ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
            </p>
        </div>

        <div class="ttd">
            <p>Handil Suruk, <?= date('d F Y', strtotime($created_at ?? date('Y-m-d'))) ?></p>
            <p>Kepala Desa Handil Suruk</p>
            <strong><u>KHALIKUL BASIR</u></strong>
        </div>
        <?php $role = session()->get('role'); ?>
        <?php if (isset($role) && $role === 'kepala_desa') : ?>
            <div class="requirements">
                <h4>Data Persyaratan:</h4>
                <ul>
                    <?php if (isset($ktp_file) && $ktp_file) : ?>
                        <li>KTP:<a href="<?= base_url('lihat-file/ktp/' . $ktp_file) ?>" target="_blank"><?= $ktp_file ?></a>
                        </li>
                    <?php else : ?>
                        <li>KTP : Tidak tersedia</li>
                    <?php endif; ?>

                    <?php if (isset($kk_file) && $kk_file) : ?>
                        <li>KK : <a href="<?= base_url('lihat-file/kk/' . $kk_file) ?>" target="_blank"><?= $kk_file ?></a></li>
                    <?php else : ?>
                        <li>KK : Tidak tersedia</li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>