<div class="setting-container">
    <div class="row">
        <div class="col-lg-10">
            <header id="header">
                <?php if ($this->session->flashdata('message_success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('message_success'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('message_error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('message_error'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            </header>
        </div>

    </div>

    <div class="main">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">
                <div class="box">
                    <h3 class="mb-3">My Profile </h3>
                    <hr class="sidebar-divider">
                    <div class="akun-info-profil mb-3">
                        <img src="<?= base_url('upload/' . $get_sesi_user['image']); ?>" class="img-fluid" style="width: 300px; max-width: 100%;">
                    </div>

                    <div class="form-akun-info p-2 pt-3">
                        <?= form_open_multipart('users/profile/update-profile/' . $get_sesi_user['id_user']); ?>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control <?= form_error('email') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($get_sesi_user['email']); ?>" name="email" id="email" autofocus required>
                                <div class="invalid-feedback"><?= form_error('email'); ?></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">Nama akun</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($get_sesi_user['name']); ?>" name="name" id="name" required>
                                <div class="invalid-feedback"><?= form_error('name'); ?></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 col-form-label">Foto upload <em><a href="#info" class="text-dark" data-toggle="modal" data-target="#info"><i class="fas fa-info "></i></a></em> </label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <div class="invalid-feedback"><?= form_error('image'); ?></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="info_akun" class="col-sm-3 col-form-label">Akun dibuat</label>
                            <div class="col-sm-9">
                                <p><?= date('d M Y H:i:s', $get_sesi_user['date_created']); ?></p>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-dark ">Update</button>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-10">
                <div class="box">
                    <div class="form-update-sandi pt-3">
                        <h3 class="mb-3">Kata sandi baru </h3>
                        <hr class="sidebar-divider">
                        <div class="alert alert-info" role="alert">
                            <h4 class="alert-heading">Pemberitahuan <i class="fas fa-fw fa-exclamation-circle"></i></h4>
                            <p>Demi keamanan akun, segera ubah kata sandi lama menjadi kata sandi terbaru</p>

                            <p>Password kamu di perbarui <b><?= date('d M Y, H:i:s', $get_sesi_user['password_update']); ?></b></em></p>
                        </div>
                        <?= form_open('users/profile/update-password/' . $get_sesi_user['id_user']); ?>
                        <div class="form-group row">
                            <label for="password_lama" class="col-sm-3 col-form-label">Password Lama</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control <?= form_error('password_lama') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('password_lama')); ?>" name="password_lama" id="password_lama" required>
                                <div class="invalid-feedback"><?= form_error('password_lama'); ?></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_baru" class="col-sm-3 col-form-label">Password Baru</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control <?= form_error('password_baru') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('password_baru')); ?>" name="password_baru" id="password_baru" required>
                                <div class="invalid-feedback"><?= form_error('password_baru'); ?></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ulangi_password" class="col-sm-3 col-form-label">Konfirmasi password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control <?= form_error('ulangi_password') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('ulangi_password')); ?>" name="ulangi_password" id="ulangi_password" required>
                                <div class="invalid-feedback"><?= form_error('ulangi_password'); ?></div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark ">Update</button>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




<div class="modal fade" id="info" tabindex="-1" aria-labelledby="infoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoLabel">Pemberitahuan!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="info-show">
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">Pemberitahuan <i class="fas fa-info"></i></h4>
                        <ol class="pt-3">
                            <li>Pilih gambar bertipe jpg/jpeg & PNG.</li>
                            <li>ukuran gambar tidak boleh dari 2 MB</li>
                        </ol>

                        <p class="inner-text">Terima kasih</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>