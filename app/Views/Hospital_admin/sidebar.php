<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
            <a href="#" class="d-block"><?php echo hospitalName();?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item ">
                <a href="<?php echo base_url('Hospital_admin/dashboard')?>" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/appointment')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Appointment</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/doctor')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Doctor</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/test')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Tests</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/gensettings')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Gensettings</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/globaladdress')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Global Address</p>
                </a>
            </li>



            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/role')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Role</p>
                </a>
            </li>
            


            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/users')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Users</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/job')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Job</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/Products')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Products</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/Order')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Order</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>Admanage <i class="right fas fa-angle-left"></i> </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">

                    <li class="nav-item">
                        <a href="<?php echo base_url('Hospital_admin/Admanagement')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ad Management</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('Hospital_admin/Admanagement/package')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ad Package</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/Settings')?>" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>Settings</p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>