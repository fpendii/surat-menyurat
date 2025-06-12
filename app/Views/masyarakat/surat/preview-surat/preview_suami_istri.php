<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Suami Istri</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .surat {
            padding: 30px;
            margin: auto;
            max-width: 800px;
        }

        .kop-border {
            border-top: 4px solid black;
            border-bottom: 1px solid black;
            margin: 10px 0 20px;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h5, .kop-text h4 {
            margin: 0;
            line-height: 1.3;
        }

        .text-isi {
            text-align: justify;
        }

        table tr td:first-child {
            width: 200px;
        }

        .ttd {
            text-align: right;
            margin-top: 50px;
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
        <h5><u><strong>SURAT KETERANGAN SUAMI ISTRI</strong></u></h5>
        <p>Nomor : <?= $no_surat ?? '...' ?></p>
    </div>

    <!-- Isi Surat -->
    <div class="text-isi">
        <p>Yang bertanda tangan di bawah ini, Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, dengan ini menerangkan bahwa:</p>

        <p><strong>Data Suami:</strong></p>
        <table>
            <tr><td>Nama</td><td>: <?= $nama_suami ?></td></tr>
            <tr><td>NIK</td><td>: <?= $nik_suami ?></td></tr>
            <tr><td>Tempat / Tgl Lahir</td><td>: <?= $ttl_suami ?></td></tr>
            <tr><td>Agama</td><td>: <?= $agama_suami ?></td></tr>
            <tr><td>Alamat</td><td>: <?= $alamat_suami ?></td></tr>
        </table>

        <p><strong>Data Istri:</strong></p>
        <table>
            <tr><td>Nama</td><td>: <?= $nama_istri ?></td></tr>
            <tr><td>NIK</td><td>: <?= $nik_istri ?></td></tr>
            <tr><td>Tempat / Tgl Lahir</td><td>: <?= $ttl_istri ?></td></tr>
            <tr><td>Agama</td><td>: <?= $agama_istri ?></td></tr>
            <tr><td>Alamat</td><td>: <?= $alamat_istri ?></td></tr>
        </table>

        <p>Adalah benar pasangan suami istri yang telah menikah secara sah menurut hukum dan tercatat sebagai warga Desa Handil Suruk.</p>

        <p>Demikian surat ini dibuat untuk digunakan sebagaimana mestinya.</p>
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
