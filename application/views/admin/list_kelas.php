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
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= isset($title) ? $title : 'Admin'; ?></li>
        </ol>
    </nav>
    <!-- Page Heading -->

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
                                    <th>ID (Kelas)</th>
                                    <th>Kelas</th>
                                    <th>Dosen</th>
                                    <th>Ruang</th>
                                    <th>Matakuliah</th>
                                    <th>Waktu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($kelas as $rows) : ?>
                                    <tr>
                                        <td><?= $rows['id_kelas']; ?></td>
                                        <td><?= $rows['nama_kelas']; ?></td>
                                        <td><?= $rows['id_dosen']; ?></td>
                                        <td><?= $rows['id_ruangan']; ?></td>
                                        <td><?= $rows['nama_matakuliah']; ?></td>
                                        <td><?= $rows['jam']; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-delete-url="<?= site_url('admin/delete_kelas/' . $rows['id_kelas']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_edit<?= $rows['id_kelas']; ?>"><i class="fas fa-edit"></i></button>
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
                <h5 class="modal-title" id="modal_tambahLabel">Add New Data Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/kelas') ?>
                <div class="form-group row">
                    <label for="id_kelas" class="col-sm-3 col-form-label">Kode Kelas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('id_kelas') ? 'is-invalid' : ''; ?>" value="<?= set_value('id_kelas'); ?>" name="id_kelas" id="id_kelas" required>
                        <div class="invalid-feedback"><?= form_error('id_kelas'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_kelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama_kelas') ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_kelas'); ?>" name="nama_kelas" id="nama_kelas">
                        <div class="invalid-feedback"><?= form_error('nama_kelas'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_dosen" class="col-sm-3 col-form-label">Kode Dosen</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" name="id_dosen" id="id_dosen">
                            <option selected disabled>Pilih Kode Dosen</option>
                            <?php
                            foreach ($dosen as $rows) : ?>
                                <option value="<?= $rows['id_dosen']; ?>"><?= $rows['id_dosen']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('jenis_kelamin'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_ruangan" class="col-sm-3 col-form-label">Ruang</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_ruangan') ? 'is-invalid' : ''; ?>" name="id_ruangan" id="id_ruangan" required>
                            <option selected disabled>Pilih ruang</option>
                            <?php
                            str_shuffle($ruangan);
                            foreach ($ruangan as $rows) :  ?>
                                <option value="<?= $rows['id_ruangan']; ?>"><?= $rows['nama_ruangan']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_ruangan'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_matakuliah" class="col-sm-3 col-form-label">Matakuliah</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_matakuliah') ? 'is-invalid' : ''; ?>" name="id_matakuliah" id="id_matakuliah">
                            <option selected disabled>Pilih Matakuliah</option>
                            <?php
                            shuffle($matakuliah);
                            foreach ($matakuliah as $rows) :  ?>
                                <option value="<?= $rows['id_matakuliah']; ?>"><?= $rows['nama_matakuliah']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_matakuliah'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="hari" class="col-sm-3 col-form-label">Hari</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('hari') ? 'is-invalid' : ''; ?>" name="hari" id="hari">
                            <option selected disabled>Pilih Hari</option>
                            <?php

                            $arr = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
                            foreach ($arr as $rows) :  ?>
                                <option value="<?= $rows; ?>"><?= $rows; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('hari'); ?></div>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="jam" class="col-sm-3 col-form-label">Jam</label>
                    <div class="col-sm-9">
                        <input type="time" class="form-control <?= form_error('jam') ? 'is-invalid' : ''; ?>" value="<?= set_value('jam'); ?>" name="jam" id="jam">
                        <div class="invalid-feedback"><?= form_error('jam'); ?></div>
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


<?php foreach ($kelas as $rows) : ?>
    <div class="modal fade" id="modal_edit<?= $rows['id_kelas']; ?>" tabindex="-1" aria-labelledby="modal_editLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_editLabel">Edit Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/update_kelas/' . $rows['id_kelas']) ?>
                    <div class="form-group row">
                        <label for="id_kelas" class="col-sm-3 col-form-label">Kode Kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('id_kelas') ? 'is-invalid' : ''; ?>" value="<?= $rows['id_kelas']; ?>" name="id_kelas" id="id_kelas" readonly>
                            <div class="invalid-feedback"><?= form_error('id_kelas'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_kelas" class="col-sm-3 col-form-label">Nama Kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama_kelas') ? 'is-invalid' : ''; ?>" value="<?= $rows['nama_kelas']; ?>" name="nama_kelas" id="nama_kelas">
                            <div class="invalid-feedback"><?= form_error('nama_kelas'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_dosen" class="col-sm-3 col-form-label">Kode Dosen</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" name="id_dosen" id="id_dosen">
                                <option selected disabled>Pilih Kode Dosen</option>
                                <?php
                                foreach ($dosen as $rows) : ?>
                                    <option value="<?= $rows['id_dosen']; ?>" <?php if ($rows['id_dosen'] == $rows['id_dosen']) echo 'selected'; ?>><?= $rows['id_dosen']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('jenis_kelamin'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_ruangan" class="col-sm-3 col-form-label">Ruang</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_ruangan') ? 'is-invalid' : ''; ?>" name="id_ruangan" id="id_ruangan" required>
                                <option selected disabled>Pilih ruang</option>
                                <?php

                                foreach ($ruangan as $rows) :  ?>
                                    <option value="<?= $rows['id_ruangan']; ?>" <?php if ($rows['id_ruangan'] == $rows['id_ruangan']) echo 'selected'; ?>><?= $rows['nama_ruangan']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_ruangan'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_matakuliah" class="col-sm-3 col-form-label">Matakuliah</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_matakuliah') ? 'is-invalid' : ''; ?>" name="id_matakuliah" id="id_matakuliah">
                                <option selected disabled>Pilih Matakuliah</option>
                                <?php

                                foreach ($matakuliah as $rows) :  ?>
                                    <option value="<?= $rows['id_matakuliah']; ?>" <?php if ($rows['id_matakuliah'] == $rows['id_matakuliah']) echo 'selected'; ?>><?= $rows['nama_matakuliah']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_matakuliah'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="hari" class="col-sm-3 col-form-label">Hari</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('hari') ? 'is-invalid' : ''; ?>" name="hari" id="hari">
                                <option selected disabled>Pilih Hari</option>
                                <?php

                                $arr = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
                                foreach ($arr as $a) :  ?>
                                    <option value="<?= $a; ?>" <?php if ($rows['hari'] == $a) echo 'selected'; ?>><?= $a; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('hari'); ?></div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="jam" class="col-sm-3 col-form-label">Jam</label>
                        <div class="col-sm-9">
                            <input type="time" class="form-control <?= form_error('jam') ? 'is-invalid' : ''; ?>" name="jam" id="jam">
                            <div class="invalid-feedback"><?= form_error('jam'); ?></div>
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