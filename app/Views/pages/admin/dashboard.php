<?= $this->extend('layout/admin/admin'); ?>

<?= $this->section('content'); ?>
<section class="content-body">
    <div class="container py-3">
        <div class="admin-dashboard">
            <div class="dashboard-title mb-3 text-white w-100 d-flex align-items-center gap-3 py-3">
                <i class="fas fa-home"></i>
                <h1 class="h4 m-0">Dashboard</h1>
            </div>
            <div class="admin-title">
                <div class="row my-4">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-body d-flex align-items-center ms-3">
                                <div class="card-detail">
                                    <h1 class="h4"><b>Halo, <?= $userLogin; ?> !</b></h1>
                                    <span>Selamat Datang di Dashboard Admin Aplikasi SAKTI Guestbook.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-card">
                <div class="top-row row mb-4">
                    <div class="col-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <div class="col-9">
                                        <h1 class="h5">TOTAL TAMU</h1>
                                        <span><?= $total_tamu; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fa fa-user-group"></i>
                                    </div>
                                    <div class="col-9">
                                        <h1 class="h5">TAMU SAKTITRUS</h1>
                                        <span><?= $totaltamu_saktitruss; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="col-9">
                                        <h1 class="h5">TAMU SAKTIGLASS</h1>
                                        <span><?= $totaltamu_saktiglass; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bot-row row">
                    <div class="col-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fa fa-sitemap"></i>
                                    </div>
                                    <div class="col-9">
                                        <h1 class="h5">DAFTAR DIVISI</h1>
                                        <span><?= $total_divisi; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fa fa-city"></i>
                                    </div>
                                    <div class="col-9">
                                        <h1 class="h5">DAFTAR INSTANSI</h1>
                                        <span><?= $total_instansi; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection(); ?>