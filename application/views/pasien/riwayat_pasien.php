 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Riwayat Buku Pasien</h6>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable">
                     <thead>
                         <tr>
                             <th>Nomor Buku Pasien</th>
                             <th>Nama Pasien</th>
                             <th>Huruf Pasien</th>
                             <th>Tanggal Datang Pasien</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php foreach ($pasien as $ps) : ?>
                             <tr>
                                 <td><?= $ps['nomor'] ?></td>
                                 <td><?= $ps['nama'] ?></td>
                                 <td><?= $ps['huruf'] ?></td>
                                 <td><?= date('d F Y', $ps['tanggal']) ?></td>
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