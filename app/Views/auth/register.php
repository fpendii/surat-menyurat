<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Registrasi</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color:rgb(234, 234, 234);
        }

        .card-custom {
            background-color:rgb(255, 255, 255); /* putih tulang */
             max-width: 450px; /* Atur ukuran maksimum card */
    margin: 0 auto;   /* Posisikan card di tengah horizontal */
        }

        .card img {
            width: 100px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 card-custom">
                <div class="card-body rounded">
                    <div class="text-center mb-4">
                        <!-- <img src="/images/logo.png" alt="Logo Sisurat"> -->
                        <h3 class="mt-3">Buat Akun</h3>
                    </div>

                    <!-- Flashdata Error -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <!-- Form -->
                    <form action="/register/proses" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   value="<?= old('name') ?>" placeholder="Masukkan nama lengkap" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="<?= old('email') ?>" placeholder="Masukkan email" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">No. Handphone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   value="<?= old('phone') ?>" placeholder="Masukkan nomor handphone" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <textarea class="form-control" id="address" name="address" rows="3"
                                      placeholder="Masukkan alamat lengkap" required><?= old('address') ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Masukkan password" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <small>Sudah punya akun? <a href="/login">Login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (optional for interaktivitas) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
