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
            <h3>Data Mahasiswa</h3>
            <button type="button" class="btn btn-dark " data-toggle="modal" data-target="#modal_tambah" aria-pressed="false">
                <i class="fas fa-plus"></i> Tambah Data Baru
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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1;
                                foreach ($mahasiswa as $rows) : ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?= $no++; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['nim']; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['nama']; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                        <td style="vertical-align: middle;">
                                            <?php if ($rows['status_mhs'] == 1) : ?>
                                                Aktif
                                            <?php elseif ($rows['status_mhs'] == 2) : ?>
                                                Cuti
                                            <?php elseif ($rows['status_mhs'] == 0) : ?>
                                                Tidak Aktif
                                            <?php else : ?>
                                                Lulus
                                            <?php endif; ?>

                                        </td>
                                        <td style="vertical-align: middle;">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('mahasiswa/delete/' . $rows['nim']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning ml-1" data-toggle="modal" data-target="#modal_edit<?= $rows['nim']; ?>"><i class="fas fa-edit"></i></a>
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
                <?= form_open('mahasiswa/add') ?>
                <div class="form-group row">
                    <label for="nim" class="col-sm-3 col-form-label">Nim</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control <?= form_error('nim') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('nim')); ?>" name="nim" id="nim" required>
                        <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama mahasiswa</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('nama')); ?>" name="nama" id="nama">
                        <div class="invalid-feedback"><?= form_error('nama'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tempat_tanggal_lahir" class="col-sm-3 col-form-label">Tempat tgl lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('tempat_tanggal_lahir') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('tempat_tanggal_lahir')); ?>" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir">
                        <div class="invalid-feedback"><?= form_error('tempat_tanggal_lahir'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('alamat')); ?>" name="alamat" id="alamat">
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
                            foreach ($jenis_kelamin as $rows) : ?>
                                <option value="<?= $rows['key']; ?>"><?= $rows['value']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('jenis_kelamin'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kode_prodi" class="col-sm-3 col-form-label">Prodi</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select  <?= form_error('kode_prodi') ? 'is-invalid' : ''; ?>" name="kode_prodi" id="kode_prodi">
                            <option selected disabled>Pilih prodi</option>
                            <?php

                            foreach ($prodi as $p) : ?>
                                <option value="<?= $p['kode_prodi']; ?>"><?= $p['nama_prodi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('kode_prodi'); ?></div>
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
                                <option value="<?= $ag; ?>"><?= $ag; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('agama'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun masuk</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select  <?= form_error('agama') ? 'is-invalid' : ''; ?>" name="tahun_masuk" id="tahun_masyk">
                            <option selected disabled>Pilih tahun</option>
                            <?php
                            $tahun_masuk = ['2015', '2016', '2017', '2018', '2018', '2019', '2020', '2021', '2022'];
                            foreach ($tahun_masuk as $th) : ?>
                                <option value="<?= $th; ?>"><?= $th; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('tahun_masuk'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status_mhs" class="col-sm-3 col-form-label">Status </label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select  <?= form_error('status_mhs') ? 'is-invalid' : ''; ?>" name="status_mhs" id="status_mhs">
                            <option disabled selected>Pilih status</option>

                            <?php
                            $status_mhs = [
                                [
                                    'key' => 1,  'value' => 'Aktif',
                                ],
                                [
                                    'key' => 2,  'value' => 'Cuti',
                                ],
                                [
                                    'key' => 0,  'value' => 'Tidak aktif',
                                ],
                                [
                                    'key' => 3,  'value' => 'Lulus',
                                ],
                            ];
                            foreach ($status_mhs as $rows) : ?>
                                <option value="<?= $rows['key']; ?>"><?= $rows['value']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('status_mhs'); ?></div>
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


<?php foreach ($mahasiswa as $rows) : ?>
    <div class="modal fade" id="modal_edit<?= $rows['nim']; ?>" tabindex="-1" aria-labelledby="modal_editLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_editLabel">Edit Data <b> Mahasiswa</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('mahasiswa/edit/' . $rows['nim']) ?>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label">Nim</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control <?= form_error('nim') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($rows['nim']); ?>" name="nim" id="nim">
                            <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama mahasiswa</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($rows['nama']); ?>" name="nama" id="nama">
                            <div class="invalid-feedback"><?= form_error('nama'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tempat_tanggal_lahir" class="col-sm-3 col-form-label">Tempat tgl lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('tempat_tanggal_lahir') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($rows['tempat_tanggal_lahir']); ?>" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir">
                            <div class="invalid-feedback"><?= form_error('tempat_tanggal_lahir'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('alamat') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($rows['alamat']); ?>" name="alamat" id="alamat">
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
                                    <option value="<?= $jk['key']; ?>" <?php if ($rows['jenis_kelamin'] == $jk['key']) echo 'selected'; ?>><?= $jk['value']; ?></option>
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
                                    <option value="<?= $ag; ?> " <?php if ($rows['agama'] == $ag) echo 'selected'; ?>><?= $ag; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('agama'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun masuk</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select  <?= form_error('agama') ? 'is-invalid' : ''; ?>" name="tahun_masuk" id="tahun_masyk">
                                <option selected disabled>Pilih tahun</option>
                                <?php
                                $tahun_masuk = ['2015', '2016', '2017', '2018', '2018', '2019', '2020', '2021', '2022'];
                                foreach ($tahun_masuk as $th) : ?>
                                    <option value="<?= $th; ?>" <?php if ($rows['tahun_masuk'] == $th) echo 'selected'; ?>><?= $th; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('tahun_masuk'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_mhs" class="col-sm-3 col-form-label">Status </label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select  <?= form_error('status_mhs') ? 'is-invalid' : ''; ?>" name="status_mhs" id="status_mhs">
                                <option disabled selected>Pilih status</option>
                                <?php
                                $status_mhs = [
                                    [
                                        'key' => 1,  'value' => 'Aktif',
                                    ],
                                    [
                                        'key' => 2,  'value' => 'Cuti',
                                    ],
                                    [
                                        'key' => 0,  'value' => 'Tidak aktif',
                                    ],
                                    [
                                        'key' => 3,  'value' => 'Lulus',
                                    ],
                                ];
                                foreach ($status_mhs as $st) : ?>
                                    <option value="<?= $st['key']; ?>" <?php if ($rows['status_mhs'] == $st['key']) echo 'selected'; ?>><?= $st['value']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('status_mhs'); ?></div>
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