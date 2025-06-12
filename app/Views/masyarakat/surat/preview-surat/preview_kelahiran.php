<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Kelahiran</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
        }

        .surat {
            padding: 30px;
            max-width: 800px;
            margin: auto;
        }

        .kop-border {
            border-top: 4px solid black;
            border-bottom: 1px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h4, .kop-text h5, .kop-text p {
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
                    <p style="font-size: 13px;">
                        Alamat: Jl. Suka Damai Rt 04 Rw 02 Desa Handil Suruk Kec. Bumi Makmur Kode Pos 70853<br>
                        Email: desahandilsuruk@gmail.com
                    </p>
                </td>
            </tr>
        </table>

        <div class="kop-border"></div>

        <!-- Judul -->
        <div style="text-align: center; margin-bottom: 20px;">
            <h5><u><strong>SURAT KETERANGAN KELAHIRAN</strong></u></h5>
            <p>Nomor : <?= $no_surat ?? '...' ?></p>
        </div>

        <!-- Isi -->
        <div class="text-isi">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, dengan ini menerangkan bahwa:</p>

            <table style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><strong><?= $nama ?></strong></td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>:</td>
                    <td><?= $ttl ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= $jenis_kelamin ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><?= $pekerjaan ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $alamat ?></td>
                </tr>
                <tr>
                    <td>Nama Ayah</td>
                    <td>:</td>
                    <td><?= $nama_ayah ?></td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td>:</td>
                    <td><?= $nama_ibu ?></td>
                </tr>
                <tr>
                    <td>Anak Ke</td>
                    <td>:</td>
                    <td><?= $anak_ke ?></td>
                </tr>
            </table>

            <p>Adalah benar merupakan warga Desa Handil Suruk yang telah lahir pada tanggal tersebut di atas.</p>

            <p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat digunakan sebagaimana mestinya.</p>
        </div>

        <!-- Tanda Tangan -->
        <div class="ttd">
            <p>Dikeluarkan di Handil Suruk</p>
            <p>Pada Tanggal: <?= date("d F Y") ?></p>
            <p style="margin-bottom: 60px;">Kepala Desa Handil Suruk</p>
            <strong><u>KHALIKUL BASIR</u></strong>
        </div>
    </div>

</body>

</html>
