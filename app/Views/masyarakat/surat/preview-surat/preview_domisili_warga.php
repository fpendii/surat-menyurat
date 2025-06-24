<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Domisili</title>
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

        table tr td:first-child {
            width: 180px;
        }

        .ttd {
            text-align: right;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <div class="surat">
        <!-- Header dan Logo -->
        <table style="width: 100%;">
            <tr>
                <td style="width: 90px; text-align: center;">
                    <img src="<?= $logo ?>" alt="Logo" style="width: 70px;">
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

        <!-- Judul -->
        <div style="text-align: center; margin-bottom: 20px;">
            <h5><u><strong>SURAT KETERANGAN DOMISILI</strong></u></h5>
            <p>Nomor : <?= $no_surat ?? '...' ?></p>
        </div>

        <!-- Isi Surat -->
        <div class="text-isi">
            <p>Yang Bertanda Tangan di bawah ini:</p>

            <table style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td>Nama Pejabat</td>
                    <td>:</td>
                    <td><strong><?php echo $nama_pejabat; ?></strong></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><strong><?php echo $jabatan; ?></strong></td>
                </tr>
                <tr>
                    <td>Kecamatan Pejabat</td>
                    <td>:</td>
                    <td><?php echo $kecamatan_pejabat; ?></td>
                </tr>
                <tr>
                    <td>Kabupaten Pejabat</td>
                    <td>:</td>
                    <td><?php echo $kabupaten_pejabat; ?></td>
                </tr>
            </table>

            <p>Menerangkan dengan Sebenarnya bahwa:</p>

            <table style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td>Nama Warga</td>
                    <td>:</td>
                    <td><strong><?php echo $nama_warga; ?></strong></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><?php echo $nik; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo $alamat; ?></td>
                </tr>
                <tr>
                    <td>Desa</td>
                    <td>:</td>
                    <td><?php echo $desa; ?></td>
                </tr>
                <tr>
                    <td>Kecamatan</td>
                    <td>:</td>
                    <td><?php echo $kecamatan; ?></td>
                </tr>
                <tr>
                    <td>Kabupaten</td>
                    <td>:</td>
                    <td><?php echo $kabupaten; ?></td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>:</td>
                    <td><?php echo $provinsi; ?></td>
                </tr>
            </table>

            <p>
               Bahwa “<?php echo $nama_warga; ?>” tersebut di atas pada saat ini benar- benar berdomisili di Desa Handil Suruk RT 04 RW 02 Kec. Bumi Makmur, Kab. Tanah Laut Prov. Kalimantan Selatan
            </p>
        </div>

        <!-- Tanda Tangan -->
        <div class="ttd">
            <p>Dikeluarkan di Handil Suruk</p>
           <p>Pada Tanggal: <?php echo $created_at ?></p>
            <p style="margin-bottom: 60px;">Kepala Desa Handil Suruk</p>
            <strong><u>KHALIKUL BASIR</u></strong>
        </div>

        <?php if (session('role') === 'kepala_desa') : ?>
            <div class="requirements">
                <h4>Data Persyaratan:</h4>
                <ul>
                    <?php
                    // Assuming 'ktp_file' and 'kk_file' are passed for this specific letter type
                    // You might need to retrieve these from the 'surat' table or a specific 'surat_domisili_gapoktan' table
                    // if they are not already available in the $data array passed to this view.
                    // For example, if your SuratModel has 'ktp' and 'kk' columns.
                    // If not, you'd need to add them to the controller function that loads this view.
                    ?>
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
