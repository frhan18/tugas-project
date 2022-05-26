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
            <li class="breadcrumb-item active" aria-current="page">Mahasiswa</li>
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
                                <th>ID (Ruang)</th>
                                <th>Nama Ruang</th>
                                <th>Kapasitas</th>
                                <th>Nama Gedung</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($ruang as $rows) : ?>
                                <tr>
                                    <td><?= $rows['id_ruangan']; ?></td>
                                    <td><?= $rows['nama_ruangan']; ?></td>
                                    <td><?= $rows['kapasitas']; ?></td>
                                    <td><?= $rows['nama_gedung']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" data-delete-url="<?= site_url('admin-ruang/delete/' . $rows['id_ruangan']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_update<?= $rows['id_ruangan']; ?>"><i class="fas fa-edit"></i></button>
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
                <?= form_open('admin-ruang/insert') ?>
                <div class="form-group row">
                    <label for="id_ruangan" class="col-sm-3 col-form-label">ID (Ruang)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('id_ruangan') ? 'is-invalid' : ''; ?>" value="<?= set_value('id_ruangan'); ?>" name="id_ruangan" id="id_ruangan">
                        <div class="invalid-feedback"><?= form_error('id_ruangan'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_ruangan" class="col-sm-3 col-form-label">Nama ruang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama_ruangan') ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_ruangan'); ?>" name="nama_ruangan" id="nama_ruangan">
                        <div class="invalid-feedback"><?= form_error('nama_ruangan'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kapasitas" class="col-sm-3 col-form-label">Kapasitas</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control <?= form_error('kapasitas') ? 'is-invalid' : ''; ?>" value="<?= set_value('kapasitas'); ?>" name="kapasitas" id="kapasitas">
                        <div class="invalid-feedback"><?= form_error('kapasitas'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_gedung" class="col-sm-3 col-form-label">Nama Gedung</label>
                    <div class="col-sm-9">
                        <!-- <input type="text" class="form-control <?= form_error('nama_gedung') ? 'is-invalid' : ''; ?>" value="<?= $rows['nama_gedung']; ?>" name="nama_gedung" id="nama_gedung"> -->
                        <?php $gedung_name = ['Gedung utama', 'Gedung kedua', 'Gedung ketiga']; ?>
                        <select class="custom-select">
                            <option selected>Pilih Gedung</option>
                            <?php foreach ($gedung_name as $gd) : ?>
                                <option value="<?= $gd; ?>"><?= $gd; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('nama_gedung'); ?></div>
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


<!-- Modal upadte -->
<?php foreach ($ruang as $rows) : ?>
    <div class="modal fade" id="modal_update<?= $rows['id_ruangan']; ?>" tabindex="-1" aria-labelledby="modal_updateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_updateLabel">Add New Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin-ruang/update/' . $rows['id_ruangan']) ?>
                    <div class="form-group row">
                        <label for="id_ruangan" class="col-sm-3 col-form-label">ID (Ruang)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('id_ruangan') ? 'is-invalid' : ''; ?>" value="<?= $rows['id_ruangan']; ?>" name="id_ruangan" id="id_ruangan" readonly>
                            <div class="invalid-feedback"><?= form_error('id_ruangan'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_ruangan" class="col-sm-3 col-form-label">Nama ruang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama_ruangan') ? 'is-invalid' : ''; ?>" value="<?= $rows['nama_ruangan']; ?>" name="nama_ruangan" id="nama_ruangan">
                            <div class="invalid-feedback"><?= form_error('nama_ruangan'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kapasitas" class="col-sm-3 col-form-label">Kapasitas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('kapasitas') ? 'is-invalid' : ''; ?>" value="<?= $rows['kapasitas']; ?>" name="kapasitas" id="kapasitas">
                            <div class="invalid-feedback"><?= form_error('kapasitas'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_gedung" class="col-sm-3 col-form-label">Nama Gedung</label>
                        <div class="col-sm-9">
                            <!-- <input type="text" class="form-control <?= form_error('nama_gedung') ? 'is-invalid' : ''; ?>" value="<?= $rows['nama_gedung']; ?>" name="nama_gedung" id="nama_gedung"> -->
                            <?php $gedung_name = ['Gedung utama', 'Gedung kedua', 'Gedung ketiga']; ?>
                            <select class="custom-select" name="nama_gedung">
                                <option selected>Pilih Gedung</option>
                                <?php foreach ($gedung_name as $gd) : ?>
                                    <option value="<?= $gd; ?>" <?php if ($rows['nama_gedung'] == $gd) echo 'selected'; ?>><?= $gd; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('nama_gedung'); ?></div>
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