<div class="dashboard-container">

    <div class="box">
        <div class="text-informasi">
            <div class="row">
                <div class="col-xl-8 col-md-10 col-sm-10">
                    <h3 class="text-dark h3">Halo , <?= $get_sesi_user['name']; ?></h3>
                    <p class="text-dark ">Selamat datang di sistem informasi akademik kampus kita / <b>SIKA</b>.</p>
                    <p class="text-dark ">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste rem exercitationem magni eos dolor voluptatibus ducimus, asperiores at voluptatem reprehenderit!</p>
                </div>
            </div>
        </div>
        <hr class="sidebar-divider">

        <div class="berita-terbaru pt-3 mt-3">
            <div class="berita-info-text mb-3">
                <h3 class="h3 text-dark">
                    Berita terkini <i class="fas fa-fw fa-blog"></i>
                </h3>
            </div>
            <div class="row">
                <div class="col-xl-10">
                    <div class="list-berita">
                        <div class="row justify-content-arround">
                            <?php foreach ($berita as $rows) : ?>
                                <?php if ($rows['is_active'] == 1) : ?>
                                    <div class="col-lg-4 col-md-10 col-sm-10 ">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="content-info-berita">
                                                    <h5 class="card-title text-dark font-weight-bold"><?= $rows['judul_berita']; ?></h5>
                                                    <p class="info-penulis small">Ditulis oleh, <strong><?= $rows['penulis']; ?>.</strong> <em> <?= date('d M Y', $rows['created_at']); ?> </em></p>
                                                </div>
                                                <div class="content-berita">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam minus quidem quod exercitationem quibusdam ratione voluptates ipsum optio ex inventore ea vitae iste eum sint esse aspernatur tempore nisi atque, illo accusantium fugit similique repudiandae accusamus! Earum sed quibusdam mollitia tenetur vel eligendi, amet nostrum unde doloribus harum ipsa reiciendis.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>