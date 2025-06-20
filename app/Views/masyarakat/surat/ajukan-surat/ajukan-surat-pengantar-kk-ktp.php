<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Catatan Kepolisian</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .surat {
            padding: 20px 30px; /* Reduced top/bottom padding */
            margin: 20px auto; /* Reduced top/bottom margin */
            max-width: 750px; /* Slightly reduced max-width for better fit on common print sizes */
            box-sizing: border-box; /* Ensures padding is included in the width */
        }

        .kop-border {
            border-top: 4px solid black;
            border-bottom: 1px solid black;
            margin-top: 8px; /* Slightly reduced margin */
            margin-bottom: 15px; /* Slightly reduced margin */
        }

        .kop-text {
            text-align: center;
        }

        .kop-text h5,
        .kop-text h4 {
            margin: 0;
            line-height: 1.2; /* Tighter line spacing for header */
        }

        .kop-text p {
            font-size: 12px; /* Slightly smaller font for address */
            margin: 0;
            line-height: 1.2;
        }

        .surat-title h5,
        .surat-title p {
            margin: 0;
            line-height: 1.2;
        }

        .text-isi {
            text-align: justify;
            font-size: 14px; /* Slightly smaller default font size for content */
        }

        .text-isi p {
            margin-bottom: 8px; /* Reduced paragraph spacing */
        }

        table.data-table {
            width: 100%;
            margin-bottom: 10px;
            font-size: 14px; /* Ensure consistent font size within table */
        }

        table.data-table tr td:first-child {
            width: 160px; /* Reduced width for the first column */
            vertical-align: top; /* Align to top for multi-line addresses */
        }
        table.data-table tr td {
            padding-bottom: 2px; /* Reduce padding between table rows */
        }


        .ttd {
            text-align: right;
            margin-top: 30px; /* Significantly reduced margin-top */
        }
        .ttd p {
            margin: 0; /* Remove default paragraph margins */
            line-height: 1.4; /* Adjust line height for TTD block */
        }
        .ttd strong {
            margin-top: 5px; /* Space above the name */
            display: block; /* Make strong tag behave like a block for margin */
        }

        /* Print specific adjustments */
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .surat {
                margin: 0; /* No margin when printing to maximize space */
                padding: 15px 25px; /* Adjust padding for print */
                max-width: 100%; /* Use full width available in print */
            }
            .kop-text h5, .kop-text h4 {
                line-height: 1.1; /* Even tighter for print */
            }
            .kop-text p {
                font-size: 11px; /* Smaller for print */
            }
            .text-isi, table.data-table {
                font-size: 13px; /* Smaller font for print content */
            }
            .ttd {
                margin-top: 25px; /* Fine-tune margin for print */
            }
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
                    <p>
                        Alamat: Jl. Suka Damai Rt 04 Rw 02 Desa Handil Suruk Kec. Bumi Makmur Kode Pos 70853<br>
                        Email : desahandilsuruk@gmail.com
                    </p>
                </td>
            </tr>
        </table>

        <div class="kop-border"></div>

        <div style="text-align: center; margin-bottom: 15px;" class="surat-title">
            <h5><u><strong>SURAT KETERANGAN CATATAN KEPOLISIAN</strong></u></h5>
            <p>Nomor : <?= $no_surat ?? '...' ?></p>
        </div>

        <div class="text-isi">
            <p>Yang bertanda tangan di bawah ini, Kepala Desa Handil Suruk Kecamatan Bumi Makmur Kabupaten Tanah Laut, dengan ini menerangkan bahwa:</p>

            <table class="data-table">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><strong><?= $nama ?></strong></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td><?= $jenis_kelamin ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tanggal Lahir</td>
                    <td>:</td>
                    <td><?= $tempat_tanggal_lahir ?></td>
                </tr>
                <tr>
                    <td>Status Perkawinan</td>
                    <td>:</td>
                    <td><?= $status_perkawinan ?></td>
                </tr>
                <tr>
                    <td>Kewarganegaraan</td>
                    <td>:</td>
                    <td><?= $kewarganegaraan ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td>:</td>
                    <td><?= $agama ?></td>
                </tr>
                <tr>
                    <td>Pekerjaan</td>
                    <td>:</td>
                    <td><?= $pekerjaan ?></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td><?= $nik ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?= $alamat ?></td>
                </tr>
            </table>

            <p>Berdasarkan data yang ada pada kantor desa kami, yang bersangkutan <strong> tidak/pernah terlibat dalam kegiatan kriminal atau tindakan melanggar hukum </strong>, serta berkelakuan baik di lingkungan masyarakat.</p>
            <p style="font-style: italic; font-size: 12px; margin-top: -5px;">(Coret yang tidak perlu pada kalimat yang dicetak tebal)</p>


            <p>Surat keterangan ini dibuat untuk dipergunakan sebagai persyaratan administratif dan keperluan lainnya yang sah.</p>

            <p>Demikian surat keterangan ini dibuat dengan sebenarnya agar dapat digunakan sebagaimana mestinya.</p>
        </div>

        <div class="ttd">
            <p>Dikeluarkan di Handil Suruk</p>
            <p>Pada Tanggal: <?php echo $created_at ?></p>
            <p style="margin-bottom: 50px;">Kepala Desa Handil Suruk</p>
            <strong><u>KHALIKUL BASIR</u></strong>
        </div>

    </div>

</body>

</html>