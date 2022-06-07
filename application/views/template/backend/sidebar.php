<?php if ($this->session->userdata('id_role') == 1) : ?>
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar  sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#sika">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-book"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SIKA</div>
        </a>
        <div class="sidebar-heading mt-3">
            Admin menu
        </div>

        <!-- Divider -->
        <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Master Data
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#data_admin" aria-expanded="true" aria-controls="data_admin">
                <i class="fas fa-fw fa-folder"></i>
                <span>Data Admin</span>
            </a>
            <div id="data_admin" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Admin:</h6>
                    <a class="collapse-item" href="<?= base_url('setting-profile'); ?>"><i class="fas fa-fw fa-user"></i> Profile</a>
                    <a class="collapse-item" href="<?= base_url('post'); ?>"><i class="fas fa-fw fa-blog"></i> Blog</a>

                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#data_pengguna" aria-expanded="true" aria-controls="data_pengguna">
                <i class="fas fa-fw fa-folder-plus"></i>
                <span>Data Pengguna</span>
            </a>
            <div id="data_pengguna" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data pengguna:</h6>
                    <a class="collapse-item" href="<?= base_url('user-account'); ?>"><i class="fas fa-fw fa-users"></i> Data pengguna</a>
                </div>
            </div>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>Data Akademik</span>
            </a>
            <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data akademik:</h6>
                    <a class="collapse-item" href="<?= base_url('data-mahasiswa'); ?>"><i class="fas fa-fw fa-user-graduate"></i> Data Mahasiswa</a>
                    <a class="collapse-item" href="<?= base_url('data-matakuliah'); ?>"><i class="fas fa-fw fa-book-open"></i> Data Matakuliah</a>
                    <a class="collapse-item" href="<?= base_url('data-kelas'); ?>"><i class="fas fa-fw fa-building"></i> Data Kelas</a>
                    <a class="collapse-item" href="<?= base_url('data-krs'); ?>"><i class="fas fa-fw fa-pen-alt"></i> Data Krs</a>
                    <a class="collapse-item" href="<?= base_url('data-prodi'); ?>"><i class="fas fa-fw fa-bookmark"></i> Data Prodi</a>
                    <a class="collapse-item" href="<?= base_url('data-perkuliahan'); ?>"><i class="fas fa-fw fa-book"></i> Data Perkuliahan</a>
                    <a class="collapse-item" href="<?= base_url('data-dosen'); ?>"><i class="fas fa-fw fa-user"></i> Data Dosen</a>
                </div>
            </div>
        </li>


        <hr class="sidebar-divider d-none d-md-block">

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('logout'); ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
<?php endif; ?>


<?php if ($this->session->userdata('id_role') == 2) : ?>
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar  sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#sika">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-book"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SIKA</div>
        </a>
        <div class="sidebar-heading mt-3">
            Menu mahasiswa
        </div>

        <!-- Divider -->
        <li class="nav-item <?= ($title === 'Home' ? 'active' : ''); ?>">
            <a class="nav-link" href="<?= base_url('users'); ?>">
                <i class="fas fa-fw fa-home"></i>
                <span>Home</span></a>
        </li>
        <li class="nav-item <?= ($title === 'Profile' ? 'active' : ''); ?> ">
            <a class="nav-link" href="<?= base_url('profile');  ?>">
                <i class="fas fa-fw fa-user"></i>
                <span>Profile</span></a>
        </li>
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Data perkuliahan
        </div>
        <li class="nav-item <?= ($title === 'Data mahasiswa' ? 'active' : ''); ?> ">
            <a class="nav-link" href="<?= base_url('data-diri'); ?>">
                <i class="fas fa-fw fa-address-book"></i>
                <span>Data Diri</span></a>
        </li>
        <li class="nav-item <?= ($title === 'Jadwal perkuliahan' ? 'active' : ''); ?> ">
            <a class="nav-link" href="<?= base_url('jadwal-perkuliahan'); ?>">
                <i class="fas fa-fw fa-calendar-check"></i>
                <span>Jadwal perkuliahan</span></a>
        </li>
        <li class="nav-item <?= ($title === 'Data KRS' ? 'active' : ''); ?> ">
            <a class="nav-link" href="<?= base_url('users/krs'); ?>">
                <i class="fas fa-fw fa-bookmark"></i>
                <span>Krs</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('logout'); ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
<?php endif; ?>