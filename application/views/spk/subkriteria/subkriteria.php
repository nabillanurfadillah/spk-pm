<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
   
    <div class="row">
        <div class="col-lg-12">
        <?= form_error('subkriteria', '<div class="alert
        alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>
            <a href="<?= base_url('spk/tambahsubkriteria'); ?>" class="btn btn-secondary mb-3">Tambah Data</a>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Nama Sub Kriteria</th>
                            <th scope="col">Factor</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php
                    $query = "SELECT subkriteria.id_subkriteria,kriteria.id_kriteria, subkriteria.nama_subkriteria, subkriteria.faktor, subkriteria.nilai_subkriteria, kriteria.nama_kriteria FROM subkriteria INNER JOIN kriteria ON subkriteria.id_kriteria = kriteria.id_kriteria";
                    $datasubkriteria = $this->db->query($query)->result_array();
                    ?>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($subkriteria as $sk) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $sk['nama_kriteria']; ?></td>
                                <td><?= $sk['nama_subkriteria']; ?></td>
                                <td><?= $sk['faktor']; ?></td>
                                <td><?= $sk['nilai_subkriteria']; ?></td>
                                <td>
                                    <a href="<?= base_url() ?>spk/editsubkriteria/<?= $sk['id_subkriteria']; ?>" class="badge badge-success">edit</a>
                                    <a href="<?= base_url() ?>spk/hapussubkriteria/<?= $sk['id_subkriteria']; ?>" class="badge badge-danger tombol-hapus-subkriteria">delete</a>
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