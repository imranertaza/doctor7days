<div class="sidebar card" >
    <div class="card-body">
        <div class="card mb-2 text-center">
            <div class="card-body d-flex justify-content-center align-items-center">
                <?php  $photo = get_data_by_id('photo','patient','pat_id',newSession()->Patient_user_id);  if (!empty($photo)){?>
                    <img src="<?php echo base_url('assets/upload/patient/'.newSession()->Patient_user_id.'/'.$photo)?>" alt="user" class="pro-img" >
                <?php }else{?>
                    <div class="af-pro ">
                        <i class="flaticon-user-1 sm-icon-2"></i>
                    </div>
                <?php } ?>


            </div>
            <p class="text-white"><?php echo  get_data_by_id('name','patient','pat_id',newSession()->Patient_user_id);?></p>
        </div>
        <ul class="list-group listUl">
            <li class="list-group-item "><a href="<?php echo base_url('Web/Dashboard')?>">Dashboard</a></li>
            <li class="list-group-item"><a href="<?php echo base_url('Web/Profile')?>">Profile</a></li>
            <li class="list-group-item"><a href="">Order List</a></li>
            <li class="list-group-item"><a href="">Inbox <span class="badge badge-primary badge-pill">14</span></a></li>
        </ul>
    </div>
</div>