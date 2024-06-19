<?= $this->extend('layout/user/user'); ?>

<?= $this->section('content'); ?>
<section class="content-body">
    <div class="container py-3">
        <div class="saktitruss-form">
            <div class="form-title mb-3 text-white w-100 d-flex align-items-center gap-3 py-3">
                <i class=" ms-3 fas fa-user-plus"></i>
                <h1 class="h4 m-0">SAKTITRUSS</h1>
            </div>
            <div class="form-body">
                <form action="/st-save" method="post">
                    <?= csrf_field(); ?>
                    <div class="input-field d-none">
                        <input type="text" name="company" id="company" value="SAKTITRUSS">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="">Nama</label>
                                <input type="text" class="form-control <?= (session()->has('validation') && session('validation')->hasError('nama_tamu')) ? 'is-invalid' : ''; ?>" value="<?= old('nama_tamu'); ?>" name="nama_tamu" id="nama_tamu" autocomplete="off">
                                <?php if (session()->has('validation') && session('validation')->hasError('nama_tamu')) : ?>
                                    <div class="invalid-feedback text-danger d-flex align-items-center gap-2">
                                        <i class="fa fa-circle-exclamation"></i>
                                        <?= session('validation')->getError('nama_tamu') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-field">
                                <label for="">Asal Instansi</label>
                                <input type="text" class="form-control <?= (session()->has('validation') && session('validation')->hasError('asal_instansi')) ? 'is-invalid' : ''; ?>" value="<?= old('asal_instansi'); ?>" name="asal_instansi" id="asal_instansi" list="asal-list">
                                <datalist id="asal-list" class="instansi-list">
                                    <?php foreach ($instansi as $ins) : ?>
                                        <option value="<?= $ins['nama_instansi'] ?>"></option>
                                    <?php endforeach; ?>
                                </datalist>
                                <?php if (session()->has('validation') && session('validation')->hasError('asal_instansi')) : ?>
                                    <div class="invalid-feedback position-absolute text-danger d-flex align-items-center gap-2">
                                        <i class="fa fa-circle-exclamation"></i>
                                        <?= session('validation')->getError('asal_instansi') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="input-field">
                                <label for="">Divisi</label>
                                <select class="form-select <?= (session()->has('validation') && session('validation')->hasError('divisi')) ? 'is-invalid' : ''; ?>" value="<?= old('divisi'); ?>" name="divisi" id="divisi">
                                    <option value="">-- Silahkan Pilih Divisi --</option>
                                    <?php foreach ($daftardivisi as $div) :  ?>
                                        <option value="<?= esc($div['nama_divisi']) ?>"><?= esc($div['nama_divisi']) ?></option>
                                    <?php endforeach;  ?>
                                </select>
                                <?php if (session()->has('validation') && session('validation')->hasError('divisi')) : ?>
                                    <div class="invalid-feedback text-danger d-flex align-items-center gap-2">
                                        <i class="fa fa-circle-exclamation"></i>
                                        <?= session('validation')->getError('divisi') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-field">
                                <label for="">Keperluan</label>
                                <select name="keperluan" id="keperluan" class="form-select <?= (session()->has('validation') && session('validation')->hasError('keperluan')) ? 'is-invalid' : ''; ?>" value="<?= old('keperluan'); ?>">
                                    <option value="">-- Silahkan Pilih Keperluan --</option>
                                    <option value="Konfirmasi Penagihan Invoice">Konfirmasi Penagihan Invoice</option>
                                    <option value="Penawaran Produk/Jasa">Penawaran Produk/Jasa</option>
                                    <option value="Penawaran Kerja Sama">Penawaran Kerja Sama</option>
                                    <option value="Interview Kerja">Interview Kerja</option>
                                    <option value="Pengambilan Pembelian Barang">Pengambilan Pembelian Barang</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                                <?php if (session()->has('validation') && session('validation')->hasError('keperluan')) : ?>
                                    <div class="invalid-feedback text-danger d-flex align-items-center gap-2">
                                        <i class="fa fa-circle-exclamation"></i>
                                        <?= session('validation')->getError('keperluan') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="input-field">
                                <label for="">Keterangan</label>
                                <input type="text" class="form-control mb-1" name="keterangan" id="keterangan" autocomplete="off">
                                <span>(*) SIlahkan isi form keterangan untuk menjelaskan lebih detail keperluan anda.</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-btn d-flex gap-5">
                        <button class="btn btn-success" type="submit">Submit</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>