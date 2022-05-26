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
            <li class="breadcrumb-item active" aria-current="page">Kelas</li>
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
                                    <td><?= $rows['id_matakuliah']; ?></td>
                                    <td><?= $rows['hari'] . ', ' . $rows['jam']; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" data-delete-url="<?= site_url('admin-kelas/delete/' . $rows['id_kelas']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_update<?= $rows['id_kelas']; ?>"><i class="fas fa-edit"></i></button>
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
                <?= form_open('admin-kelas/insert') ?>
                <div class="form-group row">
                    <label for="id_kelas" class="col-sm-3 col-form-label">ID (Kelas)</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('id_kelas') ? 'is-invalid' : ''; ?>" value="<?= set_value('id_kelas'); ?>" name="id_kelas" id="id_kelas">
                        <div class="invalid-feedback"><?= form_error('id_kelas'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_kelas" class="col-sm-3 col-form-label">Kelas</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('nama_kelas') ? 'is-invalid' : ''; ?>" name="nama_kelas" id="nama_kelas">
                            <?php $kelas = ['Kelas mawar', 'Kelas bunga', 'Kelas melati']; ?>
                            <option selected>Pilih kelas</option>
                            <?php foreach ($kelas as $ks) : ?>
                                <option value="<?= $ks; ?>"><?= $ks; ?></option>
                            <?php endforeach; ?>
                            <div class="invalid-feedback"><?= form_error('nama_kelas'); ?></div>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_dosen" class="col-sm-3 col-form-label">Dosen</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" name="id_dosen" id="id_dosen">
                            <?php $dosen = $this->db->get('dosen')->result_array(); ?>
                            <option selected>Pilih dosen</option>
                            <?php foreach ($dosen as $dsn) : ?>
                                <option value="<?= $dsn['id_dosen']; ?>"><?= $dsn['nama_dosen']; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback"><?= form_error('id_dosen'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_ruangan" class="col-sm-3 col-form-label">Ruang</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_ruangan') ? 'is-invalid' : ''; ?>" name="id_ruangan" id="id_ruangan">
                            <?php $ruang = $this->db->get('ruangan')->result_array(); ?>
                            <option selected>Pilih ruangan</option>
                            <?php foreach ($ruang as $rg) : ?>
                                <option value="<?= $rg['id_ruangan']; ?>"><?= $rg['nama_ruangan']; ?></option>
                            <?php endforeach; ?>
                            <div class="invalid-feedback"><?= form_error('id_ruangan'); ?></div>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="id_matakuliah" class="col-sm-3 col-form-label">Matakuliah</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_matakuliah') ? 'is-invalid' : ''; ?>" name="id_matakuliah" id="id_matakuliah">
                            <option selected>Pilih Matakuliah</option>
                            <?php
                            $matakuliah = $this->db->get('matakuliah')->result_array();
                            shuffle($matakuliah);
                            foreach ($matakuliah as $m) :

                            ?>
                                <option value="<?= $m['id_matakuliah']; ?>"><?= $m['nama_matakuliah']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_matakuliah'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="hari" class="col-sm-3 col-form-label">Hari</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('hari') ? 'is-invalid' : ''; ?>" name="hari" id="hari">
                            <option selected>Pilih Hari</option>
                            <?php $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                            shuffle($hari);
                            foreach ($hari as $h) :
                            ?>
                                <option value="<?= $h; ?>"><?= $h; ?></option>

                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('hari'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jam" class="col-sm-3 col-form-label">jam</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('jam') ? 'is-invalid' : ''; ?>" value="<?= set_value('jam'); ?>" name="jam" id="jam">
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

<!-- Modal tambah -->
<?php foreach ($kelas as $k) : ?>
    <div class="modal fade" id="modal_update<?= $k['id_kelas']; ?>" tabindex="-1" aria-labelledby="modal_updateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_updateLabel">Update Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin-kelas/insert') ?>
                    <div class="form-group row">
                        <label for="id_kelas" class="col-sm-3 col-form-label">ID (Kelas)</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('id_kelas') ? 'is-invalid' : ''; ?>" value="<?= set_value('id_kelas'); ?>" name="id_kelas" id="id_kelas">
                            <div class="invalid-feedback"><?= form_error('id_kelas'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_kelas" class="col-sm-3 col-form-label">Kelas</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('nama_kelas') ? 'is-invalid' : ''; ?>" name="nama_kelas" id="nama_kelas">
                                <?php $kelas = ['Kelas mawar', 'Kelas bunga', 'Kelas melati']; ?>
                                <option selected>Pilih kelas</option>
                                <?php foreach ($kelas as $ks) : ?>
                                    <option value="<?= $ks; ?>"><?= $ks; ?></option>
                                <?php endforeach; ?>
                                <div class="invalid-feedback"><?= form_error('nama_kelas'); ?></div>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_dosen" class="col-sm-3 col-form-label">Dosen</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" name="id_dosen" id="id_dosen">
                                <?php $dosen = $this->db->get('dosen')->result_array(); ?>
                                <option selected>Pilih dosen</option>
                                <?php foreach ($dosen as $dsn) : ?>
                                    <option value="<?= $dsn['id_dosen']; ?>"><?= $dsn['nama_dosen']; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <div class="invalid-feedback"><?= form_error('id_dosen'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_ruangan" class="col-sm-3 col-form-label">Ruang</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_ruangan') ? 'is-invalid' : ''; ?>" name="id_ruangan" id="id_ruangan">
                                <?php $ruang = $this->db->get('ruangan')->result_array(); ?>
                                <option selected>Pilih ruangan</option>
                                <?php foreach ($ruang as $rg) : ?>
                                    <option value="<?= $rg['id_ruangan']; ?>"><?= $rg['nama_ruangan']; ?></option>
                                <?php endforeach; ?>
                                <div class="invalid-feedback"><?= form_error('id_ruangan'); ?></div>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_matakuliah" class="col-sm-3 col-form-label">Matakuliah</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_matakuliah') ? 'is-invalid' : ''; ?>" name="id_matakuliah" id="id_matakuliah">
                                <option selected>Pilih Matakuliah</option>
                                <?php
                                $matakuliah = $this->db->get('matakuliah')->result_array();
                                shuffle($matakuliah);
                                foreach ($matakuliah as $m) :

                                ?>
                                    <option value="<?= $m['id_matakuliah']; ?>"><?= $m['nama_matakuliah']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_matakuliah'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hari" class="col-sm-3 col-form-label">Hari</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('hari') ? 'is-invalid' : ''; ?>" name="hari" id="hari">
                                <option selected>Pilih Hari</option>
                                <?php $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                shuffle($hari);
                                foreach ($hari as $h) :
                                ?>
                                    <option value="<?= $h; ?>"><?= $h; ?></option>

                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('hari'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jam" class="col-sm-3 col-form-label">jam</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('jam') ? 'is-invalid' : ''; ?>" value="<?= set_value('jam'); ?>" name="jam" id="jam">
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
<?php endforeach; ?>