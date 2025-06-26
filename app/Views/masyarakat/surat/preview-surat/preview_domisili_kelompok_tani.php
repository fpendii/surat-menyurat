<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Domisili Kelompok Tani</title>
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
            margin-top: 30px;
            /* Jarak antara bagian ttd dan persyaratan */
            border-top: 1px solid #ccc;
            padding-top: 20px;
            /* Tambahan gaya untuk konsistensi */
            padding: 15px;
            /* Menambah padding di sekitar konten persyaratan */
            border: 1px solid #ddd;
            /* Border tipis */
            background-color: #f9f9f9;
            /* Latar belakang sedikit abu-abu */
            border-radius: 5px;
            /* Sudut membulat */
        }

        .requirements h4 {
            margin-bottom: 10px;
            text-decoration: underline;
            margin-top: 0;
            /* Menghilangkan margin atas default h4 */
            color: #333;
            /* Warna teks yang lebih gelap */
        }

        .requirements ul {
            list-style-type: none;
            padding: 0;
        }

        .requirements li {
            margin-bottom: 5px;
        }

        .requirements a {
            color: #007bff;
            /* Warna biru standar untuk link */
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
            <h5><u><strong>SURAT KETERANGAN DOMISILI</strong></u></h5>
            <p>Nomor : <?= htmlspecialchars($no_surat ?? '...') ?></p>
        </div>

        <div class="text-isi">
            <p>Yang Bertanda Tangan di bawah ini Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, Menerangkan dengan sebenarnya bahwa:</p>

            <table style="width: 100%; margin-bottom: 10px;">
                <tr>
                    <td>Nama Gapoktan</td>
                    <td>:</td>
                    <td><strong style="text-transform: uppercase;"><?= htmlspecialchars($nama_gapoktan ?? '...') ?></strong></td>
                </tr>
                <tr>
                    <td>Tanggal Pembentukan</td>
                    <td>:</td>
                    <td><?= htmlspecialchars(date("d F Y", strtotime($tgl_pembentukan ?? date('Y-m-d')))) ?></td>
                </tr>
                <tr>
                    <td>Alamat Sekretariat</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($alamat ?? '...') ?></td>
                </tr>
            </table>

            <p><strong>Susunan Pengurus:</strong></p>
            <table style="width: 100%;">
                <tr>
                    <td>Ketua</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($ketua ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Sekretaris</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($sekretaris ?? '...') ?></td>
                </tr>
                <tr>
                    <td>Bendahara</td>
                    <td>:</td>
                    <td><?= htmlspecialchars($bendahara ?? '...') ?></td>
                </tr>
            </table>

            <p>
                Bahwa adalah benar-benar Gapoktan “<?= htmlspecialchars($nama_gapoktan ?? '...') ?>” yang berada di Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut.
            </p>
            <p>
                Demikian Surat Keterangan Domisili ini diberikan untuk dapat diketahui dan dipergunakan sebagaimana mestinya.
            </p>
        </div>


        <div class="ttd">
            <p>Handil Suruk, <?= htmlspecialchars(date('d F Y', strtotime($created_at ?? '2025-06-26'))) ?></p>
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

    </div>

</body>

</html>