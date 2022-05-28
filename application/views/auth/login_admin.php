<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0  my-5">
            <div class="card-body p-0">

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
                    <div class="col-lg-6 d-lg-block">
                        <div class="content-login">
                            <img src="https://adhom.id/wp-content/uploads/2021/04/landing_page_background_2-removebg-preview.png" class="img-fluid">
                            <h3 class="px-3 mx-4 pt-5 login_title">Selamat datang di sistem informasi akademik <strong>(Admin)</strong></h3>
                            <a href="#penggunaan" data-toggle="modal" data-target="#exampleModal" class="penggunaan"> Bantuan?</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="content-login">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Admin Login <i class="fas fa-user"></i></h1>
                                    <hr class="sidebar-divider">
                                </div>
                                <?= form_open('app', 'class="user"'); ?>
                                <div class="form-group">
                                    <input type="text" name="email" value="<?= set_value('email'); ?>" class="form-control form-control-user <?= form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Masukan username / Email ">
                                    <div class="invalid-feedback ml-2"><?= form_error('email'); ?></div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user <?= form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Password">
                                    <div class="invalid-feedback ml-2"><?= form_error('password'); ?></div>
                                </div>

                                <button type="submit" class="btn btn-dark btn-user btn-block">
                                    Masuk
                                </button>


                                <?= form_close(); ?>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="#">Lupa password?</a>
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