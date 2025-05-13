<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Ahli Waris</title>
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

        .table-ahli-waris {
            width: 100%;
            border-collapse: collapse;
        }

        .table-ahli-waris td, .table-ahli-waris th {
            padding: 6px;
        }

        .table-ahli-waris th {
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="surat">
        <!-- Header -->
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
            <h5><u><strong>SURAT KETERANGAN AHLI WARIS</strong></u></h5>
            <p>Nomor: 470/___/Handil Suruk/2024</p>
        </div>

        <!-- Isi Surat -->
        <div class="text-isi">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, menerangkan dengan sebenarnya bahwa:</p>

            <p>
                <strong><?= $pemilik_harta ?></strong> adalah pemilik harta yang telah meninggal dunia, dan ahli waris dari almarhum/almarhumah tersebut adalah sebagai berikut:
            </p>

            <table class="table-ahli-waris" border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Hubungan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($nama_ahli_waris as $i => $nama) {
                        echo '<tr>';
                        echo '<td>' . ($i + 1) . '</td>';
                        echo '<td>' . htmlspecialchars($nama) . '</td>';
                        echo '<td>' . htmlspecialchars($nik_ahli_waris[$i]) . '</td>';
                        echo '<td>' . htmlspecialchars($ttl_ahli_waris[$i]) . '</td>';
                        echo '<td>' . htmlspecialchars($hubungan_ahli_waris[$i]) . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>

            <p>Demikian Surat Keterangan Ahli Waris ini dibuat dengan sebenarnya agar dapat digunakan sebagaimana mestinya.</p>
        </div>

        <!-- Tanda Tangan -->
        <div class="ttd">
            <p>Handil Suruk, <?= date("d F Y") ?></p>
            <p style="margin-bottom: 60px;">Kepala Desa Handil Suruk</p>
            <strong><u>KHALIKUL BASIR</u></strong>
        </div>
    </div>

</body>

</html>
