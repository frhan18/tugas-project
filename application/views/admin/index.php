<!-- Page Heading -->
<div class="dashboard-container">

    <div class="box">
        <div class="dashboard-text ">
            <h1 class="h3 mb-4 text-dark">Selamat Datang , <?= isset($get_sesi_user['name']) ? $get_sesi_user['name'] : 'Users'; ?></h1>
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

        <div class="account-container p-3">
            <div class="row">
                <div class="col">

                    <div class="row justify-content-arround">
                        <div class="col-lg-8 col-md-6">
                            <h5 class="mb-4 text-dark">Mahasiswa terdaftar </b></h5>
                            <p class="info" style="margin-top: -15px;">Jumlah mahasiswa : <?= $count_all_mahasiswa; ?></p>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <form action="" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cari mahasiswa" name="pengguna">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="list-account">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nim</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($mahasiswa as $rows) : ?>

                                        <tr>
                                            <th scope="row" style="vertical-align: middle;"><?= $no++; ?></th>
                                            <td style="vertical-align: middle;"><?= $rows['nama']; ?></td>
                                            <td style="vertical-align: middle;"><?= $rows['nim']; ?></td>
                                            <td style="vertical-align: middle;"><?= $rows['nama_prodi']; ?></td>
                                            <td style="vertical-align: middle;">
                                                <?= $rows['status_mhs'] ? 'Aktif' : 'Tidak aktif'; ?>
                                            </td>
                                            <td style="vertical-align: middle;">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="javascript:void(0)" data-delete-url="<?= base_url('dashboard/mahasiswa/delete/' . $rows['nim']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger "><i class="fas fa-trash"></i></a>
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