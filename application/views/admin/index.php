<!-- Page Heading -->
<div class="dashboard-container">

    <div class="box">
        <div class="dashboard-text p-3">
            <h1 class="h3 mb-4 text-dark">Selamat Datang kembali, <?= isset($get_sesi_user['name']) ? $get_sesi_user['name'] : 'Users'; ?></h1>
        </div>
        <hr class="divider-sidebar">

        <div class="dashboard-list-data">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card   h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                        TOTAL MAHASISWA</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_all_mahasiswa; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-graduate fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card   h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                        TOTAL DOSEN</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_all_dosen; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-chalkboard-teacher fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card   h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                        MATAKULIAH</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_all_matakuliah; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card   h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                        Prodi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_all_prodi; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-book-open fa-3x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="activity-user pt-3">
            <div class="row">
                <div class="col">
                    <h3 class="h3 text-dark">Aktifitas user</h3>
                    <div class="activity-list">

                    </div>
                </div>
            </div>
        </div>
    </div>







</div>