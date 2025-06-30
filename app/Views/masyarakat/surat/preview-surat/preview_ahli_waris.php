<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Ahli Waris</title>
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
        table:not(.table-ahli-waris) tr td:first-child {
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

        .table-ahli-waris {
            width: 100%;
            border-collapse: collapse;
        }

        .table-ahli-waris td,
        .table-ahli-waris th {
            padding: 6px;
            border: 1px solid #000; /* Menambahkan border untuk tabel ahli waris */
        }

        .table-ahli-waris th {
            text-align: left;
        }

        /* Styling for the requirements section for head of village */
        .requirements {
            clear: both; /* Penting untuk membersihkan float agar elemen setelah ttd tidak ikut terpengaruh */
            margin-top: 40px;
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
                    <p style="font-size: 13px; margin: 0;">
                        Alamat: Jl. Suka Damai Rt 04 Rw 02 Desa Handil Suruk Kec. Bumi Makmur Kode Pos 70853<br>
                        Email : desahandilsuruk@gmail.com
                    </p>
                </td>
            </tr>
        </table>

        <div class="kop-border"></div>

        <div style="text-align: center; margin-bottom: 20px;">
            <h5><u><strong>SURAT KETERANGAN AHLI WARIS</strong></u></h5>
            <p>Nomor : <?= htmlspecialchars($no_surat ?? '...') ?></p>
        </div>

        <div class="text-isi">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, menerangkan dengan sebenarnya bahwa:</p>

            <p>
                <strong><?= htmlspecialchars($pemilik_harta ?? '...') ?></strong> adalah pemilik harta yang telah meninggal dunia, dan ahli waris dari almarhum/almarhumah tersebut adalah sebagai berikut:
            </p>

            <table class="table-ahli-waris">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Tempat Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Hubungan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Memastikan data ahli waris ada sebelum looping
                    if (isset($nama_ahli_waris) && is_array($nama_ahli_waris) && !empty($nama_ahli_waris)) {
                        foreach ($nama_ahli_waris as $i => $nama) {
                            echo '<tr>';
                            echo '<td>' . ($i + 1) . '</td>';
                            echo '<td>' . htmlspecialchars($nama ?? '') . '</td>';
                            // Menggunakan operator null coalescing untuk menghindari error jika indeks tidak ada
                            echo '<td>' . htmlspecialchars($nik_ahli_waris[$i] ?? '') . '</td>';
                            echo '<td>' . htmlspecialchars($ttl_ahli_waris[$i] ?? '') . '</td>';
                            echo '<td>' . htmlspecialchars($alamat[$i] ?? '') . '</td>'; // Assuming $alamat is array of addresses for ahli waris
                            echo '<td>' . htmlspecialchars($hubungan_ahli_waris[$i] ?? '') . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6" style="text-align: center;">Tidak ada data ahli waris yang ditemukan.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>

            <p style="margin-top: 20px;">Demikian Surat Keterangan Ahli Waris ini dibuat dengan sebenarnya agar dapat digunakan sebagaimana mestinya.</p>
        </div>

        <div class="ttd">
              <p>Handil Suruk, <?= date('d F Y', strtotime($created_at ?? date('Y-m-d'))) ?></p>
            <p>Kepala Desa Handil Suruk</p>
            <strong><u>KHALIKUL BASIR</u></strong>
        </div>

        <?php
        // Bagian ini hanya ditampilkan jika peran pengguna adalah 'kepala_desa'
        // Asumsi session('role') sudah diatur dengan benar di aplikasi CodeIgniter Anda
        ?>
        <?php $role = session()->get('role'); ?>
        <?php if (session('role') === 'kepala_desa') : ?>
            <div class="requirements">
                <h4>Data Persyaratan:</h4>
                <ul>
                    <?php if (isset($ktp_file) && $ktp_file) : ?>
                        <?php
                            // Cek apakah $ktp_file adalah array, jika ya ambil elemen pertama
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
                            // Cek apakah $kk_file adalah array, jika ya ambil elemen pertama
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

                    <?php if (isset($akta_file) && $akta_file) : ?>
                        <?php
                            // Cek apakah $akta_file adalah array, jika ya ambil elemen pertama
                            $display_akta_file = is_array($akta_file) ? ($akta_file[0] ?? null) : $akta_file;
                        ?>
                        <?php if ($display_akta_file) : ?>
                            <li>Akta: <a href="<?= base_url('lihat-file/akta_lahir/' . $display_akta_file) ?>" target="_blank"><?= htmlspecialchars($display_akta_file) ?></a></li>
                        <?php else : ?>
                            <li>Akta: Tidak tersedia</li>
                        <?php endif; ?>
                    <?php else : ?>
                        <li>Akta: Tidak tersedia</li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>