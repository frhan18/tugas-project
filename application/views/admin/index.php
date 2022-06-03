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
                <div class="col-lg-10 col-md-10 col-sm-10">

                    <div class="row justify-content-arround">
                        <div class="col-lg-8 col-md-6">
                            <h5 class="mb-4 text-dark">Akun terdaftar di tahun <b style="text-decoration: underline;"><?= date('Y'); ?></b></h5>
                            <p class="info" style="margin-top: -15px;">Jumlah pengguna : <?= $count_all_user; ?></p>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <form action="" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Cari pengguna" name="pengguna">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="list-account">
                        <div class="table-responsive">
                            <table class="table table-stripped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created</th>
                                        <th scope="col"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($user as $rows) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $rows['email']; ?></td>
                                            <td><?= $rows['name']; ?></td>
                                            <td>
                                                <?php if ($rows['role_id'] == 1 || $rows['role_id'] == 6) : ?>
                                                    <p class="text-bold text-dark">Admin</p>
                                                <?php else : ?>
                                                    <p>Mahasiswa</p>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($rows['is_active'] == 1) : ?>
                                                    <p class="text-success">Aktif</p>
                                                <?php else : ?>
                                                    <p class="text-success">Tidak aktif</p>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= date('d-M-Y',  $rows['date_created']); ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="javascript:void(0)" data-delete-url="<?= site_url('dashboard/account-delete/' . $rows['id_user']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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



    <div class="box">

        <div class="account-container p-3">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10">

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
                            <table class="table table-stripped">
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
                                    foreach ($user as $rows) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $rows['email']; ?></td>
                                            <td><?= $rows['name']; ?></td>
                                            <td>Ilmu komputer</td>
                                            <td>

                                            </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="javascript:void(0)" data-delete-url="" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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



    <div class="box">

        <div class="blog-container p-3">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <h4 class="mb-4 text-dark">Publish post <i class="fas fa-blog"></i> </h4>
                    <hr class="sidebar-divider">

                    <?php if (count($berita) <= 0) : ?>

                        <div class="text-center pt-2">
                            Belum menambahkan berita.
                        </div>

                    <?php endif; ?>

                    <div class="list-blog">
                        <div class="row justify-content-arround">
                            <?php foreach ($berita as $post) : ?>
                                <?php if ($post['penulis'] == $get_sesi_user['name']) : ?>
                                    <?php if ($post['is_active'] == 1) : ?>
                                        <div class="col-lg-4 col-md-6 col-sm-10">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= $post['judul_berita']; ?></h5>
                                                    <h6 class="card-subtitle mb-2 text-muted">Di terbitkan <?= date('d M Y', $post['created_at']); ?></h6>
                                                    <p class="card-text"><?= $post['content']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
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