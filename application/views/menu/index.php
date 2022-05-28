<!-- Page Heading -->
<header id="header">
    <?php if ($this->session->flashdata('message_success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('message_success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
</header>



<div class="wrapper">
    <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: #fff;">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= isset($title) ? $title : ''; ?></li>
        </ol>
    </nav>

    <div class="box">
        <div class="add-modal-btn mb-3">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_tambah" aria-pressed="false">
                <i class="fas fa-plus"></i> Add New Menu
            </button>
        </div>

        <div class="list-content">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Daftar Menu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($menu as $m) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $m['menu']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-delete-url="<?= site_url('menu/delete_menu/' . $m['id']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_update<?= $m['id']; ?>"><i class="fas fa-edit"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>



<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteConfirm(event) {
        Swal.fire({
            title: 'Delete Confirmation!',
            text: 'Are you sure to delete the item?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes Delete',
            confirmButtonColor: 'red'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.deleteUrl);
            }
        });
    }
</script>


<!-- Modal tambah -->
<div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="modal_tambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_tambahLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('menu/add_menu') ?>
                <div class="form-group row">
                    <label for="menu" class="col-sm-3 col-form-label">Nama menu</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('menu') ? 'is-invalid' : ''; ?>" value="<?= set_value('menu'); ?>" name="menu" id="menu">
                        <div class="invalid-feedback"><?= form_error('menu'); ?></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save </button>
                    <?= form_close(); ?>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Modal update -->
<?php foreach ($menu as $m) : ?>
    <div class="modal fade" id="modal_update<?= $m['id']; ?>" tabindex="-1" aria-labelledby="modal_updateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_updateLabel">Update Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('menu/update_menu/' . $m['id']) ?>
                    <div class="form-group row">
                        <label for="menu" class="col-sm-3 col-form-label">Nama menu</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('menu') ? 'is-invalid' : ''; ?>" value="<?= $m['menu']; ?>" name="menu" id="menu">
                            <div class="invalid-feedback"><?= form_error('menu'); ?></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update </button>
                        <?= form_close(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>