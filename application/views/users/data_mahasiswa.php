<div class="jadwal-kuliah-container">


    <div class="box">
        <div class="row">
            <div class="col">
                <h3 class="jdwl-title p-2">Data Diri Mahasiswa</h3>
                <p class="p-2">Halo, <b><?= $get_sesi_user['name']; ?></b> Berikut kami tampilkan data diri anda.</p>
                <hr class="sidebar-divider">
                <header id="header">
                    <?php if ($this->session->flashdata('message_success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('message_success'); ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-sm-10 col-md-10">
                        <div class="list-data p-2">

                            <?= form_open('data-diri/update/' . $get_sesi_user['id_user']); ?>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-3 col-form-label ">Nama Lengkap:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control " name="nama" id="nama" value="<?= $mahasiswa['nama'] ? $mahasiswa['nama'] : set_value('nama'); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label ">Email:</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control " name="email" id="email" value="<?= $mahasiswa['email'] ? $mahasiswa['email'] : "@gmail.com"; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tempat_tanggal_lahir" class="col-sm-3 col-form-label ">Ttl:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control " name="tempat_tanggal_lahir" id="tempat_tanggal_lahir" value="<?= $mahasiswa['tempat_tanggal_lahir'] ? $mahasiswa['tempat_tanggal_lahir'] : set_value('tempat_tanggal_lahit'); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jenis_kelamin" class="col-sm-3 col-form-label ">Jenis kelamin:</label>
                                <div class="col-sm-9">
                                    <!-- <input type="text" class="form-control " name="jenis_kelamin" id="jenis_kelamin" value="<?= $mahasiswa['jenis_kelamin'] == 'L' ? 'Laki Laki' : 'Perempuan'; ?>"> -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin1" value="L" <?php if ($mahasiswa['jenis_kelamin'] == 'L') echo 'checked'; ?>>
                                        <label class="form-check-label" for="jenis_kelamin1">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jenis_kelamin" value="P" <?php if ($mahasiswa['jenis_kelamin'] == 'P') echo 'checked'; ?>>
                                        <label class="form-check-label" for="jenis_kelamin">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="agama" class="col-sm-3 col-form-label ">Agama:</label>
                                <div class="col-sm-9">
                                    <!-- <input type="text" class="form-control " name="agama" id="agama" value="<?= $mahasiswa['agama'] ? $mahasiswa['agama'] : set_value('agama'); ?> "> -->
                                    <select class="custom-select" name="agama" required>
                                        <option selected value="">Pilih</option>
                                        <?php $agama = ['Islam', 'Kristen', 'Khonghucu']; ?>
                                        <?php foreach ($agama as $ag) : ?>
                                            <option value="<?= $ag; ?>" <?php if ($mahasiswa['agama'] == $ag)  echo 'selected' ?>><?= $ag; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-3 col-form-label ">Alamat:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control " name="alamat" id="alamat" value="<?= $mahasiswa['alamat'] ? $mahasiswa['alamat'] : set_value('alamat'); ?>">
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-dark">Perbarui Data</button>
                                </div>
                            </div>
                            <?= form_close(); ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>