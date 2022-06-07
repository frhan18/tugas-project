<!-- Page Heading -->
<div class="dashboard-container">

    <div class="box">
        <div class="dashboard-text ">
            <h1 class="h3 mb-4 text-dark">Halo , <?= isset($get_sesi_user['name']) ? $get_sesi_user['name'] : 'Users'; ?></h1>
            <p class="text-dark">Selamat datang di sistem informasi akademik kampus kita / SIKA.</p>
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
                                        TOTAL MATAKULIAH</div>
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
                                        TOTAL Prodi</div>
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


    </div>

    <div class="box">
        <div class="row">
            <div class="col p-3">

                <div class="info">
                    <h3 class="text-dark">Mahasiswa Yang Terdaftar</h3>
                </div>

                <hr class="sidebar-divider">


                <div class="list-data">
                    <div class="table-responsive">
                        <table class="table table-stripped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Nim</th>
                                    <th>Email</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tahun Masuk</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $no = 1;
                                foreach ($mahasiswa as $rows) : ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?= $no++; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['nama']; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['nim']; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['email']; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                        <td style="vertical-align: middle;"><?= $rows['tahun_masuk']; ?></td>
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


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteConfirm(event) {
        Swal.fire({
            title: 'Delete Confirmation!',
            text: 'Apakah anda yakin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Nanti dulu',
            confirmButtonText: 'Ya, yakin',
            confirmButtonColor: 'red'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.deleteUrl);
            }
        });
    }
</script>