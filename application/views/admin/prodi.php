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
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_prodi_add" aria-pressed="false">
                <i class="fas fa-plus"></i> Tambah Data Baru
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
                                    <th>Kode prodi</th>
                                    <th>Nama prodi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1;
                                foreach ($prodi as $rows) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $rows['kode_prodi']; ?></td>
                                        <td><?= $rows['nama_prodi']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('prodi/delete/' . $rows['kode_prodi']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_prodi_edit<?= $rows['kode_prodi']; ?>"><i class="fas fa-edit"></i></a>
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


<div class="modal fade" id="modal_prodi_add" tabindex="-1" aria-labelledby="modal_prodi_addLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title " id="modal_prodi_addLabel">Tambah Data <b> Prodi</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('prodi/add') ?>
                <div class="form-group row">
                    <label for="kode_prodi" class="col-sm-3 col-form-label">Kode prodi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('kode_prodi') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('kode_prodi')); ?>" name="kode_prodi" id="kode_prodi" required>
                        <div class="invalid-feedback"><?= form_error('kode_prodi'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_prodi" class="col-sm-3 col-form-label">Nama prodi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama_prodi') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('nama_prodi')); ?>" name="nama_prodi" id="nama_prodi" required>
                        <div class="invalid-feedback"><?= form_error('nama_prodi'); ?></div>
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


<?php foreach ($prodi as $rows) : ?>

    <div class="modal fade" id="modal_prodi_edit<?= $rows['kode_prodi']; ?>" tabindex="-1" aria-labelledby="modal_prodi_editLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="modal_prodi_editLabel">Edit Data <b> Prodi</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('prodi/edit/' . $rows['kode_prodi']) ?>
                    <div class="form-group row">
                        <label for="kode_prodi" class="col-sm-3 col-form-label">Kode prodi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('kode_prodi') ? 'is-invalid' : ''; ?>" value="<?= $rows['kode_prodi']; ?>" name="kode_prodi" id="kode_prodi" readonly>
                            <div class="invalid-feedback"><?= form_error('kode_prodi'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_prodi" class="col-sm-3 col-form-label">Nama prodi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama_prodi') ? 'is-invalid' : ''; ?>" value="<?= $rows['nama_prodi']; ?>" name="nama_prodi" id="nama_prodi" required>
                            <div class="invalid-feedback"><?= form_error('nama_prodi'); ?></div>
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