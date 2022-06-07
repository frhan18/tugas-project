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
        <div class="mahasiswa-info mb-3">
            <h3 class="text-dark">Data Mahasiswa</h3>
            <p class="text-dark">Halo <?= $get_sesi_user['name']; ?>, Jumlah data mahasiswa saat ini tersedia <strong><?= $count_tb_mahasiswa; ?></strong> data.</p>
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_tambah" aria-pressed="false">
                <i class="fas fa-plus"></i> Tambah Data Mahasiswa
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
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tahun Masuk</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1;
                                foreach ($mahasiswa as $rows) : ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?= $no++; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['nim']; ?></td>
                                        <td style="vertical-align: middle;" class="text-capitalize"><?= $rows['nama']; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['tahun_masuk']; ?></td>

                                        <td style="vertical-align: middle;">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('data-mahasiswa/delete/' . $rows['nim']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning ml-1" data-toggle="modal" data-target="#modal_edit_mhs<?= $rows['nim']; ?>"><i class="fas fa-edit"></i></a>
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
            <div class="modal-header ">
                <h5 class="modal-title " id="modal_tambahLabel">Tambah Data <b> Mahasiswa</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('data-mahasiswa/add') ?>
                <div class="form-group row">
                    <label for="nim" class="col-sm-3 col-form-label">Nim</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control <?= form_error('nim') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('nim') ? set_value('nim') : '15200'); ?>" name="nim" id="nim" required>
                        <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('nama')); ?>" name="nama" id="nama" required>
                        <div class="invalid-feedback"><?= form_error('nama'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tempat_tanggal_lahir" class="col-sm-3 col-form-label">Tempat tgl lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('tempat_tanggal_lahir') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('tempat_tanggal_lahir')); ?>" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" required>
                        <div class="invalid-feedback"><?= form_error('tempat_tanggal_lahir'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('alamat')); ?>" name="alamat" id="alamat" required>
                        <div class="invalid-feedback"><?= form_error('alamat'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis kelamin</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('jenis_kelamin') ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin" required>
                            <option selected disabled value="">Pilih jenis kelamin</option>
                            <?php
                            $jenis_kelamin = [['key' => 'L', 'value' => 'Laki-laki'], ['key' => 'P', 'value' => 'Perempuan']];
                            foreach ($jenis_kelamin as $rows) : ?>
                                <option value="<?= $rows['key']; ?>"><?= $rows['value']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('jenis_kelamin'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select  <?= form_error('agama') ? 'is-invalid' : ''; ?>" name="agama" id="agama" required>
                            <option selected disabled value="">Pilih agama</option>
                            <?php
                            $agama = ['Islam', 'Kristen', 'Konghucu'];
                            foreach ($agama as $ag) : ?>
                                <option value="<?= $ag; ?>"><?= $ag; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('agama'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun masuk</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select  <?= form_error('agama') ? 'is-invalid' : ''; ?>" name="tahun_masuk" id="tahun_masuk" required>
                            <option selected disabled value="">Pilih tahun</option>
                            <?php
                            $tahun_masuk = ['2017', '2018', '2018', '2019', '2020', '2021', '2022'];
                            foreach ($tahun_masuk as $th) : ?>
                                <option value="<?= $th; ?>"><?= $th; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('tahun_masuk'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_kelas" class="col-sm-3 col-form-label">Kode kelas</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select  <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" name="kode_kelas" id="kode_kelas" required>
                            <option selected disabled value="">Pilih kode kelas</option>
                            <?php
                            foreach ($kelas as $ks) : ?>
                                <option value="<?= $ks['kode_kelas']; ?>"><?= $ks['kode_kelas']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
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


<?php foreach ($mahasiswa as $mhs) : ?>
    <div class="modal fade" id="modal_edit_mhs<?= $mhs['nim']; ?>" tabindex="-1" aria-labelledby="modal_edit_mhsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title " id="modal_edit_mhsLabel">Edit Data <b> Mahasiswa</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('data-mahasiswa/edit/' . htmlentities($mhs['nim'])) ?>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label">Nim</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control <?= form_error('nim') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($mhs['nim']) ?>" name="nim" id="nim" required>
                            <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($mhs['nama']) ?>" name="nama" id="nama">
                            <div class="invalid-feedback"><?= form_error('nama'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tempat_tanggal_lahir" class="col-sm-3 col-form-label">Tempat tgl lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('tempat_tanggal_lahir') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($mhs['tempat_tanggal_lahir']) ?>" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir">
                            <div class="invalid-feedback"><?= form_error('tempat_tanggal_lahir'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($mhs['alamat']) ?>" name="alamat" id="alamat">
                            <div class="invalid-feedback"><?= form_error('alamat'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis kelamin</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('jenis_kelamin') ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                                <option selected disabled>Pilih jenis kelamin</option>
                                <?php
                                $jenis_kelamin = [['key' => 'L', 'value' => 'Laki-laki'], ['key' => 'P', 'value' => 'Perempuan']];
                                foreach ($jenis_kelamin as $jk) : ?>
                                    <option value="<?= $jk['key']; ?>" <?php if ($mhs['jenis_kelamin'] == $jk['key']) echo 'selected'; ?>><?= $jk['value']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('jenis_kelamin'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select  <?= form_error('agama') ? 'is-invalid' : ''; ?>" name="agama" id="agama">
                                <option selected disabled>Pilih agama</option>
                                <?php
                                $agama = ['Islam', 'Kristen', 'Konghucu'];
                                foreach ($agama as $ag) : ?>
                                    <option value="<?= $ag; ?>" <?php if ($mhs['agama'] == $ag) echo 'selected'; ?>><?= $ag; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('agama'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun masuk</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select  <?= form_error('agama') ? 'is-invalid' : ''; ?>" name="tahun_masuk" id="tahun_masuk">
                                <option selected disabled>Pilih tahun</option>
                                <?php
                                $tahun_masuk = ['2017', '2018', '2018', '2019', '2020', '2021', '2022'];
                                foreach ($tahun_masuk as $th) : ?>
                                    <option value="<?= $th; ?>" <?php if ($mhs['tahun_masuk'] == $th) echo 'selected'; ?>><?= $th; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('tahun_masuk'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_kelas" class="col-sm-3 col-form-label">Kode kelas</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select  <?= form_error('kode_kelas') ? 'is-invalid' : ''; ?>" name="kode_kelas" id="kode_kelas" required>
                                <option selected disabled value="">Pilih kode kelas</option>
                                <?php
                                foreach ($kelas as $ks) : ?>
                                    <option value="<?= $ks['kode_kelas']; ?>" <?php if ($mhs['kode_kelas'] == $ks['kode_kelas']) echo 'selected'; ?>><?= $ks['kode_kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('kode_kelas'); ?></div>
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