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
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal_tambah" aria-pressed="false">
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
                                    <th>Menu</th>
                                    <th>Title</th>
                                    <th>Url</th>
                                    <th>icon</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $base_url = base_url();
                                $no = 1;
                                foreach ($submenu as $sm) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $sm['menu']; ?></td>
                                        <td><?= $sm['title']; ?></td>
                                        <td><?= $base_url; ?><?= $sm['url']; ?></td>
                                        <td><?= $sm['icon']; ?></td>
                                        <td><?= $sm['is_active'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                        <th>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-delete-url="<?= site_url('menu/delete_submenu/' . $sm['id']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_update<?= $sm['id']; ?>"><i class="fas fa-edit"></i></button>
                                            </div>
                                        </th>
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
                <h5 class="modal-title" id="modal_tambahLabel">Add New SubMenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('menu/add_submenu') ?>
                <div class="form-group row">
                    <label for="menu_id" class="col-sm-3 col-form-label">Menu</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('menu_id') ? 'is-invalid' : ''; ?>" name="menu_id" id="menu_id" required>
                            <option selected value="">Pilih</option>
                            <?php
                            $menu = $this->db->get('user_menu')->result_array();
                            foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('menu_id'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Title</label>
                    <div class="col-sm-9">
                        <input type="text" required class="form-control <?= form_error('title') ? 'is-invalid' : ''; ?>" value="<?= set_value('title'); ?>" name="title" id="title">
                        <div class="invalid-feedback"><?= form_error('title'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Url</label>
                    <div class="col-sm-9">
                        <input type="text" required class="form-control <?= form_error('url') ? 'is-invalid' : ''; ?>" value="<?= set_value('url'); ?>" name="url" id="url" placeholder="<?= base_url(); ?>">
                        <div class="invalid-feedback"><?= form_error('url'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="icon" class="col-sm-3 col-form-label">Icon</label>
                    <div class="col-sm-9">
                        <input type="text" required class="form-control <?= form_error('icon') ? 'is-invalid' : ''; ?>" value="<?= set_value('icon'); ?>" name="icon" id="icon" placeholder="fas fa-fw fa-users">
                        <div class="invalid-feedback"><?= form_error('icon'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-3 col-form-label">Status Account</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Aktifkan / nonaktifkan submenu?
                            </label>
                        </div>
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


<?php foreach ($submenu as $sm) : ?>
    <div class="modal fade" id="modal_update<?= $sm['id']; ?>" tabindex="-1" aria-labelledby="modal_updateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_updateLabel">Edit SubMenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('menu/update_submenu/' . $sm['id']) ?>
                    <div class="form-group row">
                        <label for="menu_id" class="col-sm-3 col-form-label">Menu</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('menu_id') ? 'is-invalid' : ''; ?>" name="menu_id" id="menu_id" required>
                                <option selected value="">Pilih</option>
                                <?php
                                $menu = $this->db->get('user_menu')->result_array();
                                foreach ($menu as $m) : ?>
                                    <option value="<?= $m['id']; ?>" <?php if ($sm['menu_id'] == $m['id']) echo 'selected'; ?>><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('menu_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('title') ? 'is-invalid' : ''; ?>" value="<?= $sm['title']; ?>" name="title" id="title">
                            <div class="invalid-feedback"><?= form_error('title'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="url" class="col-sm-3 col-form-label">Url</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('url') ? 'is-invalid' : ''; ?>" value="<?= $sm['url']; ?>" name="url" id="url">
                            <div class="invalid-feedback"><?= form_error('url'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="icon" class="col-sm-3 col-form-label">Icon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('icon') ? 'is-invalid' : ''; ?>" value="<?= $sm['icon']; ?>" name="icon" id="icon" placeholder="fas fa-fw fa-users">
                            <div class="invalid-feedback"><?= form_error('icon'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-3 col-form-label">Status Submenu</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" <?php if ($sm['is_active'] == 1) echo 'checked'; ?> id="is_active">
                                <label class="form-check-label" for="is_active">
                                    Aktifkan / nonaktifkan submenu?
                                </label>
                            </div>
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