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
        <div class="kelas-info mb-3">
            <h3 class="h3 mb-2 text-dark">Data Kelas</h3>
            <p class="text-dark">Halo <?= $get_sesi_user['name']; ?>, Jumlah data kelas saat ini tersedia <strong><?= $count_tb_kelas; ?></strong> data.</p>
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_kelas" aria-pressed="false">
                <i class="fas fa-plus"></i> Tambah Data Kelas
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
                                    <th>Kode kelas</th>
                                    <th>Nama kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1;
                                foreach ($kelas as $rows) : ?>
                                    <td style="vertical-align: middle;"><?= $no++; ?></td>
                                    <td style="vertical-align: middle;"><?= $rows['kode_kelas']; ?></td>
                                    <td style="vertical-align: middle;"><?= $rows['nama_kelas']; ?></td>
                                    <td style="vertical-align: middle;">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="javascript:void(0)" data-delete-url="<?= site_url('data-kelas/delete/' . $rows['id']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-warning ml-1" data-toggle="modal" data-target="#modal_kelas_edit<?= $rows['id']; ?>"><i class="fas fa-edit"></i></a>
                                            <!-- <a href="javascript:void(0)" class="btn btn-warning btn-md ml-1" data-toggle="modal" data-target="#modal_kelas_detail<?= $rows['id']; ?>"><i class="fas fa-search-plus"></i></a> -->
                                            <a href="<?= site_url('data-kelas/show/' . strtolower($rows['kode_kelas'])); ?>" class="btn btn-warning btn-md ml-1"><i class="fas fa-search-plus"></i></a>
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
                <?= form_open('data-kelas/add') ?>
                <div class="form-group row">
                    <label for="kode_kelas" class="col-sm-3 col-form-label">Kode kelas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('kode_kelas')); ?>" name="kode_kelas" id="kode_kelas" required placeholder="Contoh kode kelas FNG1">
                        <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_kelas" class="col-sm-3 col-form-label">Nama kelas</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama_kelas') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('nama_kelas') ? set_value('nama_kelas') : 'Regular A'); ?>" name="nama_kelas" id="nama_kelas" required>
                        <div class="invalid-feedback"><?= form_error('nama_kelas'); ?></div>
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


<?php foreach ($kelas as $ks) :  ?>

    <div class="modal fade" id="modal_kelas_edit<?= $ks['id']; ?>" tabindex="-1" aria-labelledby="modal_kelas_edit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_kelas_edit_label">Edit Data <b> Kelas</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('data-kelas/edit/' . htmlentities($ks['id'])) ?>
                    <div class="form-group row">
                        <label for="kode_kelas" class="col-sm-3 col-form-label">Kode kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($ks['kode_kelas']); ?>" name="kode_kelas" id="kode_kelas" required placeholder="Contoh kode kelas FNG1">
                            <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_kelas" class="col-sm-3 col-form-label">Nama kelas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama_kelas') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($ks['nama_kelas']); ?>" name="nama_kelas" id="nama_kelas" required>
                            <div class="invalid-feedback"><?= form_error('nama_kelas'); ?></div>
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



<?php foreach ($kelas as $ks) :  ?>

    <div class="modal fade" id="modal_kelas_detail<?= $ks['id']; ?>" tabindex="-1" aria-labelledby="modal_kelas_detail" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_kelas_detail_label">Detail anggota di Kelas <?= $ks['kode_kelas']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-data-kelas">
                        <div class="row justify-content-center pt-3">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode kelas</th>
                                                <th>Nim</th>
                                                <th>Nama</th>
                                                <th>jenis_kelamin</th>
                                                <th>Tahun masuk</th>

                                            </tr>
                                        </thead>

                                        <tbody>


                                            <?php
                                            $no = 1;
                                            foreach ($kelas_where as $kelas) : ?>
                                                <tr>
                                                    <td style="vertical-align: middle;"><?= $no++; ?></td>
                                                    <td style="vertical-align: middle;"><?= $kelas['kode_kelas']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $kelas['nim']; ?></td>
                                                    <td style="vertical-align: middle;"><?= $kelas['nama']; ?></td>
                                                    <th style="vertical-align: middle;"><?= $kelas['jenis_kelamin']; ?></th>
                                                    <th style="vertical-align: middle;"><?= $kelas['tahun_masuk']; ?></th>
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
        </div>
    </div>
<?php endforeach; ?>