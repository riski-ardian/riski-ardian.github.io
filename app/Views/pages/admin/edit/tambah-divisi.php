<?= $this->extend('layout/admin/admin'); ?>

<?= $this->section('content'); ?>
<section class="content-body">
    <div class="container py-3">
        <div class="admin-dashboard">
            <div class="divisi-title mb-3 text-white w-100 d-flex align-items-center gap-3 py-3">
                <i class="fas fa-plus"></i>
                <h1 class="h4 m-0">Tambah Divisi</h1>
            </div>
            <div class="form-body">
                <form action="/divisi/tambah-divisi" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col">
                            <div class="input-field">
                                <label class="mb-3">Nama Divisi</label>
                                <input type="text" class="form-control <?= (session()->has('validation') && session('validation')->hasError('nama_divisi')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_divisi'); ?>" name="nama_divisi" id="nama_divisi" autocomplete="off">
                                <?php if (session()->has('validation') && session('validation')->hasError('nama_divisi')) : ?>
                                    <div class="invalid-feedback text-danger d-flex align-items-center gap-2">
                                        <i class="fa fa-circle-exclamation"></i>
                                        <?= session('validation')->getError('nama_divisi') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-btn d-flex gap-5">
                        <button class="btn btn-success" type="submit">Tambah</button>
                        <a class="btn btn-danger" href="/divisi">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection(); ?>