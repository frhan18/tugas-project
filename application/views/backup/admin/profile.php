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

    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="<?= base_url('assets/img/' . $get_sesi_user['image']); ?>" class="img-fluid px-3 " style="width: 300px; max-width: 100%;">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">My Profile</h5>

                <?= form_open(); ?>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" readonly value="<?= $get_sesi_user['email']; ?>" id="inputEmail3">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control-plaintext" value="<?= $get_sesi_user['name']; ?>" id="inputEmail3">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Image</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>





</div>