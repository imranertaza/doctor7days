<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><?php echo superAdminName();?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item ">
                <a href="<?php echo base_url('Super_admin/dashboard')?>" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/invoice')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Invoice</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/patient')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Patient</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>Admanage <i class="right fas fa-angle-left"></i> </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                    <li class="nav-item">
                        <a href="<?php echo base_url('Super_admin/Adcompany')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ad Company</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('Super_admin/Adpackage')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ad Package</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url('Super_admin/Admanagement')?>" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ad Management</p>
                        </a>
                    </li>
<!--                    <li class="nav-item">-->
<!--                        <a href="#" class="nav-link">-->
<!--                            <i class="far fa-circle nav-icon"></i>-->
<!--                            <p>Ad Place</p>-->
<!--                        </a>-->
<!--                    </li>-->
                </ul>
            </li>


<!--            <li class="nav-item">-->
<!--                <a href="--><?php //echo base_url('Super_admin/admanage')?><!--" class="nav-link">-->
<!--                    <i class="nav-icon fas fa-th"></i>-->
<!--                    <p>Admanage</p>-->
<!--                </a>-->
<!--            </li>-->
            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/ambulance')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Ambulance</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/blogpost')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Blog Post</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/blogsettings')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Blog Settings</p>
                </a>
            </li>



            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/hospital')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Hospital</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/indianhospital')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Indian Hospital</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/indianhospital/appointment')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Indian appointment list</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/hospitalcategory')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Hospital Category</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/specialist')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Specialist</p>
                </a>
            </li>


            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/Orders')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Orders</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/paymentMethod')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Payment Method</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/product')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Product</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/productCategory')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Product Category</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/brand')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Brand</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/store')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Store</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/Message')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Message</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?php echo base_url('Super_admin/Settings')?>" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>Settings</p>
                </a>
            </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>