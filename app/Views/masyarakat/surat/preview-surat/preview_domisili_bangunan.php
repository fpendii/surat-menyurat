<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Domisili Bangunan</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif; /* Mengubah font kembali ke Times New Roman untuk konsistensi */
            font-size: 12pt;
            margin: 30px;
        }

        /* Perbaikan untuk kop surat agar sesuai dengan struktur PHP Anda */
        .kop-container {
            text-align: center;
            overflow: hidden; /* Clearfix for floated image */
        }

        .kop-container img {
            float: left;
            width: 70px;
            height: 70px;
            margin-right: 15px; /* Memberi sedikit jarak antara logo dan teks */
        }

        .kop-text-content {
            overflow: hidden; /* Contains the text content of the header */
            display: inline-block; /* Agar bisa diatur tengah relatif ke parent */
            vertical-align: middle; /* Menjaga teks sejajar dengan gambar */
        }

        .kop-text-content h2,
        .kop-text-content h3,
        .kop-text-content p {
            margin: 0;
            line-height: 1.3;
        }

        .kop-border {
            border-top: 4px solid black;
            border-bottom: 1px solid black;
            margin-top: 10px;
            margin-bottom: 20px;
            clear: both; /* Penting untuk membersihkan float dari logo */
        }

        .title-section {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .title-section h5 {
            text-decoration: underline;
            font-weight: bold;
            margin-bottom: 5px;
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
            vertical-align: top; /* Penjajaran atas untuk konten tabel */
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

        .bold {
            font-weight: bold;
        }

        /* Gaya baru untuk bagian persyaratan */
        .requirements {
            clear: both; /* Penting untuk membersihkan float agar elemen setelah ttd tidak ikut terpengaruh */
            margin-top: 40px; /* Jarak antara bagian ttd dan persyaratan */
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

    <div class="kop-container">
        <?php if (isset($logo) && $logo) : ?>
            <img src="<?= htmlspecialchars($logo) ?>" alt="Logo" style="width: 70px;">
        <?php endif; ?>
        <div class="kop-text-content">
            <h3>PEMERINTAH KABUPATEN TANAH LAUT</h3>
            <h3>KECAMATAN BUMI MAKMUR</h3>
            <h2 class="bold">DESA HANDIL SURUK</h2>
            <p>Alamat: Jl. Suka Damai Rt 04 Rw 02 Desa Handil Suruk Kec. Bumi Makmur Kode Pos 70853</p>
            <p>Email : desahandilsuruk@gmail.com</p>
        </div>
    </div>

    <div class="kop-border"></div>

    <div class="title-section">
        <h5>SURAT KETERANGAN DOMISILI BANGUNAN</h5>
        <p>Nomor : <?= htmlspecialchars($no_surat ?? '...') ?></p>
    </div>

    <div class="content">
        <p>Yang Bertanda Tangan di bawah ini:</p>
        <table class="info-table">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td class="bold"><?= htmlspecialchars($nama_kepala_desa ?? 'KHALIKUL BASIR') ?></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><?= htmlspecialchars($jabatan ?? 'Kepala Desa Handil Suruk') ?></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td><?= htmlspecialchars($kecamatan_pejabat ?? 'Bumi Makmur') ?></td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>:</td>
                <td><?= htmlspecialchars($kabupaten_pejabat ?? 'Tanah Laut') ?></td>
            </tr>
        </table>

        <p>Menerangkan dengan Sebenarnya bahwa:</p>
        <table class="info-table">
            <tr>
                <td>Kantor</td>
                <td>:</td>
                <td><?= htmlspecialchars($nama_kantor ?? '...') ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= htmlspecialchars($alamat_kantor ?? '...') ?></td>
            </tr>
            <tr>
                <td>Desa</td>
                <td>:</td>
                <td><?= htmlspecialchars($desa ?? 'Handil Suruk') ?></td>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td><?= htmlspecialchars($kecamatan ?? 'Bumi Makmur') ?></td>
            </tr>
            <tr>
                <td>Kabupaten</td>
                <td>:</td>
                <td><?= htmlspecialchars($kabupaten ?? 'Tanah Laut') ?></td>
            </tr>
            <tr>
                <td>Provinsi</td>
                <td>:</td>
                <td><?= htmlspecialchars($provinsi ?? 'Kalimantan Selatan') ?></td>
            </tr>
        </table>

        <p>
            Bahwa Kantor tersebut di atas pada saat ini benar-benar berdomisili di
            <?= htmlspecialchars($alamat_kantor ?? '...') ?>, Desa <?= htmlspecialchars($desa ?? '...') ?>, Kec. <?= htmlspecialchars($kecamatan ?? '...') ?>, Kab. <?= htmlspecialchars($kabupaten ?? '...') ?> Prov.
            <?= htmlspecialchars($provinsi ?? '...') ?>.
        </p>
        <p>
            Demikian Surat Keterangan ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya.
        </p>
    </div>

    <div class="ttd">
        <p>Handil Suruk, <?= htmlspecialchars(date('d F Y', strtotime($tanggal ?? date('Y-m-d')))) ?></p>
        <p>Kepala Desa Handil Suruk</p>
        <strong><u>KHALIKUL BASIR</u></strong>
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

</body>

</html>