<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->

    <div class="row">
        <div class="col-lg-8">
            <!-- Collapsable Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Kriteria</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample3">
                    <div class="card-body">

                        <?= form_open_multipart(); ?>
                        <input type="hidden" name="id_kriteria" value="<?= $kriteria['id_kriteria']; ?>">

                        <div class="form-group row">
                            <label for="nama_kriteria" class="col-sm-3 col-form-label">Nama Kriteria</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="<?= $kriteria['nama_kriteria']; ?>">
                                <?= form_error('nama_kriteria', ' <small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nilai_kriteria" class="col-sm-3 col-form-label">Nilai Kriteria</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nilai_kriteria" name="nilai_kriteria" value="<?= $kriteria['nilai_kriteria']; ?>">
                                <?= form_error('nilai_kriteria', ' <small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-info">Ubah</button>

                                <a href="<?= base_url('spk/kriteria'); ?>" class="btn btn-secondary">Kembali</a>
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