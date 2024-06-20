<?= $this->extend('layout/admin/login'); ?>

<?= $this->section('content'); ?>
<div class="loginpage d-flex align-items-center">
    <div class="loginpage-main d-flex justify-content-center">
        <div class="login-form text-center">
            <?= form_open('/login/save_login'); ?>
            <div class="form-title">
                <h1 class="h3">Admin Login</h1>
            </div>
            <div class="form-body">
                <div class="form-field">
                    <i class="fa fa-user"></i>
                    <input type="text" name="username" id="username" placeholder="Username" class="form-control" autocomplete="off">
                </div>
                <div class="form-field">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" autocomplete="off">
                </div>
                <div class="row justify-content-center login-btn d-flex gap-3">
                    <button class="btn" type="submit">Login</button>
                    <a href="/" class="btn">Kembali</a>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>