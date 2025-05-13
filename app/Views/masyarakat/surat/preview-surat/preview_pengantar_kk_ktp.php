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
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            /* Supaya border tidak ganda */
        }

        th,
        td {
            border: 1px solid #000;
            /* Warna border hitam */
            padding: 8px;
            text-align: left;
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

    <p style="text-align: justify;">Disampaikan dengan hormat untuk permohonan pengurusan administrasi kependudukan ke
        kecamatan Bumi makmur Kabupaten Tanah laut, yang mana bersangkutan telah di verifikasi oleh petugas registrasi
        desa/kelurahan sesuai Peraturan pemerintah Republik Indonesia Nomor 102 Tahun 2012 Tentang Perubahan atas
        Peraturan Pemerintah Nomor 37 Tahun 2007 Pelaksanaan Undang-Undang Nomor 23 tahun 2006 berikut dokumen
        Kependudukan yang dimohon :</p>
    <table style="margin-left: 40px; margin-bottom: 20px; width: 100%; border-collapse: collapse;">
        <tr>
            <td style="border: none; padding: 6px 0;">1. Dokumen Kartu Keluarga : 1</td>
        </tr>
        <tr>
            <td style="border: none; padding: 6px 0;">2. Dokumen E_KTP : 1</td>
        </tr>
        <tr>
            <td style="border: none; padding: 6px 0;">3. Akta Kematian : 1</td>
        </tr>
    </table>


    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
            </tr>
        </thead>
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