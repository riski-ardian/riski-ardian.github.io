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

    <?= $this->renderSection('content'); ?>


    <script src="<?= base_url('/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('/vendor/sweetalert/sweetalert2.all.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/script.js') ?>"></script>
    <?php if (session()->has('loggedin')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Selamat!',
                text: '<?= session('loggedin') ?>',
                showConfirmButton: false,
                timer: 3500
            }).then(function() {
                window.location = '/dashboard';
            });
        </script>
    <?php elseif (session()->has('gagal')) : ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: '<?= session('gagal') ?>',
                text: 'Silahkan Coba Kembali !',
                confirmButtonText: 'OK'
            });
        </script>
    <?php endif; ?>
</body>

</html>