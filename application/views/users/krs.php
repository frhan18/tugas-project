<section class="krs-container">
    <div class="box">
        <h3 class="h3 text-dark">Kartu Rencana Studi <strong>(KRS)</strong></h3>

        <?php if (count($krs) <= 0) : ?>
            <div class="text-center pt-3 mt-3">Data KRS kamu belum tersedia.&#128522</div>
        <?php else : ?>
            <p>Halo, <?= $get_sesi_user['name']; ?> Kartu Rencana Studi kamu sudah tersedia.</p>
            <hr class="sidebar-divider">

            <div class="list-krs pt-3">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode MK</th>
                                        <th scope="col">Matakuliah</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">SKS</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Tahun Ajar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($krs as $k) : ?>
                                        <tr>
                                            <th scope="row" style="vertical-align: middle ;"><?= $no++; ?></th>
                                            <td style="vertical-align: middle ;"><?= $k['id_mata_kuliah']; ?></td>
                                            <td style="vertical-align: middle ;"><?= $k['nama_mata_kuliah']; ?></td>
                                            <td style="vertical-align: middle ;"><?= $k['kode_kelas']; ?></td>
                                            <td style="vertical-align: middle ;"><?= $k['semester']; ?></td>
                                            <td style="vertical-align: middle ;"><?= $k['sks']; ?></td>
                                            <td style="vertical-align: middle ;"><?= $k['nama_prodi']; ?></td>
                                            <td style="vertical-align: middle ;"><?= $k['tahun']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>

</section>