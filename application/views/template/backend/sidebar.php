<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #3a3a3a;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-graduate"></i>
        </div>
        <div class="sidebar-brand-text mx-3">My app.com</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Administrator
    </div>
    <li class="nav-item active">
        <a class="nav-link" href="<?= site_url('admin'); ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-user-edit"></i>
            <span>Edit Profile</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management Data
    </div>

    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Master</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu:</h6>
                <a class="collapse-item" href="<?= site_url('admin-mahasiswa'); ?>">Mahasiswa</a>
                <a class="collapse-item" href="<?= site_url('admin-matakuliah'); ?>">Matakuliah</a>
                <a class="collapse-item" href="<?= site_url('admin-prodi'); ?>">Prodi</a>
                <a class="collapse-item" href="<?= site_url('admin-ruang'); ?>">Ruang</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-users"></i>
            <span>User Account</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-fw fa-cog"></i>
            <span>Setting</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->