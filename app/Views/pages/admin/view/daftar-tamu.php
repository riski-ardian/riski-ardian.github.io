<?= $this->extend('layout/admin/admin'); ?>

<?= $this->section('content'); ?>
<section class="content-body">
    <div class="container py-3">
        <div class="daftar-title mb-3 text-white w-100 d-flex align-items-center gap-3 py-3">
            <i class="fas fa-list-ul"></i>
            <h1 class="h4 m-0">Daftar Tamu</h1>
        </div>
        <form action="" method="get">
            <!-- <div class="search-box mb-3 position-relative">
                <div class="row justify-content-end">
                    <div class="col-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="search" id="search" class="form-control">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
            </div> -->
        </form>
        <table class="table daftar-table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Asal</th>
                    <th scope="col">Divisi</th>
                    <th scope="col">Keperluan</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Company</th>
                    <th colspan="2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($daftartamu as $dt) : ?>
                    <tr>
                        <td class="text-center"><?= esc($dt['tanggal']); ?></td>
                        <td class="text-center"><?= esc($dt['waktu']); ?></td>
                        <td><?= esc($dt['nama']); ?></td>
                        <td><?= esc($dt['asal']); ?></td>
                        <td><?= esc($dt['divisi']); ?></td>
                        <td><?= esc($dt['keperluan']); ?></td>
                        <td><?= esc($dt['keterangan']); ?></td>
                        <td><?= esc($dt['company']); ?></td>
                        <td>

                            <a class="btn-edit text-primary" href="/daftar-tamu/edit/<?= $dt['id']; ?>"><i class="fa fa-pencil"></i></a>
                        </td>
                        <td>
                            <form id="form-delete-<?= $dt['id'] ?>" action="/daftar-tamu/delete/<?= $dt['id'] ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn-delete text-danger" type="button"><i class="fa fa-trash" onclick="confirmDelete('form-delete-<?= $dt['id'] ?>')"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach;  ?>
            </tbody>
        </table>

        <?= $pager->links('tbl_tamu', 'daftar_pager') ?>

    </div>
</section>


<?= $this->endSection(); ?>