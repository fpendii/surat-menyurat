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
            background: #fff;
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

        .kop-text h4,
        .kop-text h5,
        .kop-text p {
            margin: 0;
            line-height: 1.3;
        }

        .text-isi {
            text-align: justify;
        }

        /* Penyesuaian lebar kolom pertama tabel data utama */
        table tr td:first-child {
            width: 180px;
        }

        /* Styling untuk bagian tanda tangan */
        .ttd {
            text-align: right;
            /* Rata kanan untuk seluruh blok tanda tangan */
            margin-top: 50px;
            /* Jarak dari konten di atasnya */
        }

        .ttd p {
            margin: 0;
            /* Menghilangkan margin default pada paragraf di dalam ttd */
        }

        /* Menyesuaikan jarak antara "Kepala Desa Handil Suruk" dan nama */
        .ttd p:nth-of-type(2) {
            /* Menargetkan paragraf kedua di dalam .ttd ("Kepala Desa Handil Suruk") */
            margin-bottom: 80px;
            /* Atur jarak ini sesuai keinginan Anda, contoh: 80px */
        }

        /* Gaya untuk bagian persyaratan */
        .requirements {
            clear: both;
            /* Penting untuk membersihkan float agar elemen setelah ttd tidak ikut terpengaruh */
            margin-top: 40px;
            /* Jarak antara bagian ttd dan persyaratan */
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .requirements h4 {
            margin-top: 0;
            color: #333;
        }

        .requirements ul {
            list-style-type: none;
            padding: 0;
        }

        .requirements ul li {
            margin-bottom: 8px;
        }

        .requirements ul li a {
            color: #007bff;
            text-decoration: none;
        }

        .requirements ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="surat">
        <table style="width: 100%;">
            <tr>
                <td style="width: 90px; text-align: center;">
                    <img src="<?= htmlspecialchars($logo ?? '') ?>" alt="Logo" style="width: 70px;">
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

        <div style="text-align: center; margin-bottom: 20px;">
            <h5><u><strong>SURAT KETERANGAN KELAHIRAN</strong></u></h5>
            <p>Nomor : <?= htmlspecialchars($no_surat ?? '...') ?></p>
        </div>

        <div class="text-isi">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, dengan ini menerangkan bahwa:</p>

            <table style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><strong><?= htmlspecialchars($nama ?? '...') ?></strong></td>
                </tr>
                <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($ttl ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($jenis_kelamin ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($pekerjaan ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($alamat ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Nama Ayah</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($nama_ayah ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($nama_ibu ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Anak Ke</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($anak_ke ?? '...') ?></td>
                </tr>
            </table>

            <p>Adalah benar merupakan warga Desa Handil Suruk yang telah lahir pada tanggal tersebut di atas.</p>

            <p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat digunakan sebagaimana mestinya.</p>
        </div>

        <div class="ttd">
            <p>Handil Suruk, <?= htmlspecialchars(date('d F Y', strtotime($created_at ?? date('Y-m-d')))) ?></p>
            <p>Kepala Desa Handil Suruk</p>
            <strong><u>KHALIKUL BASIR</u></strong>
        </div>
    </div>
    <?php $role = session()->get('role'); ?>
    <?php if (isset($role) && $role === 'kepala_desa') : ?>
        <div class="requirements">
            <h4>Data Persyaratan:</h4>
            <ul>
                <?php if (isset($ktp_file) && $ktp_file) : ?>
                    <?php
                        $display_ktp_file = is_array($ktp_file) ? ($ktp_file[0] ?? null) : $ktp_file;
                    ?>
                    <?php if ($display_ktp_file) : ?>
                        <li>KTP: <a href="<?= base_url('lihat-file/ktp/' . $display_ktp_file) ?>" target="_blank"><?= htmlspecialchars($display_ktp_file) ?></a>
                        </li>
                    <?php else : ?>
                        <li>KTP : Tidak tersedia</li>
                    <?php endif; ?>
                <?php else : ?>
                    <li>KTP : Tidak tersedia</li>
                <?php endif; ?>

                <?php if (isset($kk_file) && $kk_file) : ?>
                    <?php
                        $display_kk_file = is_array($kk_file) ? ($kk_file[0] ?? null) : $kk_file;
                    ?>
                    <?php if ($display_kk_file) : ?>
                        <li>KK : <a href="<?= base_url('lihat-file/kk/' . $display_kk_file) ?>" target="_blank"><?= htmlspecialchars($display_kk_file) ?></a></li>
                    <?php else : ?>
                        <li>KK : Tidak tersedia</li>
                    <?php endif; ?>
                <?php else : ?>
                    <li>KK : Tidak tersedia</li>
                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>
</body>

</html>