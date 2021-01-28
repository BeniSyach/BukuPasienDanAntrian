<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('nama', '<div class="alert alert-danger" role="alert">', '
          </div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <a class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal" href="">Tambah Pasien Baru</a>

            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No. pasien</th>
                        <th scope="col">nama Pasien</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pasien as $p) : ?>
                        <tr>
                            <td><?= $p['nomor'] ?></td>
                            <td><?= $p['nama'] ?></td>
                            <td>
                                <a class="badge badge-success" data-toggle="modal" data-target="#Edit_pasien" href="javascript;" data-nama="<?= $p['nama'] ?>" data-huruf="<?= $p['huruf'] ?>" data-nomor="<?= $p['nomor'] ?>">Edit</a>
                                <a class="badge badge-danger" href="<?= base_url('pasien/hapuspasien_f/' . $p['id']) ?>" onclick="return confirm('Anda Yakin Menghapus Data Pasien Ini ?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal Tambah data pasien -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pasien Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pasien/editpasien/' . 6); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor Pasien...." value="<?= $nomor['nomor'] + 1 ?>" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pasien....">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Data Pasien</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data Pasien -->
<div class="modal fade" id="Edit_pasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Nama Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pasien/ubahpasien'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor Pasien....">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pasien....">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="huruf" name="huruf" placeholder="huruf Depan Pasien...." readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah Data Pasien</button>
                </div>
            </form>
        </div>
    </div>
</div>