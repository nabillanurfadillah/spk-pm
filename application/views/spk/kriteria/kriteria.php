<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg-6">
        <?= form_error('kriteria', '<div class="alert
                    alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>
            <a href="<?= base_url('spk/tambahkriteria'); ?>" class="btn btn-secondary mb-3">Tambah Data</a>
            <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Kriteria</th>
                        <th scope="col">Persentase</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($kriteria as $k) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $k['nama_kriteria']; ?></td>
                            <td><?= $k['nilai_kriteria']; ?></td>


                            <td>
                                <a href="<?= base_url() ?>spk/editkriteria/<?= $k['id_kriteria']; ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url() ?>spk/hapuskriteria/<?= $k['id_kriteria']; ?>" class="badge badge-danger tombol-hapus">delete</a>
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
<!-- Modal -->


<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Tambah Nilai Preferensi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('administrator/nilai'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">

                        <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Keterangan Nilai">
                    </div>
                    <div class="form-group">

                        <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Jumlah Nilai">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>