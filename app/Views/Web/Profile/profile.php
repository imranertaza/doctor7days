<!-- services area  -->
<section class="area-hight">
    <div class="container">
        <div class="service-inner">
            <div class="row">
                <div class="col-md-4">
                    <?php echo $sidebar;?>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Profile</h4>

<!--                            <center><h5 class="card-title mb-3">Appointment List</h5></center>-->
                            <div class="row ">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <?php  if (!empty($patient->photo)){?>
                                        <img src="<?php echo base_url('assets/upload/patient/'.$patient->pat_id.'/'.$patient->photo)?>" alt="user" class="pro-img" >
                                    <?php }else{?>
                                        <div class="af-pro ">
                                            <i class="flaticon-user-1 sm-icon-2"></i>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="col-3"> </div>
                                <div class="col-6">
                                    <div class="input-group mb-3 pt-5">
                                        <input type="text" class="form-control" name="name"  placeholder="Name" required>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" name="phone"  placeholder="Phone Number" required>
                                    </div>
                                </div>
                                <div class="col-3"> </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- services area  end-->