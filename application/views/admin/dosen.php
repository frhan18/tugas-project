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
        <div class="dosen-info mb-3">
            <h3 class="h3 mb-2 text-dark">Data Dosen</h3>
            <p class="text-dark">Halo <?= $get_sesi_user['name']; ?>, Jumlah data prodi saat ini tersedia <strong><?= $count_tb_dosen; ?></strong> data.</p>
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_tambah" aria-pressed="false">
                <i class="fas fa-plus"></i> Tambah Data Dosen
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
                                    <th>Kode dosen</th>
                                    <th>Nip</th>
                                    <th>Nama</th>
                                    <th>jenis_kelamin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($dosen as $rows) : ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?= $no++; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['id_dosen']; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['nip']; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['nama']; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['jenis_kelamin'] == 'L' ? 'Laki laki' : 'Perempuan'; ?></td>
                                        <td style="vertical-align: middle;">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('data-dosen/delete/' . htmlentities($rows['id_dosen'])); ?>" onclick="deleteConfirm(this)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning ml-1" data-toggle="modal" data-target="#edit_dosen<?= $rows['id_dosen']; ?>"><i class="fas fa-edit"></i></a>
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
                <h5 class="modal-title" id="modal_tambahLabel">Tambah data <b> Dosen</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('data-dosen/add') ?>
                <div class="form-group row">
                    <label for="id_dosen" class="col-sm-3 col-form-label">Kode Dosen</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('id_dosen')); ?>" name="id_dosen" id="id_dosen" required>
                        <div class="invalid-feedback"><?= form_error('id_dosen'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nip" class="col-sm-3 col-form-label">Nip</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control <?= form_error('nip') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('nip')); ?>" name="nip" id="nip" required>
                        <div class="invalid-feedback"><?= form_error('nip'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama dosen</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('nama')); ?>" name="nama" id="nama" required>
                        <div class="invalid-feedback"><?= form_error('nama'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label"> Jenis kelamin</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('jenis_kelamin') ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                            <option selected disabled>Pilih jenis kelamin</option>
                            <?php
                            $jenis_kelamin = [['key' => 'L', 'value' => 'Laki laki'], ['key' => 'P', 'value' => 'Perempuan']];
                            foreach ($jenis_kelamin as $mk) : ?>
                                <option value="<?= $mk['key']; ?>"><?= $mk['value']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('jenis_kelamin'); ?></div>
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



<?php foreach ($dosen as $dsn) : ?>
    <div class="modal fade" id="edit_dosen<?= $dsn['id_dosen']; ?>" tabindex="-1" aria-labelledby="edit_dosenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_dosenLabel">Edit Data <b> Dosen</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('data-dosen/edit/' . htmlentities($dsn['id_dosen'])); ?>
                    <div class="form-group row">
                        <label for="id_dosen" class="col-sm-3 col-form-label">Kode Dosen</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('id_dosen') ? 'is-invalid' : ''; ?>" value="<?= $dsn['id_dosen']; ?>" name="id_dosen" id="id_dosen" readonly>
                            <div class="invalid-feedback"><?= form_error('id_dosen'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nip" class="col-sm-3 col-form-label">Nip</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nip') ? 'is-invalid' : ''; ?>" value="<?= $dsn['nip']; ?>" name="nip" id="nip" required>
                            <div class="invalid-feedback"><?= form_error('nip'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama dosen</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= $dsn['nama']; ?>" name="nama" id="nama" required>
                            <div class="invalid-feedback"><?= form_error('nama'); ?></div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-sm-3 col-form-label"> Jenis kelamin</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('jenis_kelamin') ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                                <option selected disabled>Pilih jenis kelamin</option>
                                <?php
                                $jenis_kelamin = [['key' => 'L', 'value' => 'Laki laki'], ['key' => 'P', 'value' => 'Perempuan']];
                                foreach ($jenis_kelamin as $mk) : ?>
                                    <option value="<?= $mk['key']; ?>" <?php if ($dsn['jenis_kelamin'] == $mk['key']) echo 'selected'; ?>><?= $mk['value']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('jenis_kelamin'); ?></div>
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