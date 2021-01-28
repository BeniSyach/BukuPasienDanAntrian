<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Penyebaran Virus Corona Di Sumatera Utara</h1>


    <!-- /.container-fluid -->

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

<?= $this->session->flashdata('message'); ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Buku Pasien Rizky</h6>
        </div>
        <div class="card-body">

            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Email User</th>
                        <th scope="col">Nama User</th>
                        <th scope="col">Level User</th>
                        <th scope="col">Aktif User</th>
                        <th scope="col">Dibuat Pada Tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pengguna as $p) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $p['email'] ?></td>
                            <td><?= $p['nama_lengkap'] ?></td>
                            <td><?= $p['role'] ?></td>
                            <?php if ($p['is_actived'] == 1) {
                                echo '<td>Aktif</td>';
                            } else {
                                echo '<td>Tidak Aktif</td>';
                            } ?>
                            <td><?= date('d F Y', $p['date_created']) ?></td>
                            <td>
                                <a class="badge badge-success" data-toggle="modal" data-target="#EditUser" href="javascript;" data-id="<?= $p['id'] ?>" data-email="<?= $p['email'] ?>" data-nama_lengkap="<?= $p['nama_lengkap'] ?>" data-rule_id="<?= $p['role'] ?>" data-is_activated="<?= $p['is_actived'] ?>">Edit</a>
                                <a class="badge badge-danger" href="<?= base_url('admin/hapus_user/' . $p['date_created']) ?>" onclick="return confirm('Anda Yakin Menghapus Data Pasien Ini ?')">Hapus</a>
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
<!-- End of Main Content -->

<!-- Modal Ubah User-->
<div class="modal fade" id="EditUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/edit_user'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" id="email" name="email" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap....">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="rule_id" id="rule_id">
                            <option value="">Rule User....</option>
                            <option value="1">Admin</option>
                            <option value="2">Member</option>
                            <option value="3">Umum</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="is_actived" id="is_actived">
                            <option value="">Aktif User....</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Edit User</button>
                </div>
            </form>
        </div>
    </div>
</div>