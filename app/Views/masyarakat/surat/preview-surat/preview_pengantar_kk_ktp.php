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

    <div class="title">SURAT PENGANTAR</div>
    <div class="number">Nomor : <?= $no_surat ?? '...' ?></div>

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
        <tbody>
            <?php foreach ($dataOrang as $key => $value) : ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value['nama'] ?? '...' ?></td>
                    <td><?= $value['nik'] ?? '...' ?></td>
                    <td><?= $value['keterangan'] ?? '...' ?></td>
                    <td><?= $value['jumlah'] ?? '...' ?></td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
    <p>
        Demikian disampaikan kiranya dapat digunakan sebagaimana mestinya, sebelum dan sesudahnya kami ucapkan terimakasih.
    </p>
     <p style="text-align: center; margin-top: 50px;">
        Mengetahui, <br>
     </p>       
    <table  style="margin-top: 30px; width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <td style="text-align: center; vertical-align: middle; border: none;">Kepala Desa Handil Suruk</td>
                <td style="text-align: center; vertical-align: middle; border: none;">Kepala Desa Handil Suruk</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center; vertical-align: middle; border: none;">
                    <!-- <img src="" alt="Tanda Tangan" style="width: 100px;"> -->
                    <p style="margin-top: 100px;" class="bold">SUDARNO</p>
                    <p>NIP. 19651231 198303 1 001</p>
                </td>
                <td style="text-align: center; vertical-align: middle; border: none;">
                    <!-- <img src="" alt="Tanda Tangan" style="width: 100px;"> -->
                    <p style="margin-top: 100px;" class="bold">SUDARNO</p>
                    <p>NIP. 19651231 198303 1 001</p>
                </td>
            </tr>
    </table>



</body>

</html>