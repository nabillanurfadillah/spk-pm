<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Subkriteria</h1>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart(); ?>
            <div class="form-group row">
                <label for="id_kriteria" class="col-sm-3 col-form-label">Pilih Kriteria</label>
                <div class="col-sm-9">
                    <select name="id_kriteria" id="id_kriteria" class="form-control col-sm-9">
                        <?php foreach ($kriteria as $k) : ?>
                            <?php if ($k['id_kriteria'] == $subkriteria['id_kriteria']) : ?>
                                <option value="<?= $k['id_kriteria'] ?>" selected><?= $k['nama_kriteria'] ?></option>
                            <?php else : ?>
                                <option value="<?= $k['id_kriteria'] ?>"><?= $k['nama_kriteria'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_subkriteria" class="col-sm-3 col-form-label">Nama Subkriteria</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="nama_subkriteria" name="nama_subkriteria" value="<?= $subkriteria['nama_subkriteria']; ?>">
                    <?= form_error('nama_subkriteria', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="faktor" class="col-sm-3 col-form-label">Factor</label>
                <div class="col-sm-9">
                    <select name="faktor" id="faktor" class="form-control col-sm-9">
                        <?php foreach ($faktor as $f) : ?>
                            <?php if ($f == $subkriteria['faktor']) : ?>
                                <option value="<?= $f; ?>" selected><?= $f; ?></option>
                            <?php else : ?>
                                <option value="<?= $f; ?>"><?= $f; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nilai_subkriteria" class="col-sm-3 col-form-label">Nilai Subkriteria</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" id="nilai_subkriteria" name="nilai_subkriteria" value="<?= $subkriteria['nilai_subkriteria']; ?>">
                    <?= form_error('nilai_subkriteria', ' <small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <?php
            $query = "SELECT subkriteria.id_subkriteria,kriteria.id_kriteria, subkriteria.nama_subkriteria, subkriteria.faktor, subkriteria.nilai_subkriteria FROM subkriteria INNER JOIN kriteria ON subkriteria.id_kriteria = kriteria.id_kriteria";
            $datasubkriteria = $this->db->query($query)->result_array();
            // var_dump($datakriteria);
            // die;
            ?>
            <div class="form-group row justify-content-end">
                <div class="col-sm-9">
                    <button type="submit" class="btn btn-info">Ubah</button>
                    <a href="<?= base_url('spk/subkriteria'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->