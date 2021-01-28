<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon ">
            <i class="fas fa-hospital-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Apotek Rizky</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Query Menu -->
    <?php
    $rule_id = $this->session->userdata('rule_id');
    $queryMenu = "select `user_menu`.`id`,`menu` from `user_menu` join `user_access_menu` on `user_menu`.`id` = `user_access_menu`.`menu_id` where `user_access_menu`.`rule_id` = $rule_id order by `user_access_menu`.`menu_id` asc ";
    $menu = $this->db->query($queryMenu)->result_array();

    ?>

    <!-- looping menu -->
    <?php
    foreach ($menu as $m) :
    ?>

        <!-- Heading -->
        <div class="sidebar-heading">
            <?= $m['menu'] ?>
        </div>

        <!-- Menampilkan Sub menu -->
        <?php
        $menu_id = $m['id'];
        $querySubmenu = "select * from `user_sub_menu` join `user_menu` on `user_sub_menu`.`menu_id` = `user_menu`.`id` where `user_sub_menu`.`menu_id` = $menu_id and `user_sub_menu`.`is_active`=1";

        $subMenu = $this->db->query($querySubmenu)->result_array();
        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <!-- Nav Item - Dashboard -->
            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon'] ?>"></i>
                    <span><?= $sm['title'] ?></span></a>
                </li>

            <?php endforeach; ?>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">

        <?php endforeach; ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/Logout'); ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler Sidebar -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->