<section class="footer">
    <div class="row fixed-bottom  foot pt-3">
        <div class="col-4">
            <a class="nav-link" href="#"><i class="flaticon-menu iconfoot"></i></a>
        </div>
        <div class="col-4 text-center">
            <div class="f-home mt-1 mb-1">
                <a class="nav-link" href="<?php echo base_url('Mobile_app/home')  ?>"><i class="flaticon-home iconhome"></i></a>
            </div>
        </div>
        <div class="col-4 text-right dropdown">
            <a class="nav-link " data-toggle="dropdown" href="#"><i class="flaticon-user iconfoot"></i></a>
            <?php if (newSession()->isAmbulanceLogin == true){?>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="<?php echo base_url('Mobile_app/Ambulance_dashboard/');?>">Dashboard</a>
                <a class="dropdown-item" href="<?php echo base_url('Mobile_app/Ambulance_dashboard/profile');?>">Profile</a>
                <a class="dropdown-item " href="<?php echo base_url('Mobile_app/Ambulance/logout');?>">Logout</a>
            </div>
            <?php }?>
        </div>
    </div>
</section>
</div>


<!--all custome js-->
<?php  require_once(APPPATH.'../public_html/assets/js/ajaxJs.php'); ?>

</body>
</html>