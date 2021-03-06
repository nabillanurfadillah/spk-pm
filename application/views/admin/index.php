<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Kriteria</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $kriteria ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas  fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('spk/kriteria'); ?>" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Lihat Detail Kriteria</span>
                </a>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Sub Kriteria</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $subkriteria ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas  fa-file-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('spk/subkriteria'); ?>" class="btn btn-warning btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Lihat Detail Sub Kriteria</span>
                </a>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Karyawan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $karyawan ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas  fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('spk/karyawan'); ?>" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Lihat Detail Sub Kriteria</span>
                </a>
            </div>
        </div>

        </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->