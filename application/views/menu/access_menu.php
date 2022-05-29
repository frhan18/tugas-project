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
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_tambah" aria-pressed="false">
                <i class="fas fa-plus"></i> Add New Access Menu
            </button>
        </div>

        <div class="list-content">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-stripped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Menu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($access_menu as $menu_access) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $menu_access['role_name']; ?></td>
                                        <td><?= $menu_access['menu']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-delete-url="<?= site_url('menu/delete_access_menu/' . $menu_access['id']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_update<?= $menu_access['id']; ?>"><i class="fas fa-edit"></i></button>
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
                <h5 class="modal-title" id="modal_tambahLabel">Add New Access Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('menu/add_access_menu') ?>
                <div class="form-group row">
                    <label for="role_id" class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('role_id') ? 'is-invalid' : ''; ?>" name="role_id" id="role_id">
                            <?php $role = $this->db->get('user_role')->result_array(); ?>
                            <option selected>Pilih Role</option>
                            <?php foreach ($role as $rl) : ?>
                                <option value="<?= $rl['role_id']; ?>"><?= $rl['role_name']; ?></option>
                            <?php endforeach; ?>
                            <div class="invalid-feedback"><?= form_error('role_id'); ?></div>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="menu_id" class="col-sm-3 col-form-label">Menu</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('menu_id') ? 'is-invalid' : ''; ?>" name="menu_id" id="menu_id">
                            <?php $menu = $this->db->get('user_menu')->result_array(); ?>
                            <option selected>Pilih Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                            <div class="invalid-feedback"><?= form_error('menu_id'); ?></div>
                        </select>
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


<?php foreach ($access_menu as $menu_access) : ?>
    <div class="modal fade" id="modal_update<?= $menu_access['id']; ?>" tabindex="-1" aria-labelledby="modal_updateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_updateLabel">Edit Access Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('menu/update_access_menu/' . $menu_access['id']) ?>
                    <div class="form-group row">
                        <label for="role_id" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('role_id') ? 'is-invalid' : ''; ?>" name="role_id" id="role_id">
                                <?php $role = $this->db->get('user_role')->result_array(); ?>
                                <option selected>Pilih Role</option>
                                <?php foreach ($role as $rl) : ?>
                                    <option value="<?= $rl['role_id']; ?>" <?php if ($menu_access['role_id'] == $rl['role_id']) echo 'selected'; ?>><?= $rl['role_name']; ?></option>
                                <?php endforeach; ?>
                                <div class="invalid-feedback"><?= form_error('role_id'); ?></div>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="menu_id" class="col-sm-3 col-form-label">Menu</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('menu_id') ? 'is-invalid' : ''; ?>" name="menu_id" id="menu_id">
                                <?php $menu = $this->db->get('user_menu')->result_array(); ?>
                                <option selected>Pilih Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>" <?php if ($menu_access['menu_id'] == $m['id']) echo 'selected'; ?>><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                                <div class="invalid-feedback"><?= form_error('menu_id'); ?></div>
                            </select>
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