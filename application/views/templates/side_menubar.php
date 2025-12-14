<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">

            <!-- Dashboard -->
            <li id="dashboardMainMenu">
                <a href="<?php echo base_url('dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>accueil</span>
                </a>
            </li>
            <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li class="treeview" id="mainGroupNav">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Groups</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> Add Group</a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> Manage Groups</a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
            <?php if($user_permission): ?>
                <!-- Users -->
                <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                    <li class="treeview" id="mainUserNav">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Users</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php if(in_array('createUser', $user_permission)): ?>
                                <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> Add User</a></li>
                            <?php endif; ?>

                            <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                                <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> Manage Users</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Emp -->
                <?php if(in_array('createEmp', $user_permission) || in_array('updateEmp', $user_permission) || in_array('viewEmp', $user_permission) || in_array('deleteEmp', $user_permission)): ?>
                    <li id="emplacementNav">
                        <a href="<?php echo base_url('emplacement/') ?>">
                            <i class="fa fa-files-o"></i> <span>Emplacement</span>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Arts -->
                <?php if(in_array('createArt', $user_permission) || in_array('updateArt', $user_permission) || in_array('viewArt', $user_permission) || in_array('deleteArt', $user_permission)): ?>
                    <li id="artstockNav">
                        <a href="<?php echo base_url('artstock/') ?>">
                            <i class="glyphicon glyphicon-tags"></i> <span>article stock</span>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Stocks -->
                <?php if(in_array('createStock', $user_permission) || in_array('updateStock', $user_permission) || in_array('viewStock', $user_permission) || in_array('deleteStock', $user_permission)): ?>
                    <li id="stockNav">
                        <a href="<?php echo base_url('stock/') ?>">
                            <i class="fa fa-cube"></i> <span>article</span>
                        </a>
                    </li>
                <?php endif; ?>

                

                <!-- Settings -->
                <?php if(in_array('viewProfile', $user_permission)): ?>
                    <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span>Profile</span></a></li>
                <?php endif; ?>
                <?php if(in_array('updateSetting', $user_permission)): ?>
                    <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span>Setting</span></a></li>
                <?php endif; ?>

            <?php endif; ?>
            <!-- Logout -->
            <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Logout</span></a></li>
        </ul>
    </section>
</aside>
