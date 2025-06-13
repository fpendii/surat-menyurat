<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
            color: #333;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border: 1px solid #e3e3e3;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
        }
        .header {
            font-size: 20px;
            font-weight: bold;
            color: #0056b3;
            margin-bottom: 20px;
        }
        .detail {
            background: #f1f1f1;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 16px;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Disposisi Surat Baru</div>

        <p>Halo <strong><?= esc($nama) ?></strong>,</p>

        <p>Anda mendapatkan disposisi surat baru dengan detail sebagai berikut:</p>

        <div class="detail">
            <strong>Nomor Surat:</strong> <?= esc($nomor_surat) ?><br>
            <strong>Surat Dari:</strong> <?= esc($surat_dari) ?><br>
            <strong>Perihal:</strong> <?= esc($perihal) ?><br>
            <strong>Tanggal Surat:</strong> <?= esc($tanggal_surat) ?>
        </div>

        <p>Silakan login ke sistem untuk melihat detail lengkap surat.</p>

        <a href="<?= base_url() ?>" class="btn">Buka Sistem</a>

        <div class="footer">
            Email ini dikirim otomatis oleh Sistem Surat Desa Handil. Mohon tidak membalas email ini.
        </div>
    </div>
</body>
</html>
