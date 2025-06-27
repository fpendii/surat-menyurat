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

        /* Penyesuaian lebar kolom pertama tabel data utama */
        table tr td:first-child {
            width: 180px;
        }

        /* Styling untuk bagian tanda tangan */
        .ttd {
            text-align: right; /* Rata kanan untuk seluruh blok tanda tangan */
            margin-top: 50px; /* Jarak dari konten di atasnya */
        }

        .ttd p {
            margin: 0; /* Menghilangkan margin default pada paragraf di dalam ttd */
        }

        /* Menyesuaikan jarak antara "Kepala Desa Handil Suruk" dan nama */
        .ttd p:nth-of-type(2) { /* Menargetkan paragraf kedua di dalam .ttd ("Kepala Desa Handil Suruk") */
            margin-bottom: 80px; /* Atur jarak ini sesuai keinginan Anda, contoh: 80px */
        }

        /* Gaya untuk bagian persyaratan */
        .requirements {
            clear: both; /* Penting untuk membersihkan float agar elemen setelah ttd tidak ikut terpengaruh */
            margin-top: 30px; /* Jarak antara bagian ttd dan persyaratan */
            border-top: 1px solid #ccc;
            padding-top: 20px;
            /* Tambahan gaya untuk konsistensi */
            padding: 15px; /* Menambah padding di sekitar konten persyaratan */
            border: 1px solid #ddd; /* Border tipis */
            background-color: #f9f9f9; /* Latar belakang sedikit abu-abu */
            border-radius: 5px; /* Sudut membulat */
        }
        .requirements h4 {
            margin-bottom: 10px;
            text-decoration: underline;
            margin-top: 0; /* Menghilangkan margin atas default h4 */
            color: #333; /* Warna teks yang lebih gelap */
        }
        .requirements ul {
            list-style-type: none;
            padding: 0;
        }
        .requirements li {
            margin-bottom: 5px;
        }
        .requirements a {
            color: #007bff; /* Warna biru standar untuk link */
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
                    <img src="<?= htmlspecialchars($logo ?? '') ?>" alt="Logo" style="width: 70px;">
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
            <p>Nomor : <?= htmlspecialchars($no_surat ?? '...') ?></p>
        </div>

        <div class="text-isi">
            <p>Yang bertanda tangan di bawah ini Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, menerangkan bahwa:</p>

            <table style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><strong><?= htmlspecialchars($nama ?? '...') ?></strong></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($nik ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tgl Lahir</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($ttl ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($jenis_kelamin ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($agama ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Status Pekerjaan</td>
                    <td>:</td>
                    <td><strong><?= htmlspecialchars($status_pekerjaan ?? '...') ?></strong></td>
                </tr>
                <tr>
                    <td>Warga Negara</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($warga_negara ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($alamat ?? '...') ?></td>
                </tr>
            </table>

            <p>Benar yang bersangkutan adalah warga Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut dan sampai dengan surat ini dikeluarkan yang bersangkutan <strong>belum memiliki pekerjaan/tidak bekerja.</strong></p>

            <p>Demikian surat keterangan ini dibuat untuk dapat digunakan sebagaimana mestinya.</p>
        </div>

        <div class="ttd">
            <p>Handil Suruk, <?= htmlspecialchars(date('d F Y', strtotime($created_at ?? date('Y-m-d')))) ?></p>
            <p>Kepala Desa Handil Suruk</p>
            <strong><u>KHALIKUL BASIR</u></strong>
        </div>

        <?php if (isset($role) && $role === 'kepala_desa') : ?>
            <div class="requirements">
                <h4>Data Persyaratan:</h4>
                <ul>
                    <?php if (isset($ktp_file) && $ktp_file) : ?>
                        <?php
                            $display_ktp_file = is_array($ktp_file) ? ($ktp_file[0] ?? null) : $ktp_file;
                        ?>
                        <?php if ($display_ktp_file) : ?>
                            <li>KTP: <a href="<?= base_url('lihat-file/ktp/' . $display_ktp_file) ?>" target="_blank"><?= htmlspecialchars($display_ktp_file) ?></a></li>
                        <?php else : ?>
                            <li>KTP: Tidak tersedia</li>
                        <?php endif; ?>
                    <?php else : ?>
                        <li>KTP: Tidak tersedia</li>
                    <?php endif; ?>

                    <?php if (isset($kk_file) && $kk_file) : ?>
                        <?php
                            $display_kk_file = is_array($kk_file) ? ($kk_file[0] ?? null) : $kk_file;
                        ?>
                        <?php if ($display_kk_file) : ?>
                            <li>KK: <a href="<?= base_url('lihat-file/kk/' . $display_kk_file) ?>" target="_blank"><?= htmlspecialchars($display_kk_file) ?></a></li>
                        <?php else : ?>
                            <li>KK: Tidak tersedia</li>
                        <?php endif; ?>
                    <?php else : ?>
                        <li>KK: Tidak tersedia</li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>