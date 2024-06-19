<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/vendor/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/vendor/fontawesome/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/vendor/sweetalert/sweetalert2.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('/assets/css/style.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('/assets/img/3d.svg') ?>" type="image/x-icon">
    <title><?= $title; ?></title>
</head>

<body>
    <div class="canvas w-100 h-100 bg-body-secondary">
        <div class="main-canvas">
            <header class="content-header bg-success d-flex align-items-center">
                <div class="header-logo ms-3 d-flex align-items-center gap-2">
                    <img src="<?= base_url('assets/img/logo.png') ?>">
                    <span>SAKTI<br>GUESTBOOK</span>
                </div>
                <div class="vr mx-5"></div>
                <div class="header-menu user-menu">
                    <ul>
                        <li>
                            <a href="/">
                                HOME
                            </a>
                        </li>
                        <li>
                            <a href="/saktitruss">
                                SAKTITRUSS
                            </a>
                        </li>
                        <li>
                            <a href="/saktiglass">
                                SAKTIGLASS
                            </a>
                        </li>
                    </ul>
                </div>
            </header>

            <?= $this->renderSection('content'); ?>

        </div>
    </div>

    <script src="<?= base_url('/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('/vendor/sweetalert/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/script.js') ?>"></script>
    <?php if (session()->has('added')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "<?= session()->getFlashdata('added') ?>",
                showConfirmButton: false,
                timer: 3500
            }).then(function() {
                window.location = '/';
            });
        </script>
    <?php endif; ?>
</body>

</html>