<section class="krs-container">
    <div class="box">
        <h3 class="h3 text-dark">Kartu Rencana Studi <strong>(KRS)</strong></h3>

        <div class="list-mhs">
            <ul>
                <li>Nama mahasiswa : <?= $user['nama']; ?></li>
                <li>Nim : <?= $user['nim']; ?></li>
                <li>Semester : <?= $user['semester']; ?></li>
                <li>Kode Kelas : <?= $user['kode_kelas']; ?> </li>
                <li>Tahun ajar : <?= $user['tahun']; ?></li>
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
            <div class="row">
                <?php foreach ($krs as $rows) : ?>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card" style="background-color:#fff; height: 250px; max-width: 100%;">
                            <div class="card-body">
                                <h5 class="card-title text-dark"><?= $rows['nama_mata_kuliah']; ?> / (<?= $rows['id_mata_kuliah']; ?>)</h5>
                                <hr>
                                <p><i class="fas fa-fw fa-book"></i> Kode matakuliah : <b><?= $rows['id_mata_kuliah']; ?></b></p>
                                <p style="margin-top: -15px;"><i class="fas fa-fw fa-book"></i> Matakuliah : <b><?= $rows['nama_mata_kuliah']; ?></b></p>
                                <p style="margin-top: -15px;"><i class="fas fa-fw fa-book"></i> SKS : <b><?= $rows['sks']; ?></b></p>
                                <p style="margin-top: -15px;"><i class="fas fa-fw fa-book"></i> Kode kelas : <b><?= $rows['kode_kelas']; ?></b></p>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif ?>
    </div>
</section>