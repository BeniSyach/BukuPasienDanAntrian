<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <form action="<?= base_url('user/ganti_password'); ?>" method="POST">
                <div class="form-group">
                    <label for="password_sekarang">Password Saat ini</label>
                    <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Masukkan password saat ini..."><?= form_error('password_lama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="password_1">Password baru</label>
                    <input type="password" class="form-control" id="password_1" name="password_1" placeholder="Masukkan password baru..."><?= form_error('password_1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="password_2">Ulangi Password baru</label>
                    <input type="password" class="form-control" id="password_2" name="password_2" placeholder="Ulangi password baru..."><?= form_error('password_2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->