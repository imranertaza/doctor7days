<div class="sidebar card no-print" >
    <div class="card-body">
        <div class="card mb-2 text-center">
            <div class="card-body d-flex justify-content-center align-items-center">
                <?php  $photo = get_data_by_id('photo','patient','pat_id',newSession()->Patient_user_id);  if (!empty($photo)){ $profile = no_image_view('/assets/upload/patient/'.newSession()->Patient_user_id.'/'.$photo,'/assets/upload/patient/no_image.jpg',$photo);?>
                    <img src="<?php echo $profile; ?>" alt="user" class="pro-img" >
                <?php }else{?>
                    <div class="af-pro ">
                        <i class="flaticon-user-1 sm-icon-2"></i>
                    </div>
                <?php } ?>


            </div>
            <p class="text-white text-capitalize"><?php echo  get_data_by_id('name','patient','pat_id',newSession()->Patient_user_id);?></p>
        </div>
        <ul class="list-group listUl">
            <li class="list-group-item "><a href="<?php echo base_url('Web/Dashboard')?>">Dashboard</a></li>
            <li class="list-group-item"><a href="<?php echo base_url('Web/Profile')?>">Profile</a></li>
            <li class="list-group-item"><a href="<?php echo base_url('Web/OrderList')?>">Order List</a></li>
            <li class="list-group-item"><a href="<?php echo base_url('Web/Inbox')?>">Inbox <?php $count = count_patient_notification(newSession()->Patient_user_id); if ($count != 0){?>
                        <span class="badge badge-primary badge-pill"><?php echo $count; ?></span>
                    <?php } ?></a></li>
        </ul>
    </div>
</div>