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



<div class="wrapperr">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: #fff;">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Account</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="box">
        <div class="add-modal-btn mb-3">
            <div class="row ">
                <div class="col-lg-10 ">
                    <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#modal_tambah" aria-pressed="false">
                        <i class="fas fa-plus"></i> Tambah Data Baru
                    </button>
                </div>

            </div>
        </div>

        <div class="list-content">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <td>Foto</td>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Create</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1;
                                foreach ($user as $rows) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><img src="<?= base_url('upload/' . $rows['image']); ?>" alt="<?= $rows['name']; ?>" width="100"></td>
                                        <td><?= $rows['name']; ?></td>
                                        <td><?= $rows['email']; ?></td>
                                        <td>
                                            <?php if ($rows['role_id'] == 1 || $rows['role_id'] == 6) : ?>
                                                <p class="text-bold text-dark">Admin</p>
                                            <?php else : ?>
                                                <p>Mahasiswa</p>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $rows['is_active'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                        <td><?= date('d M Y H:i:s', $rows['date_created']); ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-delete-url="<?= site_url('user-account/delete/' . $rows['id_user']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_edit<?= $rows['id_user']; ?>"><i class="fas fa-edit"></i></button>
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


<div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="modal_tambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_tambahLabel">Tambah Data Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('user-account/add') ?>
                <div class="form-group row">
                    <label for="nim" class="col-sm-3 col-form-label">Nim </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nim') ? 'is-invalid' : ''; ?>" value="<?= set_value('nim'); ?>" name="nim" id="nim" required>
                        <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" value="<?= set_value('email') ? set_value('email') : '@gmail.com'; ?>" name="email" id="email" required>
                        <div class="invalid-feedback"><?= form_error('email'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Nama akun </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" value="<?= set_value('name'); ?>" name="name" id="name" required>
                        <div class="invalid-feedback"><?= form_error('name'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control <?= form_error('password') ? 'is-invalid' : ''; ?>" name="password" id="password" placeholder="Password" required minlength="6">
                        <div class="invalid-feedback"><?= form_error('password'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="role_id" class="col-sm-3 col-form-label">Role</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('role_id') ? 'is-invalid' : ''; ?>" name="role_id" id="role_id" required>
                            <option selected disabled value="">Pilih</option>
                            <?php
                            foreach ($role as $r) : ?>
                                <option value="<?= $r['role_id']; ?>"><?= $r['role_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('jenis_kelamin'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-3 col-form-label">Status Account</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Aktifkan / nonaktifkan account?
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

<?php foreach ($user as $rows) : ?>
    <div class="modal fade" id="modal_edit<?= $rows['id_user']; ?>" tabindex="-1" aria-labelledby="modal_editLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_editLabel">Edit Akun <?= $rows['name']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('user-account/edit/' . $rows['id_user']) ?>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label">Nim </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nim') ? 'is-invalid' : ''; ?>" value="<?= $rows['nim']; ?>" name="nim" id="nim" required>
                            <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" value="<?= $rows['email']; ?>" name="email" id="email" required>
                            <div class="invalid-feedback"><?= form_error('email'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Nama akun </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" value="<?= $rows['name']; ?>" name="name" id="name" required>
                            <div class="invalid-feedback"><?= form_error('name'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role_id" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('role_id') ? 'is-invalid' : ''; ?>" name="role_id" id="role_id" required>
                                <option selected disabled value="">Pilih</option>
                                <?php
                                foreach ($role as $r) : ?>
                                    <option value="<?= $r['role_id']; ?>" <?php if ($rows['role_id'] == $r['role_id']) echo 'selected'; ?>><?= $r['role_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('role_id'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-3 col-form-label">Status Account</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" <?php if ($rows['is_active'] == 1) echo 'checked'; ?>>
                                <label class="form-check-label" for="is_active">
                                    Aktifkan / nonaktifkan account?
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