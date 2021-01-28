 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data Buku Pasien</h6>
         </div>
         <div class="card-body">
             <?php if (validation_errors()) : ?>
                 <div class="alert alert-danger" role="alert">
                     <?= validation_errors(); ?>
                 </div>
             <?php endif; ?>

             <?= $this->session->flashdata('message'); ?>

             <div class="table-responsive">
                 <!-- <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#TambahPasien">Tambah Data Pasien</button> -->
                 <table class="table table-bordered" id="dataTable">
                     <thead>
                         <tr>
                             <th>Nomor Buku Pasien</th>
                             <th>Centang</th>
                             <th>Nama Pasien</th>
                             <th>Huruf Pasien</th>
                             <!-- <th>Aksi</th> -->
                         </tr>
                     </thead>
                     <tbody>
                         <?php foreach ($pasien as $p) : ?>
                             <tr>
                                 <td><?= $p['nomor'] ?></td>
                                 <td>
                                     <div class="form-check">
                                         <input class="cek_pasien" type="checkbox" <?= cek_riwayat($riwayat['nama'], $p['nama']) ?> data-nomor="<?= $p['nomor'] ?>" data-nama="<?= $p['nama'] ?>" data-huruf="<?= $p['huruf'] ?>">
                                     </div>
                                 </td>
                                 <td><?= $p['nama'] ?></td>
                                 <td><?= $p['huruf'] ?></td>
                                 <!-- <td> -->
                                 <!-- <a class="badge badge-success" data-toggle="modal" data-target="#EditPasien" href="" data-id="<?= $p['id'] ?>" data-nama="<?= $p['nama'] ?>" data-huruf="<?= $p['huruf'] ?>" data-nomor="<?= $p['nomor'] ?>">Edit</a> -->
                                 <!-- <a class="badge badge-danger" href="">Hapus</a> -->
                                 <!-- </td> -->
                             </tr>
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

 <!-- Modal Tambah Pasien -->
 <!-- <div class="modal fade" id="TambahPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pasien</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= base_url('pasien/data_pasien'); ?>" method="POST">
                 <div class="modal-body">
                     <div class="form-group">
                         <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pasien......">
                     </div>
                     <div class="form-group">
                         <select class="form-control" name="huruf" id="huruf">
                             <option value="">Pilih Huruf</option>
                             <option value="data_pasien">A</option>
                             <option value="huruf_b">B</option>
                             <option value="huruf_c">C</option>
                             <option value="huruf_d">D</option>
                             <option value="huruf_e">E</option>
                             <option value="huruf_f">F</option>
                             <option value="huruf_g">G</option>
                             <option value="huruf_h">H</option>
                             <option value="huruf_i">I</option>
                             <option value="huruf_j">J</option>
                             <option value="huruf_k">K</option>
                             <option value="huruf_l">L</option>
                             <option value="huruf_m">M</option>
                             <option value="huruf_n">N</option>
                             <option value="huruf_o">O</option>
                             <option value="huruf_p">P</option>
                             <option value="huruf_r">R</option>
                             <option value="huruf_s">S</option>
                             <option value="huruf_t">T</option>
                             <option value="huruf_u">U</option>
                             <option value="huruf_v">V</option>
                             <option value="huruf_w">W</option>
                             <option value="huruf_y">Y</option>
                             <option value="huruf_z">Z</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor Pasien...." readonly>
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                 </div>
             </form>
         </div>
     </div>
 </div> -->

 <!-- Modal edit pasien -->
 <!-- <div class="modal fade" id="EditPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Data Pasien</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="<?= base_url('pasien/edit_pasien'); ?>" method="POST">
                 <div class="modal-body">
                     <div class="form-group">
                         <input type="hidden" name="id" id="id">
                         <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pasien......">
                     </div>
                     <div class="form-group">
                         <select class="form-control" name="menu_id" id="menu_id">
                             <option value="">Select Menu</option>
                             <?php foreach ($menu as $m) : ?>
                                 <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                             <?php endforeach; ?>
                         </select>
                     </div>
                     <div class="form-group">
                         <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor Pasien....">
                     </div>

                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                 </div>
             </form>
         </div>
     </div>
 </div> -->