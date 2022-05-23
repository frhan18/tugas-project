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


<div class="wrapper">
    <!-- Page Heading -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background: #3a3a3a;">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Prodi</li>
        </ol>
    </nav>

    <div class="add-modal-btn mb-3">
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_tambah" aria-pressed="false">
            <i class="fas fa-plus"></i> Add New Data
        </button>
    </div>

    <div class="list-content">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID (Prodi)</th>
                                <th>Prodi</th>
                                <th>Akreditasi</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($prodi as $rows) : ?>
                                <tr>
                                    <td><?= $rows['id_prodi']; ?></td>
                                    <td><?= $rows['nama_prodi']; ?></td>
                                    <td><?= $rows['akreditasi']; ?></td>
                                    <td><?= $rows['tahun']; ?></td>
                                    <td><?= $rows['is_active'] ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" data-delete-url="<?= site_url('admin-prodi/delete/' . $rows['id_prodi']); ?>" onclick="deleteConfirm(this)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            <button type="button" class="btn btn-warning btn-sm ml-1" data-toggle="modal" data-target="#modal_update<?= $rows['id_prodi']; ?>"><i class="fas fa-edit"></i></button>
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



<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteConfirm(event) {
        Swal.fire({
            title: 'Delete Confirmation!',
            text: 'Are you sure to delete the item?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'No',
            confirmButtonText: 'Yes Delete',
            confirmButtonColor: 'red'
        }).then(dialog => {
            if (dialog.isConfirmed) {
                window.location.assign(event.dataset.deleteUrl);
            }
        });
    }
</script>