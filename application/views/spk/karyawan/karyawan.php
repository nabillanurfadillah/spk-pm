<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">
        <?= form_error('karyawan', '<div class="alert
                    alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>
            <a href="<?= base_url('spk/tambahkaryawan'); ?>" class="btn btn-secondary mb-3">Tambah Data</a>
            <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Karyawan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($karyawan as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $k['nama_karyawan']; ?></td>
                            <td>
                                <a href="<?= base_url() ?>spk/editkaryawan/<?= $k['id_karyawan']; ?>" class="badge badge-success">edit</a>
                                <a href="" class="badge badge-danger" data-toggle="modal" data-target="#hapusKaryawanModal<?= $k['id_karyawan']; ?>">delete</a>

                                    <div class="modal fade" id="hapusKaryawanModal<?= $k['id_karyawan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Karyawan</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('spk/hapuskaryawan'); ?>" method="post">
                                                    <input type="hidden" name="id_karyawan" value="<?= $k['id_karyawan'] ?>">
                                                    <div class="modal-body">Apakah ingin menghapus <?= $k['nama_karyawan']; ?> ?</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                        <button class="btn btn-primary">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                            </td>

                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->