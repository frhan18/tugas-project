<!-- Page Heading -->
<section class="dashboard-container">
    <h1 class="h3 mb-4 text-dark">Selamat Datang , <?= isset($get_sesi_user['name']) ? $get_sesi_user['name'] : 'Users'; ?></h1>
    <div class="text-inner">
        <div class="row">
            <div class="col-xl-8">
                <p class="text-dark">Kelola semua data dan kontrol segala aktifitas</p>

            </div>
        </div>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card  shadow h-100 py-2">
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
            <div class="card  shadow h-100 py-2">
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
            <div class="card  shadow h-100 py-2">
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
            <div class="card  shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                KRS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_all_matakuliah; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bookmark fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="divider-sidebar">

    <div class="box">
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <h1 class="h3 mb-4 text-white">User Account <i class="fas fa-users px-2 "></i></h1>
                    <p>User registered : <?= $count_all_user; ?></p>

                    <div class="list-user">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Create</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $no = 1;
                                    foreach ($user as $rows) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $rows['name']; ?></td>
                                            <td><?= $rows['email']; ?></td>
                                            <td>
                                                <?= $rows['role_id'] == 1 ? 'Admin' : 'Mahasiswa'; ?>
                                            </td>
                                            <td><?= $rows['is_active'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                            <td><?= date('d M Y H:i:s', $rows['date_created']); ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary btn-sm">Detail</button>
                                                </div>
                                            </td>
                                        </tr>


                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</section>