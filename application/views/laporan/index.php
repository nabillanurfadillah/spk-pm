<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->


  <div class="row">
    <div class="col-lg-12">


      <!-- Collapsable Card Example -->
      <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
          <h6 class="m-0 font-weight-bold text-primary">Nilai</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardExample1">
          <div class="card-body">
            <?= form_error('penilaian', '<div class="alert
                    alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>
            <div class="table-responsive">
              <table class="table table-sm table-hover table-bordered" id="display1">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Karyawan</th>
                    <th scope="col">Kriteria</th>
                    <th scope="col">Sub Kriteria</th>
                    <th scope="col">Nilai</th>
                    <th scope="col">Selisih</th>
                    <th scope="col">Nilai Gap</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($penilaian as $p) : ?>
                    <tr>
                      <th class="text-center" scope="row"><?= $i ?></th>
                      <td><?= $p['nama_karyawan']; ?></td>
                      <td><?= $p['nama_kriteria']; ?></td>
                      <td><?= $p['nama_subkriteria']; ?></td>
                      <td><?= $p['nilai']; ?></td>
                      <td><?= $p['selisih']; ?></td>
                      <td><?= $p['nilai_gap']; ?></td>

                    </tr>
                    <?php $i++; ?>
                  <?php endforeach; ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <!-- Collapsable Card Example -->
          <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
              <h6 class="m-0 font-weight-bold text-primary">Nilai Rata - Rata Per Faktor</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample2">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-sm table-hover table-bordered" id="display2">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Karyawan</th>
                        <th scope="col">Kriteria</th>
                        <th scope="col">Fakor</th>
                        <th scope="col">Rata - Rata</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ($hitung as $h) : ?>
                        <tr>
                          <th class="text-center" scope="row"><?= $i ?></th>
                          <td><?= $h['nama_karyawan']; ?></td>
                          <td><?= $h['nama_kriteria']; ?></td>
                          <td><?= $h['faktor']; ?></td>
                          <td><?= $h['rata_rata']; ?></td>
                        </tr>
                        <?php $i++; ?>
                      <?php endforeach; ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <!-- Collapsable Card Example -->
          <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
              <h6 class="m-0 font-weight-bold text-primary">Nilai Total & Akhir</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample3">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-sm table-hover table-bordered" id="display3">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Karyawan</th>
                        <th scope="col">Kriteria</th>
                        <th scope="col">Nilai Total</th>
                        <th scope="col">Nilai Akhir</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ($nilaiakhir as $na) : ?>
                        <tr>
                          <th class="text-center" scope="row"><?= $i ?></th>
                          <td><?= $na['nama_karyawan']; ?></td>
                          <td><?= $na['nama_kriteria']; ?></td>
                          <td><?= $na['nilai_total']; ?></td>
                          <td><?= $na['nilai_akhir']; ?></td>
                        </tr>
                        <?php $i++; ?>
                      <?php endforeach; ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <!-- Collapsable Card Example -->
          <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
              <h6 class="m-0 font-weight-bold text-primary">Rangking Karyawan</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-sm table-hover table-bordered " id="display4">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Karyawan</th>
                        <th scope="col">Rangking</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $karyawan = $this->db->join('rangking', 'rangking.id_karyawan = karyawan.id_karyawan')->order_by('nilai_rangking', 'desc')->get('karyawan')->result_array();

                      ?>
                      <?php $i = 1; ?>
                      <?php foreach ($karyawan as $k) : ?>
                        <tr>
                          <th class="text-center" scope="row"><?= $i ?></th>
                          <td><?= $k['nama_karyawan']; ?></td>
                          <td><?= round($k['nilai_rangking'], 2); ?></td>


                        </tr>
                        <?php $i++; ?>
                      <?php endforeach; ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->