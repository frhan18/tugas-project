<section class="krs-container">
    <div class="box">
        <h3 class="h3 text-dark">Kartu Rencana Studi <strong>(KRS)</strong></h3>

        <div class="list-mhs">
            <ul>
                <li>Nim : <?= $user['nim']; ?></li>
                <li>Nama mahasiswa : <?= $user['nama']; ?></li>
                <li>Kelas : <?= $user['kode_kelas']; ?> </li>
                <li>Tahun : <?= $user['tahun']; ?></li>
            </ul>
        </div>

    </div>
    <div class="box">
        <?php if (count($krs) <= 0) : ?>
            <div class="text-center mb-3">
                <h3 class="text-dark">DATA KRS BELUM TERSEDIA</h3>
            </div>
        <?php else : ?>
            <div class="text-center mb-3">
                <h3 class="text-dark">DATA KRS TERSEDIA <i class="fas fa-fw fa-bookmark"></i></h3>
            </div>
            <div class="row p-1">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kd_matakuliah</th>
                                    <th scope="col">Matakuliah</th>
                                    <th scope="col">Sks</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Kode kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($krs as $rows) : ?>
                                    <tr>
                                        <th scope="row"><?= $no++; ?></th>
                                        <td><?= $rows['id_mata_kuliah']; ?></td>
                                        <td><?= $rows['nama_mata_kuliah']; ?></td>
                                        <td><?= $rows['sks']; ?></td>
                                        <td><?= $rows['semester']; ?></td>
                                        <td><?= $rows['kode_kelas']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>