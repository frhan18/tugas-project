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
            <li class="breadcrumb-item active" aria-current="page"><?= isset($title) ? $title : 'Mahasiswa'; ?></li>
        </ol>
    </nav>

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
                                    <th>#</th>
                                    <th>Nim</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>Tahun masuk</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                foreach ($mahasiswa as $rows) :  ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $rows['nim']; ?></td>
                                        <td><?= $rows['nama_mhs']; ?></td>
                                        <td><?= $rows['nama_prodi']; ?></td>
                                        <td><?= $rows['tahun_masuk']; ?></td>
                                        <td><?= $rows['is_active'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-delete-url="<?= site_url('admin/delete_mahasiswa/' . $rows['nim']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_edit<?= $rows['nim']; ?>"><i class="fas fa-edit"></i></button>
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


<!-- Modal tambah -->
<div class="modal fade" id="modal_tambah" tabindex="-1" aria-labelledby="modal_tambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_tambahLabel">Add New Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/add_mahasiswa') ?>
                <div class="form-group row">
                    <label for="nim" class="col-sm-3 col-form-label">Nim</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control <?= form_error('nim') ? 'is-invalid' : ''; ?>" value="<?= set_value('nim'); ?>" name="nim" id="nim" placeholder="Contoh 15200700" required>
                        <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_mhs" class="col-sm-3 col-form-label">Nama mahasiswa</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('nama_mhs') ? 'is-invalid' : ''; ?>" value="<?= set_value('nama_mhs'); ?>" name="nama_mhs" id="nama_mhs" placeholder="Ujang setiawan">
                        <div class="invalid-feedback"><?= form_error('nama_mhs'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tempat_tanggal_lahir" class="col-sm-3 col-form-label">Tempat tgl lahir</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('tempat_tanggal_lahir') ? 'is-invalid' : ''; ?>" value="<?= set_value('tempat_tanggal_lahir'); ?>" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" placeholder="Jakarta, 18 april 2002">
                        <div class="invalid-feedback"><?= form_error('tempat_tanggal_lahir'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun masuk</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control <?= form_error('tahun_masuk') ? 'is-invalid' : ''; ?>" value="<?= set_value('tahun_masuk'); ?>" name="tahun_masuk" id="tahun_masuk" required>
                        <div class="invalid-feedback"><?= form_error('tahun_masuk'); ?></div>
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
                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
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
                    <label for="id_prodi" class="col-sm-3 col-form-label">Prodi</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_prodi') ? 'is-invalid' : ''; ?>" name="id_prodi" id="id_prodi" required>
                            <option selected disabled>Pilih prodi</option>
                            <?php
                            $prodi = $this->db->get('prodi')->result_array();
                            shuffle($prodi);
                            foreach ($prodi as $rows) :  ?>
                                <option value="<?= $rows['id_prodi']; ?>"><?= $rows['nama_prodi']; ?> (<?= $rows['id_prodi']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_prodi'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="id_user" class="col-sm-3 col-form-label">ID (User)</label>
                    <div class="col-sm-9">
                        <select class="custom-select custom-select <?= form_error('id_user') ? 'is-invalid' : ''; ?>" name="id_user" id="id_user">
                            <option selected disabled>Pilih ID User</option>
                            <?php
                            $user = $this->db->get('user')->result_array();
                            foreach ($user as $rows) :  ?>
                                <option value="<?= $rows['id_user']; ?>"><?= $rows['id_user']; ?> / (<?= $rows['email']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback"><?= form_error('id_user'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tahun" class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">
                                Status mahasiswa <b>aktif / nonaktif?</b>
                            </label>
                        </div>
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



<!-- Modal edit -->
<?php foreach ($mahasiswa as $rows) : ?>
    <div class="modal fade" id="modal_edit<?= $rows['nim']; ?>" tabindex="-1" aria-labelledby="modal_editLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_editLabel">Edit Data <b>Mahasiswa</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/update_mahasiswa/' . $rows['nim']) ?>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label">Nim</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control <?= form_error('nim') ? 'is-invalid' : ''; ?>" value="<?= $rows['nim']; ?>" name="nim" id="nim" readonly>
                            <div class="invalid-feedback"><?= form_error('nim'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_mhs" class="col-sm-3 col-form-label">Nama mahasiswa</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('nama_mhs') ? 'is-invalid' : ''; ?>" value="<?= $rows['nama_mhs']; ?>" name="nama_mhs" id="nama_mhs" placeholder="Ujang setiawan">
                            <div class="invalid-feedback"><?= form_error('nama_mhs'); ?></div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tempat_tanggal_lahir" class="col-sm-3 col-form-label">Tempat tgl lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control <?= form_error('tempat_tanggal_lahir') ? 'is-invalid' : ''; ?>" value="<?= $rows['tempat_tanggal_lahir']; ?>" name="tempat_tanggal_lahir" id="tempat_tanggal_lahir">
                            <div class="invalid-feedback"><?= form_error('tempat_tanggal_lahir'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun_masuk" class="col-sm-3 col-form-label">Tahun Masuk</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control <?= form_error('tahun_masuk') ? 'is-invalid' : ''; ?>" value="<?= $rows['tahun_masuk']; ?>" name="tahun_masuk" id="tahun_masuk">
                            <div class="invalid-feedback"><?= form_error('tahun_masuk'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="agama" class="col-sm-3 col-form-label">Agama</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select  <?= form_error('agama') ? 'is-invalid' : ''; ?>" name="agama" id="agama">
                                <option selected>Pilih</option>
                                <?php
                                $agama = ['Islam', 'Kristen', 'Konghucu'];
                                foreach ($agama as $ag) : ?>
                                    <option value="<?= $ag; ?>" <?php if ($rows['agama'] == $ag)  echo 'selected'; ?>><?= $ag; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('agama'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('jenis_kelamin') ? 'is-invalid' : ''; ?>" name="jenis_kelamin" id="jenis_kelamin">
                                <option selected>Pilih</option>
                                <?php
                                $jenis_kelamin = [['key' => 'L', 'value' => 'Laki-laki'], ['key' => 'P', 'value' => 'Perempuan']];
                                foreach ($jenis_kelamin as $k) : ?>
                                    <option value="<?= $k['key']; ?>" <?php if ($rows['jenis_kelamin'] == $k['key'])  echo 'selected'; ?>><?= $k['value']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('jenis_kelamin'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_prodi" class="col-sm-3 col-form-label">Prodi</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_prodi') ? 'is-invalid' : ''; ?>" name="id_prodi" id="id_prodi">
                                <option selected>Pilih</option>
                                <?php
                                $prodi = $this->db->get('prodi')->result_array();
                                shuffle($prodi);
                                foreach ($prodi as $p) :  ?>
                                    <option value="<?= $p['id_prodi']; ?>" <?php if ($rows['id_prodi'] == $p['id_prodi']) echo 'selected'; ?>><?= $p['nama_prodi']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_prodi'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_user" class="col-sm-3 col-form-label">ID (User)</label>
                        <div class="col-sm-9">
                            <select class="custom-select custom-select <?= form_error('id_user') ? 'is-invalid' : ''; ?>" name="id_user" id="id_user">
                                <option selected disabled>Pilih ID User</option>
                                <?php
                                $user = $this->db->get('user')->result_array();
                                foreach ($user as $u) :  ?>
                                    <option value="<?= $u['id_user']; ?>" <?php if ($rows['id_user'] == $u['id_user']) echo 'selected'; ?>><?= $u['id_user']; ?> / (<?= $u['email']; ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"><?= form_error('id_user'); ?></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" <?php if ($rows['is_active'] == 1)  echo 'checked'; ?> id="is_active">
                                <label class="form-check-label" for="is_active">
                                    Status mahasiswa <b>aktif / nonaktif?</b>
                                </label>
                            </div>
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