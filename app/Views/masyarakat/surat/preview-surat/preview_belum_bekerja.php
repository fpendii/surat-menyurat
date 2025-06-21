<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Belum Bekerja</title>
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

    <div class="surat">
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

        <div style="text-align: center; margin-bottom: 20px;">
            <h5><u><strong>SURAT KETERANGAN BELUM BEKERJA</strong></u></h5>
            <p>Nomor : <?= $no_surat ?? '...' ?></p>
        </div>

        <div class="text-isi">
            <p>Yang bertanda tangan di bawah ini Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, menerangkan bahwa:</p>

            <table style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><strong><?= $nama ?? '...' ?></strong></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><?= $nik ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tgl Lahir</td>
                    <td>:</td>
                    <td><?= $ttl ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= $jenis_kelamin ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><?= $agama ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Status Pekerjaan</td>
                    <td>:</td>
                    <td><strong><?= $status_pekerjaan ?? '...' ?></strong></td>
                </tr>
                <tr>
                    <td>Warga Negara</td>
                    <td>:</td>
                    <td><?= $warga_negara ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $alamat ?? '...' ?></td>
                </tr>
            </table>

            <p>Benar yang bersangkutan adalah warga Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut dan sampai dengan surat ini dikeluarkan yang bersangkutan <strong>belum memiliki pekerjaan/tidak bekerja.</strong></p>

            <p>Demikian surat keterangan ini dibuat untuk dapat digunakan sebagaimana mestinya.</p>
        </div>

     

        



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
                    // Pastikan $ktp_file dan $kk_file diteruskan dari controller yang memuat view ini.
                    // Jika tidak ada di controller, Anda harus menambahkannya.
                    ?>
                    <?php if (isset($ktp_file) && $ktp_file) : ?>
                        <li>KTP: <a href="<?= base_url('uploads/ktp/' . $ktp_file) ?>" target="_blank"><?= $ktp_file ?></a></li>
                    <?php else : ?>
                        <li>KTP: Tidak tersedia</li>
                    <?php endif; ?>

                    <?php if (isset($kk_file) && $kk_file) : ?>
                        <li>KK: <a href="<?= base_url('uploads/kk/' . $kk_file) ?>" target="_blank"><?= $kk_file ?></a></li>
                    <?php else : ?>
                        <li>KK: Tidak tersedia</li>
                    <?php endif; ?>

                    <li>Surat Pengantar RT/RW (jika ada): ...</li>
                    <li>Dokumen Pendukung Lainnya (jika ada): ...</li>
                </ul>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>