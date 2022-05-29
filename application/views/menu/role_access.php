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
        <ol class="breadcrumb" style="background: #3a3a3a;">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= isset($title) ? $title : ''; ?></li>
        </ol>
    </nav>


    <div class="box">

        <div class="add-modal-btn mb-3">
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_add_role" aria-pressed="false">
                <i class="fas fa-plus"></i> Add New Role Access
            </button>
        </div>

        <div class="list-content">
            <div class="row">
                <div class="col-xl-8">
                    <div class="table-responsive">
                        <table class="table table-stripped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($role_access as $rc) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $rc['role_name']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-delete-url="<?= site_url('menu/role_access/delete/' . $rc['role_id']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_edit_role<?= $rc['role_id']; ?>"><i class="fas fa-edit"></i></button>
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
            text: 'Apakah anda yakin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Nanti dulu',
            confirmButtonText: 'Ya, yakin',
            confirmButtonColor: 'red'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.deleteUrl);
            }
        });
    }
</script>

<div class="modal fade" id="modal_add_role" tabindex="-1" aria-labelledby="modal_add_roleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_add_roleLabel">Add New Role Access </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('menu/role_access/add') ?>
                <div class="form-group row">
                    <label for="role_name" class="col-sm-3 col-form-label">Role Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('role_name') ? 'is-invalid' : ''; ?>" value="<?= set_value('role_name'); ?>" name="role_name" id="role_name">
                        <div class="invalid-feedback"><?= form_error('role_name'); ?></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Save </button>
                    <?= form_close(); ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php foreach ($role_access as $rc) : ?>
    <div class="modal fade" id="modal_edit_role<?= $rc['role_id']; ?>" tabindex="-1" aria-labelledby="modal_edit_roleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_edit_roleLabel">Edit role Access </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('menu/role_access/edit/' . htmlentities($rc['role_id'])) ?>
                    <div class="form-group row">
                        <label for="role_name" class="col-sm-3 col-form-label">Role Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('role_name') ? 'is-invalid' : ''; ?>" value="<?= $rc['role_name']; ?>" name="role_name" id="role_name">
                            <div class="invalid-feedback"><?= form_error('role_name'); ?></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Update </button>
                        <?= form_close(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>