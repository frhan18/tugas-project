<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #3a3a3a;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIA APP</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- QUERY MENU -->
    <?php
    $role_id = $this->session->userdata('id_role');
    $query_menu = "SELECT `user_menu`.`id`,`menu`
                    FROM `user_menu`
                    JOIN `user_access_menu` ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                WHERE `user_access_menu`.`role_id`=$role_id
                ORDER BY `user_access_menu`.`menu_id` ASC";

    $menu = $this->db->query($query_menu)->result_array();

    ?>


    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <!-- looping sub menu -->
        <?php
        $menu_id = $m['id'];
        $querySubMenu = "SELECT *
                            FROM `user_sub_menu` 
                            JOIN `user_menu` ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                        WHERE `user_sub_menu`.`menu_id`=  $menu_id
                        AND `user_sub_menu`.`is_active` = 1";

        $subMenu = $this->db->query($querySubMenu)->result_array();

        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <?php if ($sm['title'] == $title) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item ">
                <?php endif; ?>
                <a class="nav-link" href="<?= site_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            <?php endforeach; ?>
            <hr class="sidebar-divider">
        <?php endforeach; ?>



        <li class="nav-item">
            <a class="nav-link" href="<?= site_url('logout'); ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->