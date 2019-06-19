 <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php 
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT `user_menu`.`id`, `menu`
                            FROM `user_menu` JOIN `user_access_menu`
                              ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                           WHERE `user_access_menu`.`role_id` = $role_id
                        ORDER BY `user_access_menu`.`menu_id` ASC
                        ";
            $menu = $this->db->query($queryMenu)->result_array();
            //var_dump($menu);
            ?>

      <?php foreach ($menu as $m) : ?>
          


        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span><?= $m['menu']; ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>

          <?php 
            $menuId = $m['id'];
            $querySubMenu = "SELECT *
                               FROM `user_sub_menu` JOIN `user_menu` 
                                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                              WHERE `user_sub_menu`.`menu_id` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                        ";
            $subMenu = $this->db->query($querySubMenu)->result_array();
            //var_dump($subMenu);
            ?>

            <ul class="treeview-menu">
          <?php foreach ($subMenu as $sm) : ?>
            
                <li>
                    <a href="<?= base_url($sm['url']); ?>"><i class="fa fa-circle-o"></i><?= $sm['title']; ?></a>
                        
                        
                </li>
              
          <?php endforeach; ?>
          </ul>

            

      <?php endforeach; ?>

            <li>
                <a href="<?= base_url('auth/logout'); ?>">
                    <i class="fa fa-sign-out"></i>
                    <span>Logout</span></a>
            </li>
          
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->