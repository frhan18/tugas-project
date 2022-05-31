<div class="jadwal-kuliah-container">
    <div class="box">
        <div class="row">
            <div class="col">
                <h3 class="jdwl-title p-2">Jadwal perkuliahan</h3>
                <p class="p-2">Halo, <b><?= $get_sesi_user['name']; ?></b> jadwal kuliah kamu sudah tersedia</p>
                <hr class="sidebar-divider">
                <?php if (count($perkuliahan) <= 0) : ?>
                    <div class="text-center">
                        <h3 class="text-dark pt-3 h3">Maaf Jadwal perkuliahan tidak tersedia</h3>
                    </div>
                <?php else : ?>
                    <div class="list-jadwal pt-3 mt-3">
                        <div class="row p-2">
                            <?php foreach ($perkuliahan as $kuliah) : ?>
                                <div class="col-lg-4 col-md-6 col-sm-10">
                                    <div class="card mb-3" style="height: 280px; max-width:100%;">
                                        <div class="card-body">
                                            <h5 class="card-title text-dark font-weight-bold"><?= $kuliah['nama_mata_kuliah']; ?> (<?= $kuliah['id_mata_kuliah']; ?>)</h5>
                                            <hr>
                                            <p class="text-dark"><i class="fas fa-fw fa-book-open"></i> Kode matakuliah <strong><?= $kuliah['id_mata_kuliah']; ?></strong></p>
                                            <p class="text-dark" style="margin-top: -15px;"><i class="fas fa-fw fa-book"></i> Matakuliah <strong><?= $kuliah['nama_mata_kuliah']; ?></strong></p>
                                            <p class="text-dark" style="margin-top: -15px;"><i class="fas fa-fw fa-building"></i> Kode kelas <strong><?= $kuliah['kode_kelas']; ?></strong></p>
                                            <p class="text-dark" style="margin-top: -15px;"><i class="fas  fa-fw fa-calendar-day"></i> Hari <strong><?= $kuliah['hari']; ?></strong></p>
                                            <p class="text-dark" style="margin-top: -15px;"><i class="fas fa-fw fa-clock"></i> Waktu <strong><?= $kuliah['waktu_mulai']; ?> - <?= $kuliah['waktu_selesai']; ?></strong></p>
                                            <p class="text-dark" style="margin-top: -15px;"><i class="fas fa-fw fa-user"></i> Dosen <strong><?= $kuliah['nama']; ?></strong></p>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>