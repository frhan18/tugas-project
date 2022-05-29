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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: #fff;">
            <li class="breadcrumb-item"><a href="<?= base_url('admin/index'); ?>">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= isset($title) ? $title : 'Admin'; ?></li>
        </ol>
    </nav>
    <div class="box">
        <div class="add-modal-btn mb-3">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_tambah" aria-pressed="false">
                <i class="fas fa-plus"></i> Add New Data
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
                                    <th>ID (Dosen)</th>
                                    <th>Nidn</th>
                                    <th>Nama Dosen</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($dosen as $rows) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $rows['id_dosen']; ?></td>
                                        <td><?= $rows['nidn']; ?></td>
                                        <td><?= $rows['nama_dosen']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-delete-url="<?= site_url('admin/delete_dosen/' . $rows['id_dosen']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_update<?= $rows['id_dosen']; ?>"><i class="fas fa-edit"></i></button>
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
    <!-- Page Heading -->

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


<!-- Modal tambah -->
<div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="modal_tambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_tambahLabel">Add New Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/dosen') ?>
                <div class="form-group row">
                    <label for="nidn" class="col-sm-3 col-form-label">Nidn</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control <?= form_error('nidn') ? 'is-invalid' : ''; ?>" value="<?= set_value('nidn'); ?>" name="nidn" id="nidn" required>
                        <div class="invalid-feedback"><?= form_error('nidn'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_dosen" class="col-sm-3 col-form-label">Nama Dosen</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama_dosen') ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_dosen'); ?>" name="nama_dosen" id="nama_dosen">
                        <div class="invalid-feedback"><?= form_error('nama_dosen'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_user" class="col-sm-3 col-form-label">ID (User)</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_user') ? 'is-invalid' : ''; ?>" name="id_user" id="id_user">
                            <option selected disabled>Pilih ID User</option>
                            <?php
                            $user = $this->db->get('user')->result_array();
                            foreach ($user as $u) :  ?>
                                <option value="<?= $u['id_user']; ?>"><?= $u['id_user']; ?> / (<?= $u['email']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_user'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_dosen" class="col-sm-3 col-form-label">ID (Dosen)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" value="<?= set_value('id_dosen'); ?>" name="id_dosen" id="id_dosen" required>
                        <div class="invalid-feedback"><?= form_error('id_dosen'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : ''; ?>" value="<?= set_value('alamat'); ?>" name="alamat" id="alamat">
                        <div class="invalid-feedback"><?= form_error('alamat'); ?></div>
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
<?php foreach ($dosen as $rows) : ?>
    <div class="modal fade" id="modal_update<?= $rows['id_dosen']; ?>" tabindex="-1" aria-labelledby="modal_updateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_updateLabel">Update Data Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/update_dosen/' . $rows['id_dosen']) ?>
                    <div class="form-group row">
                        <label for="id_dosen" class="col-sm-3 col-form-label">ID (Dosen)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" value="<?= $rows['id_dosen']; ?>" name="id_dosen" id="id_dosen" readonly>
                            <div class="invalid-feedback"><?= form_error('id_dosen'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nidn" class="col-sm-3 col-form-label">Nidn</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control <?= form_error('nidn') ? 'is-invalid' : ''; ?>" value="<?= $rows['nidn']; ?>" name="nidn" id="nidn">
                            <div class="invalid-feedback"><?= form_error('nidn'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dosen" class="col-sm-3 col-form-label">Nama Dosen</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama_dosen') ? 'is-invalid' : ''; ?>" value="<?= $rows['nama_dosen']; ?>" name="nama_dosen" id="nama_dosen">
                            <div class="invalid-feedback"><?= form_error('nama_dosen'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : ''; ?>" value="<?= $rows['alamat']; ?>" name="alamat" id="alamat">
                            <div class="invalid-feedback"><?= form_error('alamat'); ?></div>
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