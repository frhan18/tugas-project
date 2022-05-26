<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0  my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <?php if ($this->session->flashdata('message_error')) : ?>
                    <div class="notification-fb">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('message_error'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
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
                <div class="row">
                    <div class="col-lg-6  d-lg-block">
                        <h3 class="px-3 mx-4 pt-5 login_title">Selamat datang di sistem informasi akademik (SIA APP)</h3>
                        <img src="https://adhom.id/wp-content/uploads/2021/04/landing_page_background_2-removebg-preview.png" class="img-fluid">
                        <p class="login_text px-3 mx-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, delectus. Accusamus aut adipisci consequatur ea fuga natus dolorum, inventore veniam?</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Akses Aplikasi</h1>
                            </div>
                            <?= form_open('login', 'class="user"'); ?>
                            <div class="form-group">
                                <input type="text" name="email" value="<?= set_value('email'); ?>" class="form-control form-control-user <?= form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Enter Email Address...">
                                <div class="invalid-feedback ml-2"><?= form_error('email'); ?></div>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user <?= form_error('email') ? 'is-invalid' : ''; ?>" placeholder="Password">
                                <div class="invalid-feedback ml-2"><?= form_error('password'); ?></div>
                            </div>

                            <button type="submit" class="btn btn-dark btn-user btn-block">
                                Login
                            </button>


                            <?= form_close(); ?>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">Forgot Password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>