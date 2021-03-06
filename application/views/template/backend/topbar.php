<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content" style="background-color: #fff;">

        <!-- Topbar -->
        <nav class="navbar navbar-expand topbar shadow mb-4 static-top " style="background: #fff;">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" style="background: transparent;">
                <i class="fa fa-bars" style="color: #000;"></i>
            </button>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-dark small"><?= isset($get_sesi_user['name']) ? $get_sesi_user['name'] : 'Admin'; ?></span>
                        <!-- <img class="img-profile rounded-circle" src="<?= base_url('assets/img/' . 'default.svg'); ?>"> -->
                        <img class="img-profile rounded-circle" src="<?= base_url('upload/' . $get_sesi_user['image']); ?>">
                    </a>
                    <!-- Dropdown - User Information -->

                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <?php if ($this->session->userdata('id_role') == 1) : ?>
                            <a class="dropdown-item" href="<?= base_url('setting-profile'); ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                        <?php else : ?>
                            <a class="dropdown-item" href="<?= base_url('users/profile'); ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                        <?php endif; ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">