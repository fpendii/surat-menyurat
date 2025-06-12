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
            /* border: 1px solid black; */
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
            <p>Yang Bertanda Tangan di bawah ini Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, Menerangkan dengan sebenarnya bahwa:</p>

            <table style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td>Nama Gapoktan</td>
                    <td>:</td>
                    <td><strong style="text-transform: uppercase;"><?php echo $nama_gapoktan; ?></strong></td>
                </tr>
                <tr>
                    <td>Tanggal Pembentukan</td>
                    <td>:</td>
                    <td><?php echo date("d F Y", strtotime($tgl_pembentukan)); ?></td>
                </tr>
                <tr>
                    <td>Alamat Sekretariat</td>
                    <td>:</td>
                    <td><?php echo $alamat; ?></td>
                </tr>
            </table>

            <p><strong>Susunan Pengurus:</strong></p>
            <table style="width: 100%;">
                <tr>
                    <td>Ketua</td>
                    <td>:</td>
                    <td><?php echo $ketua; ?></td>
                </tr>
                <tr>
                    <td>Sekretaris</td>
                    <td>:</td>
                    <td><?php echo $sekretaris; ?></td>
                </tr>
                <tr>
                    <td>Bendahara</td>
                    <td>:</td>
                    <td><?php echo $bendahara; ?></td>
                </tr>
            </table>

            <p>
                Bahwa adalah benar-benar Gapoktan “<?php echo $nama_gapoktan; ?>” yang berada di Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut.
            </p>
            <p>
                Demikian Surat Keterangan Domisili ini diberikan untuk dapat diketahui dan dipergunakan sebagaimana mestinya.
            </p>
        </div>

        <!-- Tanda Tangan -->
        <div class="ttd">
            <p>Dikeluarkan di Handil Suruk</p>
            <p>Pada Tanggal: 26 Agustus 2024</p>
            <p style="margin-bottom: 60px;">Kepala Desa Handil Suruk</p>
            <strong><u>KHALIKUL BASIR</u></strong>
        </div>


    </div>

</body>

</html>