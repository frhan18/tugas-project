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
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_perkuliahan" aria-pressed="false">
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
                                    <th>Dosen</th>
                                    <th>Nim</th>
                                    <th>Kelas</th>
                                    <th>Matakuliah</th>
                                    <th>Waktu_mulai</th>
                                    <th>waktu_selesai</th>
                                    <th>Hari</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                $no = 1;
                                foreach ($perkuliahan as $kuliah) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $kuliah['nama']; ?></td>
                                        <td><?= $kuliah['nim']; ?></td>
                                        <td><?= $kuliah['kode_kelas']; ?></td>
                                        <td><?= $kuliah['nama_mata_kuliah']; ?></td>
                                        <td><?= $kuliah['waktu_mulai']; ?></td>
                                        <td><?= $kuliah['waktu_selesai']; ?></td>
                                        <td><?= $kuliah['hari']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('/perkuliahan/delete/' . htmlentities($kuliah['id'])); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_edit_perkuliahan<?= $kuliah['id']; ?>"><i class="fas fa-edit"></i></a>
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


<div class="modal fade" id="modal_perkuliahan" tabindex="-1" aria-labelledby="modal_perkuliahanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_perkuliahanLabel">Tambah data <b> Perkuliahan</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('perkuliahan/add') ?>
                <div class="form-group row">
                    <label for="id_dosen" class="col-sm-3 col-form-label">Dosen</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" name="id_dosen" id="id_dosen" required>
                            <option selected disabled value="">Pilih dosen</option>
                            <?php
                            foreach ($kode_dosen as $kdsn) : ?>
                                <option value="<?= $kdsn['id_dosen']; ?>"><?= $kdsn['nama']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_dosen'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nim" class="col-sm-3 col-form-label"> Nim</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('nim') ? 'is-invalid' : ''; ?>" name="nim" id="nim" required>
                            <option selected disabled value="">Pilih nim</option>
                            <?php
                            foreach ($kode_nim as $km) : ?>
                                <option value="<?= $km['nim']; ?>"><?= $km['nim']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_mata_kuliah" class="col-sm-3 col-form-label">Matakuliah</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_mata_kuliah') ? 'is-invalid' : ''; ?>" name="id_mata_kuliah" id="id_mata_kuliah" required>
                            <option selected disabled value="">Pilih matakuliah</option>
                            <?php
                            foreach ($kode_matakuliah as $kdmk) : ?>
                                <option value="<?= $kdmk['id_mata_kuliah']; ?>"><?= $kdmk['nama_mata_kuliah']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_mata_kuliah'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_kelas" class="col-sm-3 col-form-label">Kelas</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" name="kode_kelas" id="kode_kelas" required>
                            <option selected disabled value="">Pilih kelas</option>
                            <?php
                            foreach ($kode_kelas as $ks) : ?>
                                <option value="<?= $ks['kode_kelas']; ?>"><?= $ks['kode_kelas']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="waktu_mulai" class="col-sm-3 col-form-label">Waktu mulai</label>
                    <div class="col-sm-9">
                        <input type="time" class="form-control <?= form_error('waktu_mulai') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('waktu_mulai')); ?>" name="waktu_mulai" id="waktu_mulai" required>
                        <div class="invalid-feedback"><?= form_error('waktu_mulai'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="waktu_selesai" class="col-sm-3 col-form-label">Waktu selesai</label>
                    <div class="col-sm-9">
                        <input type="time" class="form-control <?= form_error('waktu_selesai') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('waktu_selesai')); ?>" name="waktu_selesai" id="waktu_selesai" required>
                        <div class="invalid-feedback"><?= form_error('waktu_selesai'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hari" class="col-sm-3 col-form-label"> Hari</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('hari') ? 'is-invalid' : ''; ?>" name="hari" id="hari" required>
                            <option selected disabled value="">Pilih hari</option>
                            <?php
                            $hari_arry = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
                            foreach ($hari_arry as $hri) : ?>
                                <option value="<?= $hri; ?>"><?= $hri; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('hari'); ?></div>
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


<?php foreach ($perkuliahan as $kuliah) : ?>
    <div class="modal fade" id="modal_edit_perkuliahan<?= $kuliah['id']; ?>" tabindex="-1" aria-labelledby="modal_edit_perkuliahanLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_edit_perkuliahanLabel">Edit data <b> Perkuliahan</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('perkuliahan/edit/' . htmlentities($kuliah['id'])) ?>
                    <div class="form-group row">
                        <label for="id_dosen" class="col-sm-3 col-form-label">Dosen</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" name="id_dosen" id="id_dosen" required>
                                <option selected disabled value="">Pilih dosen</option>
                                <?php
                                foreach ($kode_dosen as $kdsn) : ?>
                                    <option value="<?= $kdsn['id_dosen']; ?>" <?php if ($kuliah['id_dosen'] == $kdsn['id_dosen']) echo 'selected'; ?>><?= $kdsn['id_dosen']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_dosen'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label"> Nim</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('nim') ? 'is-invalid' : ''; ?>" name="nim" id="nim" required>
                                <option selected disabled value="">Pilih nim</option>
                                <?php
                                foreach ($kode_nim as $km) : ?>
                                    <option value="<?= $km['nim']; ?>" <?php if ($kuliah['nim'] == $km['nim']) echo 'selected'; ?>><?= $km['nim']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_mata_kuliah" class="col-sm-3 col-form-label"> Kode matakuliah</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_mata_kuliah') ? 'is-invalid' : ''; ?>" name="id_mata_kuliah" id="id_mata_kuliah" required>
                                <option selected disabled value="">Pilih kode matakuliah</option>
                                <?php
                                foreach ($kode_matakuliah as $kdmk) : ?>
                                    <option value="<?= $kdmk['id_mata_kuliah']; ?>" <?php if ($kuliah['id_mata_kuliah'] == $kdmk['id_mata_kuliah']) echo 'selected'; ?>><?= $kdmk['id_mata_kuliah']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_mata_kuliah'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_kelas" class="col-sm-3 col-form-label"> Kode kelas</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" name="kode_kelas" id="kode_kelas" required>
                                <option selected disabled value="">Pilih kode kelas</option>
                                <?php
                                foreach ($kode_kelas as $ks) : ?>
                                    <option value="<?= $ks['kode_kelas']; ?>" <?php if ($kuliah['kode_kelas'] == $ks['kode_kelas']) echo 'selected'; ?>><?= $ks['kode_kelas']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="waktu_mulai" class="col-sm-3 col-form-label">Waktu mulai</label>
                        <div class="col-sm-9">
                            <input type="time" class="form-control <?= form_error('waktu_mulai') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($kuliah['waktu_mulai']); ?>" name="waktu_mulai" id="waktu_mulai" required>
                            <div class="invalid-feedback"><?= form_error('waktu_mulai'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="waktu_selesai" class="col-sm-3 col-form-label">Waktu selesai</label>
                        <div class="col-sm-9">
                            <input type="time" class="form-control <?= form_error('waktu_selesai') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($kuliah['waktu_selesai']); ?>" name="waktu_selesai" id="waktu_selesai" required>
                            <div class="invalid-feedback"><?= form_error('waktu_selesai'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hari" class="col-sm-3 col-form-label"> Hari</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('hari') ? 'is-invalid' : ''; ?>" name="hari" id="hari" required>
                                <option selected disabled value="">Pilih hari</option>
                                <?php
                                $hari_arry = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
                                foreach ($hari_arry as $hri) : ?>
                                    <option value="<?= $hri; ?>" <?php if ($kuliah['hari'] == $hri) echo 'selected'; ?>><?= $hri; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('hari'); ?></div>
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