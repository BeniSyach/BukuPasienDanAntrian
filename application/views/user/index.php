<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Penyebaran Virus Corona Di Sumatera Utara</h1>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <?php foreach ($provinsi as $prov) : ?>
            <?php if ($prov['attributes']['Kode_Provi'] == 12) : ?>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        TOTAL POSITIF</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $prov['attributes']['Kasus_Posi'] ?></div>
                                    <div class="h7 mb-0 font-weight-bold text-gray-800">Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-frown fa-5x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        TOTAL SEMBUH</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $prov['attributes']['Kasus_Semb'] ?></div>
                                    <div class="h7 mb-0 font-weight-bold text-gray-800">Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-grin-beam fa-5x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">TOTAL MENINGGAL
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $prov['attributes']['Kasus_Meni'] ?></div>
                                            <div class="h7 mb-0 font-weight-bold text-gray-800">Orang</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-sad-tear fa-5x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else : ?>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Pending Requests Card Example -->
        <?php foreach ($indonesia as $indo) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    DI INDONESIA</div>
                                <div class="h9 mb-0 font-weight-bold text-gray-800"><?= $indo['positif'] ?> Positif <?= $indo['sembuh'] ?> Sembuh <?= $indo['meninggal'] ?> Died</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-flag fa-4x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php endforeach; ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
<div class="row">
    <div class="col-lg-6">
        <?= $this->session->flashdata('message'); ?>
    </div>
</div>

<div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="<?= base_url('assets/img/profile/') . $user['gambar']; ?>" class="card-img">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= $user['nama_lengkap']; ?></h5>
                <p class="card-text"><?= $user['email']; ?></p>
                <p class="card-text"><small class="text-muted">Admin Since <?= date('d F Y', $user['date_created']); ?></small></p>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->