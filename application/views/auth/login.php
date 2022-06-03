<!-- Outer Row -->
<div class="login-container">
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10">

            <div class="card o-hidden border-0  my-5">
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
                                    <h1 class="h4 text-gray-900 mb-4">Mahasiswa Login <i class="fas fa-user"></i></h1>
                                    <div class="text-small">Silahkan login dengan nim yang sudah terdaftar.</div>
                                    <hr class="sidebar-divider">
                                </div>
                                <?= form_open('login', 'class="user"'); ?>
                                <div class="form-group">
                                    <input type="number" name="nim" value="<?= set_value('nim'); ?>" class="form-control form-control-user <?= form_error('nim') ? 'is-invalid' : ''; ?>" placeholder="Masukan nim" required>
                                    <div class="invalid-feedback ml-2"><?= form_error('nim'); ?></div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user <?= form_error('password') ? 'is-invalid' : ''; ?>" placeholder="Password" required>
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




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penggunaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="penggunaan-text">
                    <ol>
                        <li>Login sesuai dengan nim / email yang sudah teregistrasi.</li>
                        <li>Masukan password dengan benar</li>
                        <li>Jika akun di nonaktifkan, segera hubungi pihak yang terkait / Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>