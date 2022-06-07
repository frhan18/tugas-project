<div class="detail-kelas-container">
    <div class="box">
        <div class="row">
            <div class="col">
                <div class="detail-info p-2">
                    <h3 class="text-dark">Detail anggota kelas <strong><?= $kelas_id; ?></strong></h3>
                </div>
                <hr class="sidebar-divider">
                <?php if (count($kelas_where) <= 0) : ?>
                    <div class="text-center">
                        Data kelas tidak tersedia&#129300.
                    </div>
                <?php else : ?>
                    <div class="list p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode kelas</th>
                                        <th>Nim</th>
                                        <th>Nama</th>
                                        <th>jenis_kelamin</th>
                                        <th>Tahun masuk</th>

                                    </tr>
                                </thead>

                                <tbody>


                                    <?php
                                    $no = 1;
                                    foreach ($kelas_where as $kelas) : ?>
                                        <tr>
                                            <td style="vertical-align: middle;"><?= $no++; ?></td>
                                            <td style="vertical-align: middle;"><?= $kelas['kode_kelas']; ?></td>
                                            <td style="vertical-align: middle;"><?= $kelas['nim']; ?></td>
                                            <td style="vertical-align: middle;"><?= $kelas['nama']; ?></td>
                                            <th style="vertical-align: middle;"><?= $kelas['jenis_kelamin'] ? 'Laki Laki' : 'Perempuan'; ?></th>
                                            <th style="vertical-align: middle;"><?= $kelas['tahun_masuk']; ?></th>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>