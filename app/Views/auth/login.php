<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="/template-admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/template-admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/template-admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/template-admin/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/template-admin/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form action="/login/proses" method="post">
                        <h1>Login</h1>

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

                        <div>
                            <input type="email" class="form-control" name="email" placeholder="Email" required />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                required />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-default submit">Login</button>
                         
                        </div>
                        <div class="separator">
                            <p class="change_link">Belum Punya Akun ?
                                <a href="#signup" class="to_register"> Buat Akun </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />


                        </div>
                    </form>

                </section>
            </div>

            <div id="register" class="animate form registration_form">
                <section class="login_content">
                    <form action="/register/proses" method="post">
                        <h1>Buat Akun</h1>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <div>
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap"
                                value="<?= old('name') ?>" required />
                        </div>

                        <div>
                            <input type="email" class="form-control" name="email" placeholder="Email"
                                value="<?= old('email') ?>" required />
                        </div>

                        <div>
                            <input type="text" class="form-control" name="phone" placeholder="No. Handphone"
                                value="<?= old('phone') ?>" required />
                        </div>

                        <div>
                            <textarea class="form-control" name="address" placeholder="Alamat" rows="3" required
                                style="display: block; width: 100%; margin-bottom: 10px;"><?= old('address') ?></textarea>
                        </div>

                        <div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required />
                        </div>

                        <div>
                            <button type="submit" class="btn btn-default submit">Submit</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Sudah Punya Akun ?
                                <a href="#signin" class="to_register"> Login </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />
                        </div>
                    </form>
                </section>
            </div>




        </div>
    </div>
</body>

</html>