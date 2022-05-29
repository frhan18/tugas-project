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
            <li class="breadcrumb-item active" aria-current="page"><?= isset($title) ? $title : 'Admin'; ?></li>
        </ol>
    </nav>

    <div class="box">
        <div class="add-modal-btn mb-3">
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_tambah" aria-pressed="false">
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
                                    <th>Kode dosen</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Kode matakuliah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($dosen as $rows) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $rows['id_dosen']; ?></td>
                                        <td><?= $rows['nama']; ?></td>
                                        <td><?= $rows['email']; ?></td>
                                        <td><?= $rows['id_mata_kuliah']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('admin/dosen/delete/' . htmlentities($rows['id_dosen'])); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#edit_dosen<?= $rows['id_dosen']; ?>"><i class="fas fa-edit"></i></a>
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


<div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="modal_tambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_tambahLabel">Tambah data <b> Dosen</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/dosen/add') ?>
                <div class="form-group row">
                    <label for="id_dosen" class="col-sm-3 col-form-label">Kode Dosen</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('id_dosen')); ?>" name="id_dosen" id="id_dosen">
                        <div class="invalid-feedback"><?= form_error('id_dosen'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama dosen</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('nama')); ?>" name="nama" id="nama">
                        <div class="invalid-feedback"><?= form_error('nama'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('email')); ?>" name="email" id="email">
                        <div class="invalid-feedback"><?= form_error('email'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_matakuliah" class="col-sm-3 col-form-label"> Matakuliah</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_matakuliah') ? 'is-invalid' : ''; ?>" name="id_matakuliah" id="id_matakuliah">
                            <option selected disabled>Pilih matakuliah</option>
                            <?php
                            foreach ($matakuliah as $mk) : ?>
                                <option value="<?= $mk['id_mata_kuliah']; ?>"><?= $mk['nama_mata_kuliah']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_matakuliah'); ?></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Save </button>
                </div>

                <?= form_close(); ?>

            </div>

        </div>
    </div>
</div>



<?php foreach ($dosen as $dsn) : ?>
    <div class="modal fade" id="edit_dosen<?= $dsn['id_dosen']; ?>" tabindex="-1" aria-labelledby="edit_dosenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_dosenLabel">Edit Data <b> Dosen</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/dosen/edit/' . htmlentities($dsn['id_dosen'])); ?>
                    <div class="form-group row">
                        <label for="id_dosen" class="col-sm-3 col-form-label">Kode Dosen</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" value="<?= $dsn['id_dosen']; ?>" name="id_dosen" id="id_dosen" readonly>
                            <div class="invalid-feedback"><?= form_error('id_dosen'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama dosen</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= $dsn['nama']; ?>" name="nama" id="nama">
                            <div class="invalid-feedback"><?= form_error('nama'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" value="<?= $dsn['email']; ?>" name="email" id="email">
                            <div class="invalid-feedback"><?= form_error('email'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_matakuliah" class="col-sm-3 col-form-label"> Matakuliah</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_matakuliah') ? 'is-invalid' : ''; ?>" name="id_matakuliah" id="id_matakuliah">
                                <option selected disabled>Pilih matakuliah</option>
                                <?php
                                foreach ($matakuliah as $mk) : ?>
                                    <option value="<?= $mk['id_mata_kuliah']; ?>" <?php if ($dsn['id_mata_kuliah'] == $mk['id_mata_kuliah']) echo 'selected'; ?>><?= $mk['nama_mata_kuliah']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_matakuliah'); ?></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> Update </button>
                    </div>

                    <?= form_close(); ?>

                </div>

            </div>
        </div>
    </div>
<?php endforeach; ?>