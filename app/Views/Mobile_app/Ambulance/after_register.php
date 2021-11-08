

<section class="category mt-5">
    <div class="row ">
        <div class="col-12 text-center">
            <img src="<?php echo base_url('assets/mobile/image/ambulance.png')?>" width="300">
        </div>
        
    </div>
</section>

<section class="banner">
    
        <div class="row">
            <div class="col-12 p-3 mt-3 in-fil text-center">
                <?php if (!empty($image)){?>
                    <center>
                        <img src="<?php echo base_url('assets/uplode/ambulance_user/'.$image)?>" alt="user" class="pro-img" >
                    </center>
                <?php }else{?>
                <div class="af-pro">
                    <i class="flaticon-user-1 sm-icon-2"></i>
                </div>
                <?php } ?>
                <p><?php echo newSession()->name; ?></p>
                <a href="<?php echo  base_url('Mobile_app/Ambulance_dashboard/add_ambulance')?>" class="btn-ambu">Add Ambulance</a>

            </div>


        </div>
    

</section>