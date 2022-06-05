<!-- Outer Row -->
<div class="login-container">
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">

            <div class="card shadow o-hidden border-0  my-5">
                <div class="card-body">
                    <?php if ($this->session->flashdata('message_success')) : ?>
                        <div class="notification-fb">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= $this->session->flashdata('message_success'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row login-box">
                        <div class="col-lg-6 col-sm-10 d-lg-block">
                            <div class="content-login-img">
                                <img src="<?= base_url('assets/img/bg-login.png'); ?>" class="img-fluid">
                                <h3 class=" pt-5 login_title">Selamat datang di sistem informasi akademik <strong>Kampus Kita / SIKA</strong> </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="content-login">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Admin Login <i class="fas fa-user"></i></h1>
                                    <div class="text-small">Silahkan login dengan username / email yang sudah terdaftar.</div>
                                    <hr class="sidebar-divider">
                                </div>
                                <?= form_open('app', 'class="user"'); ?>
                                <div class="form-group">
                                    <input type="text" name="email" value="<?= set_value('email') ? set_value('email') : 'admin@gmail.com'; ?>" class="form-control form-control-user <?= form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Masukan username / email" required>
                                    <div class="invalid-feedback ml-2"><?= form_error('email'); ?></div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" value="admin" class="form-control form-control-user <?= form_error('password') ? 'is-invalid' : ''; ?>" placeholder="Password" required>
                                    <div class="invalid-feedback ml-2"><?= form_error('password'); ?></div>
                                </div>

                                <button type="submit" class="btn btn-dark btn-user btn-block">
                                    Masuk
                                </button>


                                <?= form_close(); ?>
                                <hr>
                                <div class="text-center">
                                    <a class="small text-dark" href="#">Lupa password?</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>



<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Nested Row within Card Body -->
<?php if ($this->session->flashdata('message_error')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            text: '<?= $this->session->flashdata('message_error'); ?>',
            showCloseButton: true,
        })
    </script>
<?php endif; ?>