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
        <div class="matakuliah-info mb-3">
            <h3 class="h3 mb-2 text-dark">Data Matakuliah</h3>
            <p class="text-dark">Halo <?= $get_sesi_user['name']; ?>, Jumlah data matakuliah saat ini tersedia <strong><?= $count_tb_matakuliah; ?></strong> data.</p>
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_matakuliah" aria-pressed="false">
                <i class="fas fa-plus"></i> Tambah Data Matakuliah
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
                                    <th>Kode matakuliah</th>
                                    <th>Matakuliah</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1;
                                foreach ($matakuliah as $rows) : ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?= $no++; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['id_mata_kuliah']; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['nama_mata_kuliah']; ?></td>
                                        <td style="vertical-align: middle;">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('data-matakuliah/delete/' . $rows['id_mata_kuliah']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger "><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning  ml-1" data-toggle="modal" data-target="#modal_matakuliah_edit<?= $rows['id_mata_kuliah']; ?>"><i class="fas fa-edit"></i></a>
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


<div class="modal fade" id="modal_matakuliah" tabindex="-1" aria-labelledby="modal_matakuliahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_matakuliahLabel">Tambah Data <b> Matakuliah</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('data-matakuliah/add') ?>
                <div class="form-group row">
                    <label for="id_mata_kuliah" class="col-sm-3 col-form-label">Kode matakuliah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('id_mata_kuliah') ? 'is-invalid' : ''; ?>" value="<?= set_value('id_mata_kuliah'); ?>" name="id_mata_kuliah" id="id_mata_kuliah" required>
                        <div class="invalid-feedback"><?= form_error('id_mata_kuliah'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_mata_kuliah" class="col-sm-3 col-form-label">Nama matakuliah</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama_mata_kuliah') ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_mata_kuliah'); ?>" name="nama_mata_kuliah" id="nama_mata_kuliah" required>
                        <div class="invalid-feedback"><?= form_error('nama_mata_kuliah'); ?></div>
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


<?php foreach ($matakuliah as $mk) : ?>
    <div class="modal fade" id="modal_matakuliah_edit<?= $mk['id_mata_kuliah']; ?>" tabindex="-1" aria-labelledby="modal_matakuliah_editLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_matakuliah_editLabel">Edit Data <b> Matakuliah</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('data-matakuliah/edit/' . htmlentities($mk['id_mata_kuliah'])) ?>
                    <div class="form-group row">
                        <label for="id_mata_kuliah" class="col-sm-3 col-form-label">Kode matakuliah</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('id_mata_kuliah') ? 'is-invalid' : ''; ?>" value="<?= $mk['id_mata_kuliah']; ?>" name="id_mata_kuliah" id="id_mata_kuliah" readonly>
                            <div class="invalid-feedback"><?= form_error('id_mata_kuliah'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_mata_kuliah" class="col-sm-3 col-form-label">Nama matakuliah</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama_mata_kuliah') ? 'is-invalid' : ''; ?>" value="<?= $mk['nama_mata_kuliah']; ?>" name="nama_mata_kuliah" id="nama_mata_kuliah" required>
                            <div class="invalid-feedback"><?= form_error('nama_mata_kuliah'); ?></div>
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