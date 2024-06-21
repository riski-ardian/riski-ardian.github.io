<?= $this->extend('layout/admin/admin'); ?>

<?= $this->section('content'); ?>
<section class="content-body">
    <div class="container py-3">
        <div class="admin-dashboard">
            <div class="instansi-title mb-3 text-white w-100 d-flex align-items-center gap-3 py-3">
                <i class="fas fa-city"></i>
                <h1 class="h4 m-0">Daftar Instansi</h1>
            </div>
            <div class="container-body">
                <table class="table instansi-table table-bordered">
                    <thead class="table-primary table-bordered">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Instansi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = ($currentPage - 1) * 10 + 1; ?>
                        <?php foreach ($instansi as $ins) : ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= esc($ins['nama_instansi']); ?></td>
                                <td class="text-center btn-aksi">
                                    <a class="btn-edit text-primary" href="/instansi/edit/<?= $ins['id']; ?>"><i class="fa fa-pencil"></i></a>
                                    <div class="btn-vr"></div>
                                    <form id="form-delete-<?= $ins['id'] ?>" action="/instansi/<?= $ins['id'] ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn-delete text-danger" type="button"><i class="fa fa-trash" onclick="confirmDelete('form-delete-<?= $ins['id'] ?>')"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <?= $pager->links('tbl_instansi', 'daftar_pager') ?>

            </div>

        </div>
    </div>
</section>

<?= $this->endSection(); ?>