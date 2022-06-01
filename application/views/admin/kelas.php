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
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_kelas" aria-pressed="false">
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
                                    <th>Kode kelas</th>
                                    <th>Nama kelas</th>
                                    <th>Lokasi kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1;
                                foreach ($kelas as $rows) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $rows['kode_kelas']; ?></td>
                                        <td><?= $rows['nama_kelas']; ?></td>
                                        <td><?= $rows['lokasi_kelas']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('admin/kelas/delete/' . $rows['kode_kelas']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_kelas_edit<?= $rows['kode_kelas']; ?>"><i class="fas fa-edit"></i></a>
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


<div class="modal fade" id="modal_kelas" tabindex="-1" aria-labelledby="modal_kelas" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_kelas_label">Tambah Data <b> Kelas</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/kelas/add') ?>
                <div class="form-group row">
                    <label for="kode_kelas" class="col-sm-3 col-form-label">Kode kelas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('kode_kelas')); ?>" name="kode_kelas" id="kode_kelas" required>
                        <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_kelas" class="col-sm-3 col-form-label">Nama kelas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama_kelas') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('nama_kelas')); ?>" name="nama_kelas" id="nama_kelas" required>
                        <div class="invalid-feedback"><?= form_error('nama_kelas'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="lokasi_kelas" class="col-sm-3 col-form-label">Lokasi kelas</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('lokasi_kelas') ? 'is-invalid' : ''; ?>" name="lokasi_kelas" id="lokasi_kelas">
                            <option selected disabled>Pilih lokasi kelas</option>
                            <?php $location_class = ['Gedung depan', 'Gedung tengah', 'Gedung belakang', 'Gedung atas']; ?>
                            <?php shuffle($location_class); ?>
                            <?php foreach ($location_class as $lc) : ?>
                                <option value="<?= $lc; ?>"><?= $lc; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('lokasi_kelas'); ?></div>
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

<?php foreach ($kelas as $k) : ?>

    <div class="modal fade" id="modal_kelas_edit<?= $k['kode_kelas']; ?>" tabindex="-1" aria-labelledby="modal_kelas_edit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_kelas_edit_label">Edit Data <b> Kelas</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/kelas/edit/' . htmlentities($k['kode_kelas'])) ?>
                    <div class="form-group row">
                        <label for="kode_kelas" class="col-sm-3 col-form-label">Kode kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($k['kode_kelas']); ?>" name="kode_kelas" id="kode_kelas" readonly>
                            <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_kelas" class="col-sm-3 col-form-label">Nama kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama_kelas') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($k['nama_kelas']); ?>" name="nama_kelas" id="nama_kelas" required>
                            <div class="invalid-feedback"><?= form_error('nama_kelas'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi_kelas" class="col-sm-3 col-form-label">Lokasi kelas</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('lokasi_kelas') ? 'is-invalid' : ''; ?>" name="lokasi_kelas" id="lokasi_kelas">
                                <option selected disabled>Pilih lokasi kelas</option>
                                <?php $location_class = ['Gedung depan', 'Gedung tengah', 'Gedung belakang', 'Gedung atas']; ?>
                                <?php shuffle($location_class); ?>
                                <?php foreach ($location_class as $lc) : ?>
                                    <option value="<?= $lc; ?>" <?php if ($k['lokasi_kelas'] == $lc) echo 'selected'; ?>><?= $lc; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('lokasi_kelas'); ?></div>
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