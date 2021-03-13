<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">Tambah Penilaian</h1> -->

    <div class="row">
        <div class="col-lg-8">
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Penilaian</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample3">
                    <div class="card-body">
                        <?= form_open_multipart('spk/tambahpenilaian'); ?>
                        <div class="form-group row">
                            <label for="id_karyawan" class="col-sm-6 col-form-label">Pilih Karyawan</label>
                            <div class="col-sm-6">
                                <select name="id_karyawan" id="id_karyawan" class="form-control col-sm-9" required>
                                    <option value="">--Pilih Karyawan--</option>
                                    <?php foreach ($karyawan as $ka) : ?>

                                        <option value="<?= $ka['id_karyawan'] ?>"><?= $ka['nama_karyawan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <?php

                        $query = "SELECT nama_subkriteria , id_subkriteria from subkriteria";
                        $querk = "SELECT nama_kriteria , id_kriteria from kriteria";

                        $que = $this->db->query($query)->result_array();
                        $queryk = $this->db->query($querk)->result_array();
                        ?>
                        <?php foreach ($queryk as $qk) : ?>
                            <h5> <span class="badge m-0 font-weight-bold  badge-secondary"><?= $qk['nama_kriteria']; ?></span> </h5>

                            <?php
                            $id_kriteria = $qk['id_kriteria'];
                            $querySubkriteria =  "SELECT *
                                FROM subkriteria JOIN kriteria
                                ON subkriteria.id_kriteria = kriteria.id_kriteria
                                WHERE subkriteria.id_kriteria = $id_kriteria";

                            $subkriteria = $this->db->query($querySubkriteria)->result_array();
                            ?>

                            <?php foreach ($subkriteria as $q) : ?>
                                <div class="form-group row">
                                    <label for="subkriteria<?= $q['id_subkriteria'] ?>" name="subkriteria<?= $q['id_subkriteria'] ?>" class="col-sm-6 col-form-label"><?= $q['nama_subkriteria']; ?></label>
                                    <div class="col-sm-6">
                                        <select name="nilai<?= $q['id_subkriteria'] ?>" id="nilai<?= $q['id_subkriteria'] ?>" class="form-control col-sm-9" required>
                                            <option value="">--Pilih Nilai--</option>
                                            <option value="5">5-Sangat Baik</option>
                                            <option value="4">4-Baik</option>
                                            <option value="3">3-Cukup</option>
                                            <option value="2">2-Kurang</option>
                                            <option value="1">1-Sangat Kurang</option>
                                        </select>
                                    </div>
                                </div>
                            <?php endforeach; ?>


                        <?php endforeach; ?>


                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-info">Tambah</button>
                                <a href="<?= base_url('spk/subkriteria'); ?>" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->