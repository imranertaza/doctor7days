<div class="sidebar card no-print" >
    <div class="card-body">
        <div class="card mb-2 text-center">
            <div class="card-body d-flex justify-content-center align-items-center">
                <?php  $photo = get_data_by_id('photo','ambulance_users','ambulance_user_id',newSession()->user_id);  if (!empty($photo)){ $profile = no_image_view('/assets/upload/ambulance/'.newSession()->user_id.'/'.$photo,'/assets/upload/ambulance/no_image.jpg',$photo); ?>
                    <img src="<?php echo $profile; ?>" alt="user" class="pro-img" >
                <?php }else{?>
                    <div class="af-pro ">
                        <i class="flaticon-user-1 sm-icon-2"></i>
                    </div>
                <?php } ?>


            </div>
            <p class="text-white text-capitalize"><?php echo  get_data_by_id('name','ambulance_users','ambulance_user_id',newSession()->user_id);?></p>
        </div>
        <ul class="list-group listUl">
            <li class="list-group-item "><a href="<?php echo base_url('Web/Ambulance/dashboard')?>">Dashboard</a></li>
            <li class="list-group-item"><a href="<?php echo base_url('Web/Ambulance/profile')?>">Profile</a></li>
            <li class="list-group-item"><a href="<?php echo base_url('Web/Ambulance/create')?>">Add Ambulance</a></li>
            <li class="list-group-item"><a href="<?php echo base_url('Web/Ambulance/logout');?>">logout</a></li>

        </ul>
    </div>
</div>