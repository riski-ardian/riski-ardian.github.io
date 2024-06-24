<?= $this->extend('layout/admin/admin'); ?>

<?= $this->section('content'); ?>
<section class="content-body">
    <div class="container py-3">
        <div class="admin-dashboard">
            <div class="instansi-title mb-3 text-white w-100 d-flex align-items-center gap-3 py-3">
                <i class="fas fa-pen-to-square"></i>
                <h1 class="h4 m-0">Edit Instansi</h1>
            </div>
            <div class="form-body">
                <form action="/instansi/update/<?= $daftarinstansi['id']; ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col">
                            <div class="input-field">
                                <label class="mb-3">Nama Instansi</label>
                                <input type="text" class="form-control <?= (session()->has('validation') && session('validation')->hasError('nama_instansi')) ? 'is-invalid' : ''; ?>" value="<?= $daftarinstansi['nama_instansi']; ?>" name="nama_instansi" id="nama_instansi" autocomplete="off">
                                <?php if (session()->has('validation') && session('validation')->hasError('nama_instansi')) : ?>
                                    <div class="invalid-feedback text-danger d-flex align-items-center gap-2">
                                        <i class="fa fa-circle-exclamation"></i>
                                        <?= session('validation')->getError('nama_instansi') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-btn d-flex gap-5">
                        <button class="btn btn-success" type="submit">Update</button>
                        <a class="btn btn-danger" href="/instansi">Cancel</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection(); ?>