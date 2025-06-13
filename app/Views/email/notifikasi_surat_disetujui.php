<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Surat Disetujui</title>
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
            color: #2b4a78;
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
            background-color: #e9f5ff;
            padding: 10px;
            border-left: 4px solid #2b4a78;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Surat Telah Disetujui oleh Kepala Desa</h2>
        <div class="content">
            <p>Yth. Admin,</p>

            <p>Surat dari pemohon <strong><?= esc($nama_pengaju) ?></strong> telah <strong>disetujui oleh Kepala Desa</strong>.</p>

            <div class="highlight">
                <p><strong>Nomor Surat:</strong><br><?= esc($nomor_surat) ?></p>
            </div>

            <p>Silakan unggah surat yang telah ditandatangani melalui sistem untuk disampaikan kepada pemohon.</p>

            <p>Terima kasih atas perhatian dan kerja samanya.</p>
        </div>

        <div class="footer">
            &copy; <?= date('Y') ?> Sistem Informasi Surat Desa Handil Suruk
        </div>
    </div>
</body>
</html>
