<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - Sisurat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/template-admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template-admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <style>
        /* body {
            background-color: #fdfdf0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            
        } */

        body {
            background: url('/img/handil_suruk.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .login-card h3 {
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .alert {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <h3>Login Sisurat</h3>

        <form action="/login/proses" method="post">
            <!-- Tampilkan pesan error -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Tampilkan pesan success -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <input type="email" class="form-control" name="email" placeholder="Email" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>

            <button type="submit" class="btn btn-primary w-100">Login</button>

            <p class="mt-3 text-center">Belum punya akun? <a href="<?= base_url('/register') ?>">Buat Akun</a></p>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="/template-admin/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/template-admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>