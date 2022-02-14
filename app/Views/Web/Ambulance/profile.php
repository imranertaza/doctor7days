<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-inner">
            <div class="row">
                <div class="col-md-4">
                    <?php echo $sidebar; ?>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <h4 class="card-title">Profile Edit</h4>

                                    <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                        <?php echo session()->getFlashdata('message'); ?>
                                    <?php endif; ?>
                                </div>

                                <div class="col-12 d-flex justify-content-center align-items-center" >

                                    <?php  $photo = get_data_by_id('photo','ambulance_users','ambulance_user_id',newSession()->user_id);  if (!empty($photo)){ $profile = no_image_view('/assets/upload/ambulance/'.newSession()->user_id.'/'.$photo,'/assets/upload/ambulance/no_image.jpg',$photo);?>
                                        <img src="<?php echo $profile;?>" alt="user" class="pro-img" >
                                    <?php }else{?>
                                        <div class="af-pro ">
                                            <i class="flaticon-user-1 sm-icon-2"></i>
                                        </div>
                                    <?php } ?>

                                </div>

                                <div class="col-3 "></div>
                                <div class="col-6 ">
                                    <form action="<?php echo base_url('Web/Ambulance/profile_action')?>" method="post" enctype="multipart/form-data" >

                                        <div class="form-group">
                                            <label for="photo" class="lab-t"> Image </label>
                                            <input type="file" class="form-control in-c" name="photo">
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="lab-t">Name</label>
                                            <input class="form-control in-c" name="name" value="<?php echo $user->name; ?>" required>

                                        </div>

                                        <div class="form-group">
                                            <label for="mobile" class="lab-t">Phone</label>
                                            <input type="number" class="form-control in-c" name="mobile" value="<?php echo $user->mobile; ?>"
                                                   required>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="lab-t">Password</label>
                                            <input type="password" class="form-control in-c" name="password">
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info">Update</button>
                                        </div>

                                    </form>
                                </div>
                                <div class="col-3 "></div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- services area  end-->