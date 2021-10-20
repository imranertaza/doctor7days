<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
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
                <a href="<?php echo base_url('Hospital_admin/docavailableday')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Docavailableday</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/doctor')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Doctor</p>
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
                <a href="<?php echo base_url('Hospital_admin/invoice')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Invoice</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/patient')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Patient</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/role')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Role</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/specialist')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Specialist</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Hospital_admin/users')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Users</p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>