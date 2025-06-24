<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Domisili Bangunan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 30px;
        }

        .header {
            text-align: center;
        }

        .header img {
            float: left;
            width: 70px;
            height: 70px;
        }

        .header h2,
        .header h3,
        .header p {
            margin: 0;
        }

        .title {
            text-align: center;
            margin-top: 20px;
            text-decoration: underline;
            font-weight: bold;
        }

        .number {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-top: 10px;
        }

        .content p {
            margin: 5px 0;
        }

        .info-table {
            margin-left: 30px;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 2px 5px;
        }

        .ttd {
            text-align: right;
            margin-top: 40px;
        }

        .ttd p {
            margin: 2px 0;
        }

        .bold {
            font-weight: bold;
        }

        .clearfix::after {
            content: "";
            display: block;
            clear: both;
        }

        /* Gaya baru untuk bagian persyaratan */
        .requirements {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .requirements h4 {
            margin-bottom: 10px;
            text-decoration: underline;
        }
        .requirements ul {
            list-style-type: none;
            padding: 0;
        }
        .requirements li {
            margin-bottom: 5px;
        }
        .requirements a {
            color: blue;
            text-decoration: none;
        }
        .requirements a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="header clearfix">
        <?php if (isset($logo) && $logo) : ?>
            <img src="<?= $logo ?>" alt="Logo" style="width: 70px;">
        <?php endif; ?>
        <div style="text-align: center;">
            <h3>PEMERINTAH KABUPATEN TANAH LAUT</h3>
            <h3>KECAMATAN BUMI MAKMUR</h3>
            <h2 class="bold">DESA HANDIL SURUK</h2>
            <p>Alamat: Jl. Suka Damai Rt 04 Rw 02 Desa Handil Suruk Kec. Bumi Makmur Kode Pos 70853</p>
            <p>Email : desahandilsuruk@gmail.com</p>
        </div>
    </div>

    <hr>

    <div class="title">SURAT KETERANGAN DOMISILI</div>
    <div class="number">Nomor : <?= $no_surat ?? '...' ?></div>

    <p>Yang Bertanda Tangan di bawah ini:</p>
    <table class="info-table">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td class="bold"><?= $nama_kepala_desa ?? '...' ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?= $jabatan ?? '...' ?></td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td><?= $kecamatan_pejabat ?? '...' ?></td>
        </tr>
        <tr>
            <td>Kabupaten</td>
            <td>:</td>
            <td><?= $kabupaten_pejabat ?? '...' ?></td>
        </tr>
    </table>

    <p>Menerangkan dengan Sebenarnya bahwa:</p>
    <table class="info-table">
        <tr>
            <td>Kantor</td>
            <td>:</td>
            <td><?= $nama_kantor ?? '...' ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $alamat_kantor ?? '...' ?></td>
        </tr>
        <tr>
            <td>Desa</td>
            <td>:</td>
            <td><?= $desa ?? 'Handil Suruk' ?></td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td><?= $kecamatan ?? 'Bumi Makmur' ?></td>
        </tr>
        <tr>
            <td>Kabupaten</td>
            <td>:</td>
            <td><?= $kabupaten ?? 'Tanah Laut' ?></td>
        </tr>
        <tr>
            <td>Provinsi</td>
            <td>:</td>
            <td><?= $provinsi ?? 'Kalimantan Selatan' ?></td>
        </tr>
    </table>

    <p>
        Bahwa Kantor tersebut di atas pada saat ini benar-benar berdomisili di
        <?= $alamat_kantor ?? '...' ?>, Desa <?= $desa ?? '...' ?>, Kec. <?= $kecamatan ?? '...' ?>, Kab. <?= $kabupaten ?? '...' ?> Prov.
        <?= $provinsi ?? '...' ?>.
    </p>
    <p>
        Demikian Surat Keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.
    </p>

   

    <div class="ttd">
        <p>Dikeluarkan di Handil Suruk</p>
        <p>Pada Tanggal: <?= $tanggal ?? date('d F Y') ?></p>
        <p>Kepala Desa Handil Suruk</p>
        <br><br><br>
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

</body>

</html>