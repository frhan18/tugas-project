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
            <li class="breadcrumb-item active" aria-current="page">Matakuliah</li>
        </ol>
    </nav>

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
                                <th>ID (Matakuliah)</th>
                                <th>Matakuliah</th>
                                <th>Sks</th>
                                <th>Semester</th>
                                <th>Prodi</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($matakuliah as $rows) : ?>
                                <tr>
                                    <td><?= $rows['id_matakuliah']; ?></td>
                                    <td><?= $rows['nama_matakuliah']; ?></td>
                                    <td><?= $rows['sks']; ?></td>
                                    <td><?= $rows['semester']; ?></td>
                                    <td><?= $rows['nama_prodi']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button type="button" data-delete-url="<?= site_url('admin/delete_matakuliah/' . $rows['id_matakuliah']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_update<?= $rows['id_matakuliah']; ?>"><i class="fas fa-edit"></i></button>
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
                <h5 class="modal-title" id="modal_tambahLabel">Add New Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/add_matakuliah') ?>
                <!-- <div class="form-group row">
                    <label for="id_matakuliah" class="col-sm-3 col-form-label">ID (Matakuliah)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('id_matakuliah') ? 'is-invalid' : ''; ?>" value="<?= set_value('id_matakuliah'); ?>" name="id_matakuliah" id="id_matakuliah">
                        <div class="invalid-feedback"><?= form_error('id_matakuliah'); ?></div>
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="nama_matakuliah" class="col-sm-3 col-form-label">Nama matakuliah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama_matakuliah') ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_matakuliah'); ?>" name="nama_matakuliah" id="nama_matakuliah">
                        <div class="invalid-feedback"><?= form_error('nama_matakuliah'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sks" class="col-sm-3 col-form-label">Sks</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control <?= form_error('sks') ? 'is-invalid' : ''; ?>" value="<?= set_value('sks'); ?>" name="sks" id="sks">
                        <div class="invalid-feedback"><?= form_error('sks'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control <?= form_error('semester') ? 'is-invalid' : ''; ?>" value="<?= set_value('semester'); ?>" name="semester" id="semester">
                        <div class="invalid-feedback"><?= form_error('semester'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_prodi" class="col-sm-3 col-form-label">Program Studi</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_prodi') ? 'is-invalid' : ''; ?>" name="id_prodi" id="id_prodi">
                            <option selected>Pilih</option>
                            <?php
                            $prodi = $this->db->get('prodi')->result_array();
                            shuffle($prodi);
                            foreach ($prodi as $rows) :  ?>
                                <option value="<?= $rows['id_prodi']; ?>"><?= $rows['nama_prodi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_prodi'); ?></div>
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
<?php foreach ($matakuliah as $rows) : ?>
    <div class="modal fade" id="modal_update<?= $rows['id_matakuliah']; ?>" tabindex="-1" aria-labelledby="modal_updateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_updateLabel">Update Data <strong><?= $rows['nama_matakuliah']; ?> (<?= $rows['id_matakuliah']; ?>)</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/update_matakuliah/' . $rows['id_matakuliah']) ?>
                    <div class="form-group row">
                        <label for="id_matakuliah" class="col-sm-3 col-form-label">ID (Matakuliah)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('id_matakuliah') ? 'is-invalid' : ''; ?>" value="<?= $rows['id_matakuliah']; ?>" name="id_matakuliah" id="id_matakuliah" readonly>
                            <div class="invalid-feedback"><?= form_error('id_matakuliah'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_matakuliah" class="col-sm-3 col-form-label">Nama matakuliah</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama_matakuliah') ? 'is-invalid' : ''; ?>" value="<?= $rows['nama_matakuliah']; ?>" name="nama_matakuliah" id="nama_matakuliah">
                            <div class="invalid-feedback"><?= form_error('nama_matakuliah'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sks" class="col-sm-3 col-form-label">Sks</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control <?= form_error('sks') ? 'is-invalid' : ''; ?>" value="<?= $rows['sks']; ?>" name="sks" id="sks">
                            <div class="invalid-feedback"><?= form_error('sks'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester" class="col-sm-3 col-form-label">Semester</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control <?= form_error('semester') ? 'is-invalid' : ''; ?>" value="<?= $rows['semester']; ?>" name="semester" id="semester">
                            <div class="invalid-feedback"><?= form_error('semester'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_prodi" class="col-sm-3 col-form-label">Program Studi</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_prodi') ? 'is-invalid' : ''; ?>" name="id_prodi" id="id_prodi">
                                <option selected>Pilih</option>
                                <?php
                                shuffle($prodi);
                                foreach ($prodi as $p) :  ?>
                                    <option value="<?= $p['id_prodi']; ?>" <?php if ($rows['id_prodi'] == $p['id_prodi']) echo 'selected'; ?>><?= $p['nama_prodi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_prodi'); ?></div>
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