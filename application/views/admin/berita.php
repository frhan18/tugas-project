<div class="berita-container">

    <div class="box">
        <div class="berita-info">
            <div class="row">
                <div class="col-xl-8 col-md-10 col-sm-10">
                    <h3 class="text-dark h3">Halo , <?= $get_sesi_user['name']; ?></h3>
                    <p>Buat berita terbaru dan menarik untuk halaman dashboard user</p>
                    <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#buat_berita_modal">Tambah Berita Baru <i class="fas fa-plus"></i></a>
                </div>
            </div>
            <hr class="sidebar-divider">
        </div>

        <div class="list-berita">
            <div class="row">
                <div class="col-lg-12 col-sm-10">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Status</th>
                                    <th>created_at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($berita as $rows) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $rows['judul_berita']; ?></td>
                                        <td><?= $rows['penulis']; ?></td>
                                        <td><?= $rows['is_active'] == 1 ? 'Diterbitkan' : 'Draft'; ?></td>
                                        <td><?= date('D m Y, H:i:s',  $rows['created_at']); ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="javascript:void(0)" data-delete-url="<?= site_url('post/delete-post/' . htmlentities($rows['id_berita'])); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                <a href="javascript:void(0)" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#edit_berita_modal<?= $rows['id_berita']; ?>"><i class="fas fa-edit"></i></a>
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




<div class="modal fade" id="buat_berita_modal" tabindex="-1" aria-labelledby="buat_berita_modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buat_berita_modalLabel">Tambah berita baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('post/post-new') ?>
                <div class="form-group row">
                    <label for="judul_berita" class="col-sm-3 col-form-label">Judul berita</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('judul_berita') ? 'is-invalid' : ''; ?>" value="<?= htmlentities(set_value('judul_berita')); ?>" name="judul_berita" id="judul_berita" required>
                        <div class="invalid-feedback"><?= form_error('judul_berita'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="penulis" class="col-sm-3 col-form-label">Penulis</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control <?= form_error('penulis') ? 'is-invalid' : ''; ?>" value="<?= htmlentities($get_sesi_user['name']); ?>" name="penulis" id="penulis" required>
                        <div class="invalid-feedback"><?= form_error('penulis'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="content" class="col-sm-3 col-form-label">Kontent</label>
                    <div class="col-sm-9">
                        <div>
                            <input type="hidden" name="content" value="<?= set_value('content') ?>">
                            <div id="editor" style="min-height: 160px;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" value="0" name="is_active" class="btn btn-dark"><i class="fas fa-save"></i> Simpan ke draft </button>
                    <button type="submit" value="1" name="is_active" class="btn btn-dark"><i class="fas fa-save"></i> Terbitkan </button>
                </div>

                <?= form_close(); ?>

            </div>

        </div>
    </div>
</div>



<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php if ($this->session->flashdata('berita_berhasil')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= $this->session->flashdata('berita_berhasil'); ?>',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
<?php endif; ?>


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


<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{
                    header: [1, 2, 3, 4, 5, 6, false]
                }],
                [{
                    font: []
                }],
                ["bold", "italic"],
                ["link", "blockquote", "code-block", "image"],
                [{
                    list: "ordered"
                }, {
                    list: "bullet"
                }],
                [{
                    script: "sub"
                }, {
                    script: "super"
                }],
                [{
                    color: []
                }, {
                    background: []
                }],
            ]
        },
    });
    quill.on('text-change', function(delta, oldDelta, source) {
        document.querySelector("input[name='content']").value = quill.root.innerHTML;
    });
</script>