<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Buku Pasien 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Siap Untuk Logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Klik "Logout" Dibawah ini Jika Anda Keluar Dari Halaman Ini.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/Logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>assets/js/demo/datatables-demo.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

<script>
    $(document).ready(function() {
        // untuk diubah
        $('#Edit_pasien').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget)
            var modal = $(this)
            // isi 
            modal.find('#nomor').attr("value", div.data('nomor'));
            modal.find('#nama').attr("value", div.data('nama'));
            modal.find('#huruf').attr("value", div.data('huruf'));

        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#EditUser').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget)
            var modal = $(this)

            modal.find('#id').attr("value", div.data('id'));
            modal.find('#email').attr("value", div.data('email'));
            modal.find('#nama_lengkap').attr("value", div.data('nama_lengkap'));
            modal.find('#rule_id').attr("value", div.data('rule_id'));
            modal.find('#is_actived').attr("value", div.data('is_actived'));
        });
    });


    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });



    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const ruleId = $(this).data('rule');

        $.ajax({
            url: "<?= base_url('admin/ganti_akses'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                ruleId: ruleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/ruleakses/') ?>" + ruleId;
            }
        });

    });

    $('.cek_pasien').on('click', function() {
        var nama = $(this).data('nama');
        var nomor = $(this).data('nomor');
        var huruf = $(this).data('huruf');

        $.ajax({
            url: "<?= base_url('pasien/tambah_riwayat_pasien'); ?>",
            type: 'post',
            data: {
                nama: nama,
                nomor: nomor,
                huruf: huruf
            },
            success: function() {
                document.location.href = "<?= base_url('pasien/data_pasien') ?>";
            }
        });

    });

    $(document).ready(function() {
        // untuk dibubah
        $('#EditSubmenu').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget)
            var modal = $(this)

            // isi nilai pada input
            modal.find('#id').attr("value", div.data('id'));
            modal.find('#title').attr("value", div.data('title'));
            modal.find('#menu_id').attr("value", div.data('menu'));
            modal.find('#url').attr("value", div.data('url'));
            modal.find('#icon').attr("value", div.data('icon'));
            modal.find('#is_active').attr("value", div.data('is_active'));
        })
    });

    $(document).ready(function() {
        // untuk diubah
        $('#Edit_menu').on('show.bs.modal', function(event) {
            var div = $(event.relatedTarget)
            var modal = $(this)

            // isi 
            modal.find('#id').attr("value", div.data('id'));
            modal.find('#menu').attr("value", div.data('menu'));

        });
    });

    $('.check-centang').on('click', function() {
        const menuId = $(this).data('menu');
        const ruleId = $(this).data('rule');

        $.ajax({
            url: "<?= base_url('pasien/tambahkeriwayat'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                ruleId: ruleId
            },
            success: function() {
                document.location.href = "<?= base_url('pasien/riwayat_pasien/') ?>" + ruleId;
            }
        });

    });
</script>

</body>

</html>