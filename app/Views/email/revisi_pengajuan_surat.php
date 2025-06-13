<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Revisi Pengajuan Surat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            border: 1px solid #e1e1e1;
            border-radius: 6px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
        }

        h2 {
            color: #b44a2b;
            margin-bottom: 20px;
        }

        .content {
            font-size: 15px;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #999;
            text-align: center;
        }

        .highlight {
            background-color: #fff2f2;
            padding: 10px;
            border-left: 4px solid #b44a2b;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Revisi Pengajuan Surat</h2>
        <div class="content">
            <p>Halo <strong><?= esc($nama_pengaju) ?></strong>,</p>

            <p>Pengajuan surat Anda dengan nomor:</p>
            <div class="highlight">
                <strong><?= esc($nomor_surat) ?></strong>
            </div>

            <p>memerlukan revisi dari pihak desa.</p>

            <p><strong>Catatan Revisi:</strong></p>
            <div class="highlight">
                <?= nl2br(esc($catatan_revisi)) ?>
            </div>

            <p>Silakan login kembali ke sistem layanan surat desa dan lakukan perbaikan sesuai catatan tersebut.</p>

            <p>Terima kasih atas perhatian dan kerja samanya.</p>
        </div>

        <div class="footer">
            &copy; <?= date('Y') ?> Sistem Informasi Surat Desa Handil Suruk
        </div>
    </div>
</body>
</html>
