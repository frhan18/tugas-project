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
    <div class="box">
        <div class="krs-info mb-3">
            <h3 class="h3 mb-2 text-dark">Data KRS</h3>
            <p class="text-dark">Halo <?= $get_sesi_user['name']; ?>, Jumlah data krs saat ini tersedia <strong><?= $count_tb_krs; ?></strong> data.</p>
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_krs" aria-pressed="false">
                <i class="fas fa-plus"></i> Tambah Data KRS
            </button>
        </div>

        <hr class="sidebar-divider">
        <div class="list-content">
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nim</th>
                                    <th>Kode Mk</th>
                                    <th>Kode Prodi</th>
                                    <th>Kode Kelas</th>
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
                                        <td style="vertical-align: middle;"><?= $no++; ?></td>
                                        <td style="vertical-align: middle;"><?= $kr['nim']; ?></td>
                                        <td style="vertical-align: middle;"><?= $kr['id_mata_kuliah']; ?></td>
                                        <td style="vertical-align: middle;"><?= $kr['kode_prodi']; ?></td>
                                        <td style="vertical-align: middle;"><?= $kr['kode_kelas']; ?></td>
                                        <td style="vertical-align: middle;"><?= $kr['sks']; ?></td>
                                        <td style="vertical-align: middle;"><?= $kr['tahun']; ?></td>
                                        <td style="vertical-align: middle;"><?= $kr['semester']; ?></td>
                                        <td style="vertical-align: middle;">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('data-krs/delete/' . htmlentities($kr['id'])); ?>" onclick="deleteConfirm(this)" class="btn btn-danger "><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning  ml-1" data-toggle="modal" data-target="#modal_edit_krs<?= $kr['id']; ?>"><i class="fas fa-edit"></i></a>

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


<div class="modal fade" id="modal_krs" tabindex="-1" aria-labelledby="modal_krs" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_krs_label">Tambah Data <b> Krs</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('data-krs/add') ?>
                <div class="form-group row">
                    <label for="id_mata_kuliah" class="col-sm-3 col-form-label">Matakuliah</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_mata_kuliah') ? 'is-invalid' : ''; ?>" name="id_mata_kuliah" id="id_mata_kuliah" required>
                            <option selected disabled value="">Pilih matakuliah</option>
                            <?php foreach ($matakuliah as $mk) : ?>
                                <option value="<?= $mk['id_mata_kuliah']; ?>"><?= $mk['nama_mata_kuliah']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_mata_kuliah'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_prodi" class="col-sm-3 col-form-label">Prodi</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('kode_prodi') ? 'is-invalid' : ''; ?>" name="kode_prodi" id="kode_prodi" required>
                            <option selected disabled value="">Pilih prodi</option>
                            <?php foreach ($prodi as $pd) : ?>
                                <option value="<?= $pd['kode_prodi']; ?>"><?= $pd['nama_prodi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('kode_prodi'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_kelas" class="col-sm-3 col-form-label">Kelas</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" name="kode_kelas" id="kode_kelas">
                            <option selected disabled value="">Pilih kelas</option>
                            <?php foreach ($kelas as $ks) : ?>
                                <option value="<?= $ks['kode_kelas']; ?>"><?= $ks['kode_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sks" class="col-sm-3 col-form-label">Sks</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('sks') ? 'is-invalid' : ''; ?>" name="sks" id="sks">
                            <option selected disabled value="">Pilih sks </option>
                            <?php $sks = [1, 2, 3, 4]; ?>
                            <?php foreach ($sks as $s) : ?>
                                <option value="<?= $s; ?>"><?= $s; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('sks'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun" class="col-sm-3 col-form-label">Tahun ajar </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('tahun') ? 'is-invalid' : ''; ?>" value="<?= set_value('tahun'); ?>" name="tahun" id="tahun" placeholder="Contoh 2019 / 2020" required>
                        <div class=" invalid-feedback"><?= form_error('tahun'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="semester" class="col-sm-3 col-form-label">Semester </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('semester') ? 'is-invalid' : ''; ?>" value="<?= set_value('semester'); ?>" name="semester" id="semester" placeholder="" required>
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
                    <?= form_open('data-krs/edit/' . htmlentities($rows['id'])) ?>
                    <div class="form-group row">
                        <label for="id_mata_kuliah" class="col-sm-3 col-form-label">Matakuliah</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_mata_kuliah') ? 'is-invalid' : ''; ?>" name="id_mata_kuliah" id="id_mata_kuliah" required>
                                <option selected disabled value="">Pilih matakuliah</option>
                                <?php foreach ($matakuliah as $mk) : ?>
                                    <option value="<?= $mk['id_mata_kuliah']; ?>" <?php if ($rows['id_mata_kuliah'] == $mk['id_mata_kuliah']) echo 'selected'; ?>><?= $mk['nama_mata_kuliah']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_mata_kuliah'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_prodi" class="col-sm-3 col-form-label">Prodi</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('kode_prodi') ? 'is-invalid' : ''; ?>" name="kode_prodi" id="kode_prodi" required>
                                <option selected disabled value="">Pilih prodi</option>
                                <?php foreach ($prodi as $pd) : ?>
                                    <option value="<?= $pd['kode_prodi']; ?>" <?php if ($rows['kode_prodi'] == $pd['kode_prodi']) echo 'selected'; ?>><?= $pd['nama_prodi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('kode_prodi'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_kelas" class="col-sm-3 col-form-label">kelas</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" name="kode_kelas" id="kode_kelas" required>
                                <option selected disabled value="">Pilih kelas</option>
                                <?php foreach ($kelas as $ks) : ?>
                                    <option value="<?= $ks['kode_kelas']; ?>" <?php if ($rows['kode_kelas'] == $ks['kode_kelas']) echo 'selected'; ?>><?= $ks['kode_kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sks" class="col-sm-3 col-form-label">Sks</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('sks') ? 'is-invalid' : ''; ?>" name="sks" id="sks" required>
                                <option selected disabled value="">Pilih sks </option>
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
                            <input type="text" class="form-control <?= form_error('tahun') ? 'is-invalid' : ''; ?>" value="<?= $rows['tahun']; ?>" name="tahun" id="tahun" placeholder="2019/2020" required>
                            <div class=" invalid-feedback"><?= form_error('tahun'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester" class="col-sm-3 col-form-label">Semester </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('semester') ? 'is-invalid' : ''; ?>" value="<?= $rows['semester']; ?>" name="semester" id="semester" placeholder="" required>
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