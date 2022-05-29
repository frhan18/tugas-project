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
                                    <th>Kode matakuliah</th>
                                    <th>Kode Kelas</th>
                                    <th>Nim</th>
                                    <th>Sks</th>
                                    <th>Tahun</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1;
                                foreach ($krs as $kr) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $kr['id_mata_kuliah']; ?></td>
                                        <td><?= $kr['kode_kelas']; ?></td>
                                        <td><?= $kr['nim']; ?></td>
                                        <td><?= $kr['sks']; ?></td>
                                        <td><?= $kr['tahun']; ?></td>
                                        <td><?= $kr['semester']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('admin/krs/delete/' . htmlentities($kr['id'])); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_edit_krs<?= $kr['id']; ?>"><i class="fas fa-edit"></i></a>
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
                <h5 class="modal-title" id="modal_kelas_label">Tambah Data <b> Krs</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/krs/add') ?>
                <div class="form-group row">
                    <label for="id_mata_kuliah" class="col-sm-3 col-form-label">Kode matakuliah</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_mata_kuliah') ? 'is-invalid' : ''; ?>" name="id_mata_kuliah" id="id_mata_kuliah">
                            <option selected disabled>Pilih Kode matakuliah</option>
                            <?php foreach ($matakuliah as $mk) : ?>
                                <option value="<?= $mk['id_mata_kuliah']; ?>"><?= $mk['id_mata_kuliah']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_mata_kuliah'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_kelas" class="col-sm-3 col-form-label">Kode kelas</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" name="kode_kelas" id="kode_kelas">
                            <option selected disabled>Pilih Kode kelas</option>
                            <?php foreach ($kelas as $ks) : ?>
                                <option value="<?= $ks['kode_kelas']; ?>"><?= $ks['kode_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nim" class="col-sm-3 col-form-label">Nim</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('nim') ? 'is-invalid' : ''; ?>" name="nim" id="nim">
                            <option selected disabled>Pilih Nim</option>
                            <?php foreach ($mahasiswa as $mhs) : ?>
                                <option value="<?= $mhs['nim']; ?>"><?= $mhs['nim']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sks" class="col-sm-3 col-form-label">Sks</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('sks') ? 'is-invalid' : ''; ?>" name="sks" id="sks">
                            <option selected disabled>Pilih sks </option>
                            <?php foreach ($sks as $s) : ?>
                                <option value="<?= $s; ?>"><?= $s; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('sks'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-3 col-form-label">Tahun </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('tahun') ? 'is-invalid' : ''; ?>" value="<?= set_value('tahun'); ?>" name="tahun" id="tahun" placeholder="2019/2020">
                        <div class=" invalid-feedback"><?= form_error('tahun'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="semester" class="col-sm-3 col-form-label">Semester </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('semester') ? 'is-invalid' : ''; ?>" value="<?= set_value('semester'); ?>" name="semester" id="semester" placeholder="">
                        <div class=" invalid-feedback"><?= form_error('semester'); ?>
                        </div>
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


<?php foreach ($krs as $rows) : ?>

    <div class="modal fade" id="modal_edit_krs<?= $rows['id']; ?>" tabindex="-1" aria-labelledby="modal_edit_krs" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_edit_krs_label">Edit Data <b> Krs</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/krs/edit/' . htmlentities($rows['id'])) ?>
                    <div class="form-group row">
                        <label for="id_mata_kuliah" class="col-sm-3 col-form-label">Kode matakuliah</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_mata_kuliah') ? 'is-invalid' : ''; ?>" name="id_mata_kuliah" id="id_mata_kuliah">
                                <option selected disabled>Pilih Kode matakuliah</option>
                                <?php foreach ($matakuliah as $mk) : ?>
                                    <option value="<?= $mk['id_mata_kuliah']; ?>" <?php if ($rows['id_mata_kuliah'] == $mk['id_mata_kuliah']) echo 'selected'; ?>><?= $mk['id_mata_kuliah']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_mata_kuliah'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_kelas" class="col-sm-3 col-form-label">Kode kelas</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" name="kode_kelas" id="kode_kelas">
                                <option selected disabled>Pilih Kode kelas</option>
                                <?php foreach ($kelas as $ks) : ?>
                                    <option value="<?= $ks['kode_kelas']; ?>" <?php if ($rows['kode_kelas'] == $ks['kode_kelas']) echo 'selected'; ?>><?= $ks['kode_kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label">Nim</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('nim') ? 'is-invalid' : ''; ?>" name="nim" id="nim">
                                <option selected disabled>Pilih Nim</option>
                                <?php foreach ($mahasiswa as $mhs) : ?>
                                    <option value="<?= $mhs['nim']; ?>" <?php if ($rows['nim'] == $mhs['nim']) echo 'selected'; ?>><?= $mhs['nim']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sks" class="col-sm-3 col-form-label">Sks</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('sks') ? 'is-invalid' : ''; ?>" name="sks" id="sks">
                                <option selected disabled>Pilih sks </option>
                                <?php foreach ($sks as $s) : ?>
                                    <option value="<?= $s; ?>" <?php if ($rows['sks'] == $s) echo 'selected'; ?>><?= $s; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('sks'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-3 col-form-label">Tahun </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('tahun') ? 'is-invalid' : ''; ?>" value="<?= $rows['tahun']; ?>" name="tahun" id="tahun" placeholder="2019/2020">
                            <div class=" invalid-feedback"><?= form_error('tahun'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester" class="col-sm-3 col-form-label">Semester </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('semester') ? 'is-invalid' : ''; ?>" value="<?= $rows['semester']; ?>" name="semester" id="semester" placeholder="">
                            <div class=" invalid-feedback"><?= form_error('semester'); ?>
                            </div>
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