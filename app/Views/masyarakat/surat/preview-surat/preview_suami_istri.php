<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Suami Istri</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .surat {
            padding: 30px;
            margin: auto;
            max-width: 800px;
        }

        .kop-border {
            border-top: 4px solid black;
            border-bottom: 1px solid black;
            margin: 10px 0 20px;
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

        /* Adjusted width for data tables for better alignment */
        .data-table td:first-child {
            width: 200px;
        }

        .ttd {
            /* text-align: right; */ /* Hapus atau komen baris ini untuk rata kiri */
            margin-top: 50px;
            margin-left: auto;
            margin-right: 0;
            width: fit-content;
            float: right;
        }
        /* Penyesuaian untuk teks di dalam TTD agar rata kiri di dalam TTD box yang rata kanan */
        .ttd p {
            text-align: left;
            margin: 0;
        }
        .ttd p:last-of-type { /* Untuk "Kepala Desa Handil Suruk" */
            margin-bottom: 80px; /* <--- UBAH NILAI INI UNTUK MENYESUAIKAN JARAK */
        }
        .ttd strong {
            text-align: left;
            display: block;
        }
        /* Penting untuk membersihkan float agar elemen setelah ttd tidak ikut terpengaruh */
        .requirements {
            clear: both;
            margin-top: 50px; /* Sesuaikan jarak atas setelah tanda tangan */
        }

    </style>
</head>

<body>

    <div class="surat">
        <table style="width: 100%;">
            <tr>
                <td style="width: 90px; text-align: center;">
                    <?php if (isset($logo) && $logo) : ?>
                        <img src="<?= $logo ?>" alt="Logo" style="width: 70px;">
                    <?php endif; ?>
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
            <h5><u><strong>SURAT KETERANGAN SUAMI ISTRI</strong></u></h5>
            <p>Nomor : <?= $no_surat ?? '...' ?></p>
        </div>

        <div class="text-isi">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, dengan ini menerangkan bahwa:</p>

            <p style="margin-top: 15px;"><strong>Data Suami:</strong></p>
            <table class="data-table" style="margin-left: 30px; margin-bottom: 10px;">
                <tr>
                    <td>Nama</td>
                    <td>: <?= $nama_suami ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Tempat / Tgl Lahir</td>
                    <td>: <?= $ttl_suami ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>: <?= $agama_suami ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Status Sebelum Nikah</td>
                    <td>: <?= $status_sebelum_nikah_suami ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?= $alamat_suami ?? '...' ?></td>
                </tr>
            </table>

            <p style="margin-top: 15px;"><strong>Data Istri:</strong></p>
            <table class="data-table" style="margin-left: 30px; margin-bottom: 10px;">
                <tr>
                    <td>Nama</td>
                    <td>: <?= $nama_istri ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Tempat / Tgl Lahir</td>
                    <td>: <?= $ttl_istri ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>: <?= $agama_istri ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Status Sebelum Nikah</td>
                    <td>: <?= $status_sebelum_nikah_istri ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?= $alamat_istri ?? '...' ?></td>
                </tr>
            </table>

            <p style="margin-top: 15px;">Adalah benar pasangan suami istri yang telah melangsungkan pernikahan dengan detail sebagai berikut:</p>
            <table class="data-table" style="margin-left: 30px; margin-bottom: 10px;">
                <tr>
                    <td>Hari Nikah</td>
                    <td>: <?= $hari_nikah ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Tanggal / Bulan / Tahun Nikah</td>
                    <td>: <?= $tbt_nikah ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Tempat Akta Nikah</td>
                    <td>: <?= $tempat_akat_nikah ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Wali Nikah</td>
                    <td>: <?= $wali_nikah ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Mahar</td>
                    <td>: <?= $mahar ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Saksi Nikah</td>
                    <td>: <?= $saksi_nikah ?? '...' ?></td>
                </tr>
                <tr>
                    <td>Jumlah Anak</td>
                    <td>: <?= $jumlah_anak ?? '...' ?> orang</td>
                </tr>
            </table>

            <p style="margin-top: 15px;">Dan tercatat sebagai warga Desa Handil Suruk, Kecamatan Bumi Makmur, Kabupaten Tanah Laut.</p>
            <p>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>

        <div class="ttd">
              <p>Handil Suruk, <?= date('d F Y', strtotime($created_at ?? date('Y-m-d'))) ?></p>
            <p>Kepala Desa Handil Suruk</p>
            <strong><u>KHALIKUL BASIR</u></strong>
        </div>
        <?php $role = session()->get('role'); ?>
        <?php if (isset($role) && $role === 'kepala_desa') : ?>
            <div class="requirements">
                <h4>Data Persyaratan:</h4>
                <ul>
                    <?php if (isset($ktp_file) && $ktp_file) : ?>
                        <li>KTP:<a href="<?= base_url('lihat-file/ktp/' . $ktp_file) ?>" target="_blank"><?= $ktp_file ?></a>
                        </li>
                    <?php else : ?>
                        <li>KTP : Tidak tersedia</li>
                    <?php endif; ?>

                    <?php if (isset($kk_file) && $kk_file) : ?>
                        <li>KK : <a href="<?= base_url('lihat-file/kk/' . $kk_file) ?>" target="_blank"><?= $kk_file ?></a></li>
                    <?php else : ?>
                        <li>KK : Tidak tersedia</li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>