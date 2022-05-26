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
            <li class="breadcrumb-item active" aria-current="page">Prodi</li>
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
                                <th>ID (Prodi)</th>
                                <th>Prodi</th>
                                <th>Akreditasi</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($prodi as $rows) : ?>
                                <tr>
                                    <td><?= $rows['id_prodi']; ?></td>
                                    <td><?= $rows['nama_prodi']; ?></td>
                                    <td><?= $rows['akreditasi']; ?></td>
                                    <td><?= $rows['tahun']; ?></td>
                                    <td><?= $rows['is_active'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" data-delete-url="<?= site_url('admin/delete_prodi/' . $rows['id_prodi']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_update<?= $rows['id_prodi']; ?>"><i class="fas fa-edit"></i></button>
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
                <?= form_open('admin/add_prodi') ?>
                <div class="form-group row">
                    <label for="id_prodi" class="col-sm-3 col-form-label">ID (Prodi)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('id_prodi') ? 'is-invalid' : ''; ?>" value="<?= set_value('id_prodi'); ?>" name="id_prodi" id="id_prodi" placeholder="IKOM">
                        <div class="invalid-feedback"><?= form_error('id_prodi'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_prodi" class="col-sm-3 col-form-label">Nama prodi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama_prodi') ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_prodi'); ?>" name="nama_prodi" id="nama_prodi" placeholder="Ilmu komputer">
                        <div class="invalid-feedback"><?= form_error('nama_prodi'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="akreditasi" class="col-sm-3 col-form-label">Akreditasi</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select  <?= form_error('akreditasi') ? 'is-invalid' : ''; ?>" name="akreditasi" id="akreditasi">
                            <option selected>Pilih</option>
                            <?php
                            $akreditasi = ['A', 'B', 'C', 'D'];
                            foreach ($akreditasi as $rows) : ?>
                                <option value="<?= $rows; ?>"><?= $rows; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('akreditasi'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-3 col-form-label">Tahun Aktif</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control <?= form_error('tahun') ? 'is-invalid' : ''; ?>" value="<?= set_value('tahun'); ?>" name="tahun" id="tahun">
                        <div class="invalid-feedback"><?= form_error('tahun'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-3 col-form-label">Status Prodi</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Aktifkan / nonaktifkan prodi?
                            </label>
                        </div>
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
<?php foreach ($prodi as $rows) : ?>
    <div class="modal fade" id="modal_update<?= $rows['id_prodi']; ?>" tabindex="-1" aria-labelledby="modal_updateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_updateLabel">Update Data Prodi <strong>(<?= $rows['nama_prodi']; ?>)</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/update_prodi/' . $rows['id_prodi']) ?>
                    <div class="form-group row">
                        <label for="id_prodi" class="col-sm-3 col-form-label">ID (Prodi)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('id_prodi') ? 'is-invalid' : ''; ?>" value="<?= $rows['id_prodi']; ?>" name="id_prodi" id="id_prodi" readonly>
                            <div class="invalid-feedback"><?= form_error('id_prodi'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_prodi" class="col-sm-3 col-form-label">Nama prodi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama_prodi') ? 'is-invalid' : ''; ?>" value="<?= $rows['nama_prodi']; ?>" name="nama_prodi" id="nama_prodi">
                            <div class="invalid-feedback"><?= form_error('nama_mhs'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="akreditasi" class="col-sm-3 col-form-label">Akreditasi</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select  <?= form_error('akreditasi') ? 'is-invalid' : ''; ?>" name="akreditasi" id="akreditasi">
                                <option selected>Pilih</option>
                                <?php
                                $akreditasi = ['A', 'B', 'C', 'D'];
                                foreach ($akreditasi as $ak) : ?>
                                    <option value="<?= $ak; ?>" <?php if ($rows['akreditasi'] == $ak)  echo 'selected'; ?>><?= $ak; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('akreditasi'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-3 col-form-label">Tahun Aktif</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control <?= form_error('tahun') ? 'is-invalid' : ''; ?>" value="<?= $rows['tahun']; ?>" name="tahun" id="tahun">
                            <div class="invalid-feedback"><?= form_error('tahun'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-3 col-form-label">Status Prodi</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" <?php if ($rows['is_active'] == 1) echo 'checked'; ?> id="is_active">
                                <label class="form-check-label" for="is_active">
                                    Aktifkan / nonaktifkan prodi?
                                </label>
                            </div>
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