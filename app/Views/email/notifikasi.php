<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi Pengajuan Surat Ahli Waris</title>
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
        <h2>Pengajuan <?= esc($jenisSurat) ?></h2>
        <div class="content">
            <p>Yth. Petugas Administrasi,</p>

            <p>Ada pengajuan <strong>Surat Ahli Waris</strong> baru melalui sistem layanan desa.</p>

            <div class="highlight">
                <p><strong>Nomor Surat:</strong><br><?= esc($nomorSurat) ?></p>
            </div>

            <p>Silakan buka sistem untuk memeriksa dan memverifikasi pengajuan ini.</p>

            <p>Terima kasih atas kerja samanya.</p>
        </div>

        <div class="footer">
            &copy; <?= date('Y') ?> Sistem Informasi Surat Desa Handil Suruk
        </div>
    </div>
</body>
</html>
