<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Domisili</title>
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
    </style>
</head>

<body>

    <div class="header clearfix">
        <img src="<?= $logo ?>" alt="Logo" style="width: 70px;">
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
    <div class="number">Nomor: 400.12.2.2/53/Handil Suruk/2024</div>

    <p>Yang Bertanda Tangan di bawah ini:</p>
    <table class="info-table">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td class="bold"><?= $nama ?? '...' ?></td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td><?= $jabatan ?? '...' ?></td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td><?= $kecamatan_yangbertanda ?? '...' ?></td>
        </tr>
        <tr>
            <td>Kabupaten</td>
            <td>:</td>
            <td><?= $kabupaten_yangbertanda ?? '...' ?></td>
        </tr>
    </table>

    <p>Menerangkan dengan Sebenarnya bahwa:</p>
    <table class="info-table">
        <tr>
            <td>Kantor</td>
            <td>:</td>
            <td><?= $nama_gapoktan ?? '...' ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><?= $alamat ?? '...' ?></td>
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
        <?= $alamat ?? '...' ?>, Kec. <?= $kecamatan ?? '...' ?>, Kab. <?= $kabupaten ?? '...' ?> Prov.
        <?= $provinsi ?? '...' ?>.
    </p>
    <p>
        Demikian Surat Keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.
    </p>

    <div class="ttd">
        <p>Dikeluarkan di Handil Suruk</p>
        <p>Pada Tanggal: <?= date('d F Y', strtotime($tgl_pembentukan ?? date('Y-m-d'))) ?></p>
        <p>Kepala Desa Handil Suruk</p>
        <br><br><br>
        <p class="bold"><?= $nama ?? '...' ?></p>
    </div>

</body>

</html>