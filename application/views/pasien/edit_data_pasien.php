   <div class="container-fluid">
       <div class="card shadow mb-4">
           <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Edit Data Buku Pasien</h6>
           </div>
           <div class="card-body">


               <table class="table table-hover" id="dataTable">
                   <thead>
                       <tr>
                           <th>Nomor</th>
                           <th>Huruf Depan Pasien</th>
                           <th>Aksi</th>

                       </tr>
                   </thead>
                   <tbody>
                       <?php foreach ($huruf as $hrf) : ?>
                           <tr>
                               <td><?= $hrf['id'] ?></td>
                               <td><?= $hrf['huruf'] ?></td>
                               <td><a href="<?= base_url('pasien/editpasien/' . $hrf['id']) ?>" class="badge badge-success">Detail</a></td>
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