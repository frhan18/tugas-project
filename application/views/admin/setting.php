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

<?= validation_errors(); ?>


<div class="wrapper">
    <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: #fff;">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= isset($title) ? $title : 'Admin'; ?></li>
        </ol>
    </nav>

    <div class="box">
        <div class="setting-account1">
            <h3 class="text-white pt-3 pb-3">Account setting</h3>
            <div class="row ">
                <div class="col-sm-8 p-3">
                    <div class="setting-profile mb-3">
                        <img src="<?= base_url('assets/img/default.svg'); ?>" class="card-img-top img-fluid" style="width: 300px;">
                    </div>
                    <div class="setting-account-form">
                        <?= form_open('admin/setting_account/' . $get_sesi_user['id_user']); ?>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" id="email" value="<?= $get_sesi_user['email']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" name="name" id="name" value="<?= $get_sesi_user['name']; ?>" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Profile</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

        <hr class="sidebar-divider">

        <div class="setting">
            <h3 class="text-white pt-3 pb-3">Security & Password</h3>
            <div class="row ">
                <div class="col-sm-8 p-3">
                    <form action="">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Your password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control-plaintext" id="inputEmail3" value="****" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Last changed</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control-plaintext" id="inputEmail3" value="Kamis, 18 may 2022" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#password_modal">Update password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- Modal -->
<div class="modal fade" id="password_modal" tabindex="-1" aria-labelledby="password_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="password_modalLabel">Update password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Current password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputEmail3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">New password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputEmail3">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Confirm password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="inputEmail3">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update password</button>
                </form>
            </div>
        </div>
    </div>
</div>