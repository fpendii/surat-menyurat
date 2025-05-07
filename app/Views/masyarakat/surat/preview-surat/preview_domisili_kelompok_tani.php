<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Domisili</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
        }

        .surat {
            border: 1px solid black;
            padding: 30px;
            margin: 30px auto;
            max-width: 800px;
            background-color: white;
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
            float: right;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <div class="surat">
        <div class="row align-items-center">
            <div class="col-2 text-center">
                <img src="/img/logo.png" class="logo" alt="Logo">
            </div>
            <div class="col-10 kop-text">
                <h5><strong>PEMERINTAH KABUPATEN TANAH LAUT</strong></h5>
                <h5><strong>KECAMATAN BUMI MAKMUR</strong></h5>
                <h4><strong>DESA HANDIL SURUK</strong></h4>
                <p style="font-size: 13px;">
                    Alamat: Jl. Suka Damai Rt 04 Rw 02 Desa Handil Suruk Kec. Bumi Makmur Kode Pos 70853<br>
                    Email : desahandilsuruk@gmail.com
                </p>
            </div>
        </div>

        <div class="kop-border"></div>

        <div class="text-center mb-3">
            <h5><u><strong>SURAT KETERANGAN DOMISILI</strong></u></h5>
            <p>Nomor : 400.12.2.2/53/Handil Suruk/2024</p>
        </div>

        <div class="text-isi">
            <p>Yang Bertanda Tangan di bawah ini Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, Menerangkan dengan sebenarnya bahwa:</p>

            <table class="table table-borderless">
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

            <p><strong>Susunan Pengurus :</strong></p>
            <table class="table table-borderless">
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

        <div class="container  p-4" style="max-width: 800px; margin: auto; border: 0px solid blue;">
            <!-- Header, logo, judul, isi surat -->

            <!-- Bagian tanda tangan -->
            <div class="text-end mt-5">
                <p style="margin-bottom: 0;">Dikeluarkan di Handil Suruk</p>
                <p style="margin-bottom: 0;">Pada Tanggal: 26 Agustus 2024</p>
                <p style="margin-bottom: 100px;">Kepala Desa Handil Suruk</p>
                <strong><u>KHALIKUL BASIR</u></strong>
            </div>
        </div>

           <!-- Tombol Kirim dan Batal -->
    <div class="d-flex justify-content-between">
        <a href="/masyarakat/surat/domisili-kelompok-tani/" class="btn btn-danger">Batal</a>
        <button class="btn btn-primary" onclick="window.location.href='url_kirim'">Kirim</button>
    </div>

    </div>

</body>

</html>